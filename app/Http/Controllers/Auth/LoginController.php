<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Api\SigninController;
use App\Http\Controllers\Api\SignoutController;
use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Models\Session as ModelsSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if(Session::has('token')){
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    // function signin(SigninRequest $request)
    // {
    //     if(Session::has('token')){
    //         return ResponseFormatter::error(__('auth.already_signin'), 301);
    //     }

    //     $signin = new SigninController();
    //     $result = $signin->handle($request);
    //     if($result['success']){
    //         $message    = __('message.signin_succes');
    //         $data       = $result['data'];

    //         Session::put('token',        $data['token']);
    //         Session::put('name',         $data['person']['name']);
    //         Session::put('company',      $data['person']['company']);
    //         Session::put('branch',       $data['person']['branch']);
    //         Session::put('id',           $data['id']['user']);
    //         Session::put('employee_id',  $data['id']['emp']);

    //         unset($data['id']);

    //         return ResponseFormatter::success($data, $message);
    //     } else {
    //         return ResponseFormatter::error(__('auth.failed'), 404);
    //     }
    // }

    function signout(Request $request)
    {
        if(!Session::has('token')){
            return redirect()->route('login');
        }

        $id = Session::get('id');
        $signout = new SignoutController();
        $signout->handle($id);

        // revoke session
        Session::forget('token');
        Session::forget('name');
        Session::forget('company');
        Session::forget('branch');
        Session::forget('id');
        Session::forget('employee_id');
        Session::flush();
        Session::regenerate();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        ModelsSession::filterByUserId($id)->delete();


        // return ResponseFormatter::success(null, __('auth.signout_success'));
        return redirect()->route('login');
    }
}
