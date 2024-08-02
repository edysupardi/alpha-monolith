<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmergencyContactTypeRequest;
use App\Models\EmergencyContactType;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, DB};
use Yajra\DataTables\Facades\DataTables;

class EmergencyContactTypeController extends Controller
{
    function datatable()
    {
        $user = Auth::user();
        $data = EmergencyContactType::query()->select('id', 'name')->filterByCompany($user->company_id);

        return DataTables::of($data)->addIndexColumn()->toJson();
    }

    function store(EmergencyContactTypeRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $date = Carbon::now()->timezone(config('app.timezone'));

            $unit                       = new EmergencyContactType();
            $unit->company_id           = $user->company_id;
            $unit->name                 = $request->name;
            $unit->created_at           = $date;
            $unit->updated_at           = $date;
            $unit->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $unit->name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function detail(EmergencyContactType $emergencyContactType)
    {
        $user = Auth::user();
        if($user->company_id != $emergencyContactType->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }
        return ResponseFormatter::success($emergencyContactType->makeHidden(['id', 'created_at', 'updated_at', 'deleted_at', 'company_id']));
    }

    function update(EmergencyContactTypeRequest $request, EmergencyContactType $emergencyContactType)
    {
        $user = Auth::user();
        if($user->company_id != $emergencyContactType->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $emergencyContactType->name                 = $request->name;
            $emergencyContactType->updated_at           = $date;
            $emergencyContactType->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $emergencyContactType->name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function delete(EmergencyContactType $emergencyContactType)
    {
        $user = Auth::user();
        if($user->company_id != $emergencyContactType->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $emergencyContactType->delete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function destroy(EmergencyContactType $emergencyContactType)
    {
        $user = Auth::user();
        if($user->company_id != $emergencyContactType->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $emergencyContactType->forceDelete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }
}
