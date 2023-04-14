<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\ResponseFormatter;
use App\Traits\PrintLog;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, PrintLog;

    private $successCode = [200, 201, 202];

    public function response($result){
        if(!array_key_exists('code', $result)){
            return ResponseFormatter::error(__('content.attr_code_not_exists'), 404);
        }
        $code       = $result['code'];
        $message    = $result['message'];
        $data       = null;

        if(isset($result['data'])){
            $data = $result['data'];
        }

        if(in_array($code, $this->successCode)){
            return ResponseFormatter::success($data, $message, $code);
        }
        return ResponseFormatter::error($message, $code);
    }
}
