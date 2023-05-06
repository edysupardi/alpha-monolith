<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\ResponseFormatter;
use App\Traits\PrintLog;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, PrintLog;

    private $successCode = [200, 201, 202];

    public function __construct()
    {
        if(config('app.debug') == true) {
            DB::enableQueryLog();
        }
    }

    public function response($result){
        if(!array_key_exists('code', $result)){
            return ResponseFormatter::error(__('content.attr_code_not_exists'), 404);
        }
        $code       = $result['code'];
        $message    = array_key_exists('message', $result) ? $result['message'] : (in_array($code, [200, 201]) ? __('content.ok') : __('content.something_error'));
        $data       = [];

        if(isset($result['data'])){
            $data = $result['data'];
        }

        if(in_array($code, $this->successCode)){
            return ResponseFormatter::success($data, $message, $code);
        }
        return ResponseFormatter::error($message, $code, $data);
    }
}
