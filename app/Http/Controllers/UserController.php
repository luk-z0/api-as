<?php

namespace App\Http\Controllers;

use App\Http\Requests\{PaginationRequest, StoreUserRequest, UpdateUserRequest};
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(protected UserService $service) {}

    public function index(PaginationRequest $request)
    {
        Gate::authorize('viewAny', User::class);
        return response()->json($this->service->getAll($request), 200);
    }

    public function store(StoreUserRequest $request)
    {
        Gate::authorize('create', User::class);
        $user = $this->service->create($request->validated());

        if (!$user) {
            return response()->json(['error' => 'User creation failed'], 500);
        }

        return response()->json(['data' => $user], 201);
    }

    public function show(User $user)
    {
        Gate::authorize('view',$user);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json(['data' => $user], 200);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        Gate::authorize('update',$user);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json(
            $this->service->update($user, $request->validated()),
            200
        );
    }


    public function destroy(User $user)
    {
        Gate::authorize('delete',$user);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->delete();

        return response()->json(null, 204);
    }

    public function restore(string | int $id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        Gate::authorize('restore', $user);

        if (!$user->trashed()) {
            return response()->json(['error' => 'User is not deleted'], 400);
        }

        $user->restore();

        return response()->json(['data' => $user], 200);
    }
}
