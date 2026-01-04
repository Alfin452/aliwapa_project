<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Ambil data user dari request saat ini
        $user = $request->user();

        // 2. Cek apakah user ADA (sudah login) DAN role-nya 'admin'
        // Kita pakai pengecekan $user terlebih dahulu untuk menghindari error jika belum login
        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        // 3. Kalau bukan admin, tendang keluar
        abort(403, 'Anda tidak memiliki akses admin.');
    }
}
