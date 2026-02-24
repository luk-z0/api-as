<?php

namespace App\Http\Controllers;

use App\DTO\CreateUserDTO;
use App\DTO\UpdateUserDTO;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $user) {}

    public function index(Request $request)
    {
        return response()->json($this->user->getAll($request->per_page), 200);
    }

    public function store(UserStoreRequest $request)
    {
        try {
            return response()->json($this->user->new(CreateUserDTO::makeFromRequest($request)), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User creation failed'], 500);
        }
    }

    public function show(string|int $id)
    {
        try {
            return response()->json($this->user->findById($id), 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function update(UserUpdateRequest $request)
    {
        try {
            return response()->json($this->user->update(UpdateUserDTO::makeFromRequest($request)), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User update failed'], 400);
        }
    }

    public function destroy(int|string $id)
    {
        try {

            return response()->json($this->user->delete($id), 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User deletion failed'], 400);
        }
    }
}
