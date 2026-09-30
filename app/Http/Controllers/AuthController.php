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

    private function puedeActualizarAfiliados()
    {
        $path = storage_path('app/ultima_actualizacion_afiliados.txt');

        if (!file_exists($path)) {
            return true;
        }

        $ultimaActualizacion = (int) file_get_contents($path);
        $ahora = time();

        return ($ahora - $ultimaActualizacion) >= 300; // 5 minutos
    }

    private function registrarActualizacionAfiliados()
    {
        $path = storage_path('app/ultima_actualizacion_afiliados.txt');
        file_put_contents($path, time());
    }

    public function loguear(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        /*$response = Http::post('http://localhost/tokkens/login.php', [
            'email' => $request->email,
            'password' => $request->password,
        ]);*/
         $response = Http::post('http://172.16.0.246:8000/api/auth/login_service', [
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

        // Asignación de roles
       /*$usuariosResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken
        ])->get('http://localhost/tokkens/usuarios_residentes.php');*/

        $url = env('HOST_SSU');

        $usuariosResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken
        ])->get("{$url}/api/s1/administracion/user_residente");
        

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
                            DB::table('role_user')->insert([
                                'user_id' => $user->id,
                                'role_id' => $roleId,
                                'assigned_at' => now()
                            ]);
                        }
                    }
                    break;
                }
            }
        }

        // Ejecutar descarga en segundo plano (Linux)
        if ($this->puedeActualizarAfiliados()) {
            try {
                $this->iniciarDescargaAfiliados($accessToken);
                $this->registrarActualizacionAfiliados();
                Log::info('Se solicitó la descarga de afiliados en segundo plano para el usuario ID: ' . $user->id);
            } catch (\Throwable $e) {
                Log::error('Error lanzando comando afiliados en background: ' . $e->getMessage());
            }
        } else {
            Log::info('No se actualizó afiliados: actualización reciente detectada (menos de 5 minutos).');
        }

        return to_route('welcome');
    }

    private function iniciarDescargaAfiliados(string $accessToken): void
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $quotePowerShell = static function (string $value): string {
                return "'" . str_replace("'", "''", $value) . "'";
            };

            $script = sprintf(
                'Start-Process -FilePath %s -WorkingDirectory %s -ArgumentList @(%s,%s,%s) -WindowStyle Hidden',
                $quotePowerShell(PHP_BINARY),
                $quotePowerShell(base_path()),
                $quotePowerShell('artisan'),
                $quotePowerShell('afiliados:descargar'),
                $quotePowerShell($accessToken)
            );
            $encodedScript = base64_encode(iconv('UTF-8', 'UTF-16LE', $script));
            $command = 'powershell.exe -NoProfile -NonInteractive -EncodedCommand ' . escapeshellarg($encodedScript);
            exec($command, $output, $exitCode);

            if ($exitCode !== 0) {
                throw new \RuntimeException("No se pudo iniciar la descarga de afiliados (código {$exitCode}).");
            }

            return;
        }

        $php = escapeshellarg(PHP_BINARY);
        $artisan = escapeshellarg(base_path('artisan'));
        $token = escapeshellarg($accessToken);
        $command = "{$php} {$artisan} afiliados:descargar {$token} > /dev/null 2>&1 & echo $!";
        $processId = trim((string) shell_exec($command));

        if ($processId === '' || !ctype_digit($processId)) {
            throw new \RuntimeException('No se pudo obtener el identificador del proceso de descarga de afiliados.');
        }

        Log::info('Proceso de descarga de afiliados iniciado.', [
            'pid' => (int) $processId,
        ]);
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
