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
            'title' => ['required'],
            'description' => ['required'],
            'preparation_time' => ['required', 'numeric'],
            'serves' => ['required', 'numeric'],
            'cooking_instructions' => ['required', 'string'],
        ]);


        $recipe = Recipe::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'preparation_time' => $validated['preparation_time'],
            'serves' => $validated['serves'],
            'cooking_instructions' => $validated['cooking_instructions'],
        ]);


        return response()->json(['message' => 'Recipe added successfully', 'recipe' => $recipe]);
    }

    public function update(Request $request): JsonResponse
    {

    }


    public function drop(Request $request): JsonResponse
    {

    }
}
