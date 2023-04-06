<?php

use App\Http\Controllers\Api\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('all-cities',[GeneralController::class,'allCities']);
Route::get('all-regions',[GeneralController::class,'allRegions']);
Route::get('all-categories',[GeneralController::class,'allCategories']);
Route::get('about-us',[GeneralController::class,'aboutUs']);

