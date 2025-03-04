<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});




Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);

// Endpoint específico para consultar la cantidad de productos por categoría
Route::get('/category/{id}/products/count', [ProductController::class, 'countByCategory']);



Route::post('/dialogflow/webhook', function (Request $request) {
    $parameters = $request->input('queryResult.parameters');
    $categoryId = $parameters['category_id'] ?? null;

    if (!$categoryId) {
        return response()->json(['fulfillmentText' => 'Por favor, proporciona una categoría válida.']);
    }

    $count = \App\Models\Product::where('category_id', $categoryId)->sum('quantity');

    return response()->json(['fulfillmentText' => "Hay $count productos disponibles en esta categoría."]);
});
