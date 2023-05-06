<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{LoginController};
use App\Http\Controllers\{BranchController, CompanyController, UserController, ProvienceController, DistrictController, SubdistrictController, VillageController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('signin',                                                                           [LoginController::class, 'signIn'])->name('signin');
Route::get('/', function(){
    return response()->json(['success' => true, 'code' => 200, 'data' => ['time' => time()]]);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('signout',                                                                      [LoginController::class, 'signOut'])->name('signout');

    Route::prefix('user')->group(function(){
        Route::get('{user}',                                                                    [UserController::class, 'index']);
    });

    Route::prefix('company')->name('company')->group(function(){
        Route::prefix('my')->name('.my')->group(function(){
            Route::get('/',                                                                     [CompanyController::class, 'my'])->name('.get');
            Route::put('/',                                                                     [CompanyController::class, 'updateMine'])->name('.update');
        });
        Route::prefix('{copmany}')->group(function(){
            Route::get('/',                                                                     [CompanyController::class, 'show'])->name('.detail');
            // Route::get('branch',                                                                [BranchController::class, 'list'])->name('.branch');
        });
        Route::post('store',                                                                    [CompanyController::class, 'store'])->name('.store');
        Route::prefix('update')->name('.update')->group(function(){
            Route::put('mine',                                                                  [CompanyController::class, 'updateMine'])->name('.mine');
            Route::put('{company}',                                                             [CompanyController::class, 'update'])->name('.update');
        });
    });

    Route::prefix('branch')->name('branch')->group(function(){
        Route::get('list',                                                                      [BranchController::class, 'my'])->name('.list');
        Route::prefix('{branch}')->group(function(){
            Route::put('/',                                                                     [BranchController::class, 'update'])->name('.update');
            Route::get('/',                                                                     [BranchController::class, 'detail'])->name('.detail');
            Route::delete('/',                                                                  [BranchController::class, 'delete'])->name('.delete');
        });
        Route::post('store',                                                                    [BranchController::class, 'store'])->name('.store');
        // Route::put('{branch}',                                                                  [BranchController::class, 'update'])->name('.update');
    });

    Route::prefix('territory')->name('territory')->group(function(){
        Route::prefix('provience')->name('.provience')->group(function(){
            Route::get('all',                                                                   [ProvienceController::class, 'all'])->name('.all');
            Route::get('{provience}',                                                           [ProvienceController::class, 'detail'])->name('.detail');
        });
        Route::prefix('district')->name('.district')->group(function(){
            Route::get('all',                                                                   [DistrictController::class, 'all'])->name('.all');
            Route::get('{district}',                                                            [DistrictController::class, 'detail'])->name('.detail');
        });
        Route::prefix('subdistrict')->name('.subdistrict')->group(function(){
            Route::get('all',                                                                   [SubdistrictController::class, 'all'])->name('.all');
            Route::get('{subdistrict}',                                                         [SubdistrictController::class, 'detail'])->name('.detail');
        });
        Route::prefix('village')->name('.village')->group(function(){
            Route::get('all',                                                                   [VillageController::class, 'all'])->name('.all');
            Route::get('{village}',                                                             [VillageController::class, 'detail'])->name('.detail');
        });
    });
});
