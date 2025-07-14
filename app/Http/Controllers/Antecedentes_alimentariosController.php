<?php

namespace App\Http\Controllers;

use App\Models\Antecedentes_alimentarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Antecedentes_alimentariosController extends Controller
{
    public function update(Request $request, $id_antecedentes_alimentarios)
    {
        $userId = Auth::id();
        $validated = $request->validate([
            'antecedentes_alimentarios' => 'required|string|max:255',
        ], [
            'antecedentes_alimentarios.required' => 'El campo antecedentes perinatologicos es obligatorio.'

        ]);
        $antecedentes_alimentarios = Antecedentes_alimentarios::findOrFail($id_antecedentes_alimentarios);
        $antecedentes_alimentarios->update([
            'antecedentes_alimentarios' => $request->antecedentes_alimentarios,
            'id_usuario' => $userId // Asignar el ID del usuario autenticado
        ]);

        return redirect()->back()->with('success', 'Historia actualizado correctamente.');
    }
}
