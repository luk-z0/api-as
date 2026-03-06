<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{StoreUserRequest, UpdateUserRequest};
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(protected UserService $service) {}

    public function index(Request $request)
    {
        $current_page = $request['current_page'] ?? 1;
        $per_page = $request['per_page'] ?? 10;

        $offset = ($current_page - 1) * $per_page;

        $users = User::offset($offset)->limit($per_page)->get();

        return response()->json($users, 200);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = $this->service->create($request->validated());

            return response()->json($user, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User creation failed'], 500);
        }
    }

    public function show(User $user)
    {
        try {

            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $updatedData = $request->validated();

            if (isset($updatedData['password'])) {
                $updatedData['password'] = bcrypt($updatedData['password']);
            }

            $user->update($updatedData);

            return response()->json($user, 200);
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
