<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;

class UserController extends Controller
{
    private $userRepository;
    function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    function index($id = '')
    {
        $result = $this->userRepository->getUserById($id);

        return response()->json($result, 200);
    }
}
