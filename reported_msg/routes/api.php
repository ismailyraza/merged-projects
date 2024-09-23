<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


// Existing report-message endpoint
Route::post('/report-message', function (Request $request) {
    // Validate the input
    $validator = Validator::make($request->all(), [
        'message' => 'required|string',
        'senderid' => 'required|exists:users,id',
        'reporter' => 'required|exists:users,id',
        'group_chat' => 'required|boolean',
        'group_chat_id' => 'nullable|required_if:group_chat,true|exists:group_chats,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Insert into reported_messages table
    DB::table('reported_messages')->insert([
        'message' => $request->input('message'),
        'senderid' => $request->input('senderid'),
        'reporter' => $request->input('reporter'),
        'group_chat' => $request->input('group_chat'),
        'group_chat_id' => $request->input('group_chat') ? $request->input('group_chat_id') : null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json(['success' => 'Message reported successfully'], 201);
});

// New endpoint to aggregate reported messages
Route::get('/reported-messages', function (Request $request) {
    // Retrieve and aggregate reported messages
    $reportedMessages = DB::table('reported_messages')
        ->join('users as senders', 'reported_messages.senderid', '=', 'senders.id')
        ->join('users as reporters', 'reported_messages.reporter', '=', 'reporters.id')
        ->leftJoin('group_chats', 'reported_messages.group_chat_id', '=', 'group_chats.id')
        ->select(
            'reported_messages.id',
            'reported_messages.message',
            'senders.name as sender_name',
            'reporters.name as reporter_name',
            'reported_messages.group_chat',
            'group_chats.group_name as group_chat_name',
            'reported_messages.created_at'
        )
        ->get();

    return response()->json($reportedMessages);
});
