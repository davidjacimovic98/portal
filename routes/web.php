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
    // Show create form
    Route::get('/news/create', [NewsController::class, 'create'])->middleware('auth');

    // Store new "news" data
    Route::post('/news', [NewsController::class, 'store'])->middleware('auth');

    // Show edit form
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->middleware('auth');

    // Update news
    Route::put('/news/{news}', [NewsController::class, 'update'])->middleware('auth');

    // Delete news
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->middleware('auth');

    // Manage news
    Route::get('/news/manage', [NewsController::class, 'manage'])->middleware('auth');

    // Log user out
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
});

// Single news
Route::get('/news/{news}', [NewsController::class, 'show']);

Route::middleware('guest')->group(function() {
    // Show register user form
    Route::get('/register', [UserController::class, 'create'])->middleware('guest');

    // Show login form
    Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
});

// Store new user data
Route::post('/users', [UserController::class, 'store']);

// Log user in
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
