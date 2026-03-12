<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, UserController};

Route::get('/ping', function () {
    return response()->json(['message' => 'pong'], 200);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class)->whereNumber('user');
    
    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::patch('{user}/restore', 'restore');
        Route::delete('{user}/force', 'forceDelete');
    });
});

Route::controller(AuthController::class)->prefix('auth')->group(function () {

    Route::post('/login', 'login');
    Route::post('/register', 'register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'logout');
    });
});
