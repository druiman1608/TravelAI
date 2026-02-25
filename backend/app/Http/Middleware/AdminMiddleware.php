<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user && $user->isAdmin()) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'No tienes permisos de Administrador.');
    }
}