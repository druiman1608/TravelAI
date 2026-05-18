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

        return response()->json([
            'message' => 'Contenido exclusivo para usuarios Premium.'
        ], 403);
    }
}