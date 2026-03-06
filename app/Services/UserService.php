<?php

namespace App\Services;

use App\Constants\Pagination;
use App\Http\Requests\PaginationRequest;
use App\Models\User;

class UserService
{

    public function getAll(PaginationRequest $request)
    {
        $perPage = $request->perPage ?? Pagination::DEFAULT_PER_PAGE;
        return User::query()
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function update(User $user, array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return $user;
    }
}
