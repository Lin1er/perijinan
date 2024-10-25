<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hasRole('super-admin')) {
            return $next($request); // Super Admin memiliki akses penuh
        }

        // Untuk user biasa, bisa tambahkan aturan lain atau redirect
        return redirect('/home')->with('error', 'Tidak memiliki akses');
    }
}

