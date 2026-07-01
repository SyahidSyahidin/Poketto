<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login DAN role-nya sesuai
        if (!auth()->check() || auth()->user()->role !== $role) {
            return response()->json(['message' => 'Anda tidak memiliki akses ke halaman ini.'], 403);
        }

        return $next($request);
    }
}