<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, UserController};

Route::get('/ping', function () {
    return response()->json(['message' => 'pong'], 200);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class)->whereNumber('user');
});

Route::prefix('auth')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
