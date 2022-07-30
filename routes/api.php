<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get all messages
Route::get('/rooms/{room}/get_messages', [MessageController::class, 'getMessages']);

// send new message
Route::post('/rooms/{room}/users/{user}/send_message', [MessageController::class, 'sendMessage']);

// message
Route::resource('messages', MessageController::class);
