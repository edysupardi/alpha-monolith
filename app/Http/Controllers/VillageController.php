<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestVillageAll;
use App\Services\Village\VillageService;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    private VillageService $villageService;
    public function __construct(VillageService $villageService)
    {
        $this->villageService = $villageService;
        parent::__construct();
    }

    public function detail($id)
    {
        $result = $this->villageService->detail($id);
        return $this->response($result);
    }

    public function all(RequestVillageAll $request)
    {
        $result = $this->villageService->getAll($request);
        return $this->response($result);
    }
}
