<?php

use App\Events\SendGlobalUserNotification;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
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
    Route::get('close/window', [UserController::class, 'closeWindow']);
    Route::get('check/online', [UserController::class, 'userOnlineStatus']);
    Route::group(['prefix' => 'contact'], function(){
        Route::get('', [ContactController::class, 'index']);
        Route::post('', [ContactController::class, 'store']);
        Route::get('proses', [ContactController::class, 'proses']);
        Route::get('tolak', [ContactController::class, 'tolak']);
        Route::get('konfirmasi', [ContactController::class, 'konfirmasi']);
        Route::patch('konfirmasi/{friend}', [ContactController::class, 'proses_konfirmasi']);
    });

    Route::group(['prefix' => 'message'], function(){
        Route::get('/read-message/{id}', [MessageController::class, 'read_all_message']);
        Route::get('/user/{id}', [MessageController::class, 'user_message']);
        Route::get('/{id}', [MessageController::class, 'message_data']);
        Route::post('/{id}', [MessageController::class, 'store']);
    });
});

Route::post('register', [AuthController::class, 'register']);
Route::get('user', [AuthController::class, 'user']);
Route::get('all-user', [AuthController::class, 'all_user']);
