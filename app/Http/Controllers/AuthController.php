<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        $halaman = 'Login';
        return view('login', compact('halaman'));
    }

    public function loginProcess(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect('/dashboard')->with('pesan', "Selamat datang di CashControl, ".Auth::user()->name);
        }
        else {
            return redirect()->back()->withErrors('Email atau Password salah');
        }
    }

    public function logout() {
        Auth::logout();

        return redirect('login');
    }
}
