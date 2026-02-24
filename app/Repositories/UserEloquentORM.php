<?php

namespace App\Repositories;

use App\DTO\CreateUserDTO;
use App\DTO\UpdateUserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserEloquentORM implements UserRepositoryInterface
{
    public function __construct(protected User $model) {}

    public function getAll(int $per_page = 15): LengthAwarePaginator
    {
        return $this->model->paginate($per_page);
    }

    public function findById(int|string $id): ?User
    {
        return $this->model->findOrFail($id);
    }

    public function create(CreateUserDTO $dto): User
    {
        return $this->model->create((array) $dto);
    }

    public function update(UpdateUserDTO $dto): ?User
    {
        $user = $this->model->findOrFail($dto->id);
        if ($user) {
            $user->update((array) $dto);
        }

        return $user;
    }

    public function delete(int|string $id): bool
    {
        return $this->model->destroy($id);
    }
}
