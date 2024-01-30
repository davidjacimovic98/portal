<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// All news
Route::get('/', [NewsController::class, 'index']);

Route::middleware('auth')->group(function() {
     // Manage news
     Route::get('/news/manage', [NewsController::class, 'manage']);

    // Show create form
    Route::resource('news', NewsController::class);

    // Log user out
    Route::post('/logout', [UserController::class, 'logout']);
});

// Single news
Route::get('/news/{news}', [NewsController::class, 'show']);

Route::middleware('guest')->group(function() {
    // Show register user form
    Route::get('/register', [UserController::class, 'create']);

    // Show login form
    Route::get('/login', [UserController::class, 'login'])->name('login');
});

// Store new user data
Route::post('/users', [UserController::class, 'store']);

// Log user in
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
