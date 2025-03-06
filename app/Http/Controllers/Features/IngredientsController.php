<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Ingredients;

class IngredientsController extends Controller
{
    public function store(Request $request): JsonResponse
    {


        $validated = $request->validate([
            'recipe_name' => 'required|string',
            'quantity' => 'required|numeric',
            'unit' => 'required|string',
            'price' => 'required|numeric',
        ]);


        $ingredient = Ingredients::create([
            'recipe_id' => $request->recipe_id,
            'recipe_name' => $validated['recipe_name'],
            'quantity' => $validated['quantity'],
            'unit' => $validated['unit'],
            'price' => $validated['price'],
        ]);


        return response()->json(['message' => 'Ingredients added successfully', 'ingredient' => $ingredient]);
    }

    public function update(Request $request): JsonResponse
    {

    }


    public function drop(Request $request): JsonResponse
    {

    }
}
