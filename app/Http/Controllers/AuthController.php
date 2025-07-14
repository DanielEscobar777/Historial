<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Muestra la vista de inicio de sesión
    public function index()
    {
        return view('modules/auth/login');
    }

    // Muestra la vista de registro
    public function registro()
    {
        return view('modules/auth/registro');
    }

    // Registra un nuevo usuario en la base de datos
    public function registrar(Request $request)
    {
        $item = new User();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->password = Hash::make($request->password);
        $item->save();

        return to_route('login');
    }

    // Inicia sesión autenticando contra un endpoint PHP externo
public function loguear(Request $request)
{
    // Validar datos
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);
 // Llamar al servicio externo   
    /*$response = Http::post('http://192.168.4.55:8000/api/auth/login_service', [
        'email' => $request->email,
        'password' => $request->password,
    ]);*/
    // Enviar POST al PHP (ya adaptado)
    $response = Http::post('http://localhost/tokkens/login.php', [
        'email' => $request->email,
        'password' => $request->password, // ✅ se envía como "password"
    ]);

    $data = $response->json();

    // Validación de respuesta
    if (!$response->ok() || !isset($data['success']) || $data['success'] !== true || !isset($data['access_token'])) {
        Log::error('Error en login_service API', [
            'email' => $request->email,
            'response_status' => $response->status(),
            'response_body' => $response->body(),
            'parsed_json' => $data,
        ]);
        return back()->with('error', 'Credenciales inválidas o usuario no autorizado.');
    }

    $accessToken = $data['access_token'];
    $userData = $data['user'];

    // Buscar usuario en base de datos local
    $user = User::where('email', $userData['email'])->first();

    if (!$user) {
        // Crear usuario si no existe
        $user = new User();
        $user->name = $userData['name'] ?? $request->email;
        $user->email = $userData['email'];
        $user->password = bcrypt($request->password);
        $user->save();
    } else {
        // ✅ Si ya existe, actualizar contraseña (por si cambió en el PHP)
        $user->password = bcrypt($request->password);
        $user->save();
    }

    // Guardar token en storage
    $tokenPath = storage_path('app/token_sesion_' . $user->id . '.json');
    file_put_contents($tokenPath, json_encode([
        'access_token' => $accessToken,
        'token_type' => $data['token_type'],
        'expires_in_minutes' => $data['expires_in_minutes'],
        'issued_at' => now()
    ]));

    Auth::login($user);
    Session::put('login_time', now());

    return to_route('welcome');
}



    public function welcome()
    {
        return view('welcome');
    }

    public function logout()
    {
        $user = Auth::user();

        if ($user) {
            $tokenPath = storage_path('app/token_sesion_' . $user->id . '.json');
            if (file_exists($tokenPath)) {
                unlink($tokenPath);
            }
        }

        Session::flush();
        Auth::logout();
        return to_route('login');
    }
}
