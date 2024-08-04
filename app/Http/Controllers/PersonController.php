<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonRequest;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, DB};
use Yajra\DataTables\Facades\DataTables;

class PersonController extends Controller
{
    function datatable()
    {
        $user = Auth::user();
        $data = Person::query()->select('id', 'full_name', 'gender')->filterByCompany($user->company_id);

        return DataTables::of($data)->addIndexColumn()->toJson();
    }

    function store(PersonRequest $request)
    {
        DB::beginTransaction();
        try {
            $person = $this->_store($request);

            DB::commit();

            return ResponseFormatter::success([
                'full_name' => $person->full_name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function _store(PersonRequest $request){
        $user = Auth::user();
        $date = Carbon::now()->timezone(config('app.timezone'));

        $person                 = new Person();
        $person->company_id     = $user->company_id;
        $person->full_name      = $request->full_name;
        $person->place_of_birth = $request->place_of_birth;
        $person->date_of_birth  = $request->has('date_of_birth') ? date('Y-m-d', strtotime($request->date_of_birth)) : null;
        $person->gender         = $request->gender;
        $person->created_at     = $date;
        $person->updated_at     = $date;
        $person->save();

        return $person;
    }

    function detail(Person $person)
    {
        $user = Auth::user();
        if($user->company_id != $person->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }
        return ResponseFormatter::success($person->makeHidden([
            'id', 'created_at', 'updated_at', 'deleted_at', 'first_name', 'last_name', 'name_of_father', 'name_of_mother', 'languages', 'region_id', 'marital_status', 'last_education', 'gender', 'ethnic'
        ]));
    }

    function update(PersonRequest $request, Person $person)
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

            DB::commit();

            return ResponseFormatter::success([
                'full_name' => $person->full_name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function delete(Person $person)
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

    function destroy(Person $person)
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
