<?php

use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::get('user', [AuthController::class, 'user']);

    Route::group(['prefix' => 'contact'], function(){
        Route::get('', [ContactController::class, 'index']);
        Route::post('', [ContactController::class, 'store']);
        Route::get('proses', [ContactController::class, 'proses']);
        Route::get('tolak', [ContactController::class, 'tolak']);
        Route::get('konfirmasi', [ContactController::class, 'konfirmasi']);
        Route::patch('konfirmasi/{friend}', [ContactController::class, 'proses_konfirmasi']);
    });
});
