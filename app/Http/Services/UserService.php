<?php

namespace App\Http\Services;

use App\DTO\CreateUserDTO;
use App\DTO\UpdateUserDTO;
use stdClass;

class UserService
{
    protected $repository;

    public function __construct()
    {
        //
    }

    public function getAll(int $per_page = 15): array
    {
        return $this->repository->getAll($per_page);
    }

    public function create(array $data): stdClass
    {
        return $this->repository->create($data);
    }

    public function findById(int $id): ?stdClass
    {
        return $this->repository->findById($id);
    }

    public function new(CreateUserDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }

    public function update(UpdateUserDTO $dto): ?stdClass {
        return $this->repository->update($dto);
    }

    public function delete(int|string $id): ?bool
    {
        return $this->repository->delete($id);
    }
}
