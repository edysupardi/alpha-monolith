<?php

namespace App\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService{

    public function signin($email, $password): array;
    public function signout($request): array;
    public function getById($id);
}
