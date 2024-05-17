<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdmin;

// Show Homepage
Route::get('/', function () {
    return view('index');
});

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])
->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout']);

// Show Login Form
Route::get('/login', [UserController::class, 'login'])
->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Show Profile Page
Route::get('/profile', [UserController::class, 'profile'])
->middleware('auth');

// Show Admin Dashboard
Route::get('/dashboard', [AdminController::class, 'dashboard'])
->middleware(CheckAdmin::class);