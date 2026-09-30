<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico_sindromatico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Diagnostico_sindromaticoController extends Controller
{
    public function update(Request $request, $id_diagnostico )
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'diagnostico_sindromatico'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Diagnostico_sindromatico::findOrFail($id_diagnostico);

        // Preparar datos para actualización
        $updateData = ['id_usuario' => $userId];

        // Solo actualizar los campos que vinieron en el request
        foreach ($validated as $field => $value) {
            $updateData[$field] = $value;
        }

        // Realizar la actualización
        $antecedentes->update($updateData);

        return redirect()->back()->with('success', 'Historia actualizada correctamente.');
    }
}
