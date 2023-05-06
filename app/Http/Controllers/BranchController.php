<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Services\Branch\BranchService;

class BranchController extends Controller
{
    private BranchService $mainService;
    public function __construct(BranchService $mainService)
    {
        parent::__construct();
        $this->mainService = $mainService;
    }

    public function my()
    {
        $result = $this->mainService->myBranchs();
        return $this->response($result);
    }

    public function store(BranchRequest $request)
    {
        $result = $this->mainService->create($request->all());
        return $this->response($result);
    }

    public function detail($id)
    {
        $result = $this->mainService->getById($id);
        return $this->response($result);
    }

    public function update(String $encryptId, BranchRequest $request)
    {
        $result = $this->mainService->update($encryptId, $request->all());
        return $this->response($result);
    }

    public function delete(String $encryptId)
    {
        $result = $this->mainService->delete($encryptId);
        return $this->response($result);
    }
}
