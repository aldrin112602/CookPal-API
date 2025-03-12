<?php

use App\Http\Controllers\Features\HomeController;
use App\Http\Controllers\Features\IngredientsController;
use App\Http\Controllers\Features\RecipeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserProfileController;


Route::prefix('/user')->group(function () {
    // Return user data
    Route::middleware(['auth:sanctum'])
        ->get('/', function (Request $request) {
            return $request->user();
        });

    // Update user profile photo
    Route::middleware(['auth:sanctum'])
        ->post('/update_profile', [UserProfileController::class, 'updateProfilePhoto'])
        ->name('user.update_profile');

    // Update user profile info
    Route::middleware(['auth:sanctum'])
        ->post('/update_info', [UserProfileController::class, 'updatePersonalInformation'])
        ->name('user.update_profile_info');



    // Add recipe
    Route::middleware(['auth:sanctum'])
        ->post('/add_recipe', [RecipeController::class, 'store'])
        ->name('user.add_recipe');


    // Update recipe
    Route::middleware(['auth:sanctum'])
        ->put('/update_recipe', [RecipeController::class, 'update'])
        ->name('user.update_recipe');


    // Delete recipe
    Route::middleware(['auth:sanctum'])
        ->delete('/delete_recipe', [RecipeController::class, 'drop'])
        ->name('user.delete_recipe');




    // Add ingredient
    Route::middleware(['auth:sanctum'])
        ->post('/add_ingredient', [IngredientsController::class, 'store'])
        ->name('user.add_ingredient');


    // Update ingredient
    Route::middleware(['auth:sanctum'])
        ->put('/update_ingredient', [IngredientsController::class, 'update'])
        ->name('user.update_ingredient');


    // Delete ingredient
    Route::middleware(['auth:sanctum'])
        ->delete('/delete_ingredient', [IngredientsController::class, 'drop'])
        ->name('user.delete_ingredient');



    // Home
    Route::middleware(['auth:sanctum'])
        ->get('/home', [HomeController::class, 'index'])
        ->name('user.home');


    // View user included recipes
    Route::middleware(['auth:sanctum'])
        ->get('/profile/{id}', [UserController::class, 'index'])
        ->name('user.view_user_with_recipes');
});





require __DIR__ . '/auth.php';