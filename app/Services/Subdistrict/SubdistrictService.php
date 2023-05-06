<?php

namespace App\Services\Subdistrict;

use App\Http\Requests\RequestSubdistrictAll;
use App\Services\InterfaceService;

interface SubdistrictService extends InterfaceService{

    public function detail($id) : array;
    public function getAll(RequestSubdistrictAll $request) : array;
}
