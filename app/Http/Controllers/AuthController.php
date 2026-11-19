<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;


class AuthController extends Controller
{
        public function showLoginForm123()
    {
        return view('auth123.login123');
    }

        public function login(LoginRequest $request)
    {
        // Jalankan logika autentikasi yang ada di LoginRequest
        $request->authenticate();

        return redirect()->intended('/dashboard');
    }

        public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login123');
    }


}
