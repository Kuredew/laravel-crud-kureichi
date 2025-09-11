<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginRegisterController;


Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/', 'home')->name('home');
    Route::post('/store', 'store')->name('store');
    Route::get('/logout', 'logout')->name('logout');
});


Route::resource('posts', PostController::class)->middleware('auth');
