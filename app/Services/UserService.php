<?php

namespace App\Services;

use App\Constants\Pagination;
use App\Http\Requests\PaginationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Exception;

class UserService
{

    public function getAll(PaginationRequest $request)
    {
        Gate::authorize('viewAny', User::class);

        $perPage = $request->perPage ?? Pagination::DEFAULT_PER_PAGE;
        return User::query()
            ->latest()
            ->paginate($perPage);
    }

    public function getById(User $user): User
    {
        Gate::authorize('view', $user);
        return $user;
    }

    public function create(array $data): User
    {
        Gate::authorize('create', User::class);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function update(User $user, array $data): User
    {
        Gate::authorize('update', $user);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function delete(User $user): bool
    {
        Gate::authorize('delete', $user);
        return $user->delete();
    }

    public function restore(User $user): User
    {
        Gate::authorize('restore', User::class);

        $user = User::withTrashed()->findOrFail($user->id);

        if (!$user->trashed()) {
            throw new Exception('User is not deleted');
        }

        $user->restore();
        return $user;
    }
}
