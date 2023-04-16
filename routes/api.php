<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{LoginController};
use App\Http\Controllers\{UserController, ProvienceController};

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
    Route::post('signout',                                                                      [LoginController::class, 'signOut']);

    Route::prefix('user')->group(function(){
        Route::get('{user}',                                                                    [UserController::class, 'index']);
    });

    Route::prefix('territory')->name('territory')->group(function(){
        Route::prefix('provience')->name('.provience')->group(function(){
            Route::get('all',                                                                   [ProvienceController::class, 'all']);
            Route::get('{provience}',                                                           [ProvienceController::class, 'detail']);
        });
    });
});
