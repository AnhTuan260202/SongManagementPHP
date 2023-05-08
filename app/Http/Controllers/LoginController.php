<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function login_process(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('songs.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]); 
    }

    public function logout(Request $request) {
        Auth::logout();
        return view('login');
    }
}
