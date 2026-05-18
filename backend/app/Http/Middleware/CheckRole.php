<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'No autenticado.'], 401);
        }

        foreach ($roles as $role) {
            if ($role === 'admin' && $user->isAdmin()) {
                return $next($request);
            }
            if ($role === 'mod' && $user->isMod()) {
                return $next($request);
            }
            if ($role === 'premium' && $user->isPremium()) {
                return $next($request);
            }
        }

        return response()->json([
            'message' => 'Acceso denegado. No tienes los permisos necesarios (' . implode(', ', $roles) . ').'
        ], 403);
    }
}