<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, UserController};

Route::apiResource('/users', UserController::class)->whereNumber('user')->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
