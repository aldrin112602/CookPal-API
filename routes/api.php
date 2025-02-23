<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserProfileController;


Route::prefix('/user')->group(function () {
    // Return user data
    Route::middleware(['auth:sanctum'])->get('/', function (Request $request) {
        return $request->user();
    });

    // Update user profile
    Route::middleware(['auth:sanctum'])->post('/update_profile', [UserProfileController::class,'updateProfilePhoto'])->name('user.update_profile');
});





require __DIR__.'/auth.php';