<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// Accept Peer Request
Route::post('/peer-request/accept', function (Request $request) {
    $validated = $request->validate([
        'user_id' => 'required|uuid|exists:users,id',
        'friend_id' => 'required|uuid|exists:users,id'
    ]);

    $affectedRows = DB::table('friends')
        ->where('user_id', $validated['user_id'])
        ->where('friend_id', $validated['friend_id'])
        ->update(['status' => 'accepted', 'updated_at' => now()]);

    if ($affectedRows > 0) {
        return response()->json(['message' => 'Peer request accepted successfully.'], 200);
    }

    return response()->json(['message' => 'Peer request not found'], 404);
});

/// Unsend Peer Request
Route::delete('/peer-request/unsend', function (Request $request) {
    $validated = $request->validate([
        'user_id' => 'required|uuid|exists:users,id',
        'friend_id' => 'required|uuid|exists:users,id'
    ]);

    $affectedRows = DB::table('friends')
        ->where('user_id', $validated['user_id'])
        ->where('friend_id', $validated['friend_id'])
        ->update([
            'status' => 'unsent', // Ensure this status is valid
            'deleted_at' => now(), // Record deletion timestamp
            'updated_at' => now()
        ]);

    if ($affectedRows > 0) {
        return response()->json(['message' => 'Peer request unsent successfully.'], 200);
    }

    return response()->json(['message' => 'Peer request not found'], 404);
});
