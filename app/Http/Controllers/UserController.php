<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }

    public function showAllUsers(){
        $users = User::where('id', '!=', Auth::id())->orderBy('created_at', 'desc')->paginate(20);

        return view('users.all', compact('users'));
    }
}
