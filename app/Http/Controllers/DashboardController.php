<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //  Redirection selon rôle
    public function index()
    {
        $user = Auth::user();

        // Sécurité
        if (!$user) {
            return redirect()->route('login');
        }

        //  ADMIN
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        // 👤 USER
        return redirect('/user/dashboard');
    }

    //  Dashboard ADMIN
    public function adminDashboard()
    {
        $user = Auth::user();

        // Protection
        if ($user->role !== 'admin') {
            abort(403);
        }

        return view('admin.dashboard', compact('user'));
    }

    //  Dashboard USER
    public function userDashboard()
    {
        $user = Auth::user();

        // Protection
        if ($user->role !== 'user') {
            abort(403);
        }

        return view('user.dashboard', compact('user'));
    }
}
