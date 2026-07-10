<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DescargarAfiliados extends Command
{
    protected $signature = 'afiliados:descargar {token}';
    protected $description = 'Descarga todos los afiliados paginados y los guarda en JSON y NDJSON';

    public function handle()
    {
        try {
            $token = $this->argument('token');

            if (!$token) {
                $this->error('Token inválido o no proporcionado.');
                return;
            }

            $pagina = 1;
            $total = 0;

            $jsonPath = storage_path('app/afiliados_cache.json');
            $ndjsonPath = storage_path('app/afiliados_lineas.ndjson');

            $jsonHandle = fopen($jsonPath, 'w');
            $ndjsonHandle = fopen($ndjsonPath, 'w');

            if (!$jsonHandle || !$ndjsonHandle) {
                $this->error('No se pudieron crear los archivos de salida.');
                return;
            }

            fwrite($jsonHandle, '[');
            $first = true;

            $this->info('Descargando afiliados desde la API...');

            $url = rtrim(env('HOST_SSU', 'http://localhost'), '/');
            while (true) {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token
                ])->get("{$url}/api/s1/administracion/pacientes", [
                    'pagina' => $pagina
                ]);

                if ($response->status() === 429) {
                    $this->warn("Esperando para evitar el error 429...");
                    sleep(2);
                    continue;
                }

                if (!$response->ok()) {
                    $this->error('Error al acceder a la API en la página ' . $pagina);
                    break;
                }

                $data = $response->json()['data'] ?? [];

                if (empty($data)) {
                    break;
                }

                foreach ($data as $afiliado) {
                    $json = json_encode($afiliado);

                    if (!$first) {
                        fwrite($jsonHandle, ',');
                    }
                    fwrite($jsonHandle, $json);
                    $first = false;

                    fwrite($ndjsonHandle, $json . "\n");

                    $total++;
                }

                $this->info("Página {$pagina} descargada. Registros hasta ahora: {$total}");

                $pagina++;
                usleep(500000);
            }

            fwrite($jsonHandle, ']');
            fclose($jsonHandle);
            fclose($ndjsonHandle);

            $this->info("Afiliados descargados exitosamente. Total: {$total}");
            Log::info("Afiliados descargados exitosamente. Total: {$total}");
        } catch (\Throwable $e) {
            Log::error('Error en comando afiliados: ' . $e->getMessage());
            $this->error('Ocurrió un error. Revisa el log.');
        }
    }
}
