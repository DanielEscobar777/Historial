<?php

namespace App\Http\Controllers;

use App\Models\Examen_extremidades_inferiores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Examen_extremidades_inferioresController extends Controller
{
    public function update(Request $request, $id_examen_extremidades_inferiores)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'i_simetria',
                'i_deformidades',
                'i_articulaciones',
                'i_piel'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string|max:255';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Examen_extremidades_inferiores::findOrFail($id_examen_extremidades_inferiores);

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
