<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, UserController};
use App\Http\Controllers\Auth\{LoginController};

// Auth::routes();

Route::get('login',                                                                             [LoginController::class, 'index'])->name('login');

Route::middleware('auth_user')->group(function(){
    // Route::get('/', function(){
    //     die('index');
    // })->name('dashboard');
    Route::get('/',                                                                             [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout',                                                                        [LoginController::class, 'logout'])->name('logout');
});
