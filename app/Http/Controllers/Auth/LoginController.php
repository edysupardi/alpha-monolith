<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\{SigninRequest};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function signin(SigninRequest $request)
    {
        return response()->json(['success' => false, 'message' => 'test']);
    }

    public function signin_(Request $request)
    {
        $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required']
        ]);

        // $validator = Validator::make($request, $rules)
        // $this->request-
    }
}
