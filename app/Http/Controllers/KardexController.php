<?php

namespace App\Http\Controllers;

use App\Models\Impresion_diagnostica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Servicios;
use App\Models\Evolucion;
use Illuminate\Support\Facades\DB;



class KardexController extends Controller
{

    public function index()
    {
        $userId = Auth::id();
        $servicios = DB::table('servicios as s')
            ->join('servicio_user as su', 's.id_servicio', '=', 'su.servicio_id')
            ->where('su.user_id', $userId)
            ->get();

        $pacientes = DB::table('pacientes')
            ->get();

        return view('Kardex.index', compact('servicios','pacientes'));
    }

    public function consulta(Request $request)
    {
        $id_paciente = $request->id_paciente;
        $id_servicio = $request->id_servicio;
        $desde = $request->desde;
        $hasta = $request->hasta;

        $servicio = Servicios::where('id_servicio', $id_servicio)->first();

        $paciente = DB::table('pacientes')
         ->where('id', $id_paciente)
            ->first();

        $datos = DB::table('historials as h')
            ->join('pacientes as p', 'p.id', '=', 'h.id_paciente')
            ->where('h.id_paciente', $id_paciente)
            ->where('h.id_servicio', $id_servicio)
            ->whereBetween('h.fecha_registro', [$desde, $hasta])
            ->get();

        return view('Kardex.reporte', compact('datos','paciente','servicio'));
    }

    public function soap($id_historial)
    {
        $evoluciones = Evolucion::traerEvolucion($id_historial);
        return view('Kardex.soap', [
            'evoluciones' => $evoluciones,
            'id_historial' => $id_historial,
          
        ]);
    }

}
