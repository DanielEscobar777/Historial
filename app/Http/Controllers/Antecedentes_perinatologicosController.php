<?php

namespace App\Http\Controllers;

use App\Models\Antecedentes_perinatologicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Antecedentes_perinatologicosController extends Controller
{
    public function update(Request $request, $id_antecedentes_perinatologicos)
    {
        $userId = Auth::id();
        $validated = $request->validate([
            'antecedentes_perinatologicos' => 'required|string',
        ], [
            'antecedentes_perinatologicos.required' => 'El campo antecedentes perinatologicos es obligatorio.'

        ]);
        $antecedentes_perinatologicos = Antecedentes_perinatologicos::findOrFail($id_antecedentes_perinatologicos);
        $antecedentes_perinatologicos->update([
            'antecedentes_perinatologicos' => $request->antecedentes_perinatologicos,
            'id_usuario' => $userId // Asignar el ID del usuario autenticado
        ]);

        return redirect()->back()->with('success', 'Historia actualizado correctamente.');
    }
}
