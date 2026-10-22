<?php

// Comprobación sin base de datos ni datos clínicos reales.
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$controller = new App\Http\Controllers\PdfController;
$margins = new ReflectionMethod($controller, 'validateMargins');
$overrides = new ReflectionMethod($controller, 'sanitizePageOverrides');
$apply = new ReflectionMethod($controller, 'applyPageOverrides');
$margins->invoke($controller, 12, 1, 2, 1);
try {
    $margins->invoke($controller, 20, 10, 10, 10);
    throw new RuntimeException('Se aceptaron márgenes sin espacio útil.');
} catch (Illuminate\Validation\ValidationException $expected) {}
$custom = $overrides->invoke($controller, json_encode([2 => ['enabled' => true, 'top' => 2.6, 'bottom' => 2, 'left' => 2, 'right' => 2, 'scale' => 100]]), 10);
$evolution = (object) array_fill_keys(['fecha_registro', 'hora_registro', 'pa', 'fc', 'fr', 'sat', 'sat_2', 'FiO2', 'peso', 'diuresis', 'dh'], '10');
foreach (['descripcion', 's', 'o', 'a', 'p'] as $key) {
    $evolution->$key = str_repeat('Texto sintético para verificar continuidad y medidas. ', 35);
}
foreach ([['top' => 12, 'size' => 7, 'left' => 25, 'gap' => 5], ['top' => 1, 'size' => 18, 'left' => 10, 'gap' => 2]] as $index => $case) {
    $config = ['font_family' => 'DejaVu Sans', 'font_size' => $case['size'], 'line_height' => 1.15, 'paragraph_spacing' => 3,
        'margin_top' => $case['top'], 'margin_bottom' => 2, 'margin_left' => 2, 'margin_right' => 2,
        'left_column' => $case['left'], 'column_gap' => $case['gap'], 'right_column' => 100 - $case['left'] - $case['gap']];
    $pdf = Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.soap', ['evolucion' => $evolution, 'diagnosticos' => collect(), 'pdfConfig' => $config])->setPaper('a4');
    $bytes = $pdf->output();
    $count = $pdf->getDomPDF()->getCanvas()->get_page_count();
    $adjusted = $apply->invoke($controller, $bytes, $custom, $config);
    if (!str_starts_with($adjusted, '%PDF-') || $count < 2) throw new RuntimeException('PDF inválido.');
    if (isset($argv[1])) file_put_contents($argv[1].'/soap-check-'.$index.'.pdf', $adjusted);
    echo 'Caso '.($index + 1).': PDF generado con '.$count." páginas; ajuste individual correcto.\n";
}
echo "Validación de medidas: correcta.\n";
