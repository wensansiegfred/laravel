<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller {
    public function login(Request $request) {
        $request->validate([
          'email' => 'required',
          'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
          $user = User::where('email', $request->email)->first();
          session(['user' => $user]);
          return redirect()->intended('dashboard')->with('success', 'Signed in');
        }

        return redirect("login")->with('error', 'Invalid login credentials');
    }

    public function logout() {
      Auth::logout();
      return redirect()->route('login');
    }
}
