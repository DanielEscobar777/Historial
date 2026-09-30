<?php

namespace App\Http\Controllers;

use App\Models\Examen_cardiovascular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Examen_cardiovascularController extends Controller
{
    public function update(Request $request, $id_examen_cardiovascular)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'cardiovascular_palpacion',
                'cardiovascular_percusion',
                'cardiovascular_auscultacion',
                'cardiovascular_agregados',
                'cardiovascular_soplos',
                'cardiovascular_fremito',
                'pulsos_perifericos',
                'branquial',
                'femoral',
                'tibia',
                'radial',
                'popliteo',
                'pedio'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Examen_cardiovascular::findOrFail($id_examen_cardiovascular);

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
