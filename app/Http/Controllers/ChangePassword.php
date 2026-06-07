<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Controller
{
    public function show()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);
/** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        $user->password = Hash::make($request->password);
        $user->must_change_password = 0;
        $user->save();

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($user->role === 'chef_agence') {
            return redirect('/chef/dashboard');
        }

        if ($user->role === 'agent_comptoir') {
            return redirect('/agent/dashboard');
        }

        if ($user->role === 'comptable') {
            return redirect('/comptable/dashboard');
        }

        return redirect('/dashboard');
    }
}
