<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PacienteController extends Controller
{
    protected $cacheKeyPrefix = 'afiliados_cache_';
    protected $cacheTTL = 3600;
public function actualizarRecienNacidosDesdeApi()
{
    try {
        // 1. Obtener pacientes recién nacidos
        $recienNacidos = \DB::table('pacientes')
            ->where('nombres', 'LIKE', 'RN_%')
            ->get();

        if ($recienNacidos->isEmpty()) {
            return response()->json(['mensaje' => 'No se encontraron recién nacidos en la base de datos.']);
        }

        // Verificar si hay más de un RN con la misma fecha de nacimiento
        $agrupadosPorFecha = $recienNacidos->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->fecha_nacimiento)->toDateString();
        });

        $resultados = [];

        foreach ($agrupadosPorFecha as $fecha => $grupo) {
            if ($grupo->count() > 1) {
                $nombres = $grupo->pluck('nombres')->implode(', ');
                $resultados[] = [
                    'tipo' => 'conflicto_bd',
                    'fecha_nacimiento' => $fecha,
                    'pacientes' => $nombres,
                    'mensaje' => "Existen múltiples recién nacidos con la fecha de nacimiento {$fecha}: {$nombres}. Requiere revisión y actualización manual."
                ];
            }
        }

        // Continuar solo con pacientes sin conflicto local
        $pacientesSinConflicto = $recienNacidos->filter(function ($paciente) use ($agrupadosPorFecha) {
            return $agrupadosPorFecha[\Carbon\Carbon::parse($paciente->fecha_nacimiento)->toDateString()]->count() === 1;
        });

        // 2. Obtener token
        $user = Auth::user();
        $tokenPath = storage_path('app/token_sesion_' . $user->id . '.json');

        if (!file_exists($tokenPath)) {
            return response()->json(['error' => 'Token no encontrado'], 401);
        }

        $tokenData = json_decode(file_get_contents($tokenPath), true);
        $token = $tokenData['access_token'] ?? null;

        if (!$token) {
            return response()->json(['error' => 'Token inválido'], 401);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('http://192.168.4.55:8001/api/s1/administracion/pacientes');

           // ->get("http://localhost/tokkens/lista_afiliados.php");

        if (!$response->ok()) {
            return response()->json(['error' => 'Error al acceder a la API externa'], 500);
        }

        $apiData = $response->json();
        $afiliados = $apiData['data'] ?? [];

        // 4. Procesar pacientes sin conflicto local
        foreach ($pacientesSinConflicto as $paciente) {
            $fechaNac = \Carbon\Carbon::parse($paciente->fecha_nacimiento)->toDateString();

            // Buscar coincidencias por fecha
            $matches = collect($afiliados)->where('fecha_nacimiento', $fechaNac);

            if ($matches->count() === 1) {
                $match = $matches->first();

                // Actualizar paciente
                \DB::table('pacientes')->where('id', $paciente->id)->update([
                    'nombres' => $match['nombres'],
                    'p_apellido' => $match['p_apellido'],
                    's_apellido' => $match['s_apellido'],
                    'sexo' => $match['sexo'],
                    'fecha_nacimiento' => $match['fecha_nacimiento'],
                    'ci' => $match['ci'],
                    'complemento' => $match['complemento'],
                    'matricula_seguro' => $match['matricula_seguro'],
                    'nacionalidad' => $match['nacionalidad'],
                    'telefono' => $match['telefono'],
                    'residencia' => $match['residencia'],
                    'updated_at' => now()
                ]);

                // Actualizar tabla historials
                \DB::table('historials')
                    ->where('id_paciente', $paciente->id)
                    ->update([
                        'nombre_recien_necido' => $match['nombres']
                    ]);

                $resultados[] = [
                    'tipo' => 'exito',
                    'paciente' => $paciente->nombres,
                    'mensaje' => "Recién nacido '{$paciente->nombres}' fue actualizado correctamente con datos del afiliado '{$match['nombres']}'"
                ];
            } elseif ($matches->count() > 1) {
                $nombresCoincidentes = $matches->pluck('nombres')->implode(', ');
                $resultados[] = [
                    'tipo' => 'conflicto_api',
                    'paciente' => $paciente->nombres,
                    'mensaje' => "Se encontraron múltiples coincidencias en la API por la fecha de nacimiento de '{$paciente->nombres}': {$nombresCoincidentes}. Requiere revisión manual."
                ];
            } else {
                $resultados[] = [
                    'tipo' => 'no_encontrado',
                    'paciente' => $paciente->nombres,
                    'mensaje' => "No se encontraron actualizaciones en el recien nacido '{$paciente->nombres}' con la fecha de nacimiento de {$fechaNac}."
                ];
            }
        }

        return response()->json($resultados);
    } catch (\Throwable $e) {
        \Log::error('Error general en actualizarRecienNacidosDesdeApi: ' . $e->getMessage());
        return response()->json(['error' => 'Ocurrió un error. Revisa el log.']);
    }
}


    public function buscarRecienNacidos()
{
    $recienNacidos = \DB::table('pacientes')
        ->where('nombres', 'LIKE', 'RN_%')
        ->get();

    if ($recienNacidos->isEmpty()) {
        return response()->json(['mensaje' => 'No se encontraron recién nacidos en la base de datos.']);
    }

    $user = Auth::user();
    $tokenPath = storage_path('app/token_sesion_' . $user->id . '.json');

    if (!file_exists($tokenPath)) {
        return response()->json(['error' => 'Token no encontrado'], 401);
    }

    $tokenData = json_decode(file_get_contents($tokenPath), true);
    $token = $tokenData['access_token'] ?? null;

    if (!$token) {
        return response()->json(['error' => 'Token inválido'], 401);
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token
    ])->get('http://192.168.4.55:8001/api/s1/administracion/pacientes');


    if (!$response->ok()) {
        return response()->json(['error' => 'Error al acceder a la API externa'], 500);
    }

    $apiData = $response->json();
    $afiliados = $apiData['data'] ?? [];

    $resultados = [];

    foreach ($recienNacidos as $paciente) {
        // Obtener fecha desde campo fecha_nacimiento
        $fechaNac = \Carbon\Carbon::parse($paciente->fecha_nacimiento)->toDateString();

        // Buscar coincidencia exacta de fecha_nacimiento en la API
        $encontrado = collect($afiliados)->firstWhere('fecha_nacimiento', $fechaNac);

        $resultados[] = [
            'paciente_local' => $paciente,
            'fecha_nacimiento' => $fechaNac,
            'encontrado_api' => $encontrado ? true : false
        ];
    }

    return response()->json($resultados);
}

    public function buscarPorCI(Request $request)
    {
        if (!$request->has('term')) {
            return response()->json([]);
        }

        $term = trim($request->input('term'));
        if ($term === '') {
            return response()->json([]);
        }

      
        $user = Auth::user();
        $tokenPath = storage_path('app/token_sesion_' . $user->id . '.json');

        if (!file_exists($tokenPath)) {
            return response()->json(['error' => 'Token no encontrado'], 401);
        }

        $tokenData = json_decode(file_get_contents($tokenPath), true);
        $token = $tokenData['access_token'] ?? null;

        if (!$token) {
            return response()->json(['error' => 'Token inválido'], 401);
        }

        $cacheKey = $this->cacheKeyPrefix . $user->id;

        
        $usuarios = Cache::get($cacheKey);

        if (!$usuarios) {
          
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get('http://192.168.4.55:8001/api/s1/administracion/pacientes');

             //   ->get("http://localhost/tokkens/lista_afiliados.php");

            if (!$response->ok()) {
                return response()->json(['error' => 'Error al acceder a la API externa'], 500);
            }

            $data = $response->json();

            if (!isset($data['data']) || !is_array($data['data'])) {
                return response()->json([]);
            }

            $usuarios = $data['data'];

         
            Cache::put($cacheKey, $usuarios, $this->cacheTTL);
        }

        $resultados = [];

        
        foreach ($usuarios as $usuario) {
            if (stripos($usuario['ci'], $term) !== false) {
                $resultados[] = $usuario;
            }
        }
        $resultados = array_slice($resultados, 0, 50);

        return response()->json($resultados);
    }    
}
