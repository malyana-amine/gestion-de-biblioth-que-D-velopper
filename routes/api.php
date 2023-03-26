<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\genreController;
use App\Http\Controllers\livresController;

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

Route::get('collection', [CollectionController::class, 'index']);
Route::post('collection/add', [CollectionController::class, 'store']);
Route::get('collection/edit/{id}', [CollectionController::class, 'edit']);
Route::put('collection/edit/{id}', [CollectionController::class, 'update']);
Route::delete('collection/delete/{id}', [CollectionController::class, 'delete']);


Route::get('genre', [genreController::class, 'index']);
Route::post('genre/add', [genreController::class, 'store']);
Route::get('genre/edit/{id}', [genreController::class, 'edit']);
Route::put('genre/edit/{id}', [genreController::class, 'update']);
Route::delete('genre/delete/{id}', [genreController::class, 'delete']);


Route::get('livres', [livresController::class, 'index']);
Route::post('livres/add', [livresController::class, 'store']);
Route::put('livres/update/{id}', [livresController::class, 'update']);
Route::get('livres/show/{id}', [livresController::class, 'show']);
Route::delete('livres/delete/{id}', [livresController::class, 'delete']);