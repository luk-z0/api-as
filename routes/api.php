<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(__DIR__ . '/auth.php');

Route::prefix('users')->middleware('auth:sanctum')->group(__DIR__ . '/users.php');
