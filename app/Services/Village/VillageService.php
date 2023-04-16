<?php

namespace App\Services\Village;

use App\Http\Requests\RequestVillageAll;
use LaravelEasyRepository\BaseService;

interface VillageService extends BaseService{

    public function detail($id) : array;
    public function getAll(RequestVillageAll $request) : array;
}
