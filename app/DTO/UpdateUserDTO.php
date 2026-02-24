<?php

namespace App\DTO;

class UpdateUserDTO
{
    public function __construct(
        public int $id,
        public ?string $name = null,
        public ?string $email = null,
        public ?string $password = null,
    ) {}

    public static function makeFromRequest($request): self
    {
        return new self(
            id: $request->route('users.update'),
            name: $request->name,
            email: $request->email,
            password: bcrypt($request->password),
        );
    }
}
