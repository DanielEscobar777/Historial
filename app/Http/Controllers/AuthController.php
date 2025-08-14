<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
 
    public function index()
    {
        return view('modules/auth/login');
    }

    public function registro()
    {
        return view('modules/auth/registro');
    }

    
    public function registrar(Request $request)
    {
        $item = new User();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->password = Hash::make($request->password);
        $item->save();

        return to_route('login');
    }


public function loguear(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);
    //$response = Http::post('http://localhost/tokkens/login.php', [
    $response = Http::post('http://192.168.4.55:8000/api/auth/login_service', [
        'email' => $request->email,
        'password' => $request->password,
    ]);

    $data = $response->json();

    if (!$response->ok() || !isset($data['success']) || $data['success'] !== true || !isset($data['access_token'])) {
        return back()->with('error', 'Credenciales inválidas o usuario no autorizado.');
    }

    $accessToken = $data['access_token'];
    $userData = $data['user'];

   
    $user = User::firstOrNew(['email' => $userData['email']]);
    $user->name = $userData['name'] ?? $request->email;
    $user->password = bcrypt($request->password);
    $user->save();

   
    $tokenPath = storage_path('app/token_sesion_' . $user->id . '.json');
    file_put_contents($tokenPath, json_encode([
        'access_token' => $accessToken,
        'token_type' => $data['token_type'],
        'expires_in_minutes' => $data['expires_in_minutes'],
        'issued_at' => now()
    ]));

    
    Auth::login($user);
    Session::put('login_time', now());

//  $usuariosResponse = Http::get('http://localhost/tokkens/usuarios_residentes.php');
    $usuariosResponse = Http::get('http://192.168.4.55:8001/api/s1/administracion/user_residente');

    if ($usuariosResponse->ok()) {
        $usuariosData = $usuariosResponse->json();
        $usuariosLista = $usuariosData['data'] ?? [];

       
        foreach ($usuariosLista as $externo) {
            if ($externo['email'] === $user->email) {
                $rolTexto = strtolower(trim($externo['rol']));

               
                $rolesMap = [
                    'jefe de enseñanza' => 1,
                    'residente' => 2,
                    'interno' => 3
                ];

                if (isset($rolesMap[$rolTexto])) {
    $roleId = $rolesMap[$rolTexto];

    $yaAsignado = DB::table('role_user')
        ->where('user_id', $user->id)
        ->where('role_id', $roleId)
        ->exists();

    if (!$yaAsignado) {
        try {
            DB::table('role_user')->insert([
                'user_id' => $user->id,
                'role_id' => $roleId,
                'assigned_at' => now()
            ]);
        } catch (\Exception $e) {
            // Guardamos un error en el log y lo mandamos como alerta visual
            Log::error("Error al asignar rol al usuario {$user->email}: " . $e->getMessage());
            return back()->with('error', 'No se pudo asignar el rol al usuario. Contacte al administrador.');
        }
    }
} else {
    // El rol no está en el mapa de roles válidos
    return back()->with('error', 'El rol "' . $externo['rol'] . '" no está definido en el sistema.');
}


                break;
            }
        }
    }

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
