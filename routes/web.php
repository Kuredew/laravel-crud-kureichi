<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginRegisterController;

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::get('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::get('/Authenticate', 'Authenticate')->name('Authenticate');
    Route::get('/home', 'home')->name('home');
    Route::get('/logout', 'logout')->name('logout');
});

//Route::resource('posts', PostController::Class);
/*
Route::get('/', function () {
    return view('welcome');
});*/