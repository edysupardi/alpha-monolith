<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, OutpatientEntryController, PermissionController, RoleController, UserController};
use App\Http\Controllers\Auth\{LoginController};

Route::middleware('throttle:global')->group(function(){
    Route::get('/',                                                                                 [LoginController::class, 'index'])->name('default');
    Route::get('login',                                                                             [LoginController::class, 'index'])->name('login');
    Route::post('signin',                                                                           [LoginController::class, 'signin'])->name('signin');

    Route::middleware('session')->group(function(){
        Route::get('logout',                                                                        [LoginController::class, 'signout'])->name('logout');
        Route::get('signout',                                                                       [LoginController::class, 'signout'])->name('signout');

        Route::get('dashboard',                                                                     [DashboardController::class, 'index'])->name('dashboard');

        // Route::get('outpatient',                                                                    [DashboardController::class, 'index'])->name('outpatient');
        Route::prefix('outpatient')->name('outpatient.')->group(function(){
            Route::prefix('entry')->name('entry.')->group(function(){
                Route::get('/',                                                                     [OutpatientEntryController::class, 'index'])->name('index');
            });
        });
        Route::get('klpcm',                                                                         [DashboardController::class, 'index'])->name('klpcm');

        Route::prefix('report')->name('report.')->group(function(){
            Route::get('klpcm',                                                                     [DashboardController::class, 'index'])->name('klpcm');
            Route::get('outpatient',                                                                [DashboardController::class, 'index'])->name('outpatient');
        });

        Route::prefix('permission')->name('permission.')->group(function(){
            Route::get('/',                                                                         [PermissionController::class, 'index'])->name('index')->middleware('can:view_permission');
        });

        Route::prefix('role')->name('role.')->group(function(){
            Route::get('/',                                                                         [RoleController::class, 'index'])->name('index')->middleware('can:view_role');
        });

        Route::prefix('permission')->name('permission.')->group(function(){
            Route::get('/',                                                                         [PermissionController::class, 'index'])->name('index')->middleware('can:view_permission');
        });
    });
});

