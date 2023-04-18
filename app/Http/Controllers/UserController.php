<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;

class UserController extends Controller
{
    private UserService $userService;
    function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    function index($id = '')
    {
        $result = $this->userService->getById($id);
        return $this->response($result);
    }
}
