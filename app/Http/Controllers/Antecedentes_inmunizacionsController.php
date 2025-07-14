<?php

namespace App\Http\Controllers;

use App\Models\Antecedentes_inmunizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Antecedentes_inmunizacionsController extends Controller
{
    public function update(Request $request, $id_antecedentes_inmunizacion)
{
    $userId = Auth::id();
    $validated = $request->validate([
        'antecedentes_inmunizacion' => 'required|string|max:255',
    ], [
        'antecedentes_inmunizacion.required' => 'El campo antecedentes inmunizacion es obligatorio.'
    ]);

    // Obtener el registro existente
    $antecedentes_inmunizacion = Antecedentes_inmunizacion::findOrFail($id_antecedentes_inmunizacion);
    
    // Actualizar con los datos validados y el ID del usuario autenticado
    $antecedentes_inmunizacion->update([
        'antecedentes_inmunizacion' => $request->antecedentes_inmunizacion,
        'id_usuario' => $userId // Asignar el ID del usuario autenticado
    ]);

    return redirect()->back()->with('success', 'Historia actualizada correctamente.');
}
}
