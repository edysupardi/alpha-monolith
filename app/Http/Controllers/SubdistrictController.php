<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestSubdistrictAll;
use App\Services\Subdistrict\SubdistrictService;

class SubdistrictController extends Controller
{
    private SubdistrictService $subdistrictService;
    public function __construct(SubdistrictService $subdistrictService)
    {
        $this->subdistrictService = $subdistrictService;
        parent::__construct();
    }

    public function detail($id)
    {
        $result = $this->subdistrictService->detail($id);
        return $this->response($result);
    }

    public function all(RequestSubdistrictAll $request)
    {
        $result = $this->subdistrictService->getAll($request);
        return $this->response($result);
    }
}
