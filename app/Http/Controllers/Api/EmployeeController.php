<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Person;
use App\Models\PersonIdentity;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, DB, Hash};
use PhpParser\Node\Expr\Empty_;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    function datatable()
    {
        $user = Auth::user();
        $data = Employee::query()->select('id', 'full_name', 'gender')->filterByCompany($user->company_id);

        return DataTables::of($data)->addIndexColumn()->toJson();
    }

    function store(EmployeeRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $date = Carbon::now()->timezone(config('app.timezone'));

            // check person by name, dob & identity number
            $person = $this->findExistsPerson($request, $user->company_id);
            // if not exists, create person
            if(!$person){
                $person                 = new Person();
                $person->company_id     = $user->company_id;
                $person->full_name      = $request->full_name;
                $person->place_of_birth = $request->place_of_birth;
                $person->date_of_birth  = $request->has('date_of_birth') ? date('Y-m-d', strtotime($request->date_of_birth)) : null;
                $person->gender         = $request->gender;
                $person->created_at     = $date;
                $person->updated_at     = $date;
                $person->save();

                // save identity
                $identity = new PersonIdentity();
                $identity->company_id           = $user->company_id;
                $identity->person_id            = $person->id;
                $identity->identity_number      = $request->identity_number;
                $identity->identity_type_id     = $request->identity_type_id;
                $identity->created_at           = $date;
                $identity->updated_at           = $date;
                $identity->save();
            }

            // check branch id
            $checkBranch = Branch::filterByCompany($user->company_id)->where('id', $request->branch_id)->exists();
            if(!$checkBranch){
                DB::rollBack();
                return ResponseFormatter::error('branch not found', ResponseFormatter::$error);
            }

            // add this person to employee
            $employee                   = new Employee();
            $employee->company_id       = $user->company_id;
            $employee->branch_id        = $request->branch_id;
            $employee->person_id        = $person->id;
            $employee->username         = $request->username;
            $employee->password         = Hash::make($request->password);
            $employee->status           = Employee::STATUS_ACTIVE;
            $employee->save();

            DB::commit();

            return ResponseFormatter::success([
                'full_name' => $person->full_name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    protected function findExistsPerson(EmployeeRequest $request, $companyId)
    {
        // find by name, date of birth and identity type + number
        return Person::filterByCompany($companyId)->filterByName($request->full_name)->filterByDob($request->date_of_birth)->whereHas('identities', function($q) use ($request){
            $q->filterByIdentityNumber($request->identity_number);
        })->first();
    }

    function detail(Employee $person)
    {
        $user = Auth::user();
        if($user->company_id != $person->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        $data = Employee::where('id', $person->id)->with([
            'identity' => function($q){
                $q->select('person_id', 'identity_number', 'identity_type_id')->with([
                    'identityType' => function($q){
                        $q->select('id', 'name');
                    }
                ]);
            }
        ])
        ->first()
        ->makeHidden([
            'id', 'created_at', 'updated_at', 'deleted_at', 'first_name', 'last_name', 'name_of_father', 'name_of_mother', 'languages', 'region_id', 'marital_status', 'last_education', 'gender', 'ethnic'
        ]);

        if($data->identity){
            $data->identity->makeHidden(['person_id', 'identity_type_id']);
            if($data->identity->identityType)
                $data->identity->identityType->makeHidden('id');
        }
        return ResponseFormatter::success($data);
    }

    function update(EmployeeRequest $request, Employee $person)
    {
        $user = Auth::user();
        if($user->company_id != $person->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $person->full_name      = $request->full_name;
            $person->place_of_birth = $request->place_of_birth;
            $person->gender         = $request->gender;
            if($request->has('date_of_birth'))
                $person->date_of_birth  = date('Y-m-d', strtotime($request->date_of_birth));
            $person->updated_at     = $date;
            $person->save();

            $identity = PersonIdentity::filterByEmployee($person->id)->filterByIdentityType($request->identity_type_id)->filterByIdentityNumber($request->identity_number)->first();
            // berarti tidak punya identity dengan id & identity number tersebut
            if(!$identity){
                $new = true;
                $identity = PersonIdentity::filterByEmployee($person->id)->filterByIdentityType($request->identity_type_id)->first();
                // punya identity dengan tipe tersebut, tapi beda number, berarti mau ganti number nya
                if($identity){
                    // update existing identity
                    $identity->identity_number      = $request->identity_number;
                    $identity->identity_type_id     = $request->identity_type_id;
                    $identity->updated_at           = $date;
                    $identity->save();
                    $new = false;
                }

                $identity = PersonIdentity::filterByEmployee($person->id)->filterByIdentityNumber($request->identity_number)->first();
                // punya identity dengan number tersebut, tapi beda type, berarti mau ganti type nya
                if($identity){
                    // update existing identity
                    $identity->identity_number      = $request->identity_number;
                    $identity->identity_type_id     = $request->identity_type_id;
                    $identity->updated_at           = $date;
                    $identity->save();
                    $new = false;
                }

                // buat baru
                if($new){
                    $identity = new PersonIdentity();
                    $identity->company_id           = $user->company_id;
                    $identity->person_id            = $person->id;
                    $identity->identity_number      = $request->identity_number;
                    $identity->identity_type_id     = $request->identity_type_id;
                    $identity->created_at           = $date;
                    $identity->updated_at           = $date;
                    $identity->save();
                }
            } else {
                // update existing identity
                $identity->identity_number      = $request->identity_number;
                $identity->identity_type_id     = $request->identity_type_id;
                $identity->updated_at           = $date;
                $identity->save();
            }

            DB::commit();

            return ResponseFormatter::success([
                'full_name' => $person->full_name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function delete(Employee $person)
    {
        $user = Auth::user();
        if($user->company_id != $person->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $person->delete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function destroy(Employee $person)
    {
        $user = Auth::user();
        if($user->company_id != $person->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $person->forceDelete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }
}
