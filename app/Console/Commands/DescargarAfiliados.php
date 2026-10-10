<?php

namespace App\Console\Commands;

use App\Services\AfiliadosSyncStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

class DescargarAfiliados extends Command
{
    protected $signature = 'afiliados:descargar {userId : Usuario cuyo token externo se utilizará}';
    protected $description = 'Busca diariamente candidatos para los recién nacidos pendientes';

    private const LOCK_SECONDS = 3600;
    private const MAX_PAGES = 10000;
    private const MAX_RATE_LIMIT_RETRIES = 5;

    public function handle(AfiliadosSyncStatus $syncStatus): int
    {
        $lock = Cache::lock('afiliados:descarga', self::LOCK_SECONDS);

        if (!$lock->get()) {
            $this->warn('Ya existe una descarga de afiliados en ejecución.');
            Log::warning('Se evitó iniciar una descarga de afiliados concurrente.');
            return self::SUCCESS;
        }

        $jsonHandle = null;
        $ndjsonHandle = null;
        $jsonTempPath = null;
        $ndjsonTempPath = null;

        try {
            $userId = (int) $this->argument('userId');
            $tokenPath = storage_path("app/token_sesion_{$userId}.json");
            $tokenData = file_exists($tokenPath)
                ? json_decode((string) file_get_contents($tokenPath), true)
                : [];
            $token = is_array($tokenData) ? ($tokenData['access_token'] ?? null) : null;

            if (!$token) {
                throw new RuntimeException('La sesión del servicio de pacientes no está disponible.');
            }

            $syncStatus->set('running', 'La sincronización de recién nacidos está en curso.', [
                'current_page' => 0,
                'records_reviewed' => 0,
                'candidates_found' => 0,
            ]);

            $storageDirectory = storage_path('app');
            $this->purgeLegacyCacheOnce($storageDirectory);

            $jsonPath = $storageDirectory . DIRECTORY_SEPARATOR . 'recien_nacidos_candidatos.json';
            $ndjsonPath = $storageDirectory . DIRECTORY_SEPARATOR . 'recien_nacidos_candidatos.ndjson';
            $runId = bin2hex(random_bytes(8));
            $jsonTempPath = $jsonPath . ".{$runId}.tmp";
            $ndjsonTempPath = $ndjsonPath . ".{$runId}.tmp";

            $jsonHandle = fopen($jsonTempPath, 'wb');
            $ndjsonHandle = fopen($ndjsonTempPath, 'wb');

            if (!$jsonHandle || !$ndjsonHandle) {
                throw new RuntimeException('No se pudieron crear los archivos temporales de salida.');
            }

            fwrite($jsonHandle, '[');

            $fechasPendientes = DB::table('historials')
                ->where('id_paciente', 0)
                ->whereNotNull('fecha_recien_necido')
                ->pluck('fecha_recien_necido')
                ->map(static fn ($fecha) => substr((string) $fecha, 0, 10))
                ->filter()
                ->unique()
                ->flip()
                ->all();

            $page = 1;
            $totalRevisados = 0;
            $totalCandidatos = 0;
            $firstRecord = true;
            $pageHashes = [];
            $url = config('services.ssu.admin_url');

            if ($fechasPendientes === []) {
                $this->info('No existen recién nacidos pendientes de sincronización.');
                Log::info('No existen recién nacidos pendientes de sincronización.');
            } else {
                $this->info('Buscando candidatos para recién nacidos desde la API...');
                Log::info('Inició la búsqueda diaria de candidatos para recién nacidos.', [
                    'fechas_pendientes' => count($fechasPendientes),
                ]);
            }

            while ($fechasPendientes !== [] && $page <= self::MAX_PAGES) {
                $response = $this->requestPage($url, $token, $page);

                if (!$response->ok()) {
                    throw new RuntimeException(
                        "La API respondió {$response->status()} al solicitar la página {$page}."
                    );
                }

                $data = $response->json('data', []);

                if (!is_array($data)) {
                    throw new RuntimeException("La página {$page} no contiene un arreglo data válido.");
                }

                if ($data === []) {
                    break;
                }

                $pageHash = hash('sha256', json_encode($data, JSON_UNESCAPED_UNICODE));

                if (isset($pageHashes[$pageHash])) {
                    throw new RuntimeException(
                        "La API repitió en la página {$page} el contenido recibido en la página " .
                        $pageHashes[$pageHash] . '. Verifique que el parámetro page sea respetado.'
                    );
                }

                $pageHashes[$pageHash] = $page;

                foreach ($data as $afiliado) {
                    $totalRevisados++;
                    $fechaNacimiento = substr((string) ($afiliado['fecha_nacimiento'] ?? ''), 0, 10);

                    if (!isset($fechasPendientes[$fechaNacimiento])) {
                        continue;
                    }

                    $json = json_encode($afiliado, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

                    if ($json === false) {
                        throw new RuntimeException("No se pudo codificar un afiliado de la página {$page}.");
                    }

                    if (!$firstRecord) {
                        fwrite($jsonHandle, ',');
                    }

                    fwrite($jsonHandle, $json);
                    fwrite($ndjsonHandle, $json . PHP_EOL);
                    $firstRecord = false;
                    $totalCandidatos++;
                }

                $this->info("Página {$page} revisada. Candidatos encontrados: {$totalCandidatos}");
                $syncStatus->set('running', "Revisando la página {$page} del servicio de pacientes.", [
                    'current_page' => $page,
                    'records_reviewed' => $totalRevisados,
                    'candidates_found' => $totalCandidatos,
                ]);
                $page++;
                usleep(500000);
            }

            if ($page > self::MAX_PAGES) {
                throw new RuntimeException(
                    'Se alcanzó el límite de seguridad de páginas sin recibir una página vacía.'
                );
            }

            fwrite($jsonHandle, ']');
            fclose($jsonHandle);
            fclose($ndjsonHandle);
            $jsonHandle = null;
            $ndjsonHandle = null;

            $this->replaceFile($jsonTempPath, $jsonPath);
            $jsonTempPath = null;
            $this->replaceFile($ndjsonTempPath, $ndjsonPath);
            $ndjsonTempPath = null;

            if (file_put_contents(
                storage_path('app/ultima_actualizacion_afiliados.txt'),
                time(),
                LOCK_EX
            ) === false) {
                throw new RuntimeException('No se pudo registrar la fecha de la sincronización diaria.');
            }

            $this->info("Sincronización de recién nacidos finalizada. Candidatos: {$totalCandidatos}");
            Log::info('Sincronización diaria de recién nacidos finalizada.', [
                'registros_revisados' => $totalRevisados,
                'candidatos_guardados' => $totalCandidatos,
                'ultima_pagina_con_datos' => $page - 1,
            ]);
            $syncStatus->set('completed', 'La sincronización de recién nacidos finalizó correctamente.', [
                'last_page' => $page - 1,
                'records_reviewed' => $totalRevisados,
                'candidates_found' => $totalCandidatos,
            ]);

            return self::SUCCESS;
        } catch (Throwable $e) {
            Log::error('Error en comando afiliados: ' . $e->getMessage());
            try {
                $syncStatus->set('failed', 'No se pudo completar la sincronización. Se volverá a intentar más tarde.');
            } catch (Throwable $statusException) {
                Log::error('No se pudo registrar el fallo de sincronización.', ['exception' => $statusException]);
            }
            $this->error($e->getMessage());
            return self::FAILURE;
        } finally {
            if (is_resource($jsonHandle)) {
                fclose($jsonHandle);
            }

            if (is_resource($ndjsonHandle)) {
                fclose($ndjsonHandle);
            }

            if ($jsonTempPath && file_exists($jsonTempPath)) {
                unlink($jsonTempPath);
            }

            if ($ndjsonTempPath && file_exists($ndjsonTempPath)) {
                unlink($ndjsonTempPath);
            }

            $lock->release();
        }
    }

    private function requestPage(string $url, string $token, int $page)
    {
        $attempt = 0;

        do {
            $response = Http::withToken($token)
                ->acceptJson()
                ->connectTimeout(10)
                ->timeout(30)
                ->get("{$url}/api/s1/administracion/pacientes", [
                    'page' => $page,
                ]);

            if ($response->status() !== 429) {
                return $response;
            }

            $attempt++;

            if ($attempt <= self::MAX_RATE_LIMIT_RETRIES) {
                $seconds = min(2 ** $attempt, 30);
                $this->warn("La API limitó la página {$page}. Reintentando en {$seconds} segundos...");
                sleep($seconds);
            }
        } while ($attempt <= self::MAX_RATE_LIMIT_RETRIES);

        return $response;
    }

    private function replaceFile(string $temporaryPath, string $destinationPath): void
    {
        if (!rename($temporaryPath, $destinationPath)) {
            throw new RuntimeException("No se pudo reemplazar el archivo {$destinationPath}.");
        }
    }

    private function purgeLegacyCacheOnce(string $storageDirectory): void
    {
        $markerPath = $storageDirectory . DIRECTORY_SEPARATOR . 'afiliados_cache_cleanup_v2.done';

        if (file_exists($markerPath)) {
            return;
        }

        $legacyFiles = [
            $storageDirectory . DIRECTORY_SEPARATOR . 'afiliados_cache.json',
            $storageDirectory . DIRECTORY_SEPARATOR . 'afiliados_lineas.ndjson',
        ];

        foreach ($legacyFiles as $legacyFile) {
            if (file_exists($legacyFile) && !unlink($legacyFile)) {
                throw new RuntimeException("No se pudo eliminar el archivo repetido {$legacyFile}.");
            }
        }

        if (file_put_contents($markerPath, now()->toIso8601String(), LOCK_EX) === false) {
            throw new RuntimeException('No se pudo registrar la limpieza inicial de afiliados.');
        }

        Log::warning('Se eliminaron los archivos antiguos de afiliados con datos repetidos.');
        $this->info('Limpieza inicial: archivos repetidos eliminados correctamente.');
    }
}
