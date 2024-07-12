<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // untuk mempermudah track error dari try catch
    public function defaultCatch($th)
    {
        $user   = Auth::user();
        $userId = $user ? $user->id : null;
        $this->logError($th->getMessage(), "user: {$userId}, trace: {$th->getTraceAsString()}" );

        $debug = config('app.debug');
        return ResponseFormatter::error( $debug ? $th->getMessage() : __('message.something_error') );
    }
}
