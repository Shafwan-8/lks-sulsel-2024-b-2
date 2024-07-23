<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\DestinationsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::post('/create-user', [UserController::class, 'create']);

Route::get('/destination', [DestinationsController::class, 'index']);
Route::get('/destination/show/{id}', [DestinationsController::class, 'show']);


Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/admin/destination/create', [DestinationsController::class, 'create']);
    Route::delete('/admin/destination/{id}', [DestinationsController::class, 'destroy']);
    Route::put('/admin/destination/{id}', [DestinationsController::class, 'update']);
    

});
