<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!session('admin')) {
            return redirect()->route('admin.login');
        }

        // Ambil user dari session admin_id
        $user = \App\Models\User::find(session('admin_id'));

        if (!$user || !$user->hasRole($roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
