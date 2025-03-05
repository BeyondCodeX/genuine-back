<?php

namespace App\Http\Controllers;

use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\TextInput;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class DialogflowController extends Controller
{
    public function detectIntent(Request $request)
    {
        $text = strtolower($request->input('message'));

        // 🔹 Obtener categorías y productos desde la base de datos
        $categories = Category::pluck('name')->toArray();
        $products = Product::pluck('name')->toArray();

        // 🔹 Si el usuario pregunta por las categorías disponibles
        if (str_contains($text, 'categoría')) {
            return response()->json([
                'response' => 'Las categorías disponibles son: ' . implode(', ', $categories) . '. ¿Cuál te interesa?'
            ]);
        }

        // 🔹 Si el usuario pregunta cuántos productos hay en una categoría específica
        foreach ($categories as $category) {
            if (str_contains($text, strtolower($category))) {
                $categoryData = Category::where('name', $category)->first();
                if ($categoryData) {
                    $productCount = Product::where('category_id', $categoryData->id)->sum('quantity');
                    return response()->json([
                        'response' => "En la categoría '$category' hay un total de $productCount productos disponibles."
                    ]);
                }
            }
        }

        // 🔹 Si el usuario pregunta por la cantidad de un producto específico
        foreach ($products as $product) {
            if (str_contains($text, strtolower($product))) {
                $productData = Product::where('name', $product)->first();
                if ($productData) {
                    return response()->json([
                        'response' => "Del producto '$product' hay {$productData->quantity} unidades en stock."
                    ]);
                }
            }
        }

        // 🔹 Si la consulta no es sobre categorías ni productos, procesar con Dialogflow
        $projectId = 'tu-proyecto-id';
        $sessionId = uniqid();
        $languageCode = 'es';

        $sessionsClient = new SessionsClient();
        $session = $sessionsClient->sessionName($projectId, $sessionId);
        $queryInput = new QueryInput();
        $textInput = new TextInput();
        $textInput->setText($text);
        $textInput->setLanguageCode($languageCode);
        $queryInput->setText($textInput);

        $response = $sessionsClient->detectIntent($session, $queryInput);
        $queryResult = $response->getQueryResult();
        $fulfillmentText = $queryResult->getFulfillmentText();

        return response()->json(['response' => $fulfillmentText]);
    }
}
