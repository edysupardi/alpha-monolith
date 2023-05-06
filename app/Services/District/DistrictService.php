<?php

namespace App\Services\District;

use App\Http\Requests\RequestDistrictAll;
use App\Services\InterfaceService;

interface DistrictService extends InterfaceService{

    public function detail($id) : array;
    public function getAll(RequestDistrictAll $request) : array;
}
