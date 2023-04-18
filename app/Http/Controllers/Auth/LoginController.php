<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\{SigninRequest};
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->middleware('guest')->except(['logout', 'signOut']);
        parent::__construct();
        $this->userService = $userService;
    }

    public function index()
    {
        if (Session::get('id')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        $signOut = $this->signOut($request);
        return redirect()->route('login');
    }


    /**
     * API Service
     */

     public function signIn(SigninRequest $request)
    {
        $result = $this->userService->signin($request->email, $request->password);
        return $this->response($result);
    }

    public function signOut(Request $request)
    {
        $result = $this->userService->signout($request);
        return $this->response($result);
    }
}
