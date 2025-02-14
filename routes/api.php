<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Movie\MovieController;
use App\Http\Controllers\Rating\RatingController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function (){

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function (){
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/me', [AuthController::class, 'current']);
    });
});

Route::middleware('auth:api')->prefix('/v1')->group(function (){

    Route::apiResource('/movies', MovieController::class);

    Route::apiResource('/ratings', RatingController::class);
});
