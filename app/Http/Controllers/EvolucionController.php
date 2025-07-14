<?php

namespace App\Http\Controllers;

use App\Models\Evolucion;
use App\Models\Historial;
use App\Models\Servicios;
use App\Http\Requests\StoreEvolucionRequest;
use App\Http\Requests\UpdateEvolucionRequest;
use App\Models\Diagnostico_soap;
use App\Models\Diagnostico_temp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\LNumber;

class EvolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function formulario($id_historial)
    {
        $userId = Auth::id();
        $historial = Historial::where('id_historia', $id_historial)->first();
        $diagnosticos = DB::table('diagnostico_temp as d')
            ->where('d.id_historial', $id_historial)
            ->where('d.id_usuario', $userId)
            ->get();

        return view('evolucion.formulario', [
            'diagnosticos' => $diagnosticos,
            'id_historial' => $id_historial,
            'historial' => $historial
        ]);
    }

    public function store_temp(Request  $request)
    {
        $id_historial = $request->id_historial;
        $userId = Auth::id();
        $validated = $request->validate([
            'diagnostico' => 'required|string|max:255',
        ], [
            'diagnostico.required' => 'El campo diagnostico es obligatorio.',
        ]);

        // DB::table('diagnostico_temp')->insertGetId([
        //     'diagnostico' => $request->diagnostico,
        //     'id_historial' => $request->id_historial,
        //     'id_usuario' => $userId,
        // ]);

        $registro = Diagnostico_temp::create([
            'diagnostico' => $request->diagnostico,
            'id_historial' => $request->id_historial,
            'id_usuario' => $userId,
        ]);
        $userId = Auth::id();
        $diagnosticos = DB::table('diagnostico_temp as d')
            ->where('d.id_historial', $id_historial)
            ->where('d.id_usuario', $userId)
            ->get();
        return redirect()->route('evolucion.formulario', ['diagnosticos' => $diagnosticos, 'id_historia' => $id_historial]);
    }

    public function store(Request $request)
    {
        // Verifica que la solicitud sea POST
        if (!$request->isMethod('post')) {
            abort(405, 'Método no permitido');
        }
        DB::beginTransaction();
        try {
            $id_historial = $request->id_historial;
            $servicio = Historial::where('id_historia', $id_historial)->firstOrFail();
            $id_servicio = $servicio->id_servicio;

            $validated = $request->validate([
                'descripcion' => 'required|string',
                's' => 'required|string',
                'o' => 'required|string',
                'a' => 'required|string',
                'p' => 'required|string',
                'pa' => 'required|string',
                'fc' => 'required|numeric',
                'fr' => 'required|numeric',
                'sat' => 'required|numeric',
                'sat_2' => 'required|numeric',
                'FiO2' => 'required|numeric',
                'peso' => 'required|numeric',
                'diuresis' => 'required|numeric',
                'dh' => 'required|numeric',
            ], [
                'descripcion.required' => 'El campo descripcion es obligatorio.',
                's.required' => 'El campo S es obligatorio.',
                'o.required' => 'El campo O es obligatorio.',
                'a.required' => 'El campo A es obligatorio.',
                'p.required' => 'El campo P es obligatorio.',
                'pa.required' => 'El campo presion arterial es obligatorio.',
                'fc.required' => 'El campo frecuencia cardiaca es obligatorio.',
                'fc.numeric' => 'El campo frecuencia cardiaca debe ser un número válido.',
                'fr.required' => 'El campo frecuencia respiratoria es obligatorio.',
                'fr.numeric' => 'El campo frecuencia respiratoria debe ser un número válido.',
                'sat.required' => 'El campo sat  es obligatorio.',
                'sat.numeric' => 'El campo sat  debe ser un número válido.',
                'sat_2.required' => 'El campo sat  es obligatorio.',
                'sat_2.numeric' => 'El campo sat  debe ser un número válido.',
                'FiO2.required' => 'El campo FiO2  es obligatorio.',
                'FiO2.numeric' => 'El campo FiO2  debe ser un número válido.',
                'peso.required' => 'El campo peso  es obligatorio.',
                'peso.numeric' => 'El campo peso  debe ser un número válido.',
                'diuresis.required' => 'El campo diuresis  es obligatorio.',
                'diuresis.numeric' => 'El campo diuresis  debe ser un número válido.',
                'dh.required' => 'El campo dh  es obligatorio.',
                'dh.numeric' => 'El campo dh  debe ser un número válido.',
            ]);

            $userId = Auth::id();

            $evolucionId = DB::table('evolucions')->insertGetId([
                'descripcion' => $validated['descripcion'],
                's' => $validated['s'],
                'o' => $validated['o'],
                'a' => $validated['a'],
                'p' => $validated['p'],
                'pa' => $validated['pa'],
                'fc' => $validated['fc'],
                'fr' => $validated['fr'],
                'sat' => $validated['sat'],
                'sat_2' => $validated['sat_2'],
                'fio2' => $validated['FiO2'],
                'peso' => $validated['peso'],
                'diuresis' => $validated['diuresis'],
                'dh' => $validated['dh'],
                'fecha_registro' => now()->toDateString(),
                'hora_registro' => now()->toTimeString(),
                'id_usuario' => $userId,
                'id_historial' => $id_historial,
                'created_at' => now(),
                'updated_at' => now(),
            ], 'id_evolucion');

            // Procesar diagnósticos
            $diagnosticos = DB::table('diagnostico_temp as d')
                ->where('d.id_historial', $id_historial)
                ->where('d.id_usuario', $userId)
                ->get();

            foreach ($diagnosticos as $diagnostico) {

                DB::table('diagnostico_soaps')->insert([
                    'diagnostico' => $diagnostico->diagnostico,
                    'id_evolucion' => $evolucionId,
                    'id_historial' => $id_historial,
                    'id_usuario' => $userId,
                    'created_at' => now()
                ]);
            }
            DB::table('diagnostico_temp')
                ->where('id_usuario', $userId)
                ->where('id_historial', $id_historial)
                ->delete();

            DB::commit();
            $servicio = Servicios::where('id_servicio', $id_servicio)->first();
            $historiales = Historial::where('id_servicio', $id_servicio)->get();
            return view('historial.index_servicio', compact('historiales', 'id_servicio', 'servicio'))
                ->with('success', 'Historia registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()])
                ->withInput();
        }
    }
    public function delete(Request $request, $id_temporal)
    {
        $userId = Auth::id();
        $id_historial = $request->id_historial;

        $eliminado = DB::table('diagnostico_temp')
            ->where('id_historial', $id_historial)
            ->where('id_usuario', $userId)
            ->where('id_temporal', $id_temporal) // Si realmente existe este campo
            ->delete();

        $diagnosticos = DB::table('diagnostico_temp as d')
            ->where('d.id_historial', $id_historial)
            ->where('d.id_usuario', $userId)
            ->get();

        return redirect()->route('evolucion.formulario', ['diagnosticos' => $diagnosticos, 'id_historia' => $id_historial]);
    }

    public function edit($id_historial)
    {
        $evoluciones = Evolucion::traerEvolucion($id_historial);
        $historial = Historial::where('id_historia', $id_historial)->first();
        return view('evolucion.registro_soap', [
            'evoluciones' => $evoluciones,
            'id_historial' => $id_historial,
            'historial' => $historial
        ]);
    }

    public function edit_evolucion($id_evolucion)
    {
        $evoluciones = Evolucion::where('id_evolucion', $id_evolucion)->first();
        $id_historial = $evoluciones->id_historial;
        $diagnosticos = Diagnostico_soap::where('id_evolucion', $id_evolucion)->get();

        return view('evolucion.formulario_editar_soap', [
            'evoluciones' => $evoluciones,
            'diagnosticos' => $diagnosticos,
            'id_historial' => $id_historial
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_evolucion)
    {
        $request->validate([
            'descripcion' => 'required|string',
            's' => 'required|string',
            'o' => 'required|string',
            'a' => 'required|string',
            'p' => 'required|string',
            'pa' => 'required|string',
            'fc' => 'required|numeric',
            'fr' => 'required|numeric',
            'sat' => 'required|numeric',
            'sat_2' => 'required|numeric',
            'FiO2' => 'required|numeric',
            'peso' => 'required|numeric',
            'diuresis' => 'required|numeric',
            'dh' => 'required|numeric',
        ], [
            'descripcion.required' => 'El campo descripcion es obligatorio.',
            's.required' => 'El campo S es obligatorio.',
            'o.required' => 'El campo O es obligatorio.',
            'a.required' => 'El campo A es obligatorio.',
            'p.required' => 'El campo P es obligatorio.',
            'pa.required' => 'El campo presion arterial es obligatorio.',
            'fc.required' => 'El campo frecuencia cardiaca es obligatorio.',
            'fc.numeric' => 'El campo frecuencia cardiaca debe ser un número válido.',
            'fr.required' => 'El campo frecuencia respiratoria es obligatorio.',
            'fr.numeric' => 'El campo frecuencia respiratoria debe ser un número válido.',
            'sat.required' => 'El campo sat  es obligatorio.',
            'sat.numeric' => 'El campo sat  debe ser un número válido.',
            'sat_2.required' => 'El campo sat  es obligatorio.',
            'sat_2.numeric' => 'El campo sat  debe ser un número válido.',
            'FiO2.required' => 'El campo FiO2  es obligatorio.',
            'FiO2.numeric' => 'El campo FiO2  debe ser un número válido.',
            'peso.required' => 'El campo peso  es obligatorio.',
            'peso.numeric' => 'El campo peso  debe ser un número válido.',
            'diuresis.required' => 'El campo diuresis  es obligatorio.',
            'diuresis.numeric' => 'El campo diuresis  debe ser un número válido.',
            'dh.required' => 'El campo dh  es obligatorio.',
            'dh.numeric' => 'El campo dh  debe ser un número válido.',
        ]);
        $evolucion = Evolucion::findOrFail($id_evolucion);
        $evolucion->update($request->only([
            'descripcion',
            's',
            'o',
            'a',
            'p',
            'pa',
            'fc',
            'fr',
            'sat',
            'sat_2',
            'fio2',
            'peso',
            'diuresis',
            'dh'
        ]));

        return redirect()->back()->with('success', 'Evolucion actualizado correctamente.');
    }
    /* FORMULARIO SOAP PARA INTERNOS*/
    public function index()
    {
        $userId = Auth::id();
        $navegador = request()->header('User-Agent');
        $evoluciones = DB::table('evolucions as d')
            ->where('d.id_historial', null)
            ->where('d.id_usuario', $userId)
            ->orderBy('fecha_registro', 'desc')
            ->get();
        return view('evolucion.index', [
            'evoluciones' => $evoluciones,
        ]);
    }

    public function formulario_soap(Request $request)
    {
        $userId = Auth::id();
        // Obtener el navegador
        $navegador = request()->header('User-Agent');

        $diagnosticos = DB::table('diagnostico_temp as d')
            ->where('d.id_usuario', $userId)
            ->where('d.id_historial', null)
            ->where('d.navegador', $navegador)
            ->get();

        return view('evolucion.formulario_soap', [
            'diagnosticos' => $diagnosticos,
        ]);
    }

    public function store_temp_internos(Request  $request)
    {
        $userId = Auth::id();
        $navegador = request()->header('User-Agent');
        $request->validate([
            'diagnostico' => 'required|string|max:255',
        ], [
            'diagnostico.required' => 'El campo diagnostico es obligatorio.',
        ]);

        DB::table('diagnostico_temp')->insert([
            'diagnostico' => $request->diagnostico,
            'navegador' => $navegador,
            'id_usuario' => $userId,
        ]);

        return redirect()->route('evolucion.formulario_soap');
    }

    public function delete_internos(Request $request, $id_temporal)
    {
        $userId = Auth::id();
        $eliminado = DB::table('diagnostico_temp')
            ->where('id_usuario', $userId)
            ->where('id_temporal', $id_temporal) // Si realmente existe este campo
            ->delete();

        return redirect()->route('evolucion.formulario_soap');
    }
    public function store_internos(Request $request)
    {
        // Verifica que la solicitud sea POST
        if (!$request->isMethod('post')) {
            abort(405, 'Método no permitido');
        }
        DB::beginTransaction();
        try {

            $validated = $request->validate([
                'descripcion' => 'required|string',
                's' => 'required|string',
                'o' => 'required|string',
                'a' => 'required|string',
                'p' => 'required|string',
                'pa' => 'required|string',
                'fc' => 'required|numeric',
                'fr' => 'required|numeric',
                'sat' => 'required|numeric',
                'sat_2' => 'required|numeric',
                'FiO2' => 'required|numeric',
                'peso' => 'required|numeric',
                'diuresis' => 'required|numeric',
                'dh' => 'required|numeric',
            ], [
                'descripcion.required' => 'El campo descripcion es obligatorio.',
                's.required' => 'El campo S es obligatorio.',
                'o.required' => 'El campo O es obligatorio.',
                'a.required' => 'El campo A es obligatorio.',
                'p.required' => 'El campo P es obligatorio.',
                'pa.required' => 'El campo presion arterial es obligatorio.',
                'fc.required' => 'El campo frecuencia cardiaca es obligatorio.',
                'fc.numeric' => 'El campo frecuencia cardiaca debe ser un número válido.',
                'fr.required' => 'El campo frecuencia respiratoria es obligatorio.',
                'fr.numeric' => 'El campo frecuencia respiratoria debe ser un número válido.',
                'sat.required' => 'El campo sat  es obligatorio.',
                'sat.numeric' => 'El campo sat  debe ser un número válido.',
                'sat_2.required' => 'El campo sat  es obligatorio.',
                'sat_2.numeric' => 'El campo sat  debe ser un número válido.',
                'FiO2.required' => 'El campo FiO2  es obligatorio.',
                'FiO2.numeric' => 'El campo FiO2  debe ser un número válido.',
                'peso.required' => 'El campo peso  es obligatorio.',
                'peso.numeric' => 'El campo peso  debe ser un número válido.',
                'diuresis.required' => 'El campo diuresis  es obligatorio.',
                'diuresis.numeric' => 'El campo diuresis  debe ser un número válido.',
                'dh.required' => 'El campo dh  es obligatorio.',
                'dh.numeric' => 'El campo dh  debe ser un número válido.',
            ]);

            $userId = Auth::id();
            $navegador = request()->header('User-Agent');

            $evolucionId = DB::table('evolucions')->insertGetId([
                'descripcion' => $validated['descripcion'],
                's' => $validated['s'],
                'o' => $validated['o'],
                'a' => $validated['a'],
                'p' => $validated['p'],
                'pa' => $validated['pa'],
                'fc' => $validated['fc'],
                'fr' => $validated['fr'],
                'sat' => $validated['sat'],
                'sat_2' => $validated['sat_2'],
                'fio2' => $validated['FiO2'],
                'peso' => $validated['peso'],
                'diuresis' => $validated['diuresis'],
                'dh' => $validated['dh'],
                'fecha_registro' => now()->toDateString(),
                'hora_registro' => now()->toTimeString(),
                'id_usuario' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ], 'id_evolucion');

            // Procesar diagnósticos
            $diagnosticos = DB::table('diagnostico_temp as d')
                ->where('d.navegador', $navegador)
                ->where('d.id_usuario', $userId)
                ->get();

            foreach ($diagnosticos as $diagnostico) {

                DB::table('diagnostico_soaps')->insert([
                    'diagnostico' => $diagnostico->diagnostico,
                    'id_evolucion' => $evolucionId,
                    'navegador' => $diagnostico->navegador,
                    'id_usuario' => $userId,
                    'created_at' => now()
                ]);
            }
            DB::table('diagnostico_temp')
                ->where('id_usuario', $userId)
                ->where('navegador', $navegador)
                ->delete();

            DB::commit();
            return redirect()->route('evolucion.index')->with('success', 'Evolucion registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit_interno($id_evolucion)
    {
        $evolucion = Evolucion::where('id_evolucion', $id_evolucion)->first();
        $diagnostico = Diagnostico_soap::where('id_evolucion', $id_evolucion)->get();

        return view('evolucion.formulario_editar_soap_interno', [
            'evoluciones' => $evolucion,
            'diagnosticos' => $diagnostico
        ]);
    }
}
