<?php

namespace App\Http\Controllers;

use App\Models\Desarrollo_psicomotor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Desarrollo_psicomotorsController extends Controller
{
    public function update(Request $request, $id_desarrollo_psicomotor)
    {
        $userId = Auth::id();
        $validated = $request->validate([
            'desarrollo_psicomotor' => 'required|string',
        ], [
            'desarrollo_psicomotor.required' => 'El campo desarrollo psicomotor es obligatorio.'

        ]);
        $desarrollo_psicomotor = Desarrollo_psicomotor::findOrFail($id_desarrollo_psicomotor);
        $desarrollo_psicomotor->update([
            'desarrollo_psicomotor' => $request->desarrollo_psicomotor,
            'id_usuario' => $userId // Asignar el ID del usuario autenticado
        ]);

        return redirect()->back()->with('success', 'Historia actualizado correctamente.');
    }
}
