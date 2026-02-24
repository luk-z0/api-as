<?php

namespace App\Repositories\Interfaces;

use App\DTO\CreateUserDTO;
use App\DTO\UpdateUserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    public function getAll(int $per_page = 1): array | object;

    public function findById(int|string $id): ?User;

    public function create(CreateUserDTO $dto): User;

    public function update(UpdateUserDTO $dto): ?User;

    public function delete(int|string $id): bool;
}
