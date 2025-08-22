<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Servicios;
use App\Models\Evolucion;
use App\Models\Diagnostico_soap;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    $id_evolucion = $request->input('id_evolucion');
    $evolucion = Evolucion::where('id_evolucion', $id_evolucion)->first();
    $diagnostico = Diagnostico_soap::where('id_evolucion', $id_evolucion)->get();
    $margen_cm1 = $request->input('margen_superior_cm', 5); // cm, default 5
$margen_cm = $margen_cm1 - 2;
$espaciado = $margen_cm; // PASA EL VALOR EN CENTÍMETROS DIRECTAMENTE
    $data = [
      'evolucion' => $evolucion,
      'diagnosticos' => $diagnostico,
      'espaciado' => $espaciado
    ];
    return Pdf::loadView('pdf.soap', $data)->stream();
  } 


}
