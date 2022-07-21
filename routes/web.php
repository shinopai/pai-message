<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;

// root
Route::get('/', function () {
    return view('index');
});

// all users
Route::get('/all_users', [UserController::class, 'showAllUsers'])->name('users.show_all');

// go to chat room
Route::get('/rooms/{room}', [RoomController::class, 'showRoom'])->name('rooms.show_room');

// store room
Route::post('/users/{user}/store_room', [RoomController::class, 'storeRoom'])->name('rooms.store_room');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
