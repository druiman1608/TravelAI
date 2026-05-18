<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ModMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user && ($user->isAdmin() || $user->isMod())) {
            return $next($request);
        }

        return response()->json([
            'message' => 'Acceso denegado. Solo moderadores o administradores.'
        ], 403);
    }
}