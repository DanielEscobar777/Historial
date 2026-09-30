<?php

namespace App\Http\Controllers;

use App\Models\Interpretacion_laboratorios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Interpretacion_laboratoriosController extends Controller
{
    public function update(Request $request, $id_interpretacion )
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'laboratorios_de_estudio_y_gabinete_solicitados'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Interpretacion_laboratorios::findOrFail($id_interpretacion);

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
