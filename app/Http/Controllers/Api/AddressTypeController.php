<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressTypeRequest;
use App\Models\AddressType;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, DB};
use Yajra\DataTables\Facades\DataTables;

class AddressTypeController extends Controller
{
    function datatable()
    {
        $user = Auth::user();
        $data = AddressType::query()->select('id', 'name')->filterByCompany($user->company_id);

        return DataTables::of($data)->addIndexColumn()->toJson();
    }

    function store(AddressTypeRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $date = Carbon::now()->timezone(config('app.timezone'));

            $unit                       = new AddressType();
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

    function detail(AddressType $addressType)
    {
        $user = Auth::user();
        if($user->company_id != $addressType->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }
        return ResponseFormatter::success($addressType->makeHidden(['id', 'created_at', 'updated_at', 'deleted_at', 'company_id']));
    }

    function update(AddressTypeRequest $request, AddressType $addressType)
    {
        $user = Auth::user();
        if($user->company_id != $addressType->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $addressType->name                 = $request->name;
            $addressType->updated_at           = $date;
            $addressType->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $addressType->name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function delete(AddressType $addressType)
    {
        $user = Auth::user();
        if($user->company_id != $addressType->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $addressType->delete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function destroy(AddressType $addressType)
    {
        $user = Auth::user();
        if($user->company_id != $addressType->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $addressType->forceDelete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }
}
