<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si l'utilisateur est connecté
        if (Auth::check()) {
            $role = Auth::user()->role;

            // Redirection selon le rôle précis stocké en base de données
            if ($role === 'chef_agence') {
                return redirect()->route('chef.dashboard');
            } elseif ($role === 'comptable') {
                return redirect()->route('comptable.dashboard');
            } elseif ($role === 'agent_comptoir') {
                return redirect()->route('comptoir.dashboard');
            }
        }

        return $next($request);
    }
}
