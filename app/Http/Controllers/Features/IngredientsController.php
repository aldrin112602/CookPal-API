<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientsController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'ingredient_name' => 'required|string',
            'quantity' => 'required|numeric',
            'unit' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $ingredient = Ingredient::create($validated);

        return response()->json(['message' => 'Ingredient added successfully', 'ingredient' => $ingredient]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $ingredient = Ingredient::findOrFail($id);

        $validated = $request->validate([
            'ingredient_name' => 'sometimes|string',
            'quantity' => 'sometimes|numeric',
            'unit' => 'sometimes|string',
            'price' => 'sometimes|numeric',
        ]);

        $ingredient->update($validated);

        return response()->json(['message' => 'Ingredient updated successfully', 'ingredient' => $ingredient]);
    }

    public function drop($id): JsonResponse
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();

        return response()->json(['message' => 'Ingredient deleted successfully']);
    }
}
