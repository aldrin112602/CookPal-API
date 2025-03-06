<?php

use App\Http\Controllers\Features\RecipeController;
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
});





require __DIR__ . '/auth.php';