<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalRecordCategoryRequest;
use App\Models\MedicalRecordCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, DB};
use Yajra\DataTables\Facades\DataTables;

class MedicalRecordCategoryController extends Controller
{
    function datatable()
    {
        $user = Auth::user();
        $data = MedicalRecordCategory::query()->select('id', 'name')->filterByCompany($user->company_id);

        return DataTables::of($data)->addIndexColumn()->toJson();
    }

    function store(MedicalRecordCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $date = Carbon::now()->timezone(config('app.timezone'));

            $unit                       = new MedicalRecordCategory();
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

    function detail(MedicalRecordCategory $medicalRecordCategory)
    {
        $user = Auth::user();
        if($user->company_id != $medicalRecordCategory->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }
        return ResponseFormatter::success($medicalRecordCategory->makeHidden(['id', 'created_at', 'updated_at', 'deleted_at', 'company_id']));
    }

    function update(MedicalRecordCategoryRequest $request, MedicalRecordCategory $medicalRecordCategory)
    {
        $user = Auth::user();
        if($user->company_id != $medicalRecordCategory->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $medicalRecordCategory->name                 = $request->name;
            $medicalRecordCategory->updated_at           = $date;
            $medicalRecordCategory->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $medicalRecordCategory->name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function delete(MedicalRecordCategory $medicalRecordCategory)
    {
        $user = Auth::user();
        if($user->company_id != $medicalRecordCategory->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $medicalRecordCategory->delete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function destroy(MedicalRecordCategory $medicalRecordCategory)
    {
        $user = Auth::user();
        if($user->company_id != $medicalRecordCategory->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $medicalRecordCategory->forceDelete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }
}
