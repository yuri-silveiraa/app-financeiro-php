<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class);

Route::get('/login', [UserController::class, 'create'])->name('login.create');
Route::post('/login', [UserController::class, 'store'])->name('login.store');

Route::get('/register', [UserController::class, 'create'])->name('auth.register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

Route::get('/', function(){
    return view('home.home');
});