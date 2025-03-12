<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'description' => 'required|string',
            'preparation_time' => 'required|numeric',
            'serves' => 'required|numeric',
            'cooking_instructions' => 'required|string',
        ]);

        $recipe = Recipe::create([
            'user_id' => $user->id,
            'date_posted' => now(),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'preparation_time' => $validated['preparation_time'],
            'serves' => $validated['serves'],
            'cooking_instructions' => $validated['cooking_instructions'],
        ]);

        return response()->json(['message' => 'Recipe added successfully', 'recipe' => $recipe]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $recipe = Recipe::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string',
            'category' => 'sometimes|string',
            'description' => 'sometimes|string',
            'preparation_time' => 'sometimes|numeric',
            'serves' => 'sometimes|numeric',
            'cooking_instructions' => 'sometimes|string',
        ]);

        $recipe->update($validated);

        return response()->json(['message' => 'Recipe updated successfully', 'recipe' => $recipe]);
    }

    public function drop($id): JsonResponse
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();

        return response()->json(['message' => 'Recipe deleted successfully']);
    }
}
