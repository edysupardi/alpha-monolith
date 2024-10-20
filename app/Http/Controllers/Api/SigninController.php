<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SigninController extends Controller
{
    function handle(SigninRequest $request)
    {
        if(Auth::attempt($request->only('username', 'password'))){
            $user           = Auth::user();
            $user->tokens()->delete(); // menghapus token yang lama

            $person         = $user->person;
            $key            = explode(":", config('app.key'))[1];
            $token          = $user->createToken($key)->plainTextToken;

            $company        = $user->company;
            $companyName    = $company->name;
            $branch         = $user->branch;
            $branchName     = $branch->name;
            $name           = $person->full_name;
            $userId         = $user->id; // employee id
            $empId          = $person->id; // person id

            // save token to cookie to speed access on client
            $cookie = cookie('api_token', $token, config('session.lifetime'), null, config('sanctum.stateful_domain'), true, true, false, 'Strict');

            // save session to use on web route
            Session::put('token',        $token);
            Session::put('name',         $name);
            Session::put('company',      $companyName);
            Session::put('branch',       $branch);
            Session::put('id',           $userId);
            Session::put('employee_id',  $empId);

            if(config('app.env') === 'production'){
                $data           = [
                    'person'    => [
                        'name'      => $name,
                        'company'   => $companyName,
                        'branch'    => $branchName,
                    ]
                ];
            } else {
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
            }

            return ResponseFormatter::success($data)->cookie($cookie);
        } else {
            return ResponseFormatter::error(__('auth.failed'), 400);
        }
    }
}
