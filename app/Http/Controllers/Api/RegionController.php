<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegionRequest;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, DB};
use Yajra\DataTables\Facades\DataTables;

class RegionController extends Controller
{
    function datatable()
    {
        $user = Auth::user();
        $data = Region::query()->select('id', 'name')->filterByCompany($user->company_id);

        return DataTables::of($data)->addIndexColumn()->toJson();
    }

    function store(RegionRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $date = Carbon::now()->timezone(config('app.timezone'));

            $unit                       = new Region();
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

    function detail(Region $region)
    {
        $user = Auth::user();
        if($user->company_id != $region->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }
        return ResponseFormatter::success($region->makeHidden(['id', 'created_at', 'updated_at', 'deleted_at', 'company_id']));
    }

    function update(RegionRequest $request, Region $region)
    {
        $user = Auth::user();
        if($user->company_id != $region->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $region->name                 = $request->name;
            $region->updated_at           = $date;
            $region->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $region->name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function delete(Region $region)
    {
        $user = Auth::user();
        if($user->company_id != $region->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $region->delete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function destroy(Region $region)
    {
        $user = Auth::user();
        if($user->company_id != $region->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $region->forceDelete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }
}
