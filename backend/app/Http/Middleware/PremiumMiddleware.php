<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PremiumMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user && ($user->isPremium() || $user->isMod() || $user->isAdmin())) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'El chat con IA es exclusivo para usuarios Premium.');
    }
}
