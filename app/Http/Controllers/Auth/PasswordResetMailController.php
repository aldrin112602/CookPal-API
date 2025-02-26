<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use App\Models\User;

class PasswordResetMailController extends Controller
{
    /**
     * Send OTP to the user's email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $otp = str_pad(random_int(1000, 9999), 4, '0', STR_PAD_LEFT);
        $expires_at = now()->addMinutes(10);

        Mail::to($user->email)->send(new PasswordResetMail($otp, $user->email));

        return response()->json([
            'message' => 'OTP sent successfully.',
            'otp' => $otp,
            'expires_at' => $expires_at
        ]);
    }


}
