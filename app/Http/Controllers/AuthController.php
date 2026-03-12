<?php

namespace App\Http\Controllers;

use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\{LoginRequest, StoreUserRequest};
use App\Services\{AuthService, UserService};

class AuthController extends Controller
{

    public function __construct(
        protected AuthService $service,
        protected UserService $userService
    ) {}

    function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->validated())) {

            return response()->json([
                'access_token' => $request->user()->createToken('auth_token')->plainTextToken,
                'token_type' => 'Bearer',
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    function register(StoreUserRequest $request): JsonResponse
    {
        $user = $this->service->register($request->validated());

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }
}
