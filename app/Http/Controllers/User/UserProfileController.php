<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;


class UserProfileController extends Controller
{
    public function updateProfilePhoto(Request $request): JsonResponse
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $user = $request->user();
        $path = $request->file('photo')->store('profiles', 'public');
        $user->update([
            'profile' => $path
        ]);

        return response()->json([
            'message' => 'Profile photo updated successfully',
            'profile_url' => asset('storage/' . $path),
        ]);
    }


    public function updatePersonalInformation(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|max:255',
            'new_password' => ['nullable', Rules\Password::defaults()],
        ]);

        // Check if the current password is provided and matches
        if ($request->filled('password')) {
            if (!Hash::check($request->input('password'), $user->password)) {
                return response()->json([
                    'message' => 'The provided password does not match our records',
                    'errors' => [
                        'password' => ['The provided password does not match our records']
                    ]
                ], 401);
            }

            // Update password if new password is provided
            if ($request->filled('new_password')) {
                $user->update([
                    'password' => Hash::make($request->input('new_password')),
                ]);
            }
        }

        // Update other personal information
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username']
        ]);

        return response()->json([
            'message' => 'Personal information updated successfully',
        ]);
    }

}
