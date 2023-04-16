<?php

namespace App\Services\Provience;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface ProvienceService extends BaseService{

    public function detail($id) : array;
    public function getAll(Request $request = null) : array;
}
