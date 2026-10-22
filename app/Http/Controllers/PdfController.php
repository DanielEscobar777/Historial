<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Servicios;
use App\Models\Evolucion;
use App\Models\Diagnostico_soap;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;

class PdfController extends Controller
{
  public function generatePdf($id_historia)
  {
    $filiacion = Historial::filiacion($id_historia);
    $h_antecedentes = Historial::traerantecedentes($id_historia);
    $h_examen_general = Historial::traerExamenGeneral($id_historia);
    $h_examen_segmentado = Historial::traerexamensegmentado($id_historia);
    $h_examen_segmentado_mi = Historial::traerexamensegmentado_mi($id_historia);
    $h_sistema_nervioso = Historial::traerexamensistemanervioso($id_historia);
    $h_examenes = Historial::traerdiagnosticos($id_historia);
    $imagePath = public_path('images/silueta.jpg');
    $id_servicio = $h_antecedentes->id_servicio;
    $permisos = Servicios::permisos_n1($id_servicio);
    
    $data = [
      'imagePath' => $imagePath,
      'filiacion' => $filiacion,
      'h_antecedentes' => $h_antecedentes,
      'h_examen_general' => $h_examen_general,
      'h_examen_segmentado' => $h_examen_segmentado,
      'h_examen_segmentado_mi' => $h_examen_segmentado_mi,
      'h_sistema_nervioso' => $h_sistema_nervioso,
      'h_examenes' => $h_examenes,
      'permisos' => $permisos
    ];

    return Pdf::loadView('pdf.documento', $data)->stream();
  }

  public function generateSOAP(Request $request)
  {
    $validated = $request->validate([
      'id_evolucion' => ['required', 'integer', 'exists:evolucions,id_evolucion'],
      'font_family' => ['nullable', Rule::in(['verdana', 'dejavu', 'helvetica', 'times', 'courier'])],
      'font_size' => ['nullable', 'numeric', 'min:4', 'max:36'],
      'line_height' => ['nullable', 'numeric', 'min:0.8', 'max:4'],
      'margin_top' => ['nullable', 'numeric', 'min:0', 'max:26'],
      'margin_right' => ['nullable', 'numeric', 'min:0', 'max:17'],
      'margin_bottom' => ['nullable', 'numeric', 'min:0', 'max:26'],
      'margin_left' => ['nullable', 'numeric', 'min:0', 'max:17'],
      'left_column' => ['nullable', 'numeric', 'min:5', 'max:90'],
      'column_gap' => ['nullable', 'numeric', 'min:0', 'max:50'],
      'paragraph_spacing' => ['nullable', 'numeric', 'min:0', 'max:72'],
      'page_overrides' => ['nullable', 'json', 'max:20000'],
      'output' => ['nullable', Rule::in(['preview', 'download'])],
    ]);

    $leftColumn = (float) ($validated['left_column'] ?? 25);
    $columnGap = (float) ($validated['column_gap'] ?? 5);

    if ($leftColumn + $columnGap > 95) {
      return response()->json([
        'message' => 'La columna izquierda y la separación ocupan demasiado espacio. Reduzca uno de esos valores.',
        'errors' => ['left_column' => ['Reserve al menos 5% para la nota de evolución: columna izquierda y separación deben sumar como máximo 95%.']],
      ], 422);
    }

    $fontFamilies = [
      'verdana' => "Verdana, 'DejaVu Sans', sans-serif",
      'dejavu' => "'DejaVu Sans', sans-serif",
      'helvetica' => 'Helvetica, Arial, sans-serif',
      'times' => "'Times-Roman', serif",
      'courier' => 'Courier, monospace',
    ];
    $fontKey = $validated['font_family'] ?? 'verdana';
    $pdfConfig = [
      'font_family' => $fontFamilies[$fontKey],
      'font_size' => (float) ($validated['font_size'] ?? 7),
      'line_height' => (float) ($validated['line_height'] ?? 1.15),
      'margin_top' => (float) ($validated['margin_top'] ?? 2.5),
      'margin_right' => (float) ($validated['margin_right'] ?? 3),
      'margin_bottom' => (float) ($validated['margin_bottom'] ?? 2.5),
      'margin_left' => (float) ($validated['margin_left'] ?? 3),
      'left_column' => $leftColumn,
      'column_gap' => $columnGap,
      'right_column' => 100 - $leftColumn - $columnGap,
      'paragraph_spacing' => (float) ($validated['paragraph_spacing'] ?? 3),
    ];

    $this->validateMargins($pdfConfig['margin_top'], $pdfConfig['margin_right'], $pdfConfig['margin_bottom'], $pdfConfig['margin_left']);
    $overrides = $this->sanitizePageOverrides($validated['page_overrides'] ?? null, PHP_INT_MAX);
    $idEvolucion = $validated['id_evolucion'];
    $evolucion = Evolucion::where('id_evolucion', $idEvolucion)->firstOrFail();
    $diagnostico = Diagnostico_soap::where('id_evolucion', $idEvolucion)->get();
    $data = [
      'evolucion' => $evolucion,
      'diagnosticos' => $diagnostico,
      'pdfConfig' => $pdfConfig,
    ];

    $pdf = Pdf::loadView('pdf.soap', $data)->setPaper('a4', 'portrait');
    $pdf->render();
    $pdfBytes = $pdf->output();
    $pageCount = $pdf->getDomPDF()->getCanvas()->get_page_count();
    $overrides = $this->sanitizePageOverrides($validated['page_overrides'] ?? null, $pageCount);

    if ($overrides !== []) {
      $pdfBytes = $this->applyPageOverrides($pdfBytes, $overrides, $pdfConfig);
    }

    $disposition = ($validated['output'] ?? 'preview') === 'download' ? 'attachment' : 'inline';

    return response($pdfBytes, 200, [
      'Content-Type' => 'application/pdf',
      'Content-Disposition' => $disposition.'; filename="evolucion-'.$idEvolucion.'.pdf"',
      'X-PDF-Pages' => (string) $pageCount,
      'Cache-Control' => 'no-store, private',
    ]);
  }

