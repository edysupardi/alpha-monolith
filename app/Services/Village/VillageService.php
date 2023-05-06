<?php

namespace App\Services\Village;

use App\Http\Requests\RequestVillageAll;
use App\Services\InterfaceService;

interface VillageService extends InterfaceService{

    public function detail($id) : array;
    public function getAll(RequestVillageAll $request) : array;
}
