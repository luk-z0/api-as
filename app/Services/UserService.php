<?php

namespace App\Http\Services;

use App\DTO\CreateUserDTO;
use App\DTO\UpdateUserDTO;
use App\Repositories\Interfaces\UserRepositoryInterface;
use stdClass;

class UserService
{
    public function __construct(protected UserRepositoryInterface $repository) {}

    public function getAll(int $per_page = 15): array
    {
        return $this->repository->getAll($per_page);
    }

    public function findById(int $id): ?stdClass
    {
        return $this->repository->findById($id);
    }

    public function create(CreateUserDTO $dto): stdClass
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateUserDTO $dto): ?stdClass
    {
        return $this->repository->update($dto);
    }

    public function delete(int|string $id): ?bool
    {
        return $this->repository->delete($id);
    }
}
