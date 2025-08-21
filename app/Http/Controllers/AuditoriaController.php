<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Servicios;
use App\Models\Permisos_historia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuditoriaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $servicios = DB::table('servicios as s')
            ->join('servicio_user as su', 's.id_servicio', '=', 'su.servicio_id')
            ->where('su.user_id', $userId)
            ->get();
        return view('auditoria.index', compact('servicios'));
    }
    public function show($id_servicio)
    {
        $historiales = Historial::paciente( $id_servicio);
        $servicio = Servicios::where('id_servicio', $id_servicio)->first();
        $historiaRN =Historial::where('nombre_recien_necido','<>', 'null')->get();
        return view('auditoria.index_servicio', compact('historiales', 'id_servicio', 'servicio','historiaRN'));
    }
    public function auditoria($id_historia)
    {
        $historial = Historial::where('id_historia', $id_historia)->first();
        $id_servicio = $historial->id_servicio;
        $permisos = Permisos_historia::traer_permisos_2($id_servicio);
        $permisos_1 = Permisos_historia::traerPermisos1($id_servicio);

        $servicio = DB::table('au_historial as h')
        ->join('servicios as s', 'h.id_usuario', '=', 's.id_servicio')
        ->where('h.id_historia', $id_historia)
        ->first(); 
        $historiaRN =DB::table('au_historial as h')
        ->join('users as u', 'h.id_usuario', '=', 'u.id')
        ->where('h.id_historia', $id_historia)
        ->get();
         $filiacion = DB::table('au_historial as h')
        ->join('users as u', 'h.id_usuario', '=', 'u.id')
        ->join('pacientes as p', DB::raw('h.id_paciente::integer'), '=', 'p.id')
        ->where('h.id_historia', $id_historia)
        ->get();

        $antecedentes_perinatologicos = DB::table('au_antecedentes_perinatologicos as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $antecedentes_inmunizacion = DB::table('au_antecedentes_inmunizacion as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $antecedentes_familiares = DB::table('au_antecedentes_familiares as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $desarrollo_psicomotors = DB::table('au_desarrollo_psicomotors as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $antecedentes_heredofamiliares = DB::table('au_antecedentes_heredofamiliares as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $antecedentes_patologicos = DB::table('au_antecedentes_patologicos as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $antecedentes_no_patologicos = DB::table('au_antecedentes_no_patologicos as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $antecedentes_gineco_obstetricos = DB::table('au_antecedentes_gineco_obstetricos as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $anamnesis_sistemas = DB::table('au_anamnesis_sistemas as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $motivo_de_internacion = DB::table('au_motivo_de_internacion as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $historia_enfermedad_actual = DB::table('au_historia_enfermedad_actual as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $examen_fisico_generals = DB::table('au_examen_fisico_generals as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $examen_fisico_segmentado = DB::table('au_examen_fisico_segmentado as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $examen_obstetrico = DB::table('au_examen_obstetrico as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $examen_ginecologico = DB::table('au_examen_ginecologico as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $examen_cardiovascular = DB::table('au_examen_cardiovascular as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $examen_genito_urinario = DB::table('au_examen_genito_urinario as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $examen_extremidades_superiores = DB::table('au_examen_extremidades_superiores as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $examen_extremidades_inferiores = DB::table('au_examen_extremidades_inferiores as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $dermatologia = DB::table('au_dermatologia as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $ganglios_linfaticos = DB::table('au_ganglios_linfaticos as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $sistema_nervioso = DB::table('au_sistema_nervioso as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $sistema_motor = DB::table('au_sistema_motor as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $sistema_sensitivo = DB::table('au_sistema_sensitivo as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $diagnostico_sindromatico = DB::table('au_diagnostico_sindromatico as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $examenes_complementarios = DB::table('au_examenes_complementarios as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $impresion_diagnostica = DB::table('au_impresion_diagnostica as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $comentarios = DB::table('au_comentarios as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        $interpretacion_laboratorio = DB::table('au_interpretacion_laboratorio as h')
            ->join('users as u', 'h.id_usuario', '=', 'u.id')
            ->where('h.id_historial', $id_historia)
            ->get();

        return view('auditoria.auditoria', [
            'historial' => $historial,
            'permisos' => $permisos,
            'permisos_1' => $permisos_1,
            'filiaciones' => $filiacion,
            'antecedentes_perinatologicos' => $antecedentes_perinatologicos,
            'antecedentes_inmunizacion' => $antecedentes_inmunizacion,
            'antecedentes_familiares' => $antecedentes_familiares,
            'desarrollo_psicomotors' => $desarrollo_psicomotors,
            'antecedentes_heredofamiliares' =>  $antecedentes_heredofamiliares,
            'antecedentes_patologicos' => $antecedentes_patologicos,
            'antecedentes_no_patologicos' => $antecedentes_no_patologicos,
            'antecedentes_gineco_obstetricos' => $antecedentes_gineco_obstetricos,
            'anamnesis_sistemas' => $anamnesis_sistemas,
            'motivo_de_internacion' => $motivo_de_internacion,
            'historia_enfermedad_actual' => $historia_enfermedad_actual,
            'examen_fisico_generals' => $examen_fisico_generals,
            'examen_fisico_segmentado' => $examen_fisico_segmentado,
            'examen_obstetrico' => $examen_obstetrico,
            'examen_ginecologico' => $examen_ginecologico,
            'examen_cardiovascular' => $examen_cardiovascular,
            'examen_genito_urinario' => $examen_genito_urinario,
            'examen_extremidades_superiores' => $examen_extremidades_superiores,
            'examen_extremidades_inferiores' => $examen_extremidades_inferiores,
            'dermatologias' => $dermatologia,
            'ganglios_linfaticos' => $ganglios_linfaticos,
            'sistema_nervioso' => $sistema_nervioso,
            'sistema_motor' => $sistema_motor,
            'sistema_sensitivo' => $sistema_sensitivo,
            'diagnostico_sindromatico' => $diagnostico_sindromatico,
            'examenes_complementarios' => $examenes_complementarios,
            'comentarios' => $comentarios,
            'impresion_diagnostica' => $impresion_diagnostica,
            'servicio' => $servicio,
            'historiaRN' => $historiaRN,
            'interpretacion_laboratorio' => $interpretacion_laboratorio

        ]);
    }
}
