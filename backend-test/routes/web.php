<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

// Rutas API para categorías y productos
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);

// Endpoint específico para consultar la cantidad de productos por categoría


Route::post('/dialogflow-webhook', function (Request $request) {
    $queryText = $request->input('queryResult.queryText');
    $parameters = $request->input('queryResult.parameters');

    // Suponiendo que tienes una API que devuelve la cantidad de productos
    $category = $parameters['category'] ?? 'general';
    $apiResponse = Http::get("https://f8e3-52-23-198-223.ngrok-free.app/category/{$category}/products/count", ['category' => $category]);

    $quantity = $apiResponse->json()['total_products'] ?? 'desconocida';

    return response()->json([
        "fulfillmentText" => "There are left $quantity units of $category available."
    ]);
});
