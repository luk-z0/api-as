<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{PaginationRequest, StoreUserRequest, UpdateUserRequest};
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(protected UserService $service) {}

    public function index(PaginationRequest $request)
    {
        return response()->json($this->service->getAll($request), 200);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = $this->service->create($request->validated());

            return response()->json(['data' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User creation failed'], 500);
        }
    }

    public function show(User $user)
    {
        try {
            return response()->json(['data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            return response()->json(
                $this->service->update($user, $request->validated()),
                200
            );
        } catch (\Exception $e) {
            return response()->json(['error' => 'User update failed'], 400);
        }
    }

    public function destroy(User $user)
    {
        try {

            $user->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User deletion failed'], 400);
        }
    }
}
