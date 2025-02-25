<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserProfileController;


Route::prefix('/user')->group(function () {
    // Return user data
    Route::middleware(['auth:sanctum'])->get('/', function (Request $request) {
        return $request->user();
    });

    // Update user profile photo
    Route::middleware(['auth:sanctum'])->post('/update_profile', [UserProfileController::class, 'updateProfilePhoto'])->name('user.update_profile');

    // Update user profile info
    Route::middleware(['auth:sanctum'])->post('/update_info', [UserProfileController::class, 'updatePersonalInformation'])->name('user.update_profile_info');
});





require __DIR__ . '/auth.php';