<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{
    function handle(SigninRequest $request)
    {
        if(Auth::attempt($request->only('username', 'password'))){
            $user           = Auth::user();
            $person         = $user->person;
            $key            = explode(":", config('app.key'))[1];
            $token          = $user->createToken($key)->accessToken;

            $company        = $user->company;
            $companyName    = $company->name;
            $branch         = $user->branch;
            $branchName     = $branch->name;
            $name           = $person->full_name;
            $userId         = $user->id; // employee id
            $empId          = $person->id; // person id

            $data           = [
                'token' => $token,
                'person' => [
                    'name'          => $name,
                    'company'       => $companyName,
                    'branch'        => $branchName,
                ],
                'id' => [
                    'user'  => $userId,
                    'emp'   => $empId,
                ]
            ];

            // return ResponseFormatter::success($data, $message);
            return ['success' => true, 'data' => $data];
        } else {
            // return ResponseFormatter::error(__('auth.failed'), 404);
            return ['success' => false, 'message' => __('auth.failed')];
        }
    }
}
