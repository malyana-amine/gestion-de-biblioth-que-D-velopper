<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\genreController;
use App\Http\Controllers\livresController;
use App\Http\Controllers\ChangeRole;


Route::post('register', [AuthController::class , 'register']);
Route::post('login', [AuthController::class , 'login']);
Route::post('logout', [AuthController::class , 'logout']);
Route::post('forget-password', [PasswordResetController::class, 'sendEmail']);





Route::get('collection', [CollectionController::class, 'index'])->middleware('admin:api');
Route::post('collection/add', [CollectionController::class, 'store'])->middleware('admin:api');
Route::get('collection/edit/{id}', [CollectionController::class, 'edit'])->middleware('admin:api');
Route::put('collection/edit/{id}', [CollectionController::class, 'update'])->middleware('admin:api');
Route::delete('collection/delete/{id}', [CollectionController::class, 'delete'])->middleware('admin:api');


Route::get('genre', [genreController::class, 'index'])->middleware('admin:api');
Route::post('genre/add', [genreController::class, 'store'])->middleware('admin:api');
Route::get('genre/edit/{id}', [genreController::class, 'edit'])->middleware('admin:api');
Route::put('genre/edit/{id}', [genreController::class, 'update'])->middleware('admin:api');
Route::delete('genre/delete/{id}', [genreController::class, 'delete'])->middleware('admin:api');



Route::get('livres', [livresController::class, 'index'])->middleware('réceptionniste:api');
Route::post('livres/add', [livresController::class, 'store'])->middleware('réceptionniste:api');
Route::put('livres/update/{id}', [livresController::class, 'update'])->middleware('réceptionniste:api');
Route::get('livres/show/{id}', [livresController::class, 'show']);
Route::delete('livres/delete/{id}', [livresController::class, 'delete'])->middleware('réceptionniste:api');



Route::put('updateroleuser/{id}', [ChangeRole::class, 'updateroleuser'])->middleware('admin:api');