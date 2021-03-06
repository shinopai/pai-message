<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;

class RoomController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }

    public function showRoom(Request $request, Room $room, User $user){
        return view('rooms.show', ['room' => $room->id, 'user' => $user->id, 'partner' => $request->partner]);
    }

    public function storeRoom(Request $request, User $user){
        $this->validate($request, [
            'partner_id' => 'required|integer'
        ]);

        $res = $user->rooms()->create([
            'partner_id' => $request->partner_id
        ]);

        return redirect()->route('rooms.show_room', ['room' => $res->id]);
    }

}
