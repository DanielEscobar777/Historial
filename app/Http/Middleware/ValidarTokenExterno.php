<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ValidarTokenExterno
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $tokenPath = storage_path('app/token_sesion_' . $user->id . '.json');

            if (!file_exists($tokenPath)) {
                $this->cerrarSesion();
                return redirect()->route('login')->with('error', 'Token no encontrado. Inicia sesión nuevamente.');
            }

            $tokenData = json_decode(file_get_contents($tokenPath), true);
            $token = $tokenData['access_token'] ?? null;

            if (!$token) {
                $this->cerrarSesion();
                return redirect()->route('login')->with('error', 'Token vacío o corrupto.');
            }

            try {
                $response = Http::withToken($token)
                   ->get('http://192.168.4.55:8000/api/auth/test_token');
                  // ->get('http://localhost/tokkens/token-test.php');
                 //->get('https://67a7434660c5.ngrok-free.app/tokkens/token-test.php');

                if ($response->status() !== 200 || ($response->json()['status'] ?? null) !== 200) {
                    $this->cerrarSesion($user->id);
                    return redirect()->route('login')->with('error', 'Token expirado o inválido.');
                }
            } catch (\Exception $e) {
                $this->cerrarSesion($user->id);
                return redirect()->route('login')->with('error', 'Error de conexión con el servidor externo.');
            }
        }

        return $next($request);
    }

    protected function cerrarSesion($userId = null)
    {
        if ($userId) {
            $tokenPath = storage_path('app/token_sesion_' . $userId . '.json');
            if (file_exists($tokenPath)) {
                unlink($tokenPath);
            }
        }

        Auth::logout();
        Session::flush();
    }
}
