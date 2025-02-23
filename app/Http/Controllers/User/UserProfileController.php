<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function updateProfilePhoto(Request $request)
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

}
