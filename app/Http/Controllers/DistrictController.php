<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestDistrictAll;
use App\Services\District\DistrictService;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    private DistrictService $districtService;
    public function __construct(DistrictService $districtService)
    {
        parent::__construct();
        $this->districtService = $districtService;
    }

    public function detail($id)
    {
        $result = $this->districtService->detail($id);
        return $this->response($result);
    }

    public function all(RequestDistrictAll $request)
    {
        $result = $this->districtService->getAll($request);
        return $this->response($result);
    }
}
