<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('chauffeur')->group(function () {
    Route::post('authenticate', [\App\Http\Controllers\UserController::class, 'requestToken']);
    Route::middleware('auth:sanctum')->group(
        function(){
            Route::get('/trajets', [\App\Http\Controllers\Api\TrajetController::class, 'index']);
            Route::get('/lieux', [\App\Http\Controllers\Api\LieuController::class, 'index']);
            Route::get('/vehicules',[\App\http\Controllers\Api\VehiculeController::class, 'index']);
        }
    );
});