<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('add_user', [UserController::class, 'add_user'])->name('add_user');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('register', [UserController::class, 'register'])->name('register');
