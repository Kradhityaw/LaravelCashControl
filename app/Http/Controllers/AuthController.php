<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
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

    public function showRegister() {
        $halaman = 'Register';
        return view('register', compact('halaman'));
    }

    public function registerProcess(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $find = User::find(Auth::user()->id)['id'];
            
            // $makeGroup = Group::create([
            //     'nama' => $request->name . 'Group',
            //     'deskripsi' => 'Isi deskripsimu',
            //     'created_at' => now()
            // ]);

            // GroupUser::create([
            //     'user_id' => $find->id,
            //     'group_id' => $makeGroup->id,
            //     'role_id' => 1
            // ]);

            return redirect("/setup/$find")->with('data', $find)->with('success', 'Akun Berhasil Dibuat');
        } else {
            return redirect()->back()->withErrors('Email atau password salah');
        }
    }

    public function showSetup() {
        return view('setup');
    }

    public function setupProcess(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'saldo' => 'required|numeric'
        ]);

        $find = User::findOrFail($id);

        $find->update([
            'name' => $request->name,
            'saldo' => $request->saldo
        ]);

        $group = Group::create([
            'nama' => $find['name'] . 'Group',
            'deskripsi' => 'Isi Deskripsi...'
        ]);

        GroupUser::create([
            'user_id' => $id,
            'group_id' => $group['id'],
            'role_id' => 1
        ]);

        return redirect('/dashboard')->with('pesan', "Selamat datang di CashControl, ".Auth::user()->name);
    }

    public function logout() {
        Auth::logout();

        return redirect('login');
    }
}
