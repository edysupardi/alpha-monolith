<?php

namespace App\Services\User;

use App\Services\InterfaceService;

interface UserService extends InterfaceService{

    public function signin($email, $password): array;
    public function signout($request): array;
    public function getById($id);
}
