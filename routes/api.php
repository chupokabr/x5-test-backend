<?php

use \App\Http\Controllers\Auth\RegisterController;
use \App\Http\Controllers\Auth\LoginController;
use \App\Http\Controllers\UserController;

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


/** Авторизация и регистрация */
Route::group(['namespace' => 'Auth'], function () {
    Route::post('auth/login', [LoginController::class, 'login']);
    Route::post('auth/register', [RegisterController::class, 'register']);
});

/** Пользователь */
Route::group(['middleware' => 'authorized'], function () {
    Route::get('user/info', [UserController::class, 'getInfo']);
});
