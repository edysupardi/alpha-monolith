<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCompany;
use App\Services\Company\CompanyService;

class CompanyController extends Controller
{
    private CompanyService $mainService;
    public function __construct(CompanyService $mainService)
    {
        parent::__construct();
        $this->mainService = $mainService;
    }

    public function index()
    {
        return view('company.mine');
    }

    /**
     * API Service
     */

    public function show($encryptId)
    {
        $result = $this->mainService->getById($encryptId);
        return $this->response($result);
    }

    public function my()
    {
        $result = $this->mainService->myCompany();
        return $this->response($result);
    }

    public function updateMine(RequestCompany $request)
    {
        $result = $this->mainService->updateMine($request);
        return $this->response($result);
    }

    public function update($encryptId, RequestCompany $request)
    {
        $result = $this->mainService->customUpdate($encryptId, $request);
        return $this->response($result);
    }
}
