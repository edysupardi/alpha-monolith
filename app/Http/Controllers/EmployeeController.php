<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    function index()
    {
        $user = Auth::user();
        echo $user->token();

        // return view('employee.index');
    }
}
