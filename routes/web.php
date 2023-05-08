<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('myauth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('songs', SongController::class);
});

// Route::resource('login', LoginController::class);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login_process'])->name('login_process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');