<?php

use App\Http\Controllers\Api\ClientsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/clients', [ClientsController::class, 'index']);
Route::get('/single_client/{id}' , [ClientsController::class, 'get_single_client']);
Route::post('/client' , [ClientsController::class , 'store']);
Route::delete('/client/delete/{id}' , [ ClientsController::class , 'delete_client']);
Route::put('/client/update/{id} ', [ClientsController::class, 'update_client']);

