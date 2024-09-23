<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// Generate OTP
Route::post('/generate-otp', function (Request $request) {
    $request->validate([
        'user_id' => 'required|string|exists:users,user_id',
    ]);

    $otp = rand(100000, 999999); // Generate a 6-digit OTP
    $user_id = $request->input('user_id');

    // Invalidate previous unverified OTPs
    DB::table('otps')
        ->where('user_id', $user_id)
        ->where('status', false)
        ->update(['status' => true]);

    // Insert the new OTP with timestamp and expiry time
    DB::table('otps')->insert([
        'user_id' => $user_id,
        'otp' => $otp,
        'created_at' => Carbon::now(),
        'expires_at' => Carbon::now()->addMinutes(5), // Set expiry time to 5 minutes from now
        'status' => false,
    ]);

    return response()->json([
        'message' => 'OTP generated successfully.',
        'otp' => $otp, // Send the OTP here (for testing purposes)
    ]);
});

// Verify OTP
Route::post('/verify-otp', function (Request $request) {
    $request->validate([
        'user_id' => 'required|string|exists:users,user_id',
        'otp' => 'required|integer',
    ]);

    $user_id = $request->input('user_id');
    $otp = $request->input('otp');

    // Get the latest OTP for the user
    $otpEntry = DB::table('otps')
        ->where('user_id', $user_id)
        ->where('otp', $otp)
        ->where('status', false)
        ->orderBy('created_at', 'desc')
        ->first();

    if (!$otpEntry) {
        return response()->json(['message' => 'Invalid OTP or it has already been used.'], 400);
    }

    // Check if the OTP has expired
    if (Carbon::now()->gt($otpEntry->expires_at)) {
        return response()->json(['message' => 'OTP has expired.'], 400);
    }

    // Mark the OTP as verified
    DB::table('otps')
        ->where('id', $otpEntry->id)
        ->update(['status' => true]);

    return response()->json(['message' => 'OTP verified successfully.']);
});

// Resend OTP
Route::post('/resend-otp', function (Request $request) {
    $request->validate([
        'user_id' => 'required|string|exists:users,user_id',
    ]);

    $user_id = $request->input('user_id');

    // Invalidate old OTPs
    DB::table('otps')
        ->where('user_id', $user_id)
        ->where('status', false)
        ->update(['status' => true]);

    // Generate a new OTP
    $otp = rand(100000, 999999);

    // Insert the new OTP with timestamp and expiry time
    DB::table('otps')->insert([
        'user_id' => $user_id,
        'otp' => $otp,
        'created_at' => Carbon::now(),
        'expires_at' => Carbon::now()->addMinutes(5), // Set expiry time to 5 minutes from now
        'status' => false,
    ]);

    return response()->json([
        'message' => 'OTP resent successfully.',
        'otp' => $otp, // Send the OTP here (for testing purposes)
    ]);
});
