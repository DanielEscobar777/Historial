<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DescargarAfiliados extends Command
{
    protected $signature = 'afiliados:descargar {token}';
    protected $description = 'Descarga todos los afiliados paginados y los guarda en un archivo JSON';

    public function handle()
    {
        try {
            $token = $this->argument('token');

            if (!$token) {
                $this->error('Token inválido o no proporcionado.');
                return;
            }

            $pagina = 1;
            $afiliados = [];

            $this->info('Descargando afiliados desde la API...');

            while (true) {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token
                ])->get('http://192.168.2.102:8001/api/s1/administracion/pacientes', [
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

                $afiliados = array_merge($afiliados, $data);
                $this->info("Página {$pagina} descargada.");

                $pagina++;
                usleep(500000); // Esperar 0.5 segundos para no saturar la API
            }

            Storage::put('afiliados_cache.json', json_encode($afiliados));
            $this->info('Afiliados descargados y guardados exitosamente.');
            Log::info('Afiliados descargados exitosamente. Total: ' . count($afiliados));
        } catch (\Throwable $e) {
            Log::error('Error en comando afiliados: ' . $e->getMessage());
            $this->error('Ocurrió un error. Revisa el log.');
        }
    }
}
