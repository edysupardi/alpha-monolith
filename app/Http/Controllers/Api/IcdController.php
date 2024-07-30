<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\IcdRequest;
use App\Models\Icd;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, DB};
use Yajra\DataTables\Facades\DataTables;

class IcdController extends Controller
{
    function datatable()
    {
        $user = Auth::user();
        $data = Icd::query()->select('icd', 'name', 'parent_id', 'group')->with([
            'parent' => function($q){
                return $q->select('icd', 'name');
            }
        ])->filterByCompany($user->company_id);

        return DataTables::of($data)
            ->addIndexColumn()
            ->removeColumn('parent_id')
            ->toJson();
    }

    function store(IcdRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $date = Carbon::now()->timezone(config('app.timezone'));

            $data                       = new Icd();
            $data->company_id           = $user->company_id;
            $data->icd                  = $request->icd;
            $data->name                 = $request->name;
            $data->group                = $request->group;
            $data->parent_id            = $request->parent;
            $data->created_at           = $date;
            $data->updated_at           = $date;
            $data->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $data->name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function detail(Icd $icd)
    {
        $user = Auth::user();
        if($user->company_id != $icd->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        $data = $icd->with([
            'parent' => function($q){
                return $q->select('icd', 'name');
            }
        ])
        ->filterByIcd($icd->icd)
        ->select('icd', 'name', 'parent_id', 'group')->first();

        return ResponseFormatter::success($data);
    }

    function update(IcdRequest $request, Icd $icd)
    {
        $user = Auth::user();
        if($user->company_id != $icd->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $icd->name                 = $request->name;
            $icd->group                = $request->group;
            $icd->parent_id            = $request->parent;
            $icd->updated_at           = $date;
            $icd->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $icd->name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function delete(Icd $icd)
    {
        $user = Auth::user();
        if($user->company_id != $icd->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $icd->delete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function destroy(Icd $icd)
    {
        $user = Auth::user();
        if($user->company_id != $icd->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $icd->forceDelete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }
}
