<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, UserController, CompanyController};
use App\Http\Controllers\Auth\{LoginController};

Route::get('login',                                                                             [LoginController::class, 'index'])->name('login');

Route::middleware('auth_user')->group(function(){
    Route::get('/',                                                                             [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout',                                                                        [LoginController::class, 'logout'])->name('logout');

    // user
    Route::get('profile',                                                                       [UserController::class, 'profile'])->name('profile');
    Route::get('user',                                                                          [UserController::class, 'index'])->name('user');

    // poly
    Route::get('polyclinic',                                                                    [UserController::class, 'index'])->name('polyclinic');
    Route::get('branch',                                                                        [UserController::class, 'index'])->name('branch');
    Route::get('company',                                                                       [CompanyController::class, 'index'])->name('company');

    Route::group(['prefix' => 'inpatient'], function(){
        Route::get('/',                                                                         [UserController::class, 'index'])->name('inpatient');
        Route::get('report',                                                                    [UserController::class, 'index'])->name('inpatient.report');
    });
    Route::group(['prefix' => 'outpatient'], function(){
        Route::get('/',                                                                         [UserController::class, 'index'])->name('outpatient');
        Route::get('report',                                                                    [UserController::class, 'index'])->name('outpatient.report');
    });
});
