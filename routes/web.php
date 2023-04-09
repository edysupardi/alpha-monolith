<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, UserController};
use App\Http\Controllers\Auth\{LoginController};

// Auth::routes();

Route::get('login',                                                                             [LoginController::class, 'index'])->name('login');
Route::post('signin',                                                                           [LoginController::class, 'signin'])->name('signin');
Route::get('tes',                                                                           [UserController::class, 'index']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/',                                                                             [DashboardController::class, 'index'])->name('dashboard');
});
