<?php

namespace App\Services\District;

use App\Http\Requests\RequestDistrictAll;
use LaravelEasyRepository\BaseService;

interface DistrictService extends BaseService{

    public function detail($id) : array;
    public function getAll(RequestDistrictAll $request) : array;
}
