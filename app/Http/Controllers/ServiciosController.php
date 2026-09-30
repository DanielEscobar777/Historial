<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use App\Models\Permisos_historia;
use App\Models\Detalle_servicio_permiso;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServiciosRequest;
use App\Http\Requests\UpdateServiciosRequest;
use Illuminate\Support\Facades\Auth;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $servicios = Servicios::all();
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {   $userId = Auth::id();
        $validated = $request->validate([
            'nombre_servicio' => 'required|string',
        ]);
          $registro = Servicios::create([
            'nombre_servicio' => $request->nombre_servicio,
            'id_usuario' => $userId,
        ]);

        return redirect()->back()->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function administrar($id_servicio)
    {
        $nivel_1 =  Permisos_historia::where('nivel', '1')->orderBy('id_permisos_historia')->get();
        $nivel_2 = Permisos_historia::where('nivel', '2')->orderBy('id_permisos_historia')->get();
        $servicio = Servicios::where('id_servicio', $id_servicio)->first();

        $permisosAsignados = Detalle_servicio_permiso::where('id_servicio', $id_servicio)->get();

        $asignado = array();
        foreach ($permisosAsignados as $permisoAsignado) {
            $asignado[$permisoAsignado['id_permisos_historia']] = true;
        }

        return view('servicios.permisos_servicio', compact('nivel_1', 'nivel_2', 'asignado', 'servicio'));
    }
    public function store_permisos(Request $request)
    {
        if ($request->isMethod('post')) {
            $idServicio = $request->input('id_servicio');
            $permisos = $request->input('permisos');

            // Eliminar permisos existentes
            Detalle_servicio_permiso::where('id_servicio', $idServicio)->delete();

            // Insertar nuevos permisos
            $dataToInsert = collect($permisos)->map(function ($permiso) use ($idServicio) {
                return [
                    'id_servicio' => $idServicio,
                    'id_permisos_historia' => $permiso,
                ];
            })->toArray();

            Detalle_servicio_permiso::insert($dataToInsert);
            
        $servicios = Servicios::all();
        return view('servicios.index', compact('servicios'));
         //return view('servicios.index'.compact('userData'))->with('success');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicios $servicios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiciosRequest $request, Servicios $servicios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicios $servicios)
    {
        //
    }
}
