<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{
    function authenticate(SigninRequest $request)
    {
        if(Auth::attempt($request->only('username', 'password'))){
            $user           = Auth::user();
            $person         = $user->person;
            // $permissions    = $user->getAllPermissions();
            $key            = explode(":", config('app.key'))[1];
            $message        = __('message.signin_succes');
            $data           = [
                'token' => Employee::TOKEN_TYPE . ' ' . $user->createToken('')->accessToken,
                'person' => [
                    'id'            => $person->id,
                    'name'          => $person->full_name,
                    'company_id'    => $person->company_id,
                ]
            ];
            return ResponseFormatter::success($data, $message);
        } else {
            return ResponseFormatter::error(__('auth.failed'), 404);
        }
    }
}
