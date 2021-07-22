<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Room;

class DashboardController extends Controller {
  public function index(Request $request) {
    return view('dashboard');
  }

  public function getRooms(Request $request) {
    $user = session('user');
    $my_rooms = DB::table('rooms')->where('created_by', $user->id)->get();
    $public_rooms = DB::table('rooms')->where('public', 1)->where('created_by', '<>', $user->id)->get();
    $data = ['my_rooms' => $my_rooms, 'public_rooms' => $public_rooms];

    return view('subpages.dashboard.room', ['data' => $data]);
  }

  public function createRoom(Request $request) {
      $user = session('user');
      return view('subpages.dashboard.room_create', ['userId' => $user->id]);
  }

  public function addRoom(Request $request) {
    $name = $request->name;
    $public = $request->public === TRUE ? 1 : 0;
    $userId = $request->userId;

    $room = new Room();
    $room->name = $name;
    $room->created_by = $userId;
    $room->public = $public;
    $room->active = true;

    $room->save();

    return response()->json(['success' => true]);
  }
}
