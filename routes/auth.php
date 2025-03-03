<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetMailController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');


Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');



    Route::post('/password_reset_otp', [PasswordResetMailController::class, 'sendOtp'])
    ->middleware('guest')
    ->name('password_reset_otp');


    Route::post('/password_reset', [PasswordResetController::class, 'store'])
    ->middleware('guest')
    ->name('password_reset');

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->middleware('auth')
//     ->name('logout');
