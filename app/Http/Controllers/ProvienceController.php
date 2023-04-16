<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestProvienceAll;
use App\Services\Provience\ProvienceService;

class ProvienceController extends Controller
{
    private ProvienceService $provienceService;
    public function __construct(ProvienceService $provienceService)
    {
        parent::__construct();
        $this->provienceService = $provienceService;
    }

    public function detail($id)
    {
        $result = $this->provienceService->detail($id);
        return $this->response($result);
    }

    public function all(RequestProvienceAll $request)
    {
        $result = $this->provienceService->getAll($request);
        return $this->response($result);
    }
}
