<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\OauthAccessToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SignoutController extends Controller
{
    function handle(int $userId)
    {
        // revoke token
        // $user = Auth::user();
        // $token = $user->token();
        // $token->revoke();

        // revoke session
        // Session::forget('token');
        // Session::forget('name');
        // Session::forget('company');
        // Session::forget('branch');
        // Session::flush();
        // return ResponseFormatter::success(null, __('auth.signout_success'));

        // get token by user id
        $token = OauthAccessToken::filterByUserId($userId)->delete();
        return ['success' => true];

    }
}
