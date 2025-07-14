<?php

namespace App\Http\Controllers;

use App\Models\Sistema_sensitivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Sistema_sensitivoController extends Controller
{
    public function update(Request $request, $id_sistema_sensitivo)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'sensibilidad_superficial',
                'sensibilidad_profunda_consciente',
                'sensibilidad_profunda_inconsciente',
                'sistema_vestibulo_cerebeloso',
                'signos_irritacion_meningea',
                'marcha'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string|max:255';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Sistema_sensitivo::findOrFail($id_sistema_sensitivo);

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