  private function sanitizePageOverrides(?string $json, int $pageCount): array
  {
    if (! $json) {
      return [];
    }

    $decoded = json_decode($json, true);
    if (! is_array($decoded)) {
      return [];
    }

    $overrides = [];
    foreach ($decoded as $page => $settings) {
      $pageNumber = filter_var($page, FILTER_VALIDATE_INT);
      if (! $pageNumber || $pageNumber < 1 || $pageNumber > $pageCount || ! is_array($settings) || empty($settings['enabled'])) {
        continue;
      }

      $overrides[$pageNumber] = [
        'top' => $settings['top'] ?? 0,
        'right' => $settings['right'] ?? 0,
        'bottom' => $settings['bottom'] ?? 0,
        'left' => $settings['left'] ?? 0,
        'scale' => $settings['scale'] ?? 100,
      ];
      foreach ($overrides[$pageNumber] as $key => $value) {
        if (!is_numeric($value) || !is_finite((float) $value) || $value < ($key === 'scale' ? 10 : 0) || $value > ($key === 'scale' ? 100 : (in_array($key, ['top', 'bottom']) ? 26 : 17))) {
          throw ValidationException::withMessages(['page_overrides' => "Revise las medidas de la hoja {$pageNumber}: márgenes verticales 0–26 cm, laterales 0–17 cm y escala 10–100%."]);
        }
        $overrides[$pageNumber][$key] = (float) $value;
      }
      $this->validateMargins($overrides[$pageNumber]['top'], $overrides[$pageNumber]['right'], $overrides[$pageNumber]['bottom'], $overrides[$pageNumber]['left'], "Hoja {$pageNumber}");
    }

    return $overrides;
  }

  private function validateMargins(float $top, float $right, float $bottom, float $left, string $label = 'Márgenes generales'): void
  {
    if ($left + $right > 17 || $top + $bottom > 26.7) {
      throw ValidationException::withMessages(['page_overrides' => "{$label}: deje al menos 4 cm de ancho y 3 cm de alto libres en la hoja A4 (21 × 29,7 cm). Reduzca los márgenes opuestos."]);
    }
  }

  private function applyPageOverrides(string $sourcePdf, array $overrides, array $globalSettings): string
  {
    $result = new Fpdi('P', 'mm', 'A4');
    $pageCount = $result->setSourceFile(StreamReader::createByString($sourcePdf));

    for ($page = 1; $page <= $pageCount; $page++) {
      $template = $result->importPage($page);
      $size = $result->getTemplateSize($template);
      $result->AddPage($size['orientation'], [$size['width'], $size['height']]);

      if (! isset($overrides[$page])) {
        $result->useTemplate($template, 0, 0, $size['width'], $size['height']);
        continue;
      }

      $settings = $overrides[$page];
      $sourceLeft = $globalSettings['margin_left'] * 10;
      $sourceRight = $globalSettings['margin_right'] * 10;
      $sourceTop = $globalSettings['margin_top'] * 10;
      $sourceBottom = $globalSettings['margin_bottom'] * 10;
      $targetLeft = $settings['left'] * 10;
      $targetRight = $settings['right'] * 10;
      $targetTop = $settings['top'] * 10;
      $targetBottom = $settings['bottom'] * 10;

      $sourceContentWidth = max(10, $size['width'] - $sourceLeft - $sourceRight);
      $sourceContentHeight = max(10, $size['height'] - $sourceTop - $sourceBottom);
      $targetContentWidth = max(10, $size['width'] - $targetLeft - $targetRight);
      $targetContentHeight = max(10, $size['height'] - $targetTop - $targetBottom);
      $requestedScale = $settings['scale'] / 100;
      $scale = min(
        $requestedScale,
        $targetContentWidth / $sourceContentWidth,
        $targetContentHeight / $sourceContentHeight
      );

      // El margen específico sustituye al margen general: no se suma sobre él.
      $x = $targetLeft - ($sourceLeft * $scale);
      $y = $targetTop - ($sourceTop * $scale);
      $result->useTemplate($template, $x, $y, $size['width'] * $scale, $size['height'] * $scale);
    }

    return $result->Output('S');
  }


}
