<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::apiResource('/', UserController::class)
    ->parameters(['' => 'user'])
    ->names('users');

Route::patch('{user}/restore', [UserController::class, 'restore']);

Route::delete('{user}/force', [UserController::class, 'forceDelete']);
