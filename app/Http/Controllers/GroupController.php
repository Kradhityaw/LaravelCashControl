<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index() {
        $cekUser = 0;
        $user = User::with('groups')->findOrFail(Auth::user()->id);

        foreach ($user->groups as $oke) {
            $cekUser = $oke['id'];
        }

        $data = Group::with('users.roles')->findOrFail($cekUser);

        return view('grup', compact('data'));
    }
}
