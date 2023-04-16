<?php

namespace App\Http\Controllers;

use App\Services\Provience\ProvienceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function all(Request $request)
    {
        $result = $this->provienceService->getAll($request);
        return $this->response($result);
    }
}
