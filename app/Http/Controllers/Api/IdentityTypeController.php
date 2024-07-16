<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdentityTypeRequest;
use App\Models\IdentityType;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, DB};
use Yajra\DataTables\Facades\DataTables;

class IdentityTypeController extends Controller
{
    function datatable()
    {
        $user = Auth::user();
        $data = IdentityType::query()->select('id', 'name')->filterByCompany($user->company_id);

        return DataTables::of($data)->addIndexColumn()->toJson();
    }

    function store(IdentityTypeRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $date = Carbon::now()->timezone(config('app.timezone'));

            $unit                       = new IdentityType();
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

    function detail(IdentityType $identityType)
    {
        $user = Auth::user();
        if($user->company_id != $identityType->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }
        return ResponseFormatter::success($identityType->makeHidden(['id', 'created_at', 'updated_at', 'deleted_at', 'company_id']));
    }

    function update(IdentityTypeRequest $request, IdentityType $identityType)
    {
        $user = Auth::user();
        if($user->company_id != $identityType->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $identityType->name                 = $request->name;
            $identityType->updated_at           = $date;
            $identityType->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $identityType->name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function delete(IdentityType $identityType)
    {
        $user = Auth::user();
        if($user->company_id != $identityType->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $identityType->delete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function destroy(IdentityType $identityType)
    {
        $user = Auth::user();
        if($user->company_id != $identityType->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $identityType->forceDelete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }
}
