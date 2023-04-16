<?php

namespace App\Services\Provience;

use App\Http\Requests\RequestProvienceAll;
use LaravelEasyRepository\BaseService;

interface ProvienceService extends BaseService{

    public function detail($id) : array;
    public function getAll(RequestProvienceAll $request = null) : array;
}
