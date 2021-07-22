<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller {

  public function signup(Request $request) {

    $user_exist = User::where('email', $request->email)->count();

    if ($user_exist > 0) {
      return redirect()->back()->withInput()->with('error', 'User already exist with this email. ');
    } else {
      if (strlen($request->password) > 0 && $request->password == $request->confirm_password) {
        $new_user = new User();
        $new_user->email = $request->email;
        $new_user->first_name = $request->first_name;
        $new_user->last_name = $request->last_name;
        $new_user->password = hash::make($request->password);
        $new_user->save();
        return redirect("/")->with('success', 'Successfully created.');
      } else {
        return redirect()->back()->withInput()->with('error', 'Invalid password.');
      }
    }
  }
}
