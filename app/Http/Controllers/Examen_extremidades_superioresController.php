<?php

namespace App\Http\Controllers;

use App\Models\Examen_extremidades_superiores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Examen_extremidades_superioresController extends Controller
{
    public function update(Request $request, $id_examen_extremidades_superiores)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                's_simetria',
                's_deformidades',
                's_articulaciones',
                's_piel'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string|max:255';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Examen_extremidades_superiores::findOrFail($id_examen_extremidades_superiores);

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
