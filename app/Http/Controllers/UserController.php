<?php

namespace App\Http\Controllers;

use App\Http\Requests\{PaginationRequest, StoreUserRequest, UpdateUserRequest};
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(protected UserService $service) {}

    public function index(PaginationRequest $request)
    {
        return response()->json(
            $this->service->getAll($request), 
            200
        );
    }

    public function store(StoreUserRequest $request)
    {
        return response()->json(
            $this->service->create($request->validated()), 
            201
        );
    }

    public function show(User $user)
    {
        return response()->json(
            $this->service->getById($user),
            200
        );
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        return response()->json(
            $this->service->update($user, $request->validated()),
            200
        );
    }

    public function destroy(User $user)
    {
        $this->service->delete($user);
        return response()->json(null, 204);
    }

    public function restore(User $user)
    {
        return response()->json(
            $this->service->restore($user),
            200
        );
    }
}
