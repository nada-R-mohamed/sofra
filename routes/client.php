<?php

use App\Http\Controllers\Api\Auth\Client\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
    Route::post('reset-password',[AuthController::class,'resetPassword']);
    Route::post('new-password',[AuthController::class,'newPassword']);

    Route::middleware('auth')->group(function () {
        Route::post('logout-current-token', [AuthController::class, 'logoutCurrentToken']);
        Route::post('logout-all-tokens', [AuthController::class, 'logoutAllTokens']);
    });

