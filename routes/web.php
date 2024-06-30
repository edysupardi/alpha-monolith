<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, UserController};
use App\Http\Controllers\Auth\{LoginController};
use Illuminate\Support\Facades\Hash;

// Auth::routes();

Route::get('login',                                                                             [LoginController::class, 'index'])->name('login');
Route::post('signin',                                                                           [LoginController::class, 'signin'])->name('signin');
Route::get('tes',                                                                               function(){
    echo Hash::make('admin');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/',                                                                             [DashboardController::class, 'index'])->name('dashboard');
});
