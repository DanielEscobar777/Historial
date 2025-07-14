<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LoginExternoController extends Controller
{
    public function loguear(Request $request)
    {
        try {
            $response = Http::post('http://localhost/tokkens/login.php', [
                'usuario' => $request->usuario,
                'password' => $request->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                Session::put('jwt_token', $data['token']);
                Session::put('usuario_email', $request->usuario);
                Session::put('logged_in', true); // bandera personalizada

                return redirect()->route('welcome');
            }

            $error = $response->json();

            return back()->withErrors([
                'login_error' => $error['error'] ?? 'Credenciales inválidas',
            ])->withInput();
        } catch (\Exception $e) {
            return back()->withErrors([
                'login_error' => 'Error de conexión con el servidor externo: ' . $e->getMessage(),
            ]);
        }
    }
public function welcome()
{
    return view('welcome'); // Asegúrate de tener resources/views/welcome.blade.php
}
}

