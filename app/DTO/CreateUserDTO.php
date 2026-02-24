<?php

namespace App\DTO;

use App\Http\Requests\UserStoreRequest;

class CreateUserDTO
{
    private function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {}

    public static function makeFromRequest(UserStoreRequest $request): self
    {
        return new self(
            name: $request->name,
            email: $request->email,
            password: bcrypt($request->password)
        );
    }
}
