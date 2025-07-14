<?php

namespace App\Http\Controllers;

use App\Models\Motivo_de_internacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Motivo_de_internacionController extends Controller
{
    public function update(Request $request, $id_motivo_internacion)
    {
        $userId = Auth::id();
        $validated = $request->validate([
            'motivo_de_internacion' => 'required|string|max:255',
        ], [
            'motivo_de_internacion.required' => 'El campo antecedentes familiares es obligatorio.'

        ]);
        $Motivo_de_internacion = Motivo_de_internacion::findOrFail($id_motivo_internacion);
        $Motivo_de_internacion->update([
            'motivo_internacion' => $request->motivo_de_internacion,
            'id_usuario' => $userId // Asignar el ID del usuario autenticado
        ]);

        return redirect()->back()->with('success', 'Historia actualizado correctamente.');
    }
}
