<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PacienteController extends Controller
{
    protected $ndjsonPath = 'app/afiliados_lineas.ndjson';

    // ✅ Método principal para actualizar RN desde API
public function actualizarRecienNacidosDesdeApi() 
{
    Log::info('Método actualizarRecienNacidosDesdeApi llamado');
    try {
        // 1. Obtener recien nacidos desde la tabla historial (donde id_paciente = 0)
        $recienNacidos = DB::table('historials')
            ->where('id_paciente', 0)
            ->whereNotNull('nombre_recien_necido')
            ->where('nombre_recien_necido', '<>', '')
            ->select(
                'id_historia',
                'id_paciente',
                'nombre_recien_necido',
                'fecha_recien_necido',
                'hora_recien_necido',
                'sexo'
            )
            ->get();

        Log::info("👶 Recién nacidos encontrados en historials con id_paciente=0: " . $recienNacidos->count());

        if ($recienNacidos->isEmpty()) {
            return response()->json(['mensaje' => 'No se encontraron recién nacidos en la base de datos.']);
        }

        // 2. Agrupar por fecha de nacimiento
        $agrupadosPorFecha = $recienNacidos->groupBy(function ($item) {
            return Carbon::parse($item->fecha_recien_necido)->toDateString();
        });

        $resultados = [];

        // 3. Verificar conflictos por fecha
        foreach ($agrupadosPorFecha as $fecha => $grupo) {
            if ($grupo->count() > 1) {
                // Opcional: incluir IDs
                $detalles = $grupo->map(function($item) {
                    return "{$item->nombre_recien_necido} (ID: {$item->id_historia})";
                })->implode(', ');

                $resultados[] = [
                    'tipo' => 'conflicto_bd',
                    'fecha_nacimiento' => $fecha,
                    'pacientes' => $detalles,
                    'paciente' => '', // Para evitar "undefined"
                    'mensaje' => "Existen múltiples recién nacidos con la fecha {$fecha}: {$detalles}. Requiere revisión."
                ];
            }
        }

        // 4. Filtrar recien nacidos sin conflicto
        $recienNacidosSinConflicto = $recienNacidos->filter(function ($paciente) use ($agrupadosPorFecha) {
            return $agrupadosPorFecha[Carbon::parse($paciente->fecha_recien_necido)->toDateString()]->count() === 1;
        });

        Log::info("Recién nacidos sin conflicto: " . $recienNacidosSinConflicto->count());

        // 5. Procesar cada RN sin conflicto
        foreach ($recienNacidosSinConflicto as $paciente) {
            $fechaNac = Carbon::parse($paciente->fecha_recien_necido)->toDateString();
            $nombreRN = $paciente->nombre_recien_necido;

            // Buscar coincidencias en afiliados con fecha (streaming)
            $matches = $this->buscarAfiliadosPorFecha($fechaNac);

            Log::info("🔍 Buscando coincidencias para RN '{$nombreRN}' con fecha {$fechaNac}: " . count($matches));

            if (count($matches) === 1) {
                $match = $matches[0];

                // Crear nuevo paciente con datos del afiliado
                Log::info('PASO 4: intentando insertar paciente', [
    'datos' => $match
]);
                $nuevoId = DB::table('pacientes')->insertGetId([
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
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Actualizar el historial con nuevo id_paciente
                DB::table('historials')
                    ->where('id_historia', $paciente->id_historia)
                    ->update([
                        'id_paciente' => $nuevoId,
                        'nombre_recien_necido' => $match['nombres']
                    ]);

                $resultados[] = [
                    'tipo' => 'creado',
                    'paciente' => $match['nombres'],
                    'mensaje' => "Paciente nuevo creado con ID {$nuevoId} a partir de RN '{$nombreRN}'"
                ];

                Log::info("🆕 Paciente creado con ID {$nuevoId} desde historial ID {$paciente->id_historia}");

            } elseif (count($matches) > 1) {
                $nombresCoincidentes = implode(', ', array_column($matches, 'nombres'));
                $resultados[] = [
                    'tipo' => 'conflicto_api',
                    'paciente' => $nombreRN,
                    'mensaje' => "Múltiples coincidencias en la API: {$nombresCoincidentes}"
                ];
            } else {
                $resultados[] = [
                    'tipo' => 'no_encontrado',
                    'paciente' => $nombreRN,
                    'mensaje' => "No se encontró coincidencia para la fecha de nacimiento {$fechaNac}"
                ];
            }
        }

        return response()->json($resultados);

    } catch (\Throwable $e) {
        Log::error('❌ Error en actualizarRecienNacidosDesdeApi: ' . $e->getMessage());
        return response()->json(['error' => 'Error interno. Revisa el log.'], 500);
    }
}





    // ✅ Método para buscar coincidencias RN vs API
    public function buscarRecienNacidos()
    {
        try {
            $recienNacidos = DB::table('pacientes')
                ->where('nombres', 'LIKE', 'RN_%')
                ->get();

            Log::info("🔎 buscarRecienNacidos: RN encontrados: " . $recienNacidos->count());

            if ($recienNacidos->isEmpty()) {
                return response()->json(['mensaje' => 'No se encontraron recién nacidos en la base de datos.']);
            }

            $resultados = [];

            foreach ($recienNacidos as $paciente) {
                $fechaNac = Carbon::parse($paciente->fecha_nacimiento)->toDateString();
                $encontrado = $this->buscarAfiliadosPorFecha($fechaNac);

                $resultados[] = [
                    'paciente_local' => $paciente,
                    'fecha_nacimiento' => $fechaNac,
                    'encontrado_api' => count($encontrado) > 0
                ];
            }

            Log::info("🔍 Comparación de RN finalizada.");

            return response()->json($resultados);
        } catch (\Throwable $e) {
            Log::error('❌ Error en buscarRecienNacidos: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno. Revisa el log.'], 500);
        }
    }

    // ✅ Método para buscar afiliados por CI
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
            Log::info("🔍 Buscando CI: {$term}");

            $resultados = $this->buscarAfiliadosPorCI($term, 50);

            if (is_array($resultados) && isset($resultados['error'])) {
                return response()->json($resultados, 500);
            }

            Log::info("🎯 Resultados encontrados: " . count($resultados));

            return response()->json($resultados);
        } catch (\Throwable $e) {
            Log::error('❌ Error en buscarPorCI: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno. Revisa el log.'], 500);
        }
    }

    public function ensureNdjsonExists()
    {
        $ndjsonPath = storage_path($this->ndjsonPath);
        if (file_exists($ndjsonPath) && filesize($ndjsonPath) > 0) {
            return true;
        }

        $jsonPath = storage_path('app/afiliados_cache.json');
        if (!file_exists($jsonPath)) {
            return false;
        }

        return $this->convertirJsonANdjson($jsonPath, $ndjsonPath);
    }

    private function convertirJsonANdjson($jsonPath, $ndjsonPath)
    {
        $memoriaNecesaria = filesize($jsonPath) * 1.5;
        $memoriaLimit = ini_get('memory_limit');
        if ($memoriaLimit !== '-1') {
            $memoriaActual = $this->return_bytes($memoriaLimit);
            if ($memoriaNecesaria > $memoriaActual) {
                ini_set('memory_limit', (int)($memoriaNecesaria / 1024 / 1024 + 64) . 'M');
            }
        }

        $content = file_get_contents($jsonPath);
        if ($content === false) {
            Log::error('No se pudo leer afiliados_cache.json para conversión NDJSON');
            return false;
        }

        $content = ltrim($content);
        if (isset($content[0]) && $content[0] === '[') {
            $content = substr($content, 1);
        }
        $content = rtrim($content);
        if (substr($content, -1) === ']') {
            $content = substr($content, 0, -1);
        }

        $outHandle = fopen($ndjsonPath, 'w');
        if (!$outHandle) return false;

        $count = 0;
        $len = strlen($content);
        $depth = 0;
        $start = 0;
        $inString = false;
        $escape = false;

        for ($i = 0; $i < $len; $i++) {
            $char = $content[$i];
            if ($escape) { $escape = false; continue; }
            if ($char === '\\' && $inString) { $escape = true; continue; }
            if ($char === '"') { $inString = !$inString; continue; }
            if ($inString) continue;

            if ($char === '{') {
                if ($depth === 0) $start = $i;
                $depth++;
            } elseif ($char === '}') {
                $depth--;
                if ($depth === 0) {
                    fwrite($outHandle, substr($content, $start, $i - $start + 1) . "\n");
                    $count++;
                }
            }
        }

        fclose($outHandle);
        unset($content);

        Log::info("Archivo NDJSON generado. Total registros: {$count}");
        return $count > 0;
    }

    // ✅ Streaming: buscar por CI sin cargar todo en memoria
    protected function buscarAfiliadosPorCI($term, $limit = 50)
    {
        $this->ensureNdjsonExists();
        $path = storage_path($this->ndjsonPath);

        if (!file_exists($path)) {
            return ['error' => 'El archivo de afiliados aún no ha sido generado.'];
        }

        $handle = fopen($path, 'r');
        if (!$handle) {
            return ['error' => 'No se pudo abrir el archivo de afiliados.'];
        }

        $resultados = [];
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            if ($line === '') continue;
            $afiliado = json_decode($line, true);
            if ($afiliado && stripos((string)($afiliado['ci'] ?? ''), $term) !== false) {
                $resultados[] = $afiliado;
                if (count($resultados) >= $limit) break;
            }
        }

        fclose($handle);
        return $resultados;
    }

    // ✅ Streaming: buscar por fecha_nacimiento (para RN)
    protected function buscarAfiliadosPorFecha($fechaNac)
    {
        $this->ensureNdjsonExists();
        $path = storage_path($this->ndjsonPath);

        if (!file_exists($path)) {
            return ['error' => 'El archivo de afiliados aún no ha sido generado.'];
        }

        $handle = fopen($path, 'r');
        if (!$handle) {
            return ['error' => 'No se pudo abrir el archivo de afiliados.'];
        }

        $matches = [];
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            if ($line === '') continue;
            $afiliado = json_decode($line, true);
            if ($afiliado && ($afiliado['fecha_nacimiento'] ?? '') === $fechaNac) {
                $matches[] = $afiliado;
            }
        }

        fclose($handle);
        return $matches;
    }

    // ✅ Streaming: obtener todos los afiliados (solo cuando es estrictamente necesario)
    protected function obtenerTodosLosAfiliados()
    {
        $path = storage_path($this->ndjsonPath);

        if (!file_exists($path)) {
            return ['error' => 'El archivo de afiliados aún no ha sido generado.'];
        }

        $handle = fopen($path, 'r');
        if (!$handle) {
            return ['error' => 'No se pudo abrir el archivo de afiliados.'];
        }

        $afiliados = [];
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            if ($line === '') continue;
            $afiliado = json_decode($line, true);
            if ($afiliado) {
                $afiliados[] = $afiliado;
            }
        }

        fclose($handle);
        return $afiliados;
    }

    private function return_bytes($val)
    {
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);
        $val = (int) $val;
        switch ($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }
}
