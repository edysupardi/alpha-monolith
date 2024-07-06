<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, UserController};
use App\Http\Controllers\Auth\{LoginController};
use Illuminate\Support\Facades\Hash;

// Auth::routes();

Route::get('/',                                                                                 [LoginController::class, 'index'])->name('default');
Route::get('login',                                                                             [LoginController::class, 'index'])->name('login');

Route::middleware('auth:api')->group(function(){
    Route::get('dashboard',                                                                     [DashboardController::class, 'index'])->name('dashboard');
});
