<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Carbon;


class HomeController extends Controller
{
    // Return all recipes with user (creator) and ingredients
    public function index()
    {
        $recipes = Recipe::with([
            'user:id,name,profile',
            'ingredients:id,recipe_id,recipe_id,quantity,unit,price'
        ])->latest()->get();

        // Format created_at into "time ago" format
        $recipes->each(function ($recipe) {
            $recipe->time_ago = Carbon::parse($recipe->created_at)->diffForHumans();
        });

        return response()->json([
            'message' => 'Recipes retrieved successfully',
            'recipes' => $recipes
        ]);
    }
}
