<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        echo 'dashboard: ';
        echo Session::get('token');
        // dd(session()->all());
    }
}
