<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ValidarTokenExterno
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $tokenPath = storage_path('app/token_sesion_' . $user->id . '.json');

            if (!file_exists($tokenPath)) {
                $this->cerrarSesion($request, $user->id);
                return redirect()->route('login')->with('error', 'Token no encontrado. Inicia sesión nuevamente.');
            }

            $tokenData = json_decode(file_get_contents($tokenPath), true);
            $token = $tokenData['access_token'] ?? null;

            if (!$token) {
                $this->cerrarSesion($request, $user->id);
                return redirect()->route('login')->with('error', 'Token vacío o corrupto.');
            }

            try {
                $response = Http::withToken($token)
                    ->acceptJson()
                    ->connectTimeout(5)
                    ->timeout(10)
                    ->get(config('services.ssu.auth_url') . '/api/auth/test_token');

                if ($response->status() !== 200 || ($response->json()['status'] ?? null) !== 200) {
                    $this->cerrarSesion($request, $user->id);
                    return redirect()->route('login')->with('error', 'Token expirado o inválido.');
                }
            } catch (\Exception $e) {
                $this->cerrarSesion($request, $user->id);
                return redirect()->route('login')->with('error', 'Error de conexión con el servidor externo.');
            }
        }

        return $next($request);
    }

    protected function cerrarSesion(Request $request, $userId = null)
    {
        if ($userId) {
            $tokenPath = storage_path('app/token_sesion_' . $userId . '.json');
            if (file_exists($tokenPath)) {
                unlink($tokenPath);
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
