<?php

namespace App\Services;

use App\Services\UserService;
use App\Models\User;

class AuthService
{

    public function __construct(protected UserService $userService){}

    public function register(array $data): User
    {
        return $this->userService->create($data);
    }
}
