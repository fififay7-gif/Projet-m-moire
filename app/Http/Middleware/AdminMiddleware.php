<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Si aucun admin dans la base → autoriser création du premier admin
        if (!User::where('role', 'admin')->exists()) {
            return $next($request);
        }

        // Si utilisateur connecté et admin → autoriser
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        abort(403, 'Accès refusé');
    }
}
