<?php

use App\Http\Controllers\Api\Restaurant\Auth\AuthController;
use App\Http\Controllers\Api\Restaurant\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('reset-password',[AuthController::class,'resetPassword']);
Route::post('new-password',[AuthController::class,'newPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout-current-token', [AuthController::class, 'logoutCurrentToken']);
    Route::post('logout-all-tokens', [AuthController::class, 'logoutAllTokens']);
});
Route::get('all-restaurants',[RestaurantController::class,'getAllRestaurants']);
Route::get('restaurant/{id}',[RestaurantController::class, 'getRestaurant']);
Route::get('meals-restaurant/{id}',[RestaurantController::class,'getMealsForRestaurant']);
Route::get('reviews-restaurant/{id}',[RestaurantController::class,'getReviewsForRestaurant']);
