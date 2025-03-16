<?php

use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', function (Request $request) {
    return  User::whereNot('id', $request->user()->id)->get();
})->middleware('auth:sanctum');

Route::get('/users/{user}', function (User $user) {
    return $user;
})->middleware('auth:sanctum');

Route::get('/messages/{user}', function (User $user, Request $request) {
    return ChatMessage::query()
    ->where(function ($query) use ($user, $request) {
        $query->where('sender_id', $request->user()->id)
            ->where('receiver_id', $user->id);
    })
    ->orWhere(function ($query) use ($user, $request) {
        $query->where('sender_id', $user->id)
            ->where('receiver_id', $request->user()->id);
    })
   ->with(['sender', 'receiver'])
   ->orderBy('id', 'asc')
   ->get();
})
->middleware('auth:sanctum');

Route::post('/messages/{user}', function (User $user, Request $request) {
    $request->validate([
        'message' => 'required|string'
    ]);

    $message = ChatMessage::create([
        'sender_id' => $request->user()->id,
        'receiver_id' => $user->id,
        'text' => $request->message
    ]);

    broadcast(new MessageSent($message));

    return $message;
});
