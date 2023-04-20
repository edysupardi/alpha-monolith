<?php

namespace App\Http\Controllers;

use App\Services\Branch\BranchService;
use Illuminate\Http\Request;

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
}
