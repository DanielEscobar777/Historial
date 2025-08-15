<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PacienteController extends Controller
{

    protected $cacheKeyPrefix = 'afiliados_cache_';
    protected $cacheTTL = 3600;

    

    // Método principal para actualizar RN desde la API
    public function actualizarRecienNacidosDesdeApi()
    {
        try {
            $recienNacidos = DB::table('pacientes')
                ->where('nombres', 'LIKE', 'RN_%')
                ->get();

            if ($recienNacidos->isEmpty()) {
                return response()->json(['mensaje' => 'No se encontraron recién nacidos en la base de datos.']);
            }

            $agrupadosPorFecha = $recienNacidos->groupBy(function ($item) {
                return Carbon::parse($item->fecha_nacimiento)->toDateString();
            });

            $resultados = [];

            foreach ($agrupadosPorFecha as $fecha => $grupo) {
                if ($grupo->count() > 1) {
                    $nombres = $grupo->pluck('nombres')->implode(', ');
                    $resultados[] = [
                        'tipo' => 'conflicto_bd',
                        'fecha_nacimiento' => $fecha,
                        'pacientes' => $nombres,
                        'mensaje' => "Existen múltiples recién nacidos con la fecha {$fecha}: {$nombres}. Requiere revisión."
                    ];
                }
            }

            $pacientesSinConflicto = $recienNacidos->filter(function ($paciente) use ($agrupadosPorFecha) {
                return $agrupadosPorFecha[Carbon::parse($paciente->fecha_nacimiento)->toDateString()]->count() === 1;
            });

            $afiliados = $this->obtenerTodosLosAfiliados();

            if (is_array($afiliados) && isset($afiliados['error'])) {
                return response()->json($afiliados, 500);
            }

            foreach ($pacientesSinConflicto as $paciente) {
                $fechaNac = Carbon::parse($paciente->fecha_nacimiento)->toDateString();
                $matches = collect($afiliados)->where('fecha_nacimiento', $fechaNac);

                if ($matches->count() === 1) {
                    $match = $matches->first();

                    DB::table('pacientes')->where('id', $paciente->id)->update([
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

                    DB::table('historials')->where('id_paciente', $paciente->id)->update([
                        'nombre_recien_necido' => $match['nombres']
                    ]);

                    $resultados[] = [
                        'tipo' => 'exito',
                        'paciente' => $paciente->nombres,
                        'mensaje' => "Actualizado con datos del afiliado '{$match['nombres']}'"
                    ];
                } elseif ($matches->count() > 1) {
                    $nombresCoincidentes = $matches->pluck('nombres')->implode(', ');
                    $resultados[] = [
                        'tipo' => 'conflicto_api',
                        'paciente' => $paciente->nombres,
                        'mensaje' => "Múltiples coincidencias en la API: {$nombresCoincidentes}"
                    ];
                } else {
                    $resultados[] = [
                        'tipo' => 'no_encontrado',
                        'paciente' => $paciente->nombres,
                        'mensaje' => "No se encontró coincidencia para la fecha de nacimiento {$fechaNac}"
                    ];
                }
            }

            return response()->json($resultados);
        } catch (\Throwable $e) {
            Log::error('Error en actualizarRecienNacidosDesdeApi: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno. Revisa el log.'], 500);
        }
    }

    // Método para buscar coincidencias RN vs API
    public function buscarRecienNacidos()
    {
        try {
            $recienNacidos = DB::table('pacientes')
                ->where('nombres', 'LIKE', 'RN_%')
                ->get();

            if ($recienNacidos->isEmpty()) {
                return response()->json(['mensaje' => 'No se encontraron recién nacidos en la base de datos.']);
            }

            $afiliados = $this->obtenerTodosLosAfiliados();

            if (is_array($afiliados) && isset($afiliados['error'])) {
                return response()->json($afiliados, 500);
            }

            $resultados = [];

            foreach ($recienNacidos as $paciente) {
                $fechaNac = Carbon::parse($paciente->fecha_nacimiento)->toDateString();
                $encontrado = collect($afiliados)->firstWhere('fecha_nacimiento', $fechaNac);

                $resultados[] = [
                    'paciente_local' => $paciente,
                    'fecha_nacimiento' => $fechaNac,
                    'encontrado_api' => $encontrado ? true : false
                ];
            }

            return response()->json($resultados);
        } catch (\Throwable $e) {
            Log::error('Error en buscarRecienNacidos: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno. Revisa el log.'], 500);
        }
    }

    // Método para buscar por CI
    public function buscarPorCI(Request $request)
    {
        if (!$request->filled('term')) {
            return response()->json([]);
        }

        $term = trim($request->input('term'));

        if ($term === '') {
            return response()->json([]);
        }

        try {
            $user = Auth::user();
            $cacheKey = $this->cacheKeyPrefix . $user->id;

            $usuarios = Cache::get($cacheKey);

            if (!$usuarios) {
                $usuarios = $this->obtenerTodosLosAfiliados();

                if (is_array($usuarios) && isset($usuarios['error'])) {
                    return response()->json($usuarios, 500);
                }

                Cache::put($cacheKey, $usuarios, $this->cacheTTL);
            }

            $resultados = collect($usuarios)
                ->filter(function ($usuario) use ($term) {
                    return stripos($usuario['ci'], $term) !== false;
                })
                ->take(50)
                ->values();

            return response()->json($resultados);
        } catch (\Throwable $e) {
            Log::error('Error en buscarPorCI: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno. Revisa el log.'], 500);
        }
    }

    // 🔁 Método reutilizable para obtener todos los afiliados paginando
    protected function obtenerTodosLosAfiliados()
{
    try {
        $cachePath = storage_path('app/afiliados_cache.json');

        if (!file_exists($cachePath)) {
            return ['error' => 'El archivo de afiliados aún no ha sido generado.'];
        }

        $contenido = file_get_contents($cachePath);
        $afiliados = json_decode($contenido, true);

        if (!is_array($afiliados)) {
            return ['error' => 'El formato del archivo de afiliados es inválido.'];
        }

        return $afiliados;
    } catch (\Throwable $e) {
        Log::error('Error al leer afiliados_cache.json: ' . $e->getMessage());
        return ['error' => 'Error interno al leer el archivo de afiliados.'];
    }
}

}
