<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StripeController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class, 'getUser']);
    Route::delete('user', [UserController::class, 'deleteUser']);
    Route::post('changepassword', [UserController::class, 'changePassword']);
});

Route::get('get-checkout-session', [StripeController::class, 'getSession']);

