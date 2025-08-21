<?php

use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\FacturesController;
use App\Http\Controllers\Api\ProduitsController;
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


Route::post('/produit' , [ ProduitsController::class , 'store']) ;
Route::get('/produits' , [ProduitsController::class , 'index']);
Route::put('/produit/update/{id}' , [ProduitsController::class, 'update_produit']);
Route::delete('/produit/delete/{id}' , [ProduitsController::class, 'delete_produit']);

Route::post('/facture' , [FacturesController::class , 'store']);
Route::get('/factures' , [FacturesController::class , 'index']);
Route::get('/facture/{id}' , [FacturesController::class , 'show']);
Route::put('/facture/update/{id}' , [FacturesController::class, 'update_facture']);
Route::delete('/facture/delete/{id}' , [FacturesController::class, 'delete_facture']);
