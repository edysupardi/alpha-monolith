<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\DivisionUnitRequest;
use App\Models\DivisionUnit;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, DB};
use Yajra\DataTables\Facades\DataTables;

class DivisionUnitController extends Controller
{
    function datatable()
    {
        $user = Auth::user();
        $data = DivisionUnit::query()->select('id', 'name', 'is_can_loan_rm_file')
        ->with(['parent' => function($q){
            $q->select('id', 'name');
        }])
        ->filterByCompany($user->company_id);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('can_loan', function(DivisionUnit $d){
                return $d->is_can_loan_rm_file;
            })
            ->removeColumn('is_can_loan_rm_file')
            ->toJson();
    }

    function store(DivisionUnitRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $date = Carbon::now()->timezone(config('app.timezone'));

            $unit                       = new DivisionUnit();
            $unit->company_id           = $user->company_id;
            $unit->parent_id            = $request->parent;
            $unit->name                 = $request->name;
            $unit->is_can_loan_rm_file  = $request->can_loan;
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

    function detail(DivisionUnit $divisionUnit)
    {
        $user = Auth::user();
        if($user->company_id != $divisionUnit->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }
        $divisionUnit->can_loan = $divisionUnit->is_can_loan_rm_file;
        return ResponseFormatter::success($divisionUnit->makeHidden(['id', 'created_at', 'updated_at', 'deleted_at', 'company_id', 'is_can_loan_rm_file']));
    }

    function update(DivisionUnitRequest $request, DivisionUnit $divisionUnit)
    {
        $user = Auth::user();
        if($user->company_id != $divisionUnit->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $divisionUnit->parent_id            = $request->parent;
            $divisionUnit->name                 = $request->name;
            $divisionUnit->is_can_loan_rm_file  = $request->can_loan;
            $divisionUnit->updated_at           = $date;
            $divisionUnit->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $divisionUnit->name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function delete(DivisionUnit $divisionUnit)
    {
        $user = Auth::user();
        if($user->company_id != $divisionUnit->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $divisionUnit->delete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function destroy(DivisionUnit $divisionUnit)
    {
        $user = Auth::user();
        if($user->company_id != $divisionUnit->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $divisionUnit->forceDelete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }
}
