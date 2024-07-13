<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    function datatable()
    {
        $user = Auth::user();
        $data = Branch::query()->select('id', 'name', 'phone', 'address', 'main_branch', 'status')
        ->filterByCompany($user->company_id);

        return DataTables::of($data)->addIndexColumn()->toJson();
    }

    function store(BranchRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $date = Carbon::now()->timezone(config('app.timezone'));

            $branch                 = new Branch();
            $branch->company_id     = $user->company_id;
            $branch->name           = $request->name;
            $branch->phone          = $request->phone;
            $branch->address        = $request->address;
            $branch->status         = Branch::STATUS_ACTIVE;
            $branch->main_branch    = $request->is_main;
            $branch->created_at     = $date;
            $branch->updated_at     = $date;
            $branch->save();

            if($request->is_main == Branch::IS_MAIN){ // jika request yg baru sudah menjadi main branch, maka yg lain harus di keluarkan dari main branch
                $newId = $branch->id;
                Branch::filterNotById($newId)->update(['main_branch' => Branch::IS_NOT_MAIN]);
            }

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
        $user = Auth::user();
        if($user->company_id != $branch->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }
        return ResponseFormatter::success($branch->makeHidden(['id', 'created_at', 'updated_at', 'deleted_at', 'company_id']));
    }

    function update(BranchRequest $request, Branch $branch)
    {
        $user = Auth::user();
        if($user->company_id != $branch->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $branch->name           = $request->name;
            $branch->phone          = $request->phone;
            $branch->address        = $request->address;
            $branch->status         = $request->status;
            $branch->main_branch    = $request->is_main;
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
        $user = Auth::user();
        if($user->company_id != $branch->company_id){
            return ResponseFormatter::error(__('message.unauthorized'), ResponseFormatter::$errorUnauthorized);
        }

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
