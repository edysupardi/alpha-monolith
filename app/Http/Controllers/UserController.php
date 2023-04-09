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

    function index()
    {
        $result = $this->userRepository->getUserById('988bfd94-cfda-11ed-afa1-0242ac120002');

        return response()->json($result, 200);
    }
}
