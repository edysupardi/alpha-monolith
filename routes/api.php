<?php

use App\Http\Controllers\Api\{BranchController, CompanyController, DivisionUnitController, SigninController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::name('api.')->group(function(){
    Route::get('/', function(){
        return response()->json([
            'time' => time()
        ], 200);
    });

    Route::post('signin',                                           [SigninController::class, 'handle'])->name('signin');

    Route::middleware('auth:api')->group(function(){
        // Route::prefix('company')->name('company.')->group(function(){
        //     Route::get('datatable',                                 [CompanyController::class, 'datatable'])->name('datatable');
        //     Route::prefix('{company}')->group(function(){
        //         Route::get('/',                                     [CompanyController::class, 'detail'])->name('detail');
        //         Route::put('/',                                     [CompanyController::class, 'update'])->name('update');
        //         Route::delete('/',                                  [CompanyController::class, 'delete'])->name('delete');
        //         Route::delete('destroy',                            [CompanyController::class, 'destroy'])->name('destroy');
        //     });
        //     Route::post('/',                                        [CompanyController::class, 'store'])->name('store');
        // });

        Route::prefix('branch')->name('branch.')->group(function(){
            Route::get('datatable',                                 [BranchController::class, 'datatable'])->name('datatable');
            Route::prefix('{branch}')->group(function(){
                Route::get('/',                                     [BranchController::class, 'detail'])->name('detail');
                Route::put('/',                                     [BranchController::class, 'update'])->name('update');
                Route::delete('/',                                  [BranchController::class, 'delete'])->name('delete');
                Route::delete('destroy',                            [BranchController::class, 'destroy'])->name('destroy');
            });
            Route::post('/',                                        [BranchController::class, 'store'])->name('store');
        });

        Route::prefix('division_unit')->name('division_unit.')->group(function(){
            Route::get('datatable',                                 [DivisionUnitController::class, 'datatable'])->name('datatable');
            Route::prefix('{division_unit}')->group(function(){
                Route::get('/',                                     [DivisionUnitController::class, 'detail'])->name('detail');
                Route::put('/',                                     [DivisionUnitController::class, 'update'])->name('update');
                Route::delete('/',                                  [DivisionUnitController::class, 'delete'])->name('delete');
                Route::delete('destroy',                            [DivisionUnitController::class, 'destroy'])->name('destroy');
            });
            Route::post('/',                                        [DivisionUnitController::class, 'store'])->name('store');
        });
    });
});

