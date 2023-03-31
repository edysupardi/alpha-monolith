<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController};
use App\Http\Controllers\Auth\{LoginController};

// Auth::routes();

Route::get('login',                                                                             [LoginController::class, 'index'])->name('login');
Route::post('signin',                                                                           [LoginController::class, 'signin'])->name('signin');

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/',                                                                             [DashboardController::class, 'index'])->name('dashboard');
});
