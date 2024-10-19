<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    function index()
    {
        $user = Auth::user();

        $data = Permission::filterByCompany($user->company_id)->get();

        return view('permission.index', compact('data'));
    }
}
