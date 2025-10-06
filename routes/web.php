<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class)->only(['create', 'store']);
Route::resource('users', UserController::class)->except(['create', 'store'])->middleware('auth.jwt');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/expensive/{id}', 'expensive.expensive')->name('expensive.expensive')->middleware('auth.jwt');
Route::view('/', 'index')->name('home');