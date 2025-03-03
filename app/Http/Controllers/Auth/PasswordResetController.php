<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class PasswordResetController extends Controller
{
    public function store(Request $request): JsonResponse {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', Rules\Password::defaults(), 'confirmed'],
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                "message" => "User with this email not found."
            ], 404);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            "message" => "Password reset successfully"
        ], 200);
    }
}
