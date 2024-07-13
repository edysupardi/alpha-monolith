<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    function datatable()
    {
        $data = Company::query()->select('id', 'name', 'phone', 'address');

        return DataTables::of($data)->addIndexColumn()->toJson();
    }

    function store(CompanyRequest $request)
    {
        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $company                = new Company();
            $company->name          = $request->name;
            $company->phone         = $request->phone;
            $company->address       = $request->address;
            $company->created_at    = $date;
            $company->updated_at    = $date;
            $company->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $company->name,
            ], __('message.insert_success'), ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function detail(Company $company)
    {
        return ResponseFormatter::success($company->makeHidden(['id', 'created_at', 'updated_at', 'deleted_at']));
    }

    function update(CompanyRequest $request, Company $company)
    {
        DB::beginTransaction();
        try {
            $date = Carbon::now()->timezone(config('app.timezone'));

            $company->name          = $request->name;
            $company->phone         = $request->phone;
            $company->address       = $request->address;
            $company->updated_at    = $date;
            $company->save();

            DB::commit();

            return ResponseFormatter::success([
                'name' => $company->name,
            ], __('message.update_success'), ResponseFormatter::$successCreate);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function delete(Company $company)
    {
        DB::beginTransaction();
        try {
            $company->delete();
            DB::commit();

            return ResponseFormatter::success(null, __('message.delete_success'), ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }

    function destroy(Company $company)
    {
        DB::beginTransaction();
        try {
            $company->forceDelete();
            DB::commit();

            return ResponseFormatter::success(null, __('message.delete_success'), ResponseFormatter::$successDelete);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->defaultCatch($th);
        }
    }
}
