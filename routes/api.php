<?php

use App\Http\Controllers\Api\AlmacenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AlmacenController::class)->group(function(){
    Route::get('/inventario','index');
    Route::post('/inventario','store');
    Route::get('/inventario/{id}','show');
    Route::put('/inventario/{id}','update');
    Route::delete('/inventario/{id}','destroy');
});