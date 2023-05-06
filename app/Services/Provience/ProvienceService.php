<?php

namespace App\Services\Provience;

use App\Http\Requests\RequestProvienceAll;
use App\Services\InterfaceService;

interface ProvienceService extends InterfaceService{

    public function detail($id) : array;
    public function getAll(RequestProvienceAll $request = null) : array;
}
