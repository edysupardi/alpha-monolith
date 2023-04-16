<?php

namespace App\Services\Subdistrict;

use App\Http\Requests\RequestSubdistrictAll;
use LaravelEasyRepository\BaseService;

interface SubdistrictService extends BaseService{

    public function detail($id) : array;
    public function getAll(RequestSubdistrictAll $request) : array;
}
