<?php

namespace App\Http\Controllers;

use App\Models\Anamnesis_sistemas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Anamnesis_sistemasController extends Controller
{
    public function update(Request $request, $id_anamnesis_sistema )
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];

        // Solo validar los campos que vienen en el request
        foreach (['cardiovascular_respiratorio', 'gastro_intestinal', 'genito_urinario', 'hematologico', 'dermatologico', 'neurologico','locomotor'] as $field) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }

        // Validar solo los campos presentes
        $validated = $request->validate($rules, $messages);

        // Obtener el registro a actualizar
        $antecedentes = Anamnesis_sistemas::findOrFail($id_anamnesis_sistema);

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
