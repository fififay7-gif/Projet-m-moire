<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{

    public function update(Request $request)
{
    $request->validate([
        'password' => 'required|confirmed|min:6'
    ]);

   /** @var \App\Models\User $user */
$user = Auth::user();

    $user->password = Hash::make($request->password);
    $user->must_change_password = false;
    $user->save();


    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/user/dashboard');
}
public function show()
{
    return view('auth.change-password');
}
}
