<?php

use App\Http\Controllers\Api\{AddressTypeController, BranchController, CompanyController, DivisionUnitController, IcdController, IdentityTypeController, RegionController, SigninController};
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

        Route::prefix('address_type')->name('address_type.')->group(function(){
            Route::get('datatable',                                 [AddressTypeController::class, 'datatable'])->name('datatable');
            Route::prefix('{address_type}')->group(function(){
                Route::get('/',                                     [AddressTypeController::class, 'detail'])->name('detail');
                Route::put('/',                                     [AddressTypeController::class, 'update'])->name('update');
                Route::delete('/',                                  [AddressTypeController::class, 'delete'])->name('delete');
                Route::delete('destroy',                            [AddressTypeController::class, 'destroy'])->name('destroy');
            });
            Route::post('/',                                        [AddressTypeController::class, 'store'])->name('store');
        });
        Route::prefix('identity_type')->name('identity_type.')->group(function(){
            Route::get('datatable',                                 [IdentityTypeController::class, 'datatable'])->name('datatable');
            Route::prefix('{identity_type}')->group(function(){
                Route::get('/',                                     [IdentityTypeController::class, 'detail'])->name('detail');
                Route::put('/',                                     [IdentityTypeController::class, 'update'])->name('update');
                Route::delete('/',                                  [IdentityTypeController::class, 'delete'])->name('delete');
                Route::delete('destroy',                            [IdentityTypeController::class, 'destroy'])->name('destroy');
            });
            Route::post('/',                                        [IdentityTypeController::class, 'store'])->name('store');
        });
        Route::prefix('region')->name('region.')->group(function(){
            Route::get('datatable',                                 [RegionController::class, 'datatable'])->name('datatable');
            Route::prefix('{region}')->group(function(){
                Route::get('/',                                     [RegionController::class, 'detail'])->name('detail');
                Route::put('/',                                     [RegionController::class, 'update'])->name('update');
                Route::delete('/',                                  [RegionController::class, 'delete'])->name('delete');
                Route::delete('destroy',                            [RegionController::class, 'destroy'])->name('destroy');
            });
            Route::post('/',                                        [RegionController::class, 'store'])->name('store');
        });
        Route::prefix('icd')->name('icd.')->group(function(){
            Route::get('datatable',                                 [IcdController::class, 'datatable'])->name('datatable');
            Route::prefix('{icd}')->group(function(){
                Route::get('/',                                     [IcdController::class, 'detail'])->name('detail');
                Route::put('/',                                     [IcdController::class, 'update'])->name('update');
                Route::delete('/',                                  [IcdController::class, 'delete'])->name('delete');
                Route::delete('destroy',                            [IcdController::class, 'destroy'])->name('destroy');
            });
            Route::post('/',                                        [IcdController::class, 'store'])->name('store');
        });
    });
});

