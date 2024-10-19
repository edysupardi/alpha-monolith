<?php

namespace App\Http\Controllers;

use App\Models\RoleMemberCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    function index()
    {
        $user = Auth::user();

        $data = RoleMemberCount::filterByCompany($user->company_id)->get();

        return view('role.index', compact('data'));
    }
}
