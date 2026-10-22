<?php

// Prueba sin consultar ni modificar registros clínicos.
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:', 'session.driver' => 'array']);
$user = new App\Models\User(['name' => 'Prueba de interfaz']);
$user->setRelation('roles', collect());
Illuminate\Support\Facades\Auth::setUser($user);

$view = null;
Illuminate\Support\Facades\DB::pretend(function () use (&$view) {
    $view = (new App\Http\Controllers\KardexController)->soap(0);
});
if ($view->name() !== 'kardex.soap') {
    throw new RuntimeException('El nombre de la vista debe coincidir con la carpeta en Linux.');
}
foreach ([collect(), collect([(object) ['id_evolucion' => 0, 'fecha_registro' => '2026-01-01', 'hora_registro' => '10:00']])] as $items) {
    $html = $view->with('evoluciones', $items)->render();
    if (!str_contains($html, 'soapPdfConfigModal') || !str_contains($html, 'soapPdfConfigurator')) {
        throw new RuntimeException('No se cargó el configurador SOAP o sus archivos publicados.');
    }
}
echo "Kárdex SOAP: vista y configurador renderizados con datos ficticios y sin registros.\n";
