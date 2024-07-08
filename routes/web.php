<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, UserController};
use App\Http\Controllers\Auth\{LoginController};
use Illuminate\Support\Facades\Hash;

// Auth::routes();

Route::get('/',                                                                                 [LoginController::class, 'index'])->name('default');
Route::get('login',                                                                             [LoginController::class, 'index'])->name('login');
Route::post('signin',                                                                           [LoginController::class, 'signin'])->name('signin');

Route::middleware('session')->group(function(){
    Route::get('logout',                                                                        [LoginController::class, 'signout'])->name('logout');
    Route::get('signout',                                                                       [LoginController::class, 'signout'])->name('signout');

    Route::get('dashboard',                                                                     [DashboardController::class, 'index'])->name('dashboard');

    Route::get('outpatient',                                                                    [DashboardController::class, 'index'])->name('outpatient');
    Route::get('klpcm',                                                                         [DashboardController::class, 'index'])->name('klpcm');

    Route::prefix('report')->name('report.')->group(function(){
        Route::get('klpcm',                                                                     [DashboardController::class, 'index'])->name('klpcm');
        Route::get('outpatient',                                                                [DashboardController::class, 'index'])->name('outpatient');
    });
});
