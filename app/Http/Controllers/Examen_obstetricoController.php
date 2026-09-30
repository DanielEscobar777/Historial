<?php

namespace App\Http\Controllers;

use App\Models\Examen_obstetrico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Examen_obstetricoController extends Controller
{
    public function update(Request $request, $id_examen_obstetrico)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];

        // Solo validar los campos que vienen en el request
        foreach (['genitales', 'flujos', 'afu', 'situacion', 'posicion', 'tacto_vaginal','fcf',
        'presentacion'] as $field) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }

        // Validar solo los campos presentes
        $validated = $request->validate($rules, $messages);

        // Obtener el registro a actualizar
        $antecedentes = Examen_obstetrico::findOrFail($id_examen_obstetrico);

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
