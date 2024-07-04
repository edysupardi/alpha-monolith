<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{
    function handle(SigninRequest $request)
    {
        if(Auth::attempt($request->only('username', 'password'))){
            $user           = Auth::user();
            $person         = $user->person;
            $key            = explode(":", config('app.key'))[1];
            $message        = __('message.signin_succes');
            $data           = [
                'token' => $user->createToken($key)->accessToken,
                'person' => [
                    'name'          => $person->full_name,
                ]
            ];
            return ResponseFormatter::success($data, $message);
        } else {
            return ResponseFormatter::error(__('auth.failed'), 404);
        }
    }
}
