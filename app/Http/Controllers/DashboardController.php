<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // $session = $request->session();
        // $this->preDie($session);

        // $session = Session::get('token');
        // echo $session;
        // echo 'dashboard index: <br/> '.$session->token;
        return view('dashboard.index');
    }
}
