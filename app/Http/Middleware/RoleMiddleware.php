<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah pengguna yang login memiliki role yang sesuai
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request); // Lanjutkan ke request berikutnya jika role cocok
        }

        // Jika tidak cocok, redirect ke halaman dashboard biasa atau halaman lainnya
        return redirect()->route('dashboard');
    }
}
