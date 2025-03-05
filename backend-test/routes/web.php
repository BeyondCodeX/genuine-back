<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\DialogflowController; // <-- Importar el controlador

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Rutas API para categorías y productos
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);

// Endpoint específico para consultar la cantidad de productos por categoría
Route::get('/category/{id}/products/count', [ProductController::class, 'countByCategory']);

// Ruta para Dialogflow
Route::post('/dialogflow', [DialogflowController::class, 'detectIntent']); 

