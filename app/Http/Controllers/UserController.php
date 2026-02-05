<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $current_page = $request->get('current_page') ?? 1;
        $per_page = $request->get('per_page') ?? 10;

        $offset = ($current_page - 1) * $per_page;

        $users = User::offset($offset)->limit($per_page)->get();

        return response()->json($users, 200);
    }

    public function store(UserStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);

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

    public function update(UserUpdateRequest $request, User $user)
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
