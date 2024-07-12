<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    function datatable()
    {
        $data = Branch::query();

        return DataTables::of($data)->addIndexColumn()->toJson();
    }

    function store(BranchRequest $request)
    {
        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $branch                 = new Branch();
            $branch->name           = $request->name;
            $branch->phone          = $request->phone;
            $branch->address        = $request->address;
            $branch->created_at     = $date;
            $branch->updated_at     = $date;
            $branch->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $branch->name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function detail(Branch $branch)
    {
        return ResponseFormatter::success($branch->makeHidden(['id', 'created_at', 'updated_at', 'deleted_at']));
    }

    function update(BranchRequest $request, Branch $branch)
    {
        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $branch->name           = $request->name;
            $branch->phone          = $request->phone;
            $branch->address        = $request->address;
            $branch->updated_at     = $date;
            $branch->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $branch->name,
            ], null, ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function delete(Branch $branch)
    {
        DB::beginTransaction();
        try {
            $branch->delete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function destroy(Branch $branch)
    {
        DB::beginTransaction();
        try {
            $branch->forceDelete();
            DB::commit();

            return ResponseFormatter::success(null, null, ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }
}
