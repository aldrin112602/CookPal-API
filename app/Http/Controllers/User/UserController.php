<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $recipes = Recipe::where('user_id', $id)
            ->with(['ingredients:id,recipe_id,quantity,unit,price'])
            ->latest()
            ->get();

        $recipes->each(function ($recipe) {
            $recipe->time_ago = Carbon::parse($recipe->created_at)->diffForHumans();
        });

        return response()->json([
            'message' => 'User and Recipes retrieved successfully',
            'user' => $user,
            'recipes' => $recipes
        ]);
    }
}
