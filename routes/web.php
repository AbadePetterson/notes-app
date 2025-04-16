<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

// auth routes
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login-submit', [AuthController::class, 'login_submit']);

Route::get('/logout', [AuthController::class, 'logout']);