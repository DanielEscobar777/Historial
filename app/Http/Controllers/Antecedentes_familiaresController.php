<?php

namespace App\Http\Controllers;

use App\Models\Antecedentes_familiares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Antecedentes_familiaresController extends Controller
{
    public function update(Request $request, $id_antecedentes_familiares)
    {
        $userId = Auth::id();
        $validated = $request->validate([
            'antecedentes_familiares' => 'required|string',
        ], [
            'antecedentes_familiares.required' => 'El campo antecedentes familiares es obligatorio.'

        ]);
        $antecedentes_familiares = Antecedentes_familiares::findOrFail($id_antecedentes_familiares);
        $antecedentes_familiares->update([
            'antecedentes_familiares' => $request->antecedentes_familiares,
            'id_usuario' => $userId // Asignar el ID del usuario autenticado
        ]);

        return redirect()->back()->with('success', 'Historia actualizado correctamente.');
    }
}
