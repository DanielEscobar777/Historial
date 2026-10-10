<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class AfiliadosSyncStatus
{
    private const FILE = 'app/afiliados_sync_status.json';

    public function get(): array
    {
        $path = storage_path(self::FILE);
        $hasStatusFile = file_exists($path);
        $data = $hasStatusFile
            ? json_decode((string) file_get_contents($path), true)
            : [];

        if (!is_array($data)) {
            $data = [];
        }

        $lastSuccessPath = storage_path('app/ultima_actualizacion_afiliados.txt');
        if (empty($data['completed_at']) && file_exists($lastSuccessPath)) {
            $timestamp = (int) file_get_contents($lastSuccessPath);
            if ($timestamp > 0) {
                $data['completed_at'] = Carbon::createFromTimestamp($timestamp)->toIso8601String();
                if (!$hasStatusFile) {
                    $data['state'] = 'completed';
                    $data['message'] = 'La última sincronización registrada finalizó correctamente.';
                }
            }
        }

        if (($data['state'] ?? null) === 'running' && !empty($data['started_at'])) {
            $startedAt = Carbon::parse($data['started_at']);
            if ($startedAt->lt(now()->subSeconds(3600))) {
                $data['state'] = 'failed';
                $data['message'] = 'La sincronización no finalizó dentro del tiempo esperado. Se volverá a intentar más tarde.';
                $data['failed_at'] = now()->toIso8601String();
            }
        }

        if (($data['state'] ?? null) === 'pending' && !empty($data['requested_at'])) {
            $requestedAt = Carbon::parse($data['requested_at']);
            if ($requestedAt->lt(now()->subMinutes(5))) {
                $data['state'] = 'failed';
                $data['message'] = 'La sincronización no logró comenzar. Se volverá a intentar en el próximo acceso.';
                $data['failed_at'] = now()->toIso8601String();
            }
        }

        return array_merge([
            'state' => 'pending',
            'message' => 'La sincronización de recién nacidos todavía no se ha ejecutado.',
            'requested_at' => null,
            'started_at' => null,
            'completed_at' => null,
            'failed_at' => null,
        ], $data);
    }

    public function set(string $state, string $message, array $details = []): void
    {
        $allowed = ['pending', 'running', 'completed', 'failed'];
        if (!in_array($state, $allowed, true)) {
            throw new \InvalidArgumentException('Estado de sincronización inválido.');
        }

        $current = $this->get();
        $now = now()->toIso8601String();
        $timestampKey = match ($state) {
            'pending' => 'requested_at',
            'running' => 'started_at',
            'completed' => 'completed_at',
            'failed' => 'failed_at',
        };

        $data = array_merge($current, $details, [
            'state' => $state,
            'message' => $message,
            $timestampKey => $now,
            'updated_at' => $now,
        ]);

        $path = storage_path(self::FILE);
        $temporaryPath = $path . '.' . bin2hex(random_bytes(6)) . '.tmp';
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        if ($json === false || file_put_contents($temporaryPath, $json, LOCK_EX) === false) {
            throw new \RuntimeException('No se pudo registrar el estado de la sincronización.');
        }

        if (PHP_OS_FAMILY === 'Windows' && file_exists($path) && !unlink($path)) {
            @unlink($temporaryPath);
            throw new \RuntimeException('No se pudo preparar la actualización del estado de sincronización.');
        }

        if (!rename($temporaryPath, $path)) {
            @unlink($temporaryPath);
            throw new \RuntimeException('No se pudo actualizar el estado de la sincronización.');
        }
    }
}
