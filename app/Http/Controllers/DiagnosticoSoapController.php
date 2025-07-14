<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico_soap;
use App\Http\Requests\StoreDiagnostico_soapRequest;
use App\Http\Requests\UpdateDiagnostico_soapRequest;
use Illuminate\Http\Request;

class DiagnosticoSoapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiagnostico_soapRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnostico_soap $diagnostico_soap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagnostico_soap $diagnostico_soap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, $id_evolucion)
    {
        $request->validate([
            'diagnostico' => 'required|string',

        ], [
            'diagnostico.required' => 'El campo diagnostico es obligatorio.',
       
        ]);
        $evolucion = Diagnostico_soap::findOrFail($id_evolucion);
        $evolucion->update($request->only([
            'diagnostico'
        ]));

        return redirect()->back()->with('success', 'Diagnostico actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnostico_soap $diagnostico_soap)
    {
        //
    }
}
