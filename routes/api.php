<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;

// Route::controller(AuthController::class)->group(function () {
//     Route::post('login', 'login');
//     Route::post('register', 'register');
//     Route::post('logout', 'logout');
//     Route::post('refresh', 'refresh');
//     Route::get('me', 'me');
// });
Route::post('register', [AuthController::class , 'register']);
Route::post('login', [AuthController::class , 'login']);
Route::post('logout', [AuthController::class , 'logout']);
Route::post('forget-password', [PasswordResetController::class, 'sendEmail']);