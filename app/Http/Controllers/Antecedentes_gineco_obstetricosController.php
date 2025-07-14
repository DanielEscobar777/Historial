<?php

namespace App\Http\Controllers;

use App\Models\Antecedentes_gineco_obstetricos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Antecedentes_gineco_obstetricosController extends Controller
{
    public function update(Request $request, $id_antecedentes_gineco)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];

        // Solo validar los campos que vienen en el request
        foreach (['fecha_ultima_menstruacion', 'menarca', 'ritmo_menstrual', 'menopausia', 'gestaciones', 'partos','cesareas',
        'abortos','hijos_macrosomicos', 'preeclampsia_eclampsia', 'anticonceptivos','fecha_ultima_papanicolau','fecha_ultima_mamografia',
        'fecha_ultima_densitometria'] as $field) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string|max:255';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }

        // Validar solo los campos presentes
        $validated = $request->validate($rules, $messages);

        // Obtener el registro a actualizar
        $antecedentes = Antecedentes_gineco_obstetricos::findOrFail($id_antecedentes_gineco);

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
