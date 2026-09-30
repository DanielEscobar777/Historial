<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class RolAdministrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        // Verifica si el usuario tiene role_id = 1 (Jefe de Enseñanza)
        $isAdmin = DB::table('role_user')
            ->where('user_id', $user->id)
            ->where('role_id', 1)
            ->exists();

        if (!$isAdmin) {
            abort(403, 'Acceso no autorizado');
        }

        return $next($request);
    }
}
