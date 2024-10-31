<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\OperationController;
use App\Http\Controllers\Api\RegisterController;

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('clients', ClientController::class);
});