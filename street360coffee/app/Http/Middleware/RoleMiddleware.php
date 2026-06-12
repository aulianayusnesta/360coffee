<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        // ✅ Admin bisa akses semua halaman
        if (auth()->user()->role === 'admin') {
            return $next($request);
        }

        if (! in_array(auth()->user()->role, $roles)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}