<?php

namespace App\Http\Controllers;

use App\Models\Antecedentes_patologicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Antecedentes_patologicosController extends Controller
{
    public function update(Request $request, $id_antecedentes_patologicos)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];

        // Solo validar los campos que vienen en el request
        foreach (['clinicos', 'quirurjicos', 'alergicos', 'otros', 'internaciones', 'cirujias','transfusion_de_sangre',
        'iras','gastroenteritis', 'traumatismos', 'medicamentos','enfermedades'] as $field) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string|max:255';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }

        // Validar solo los campos presentes
        $validated = $request->validate($rules, $messages);

        // Obtener el registro a actualizar
        $antecedentes = Antecedentes_patologicos::findOrFail($id_antecedentes_patologicos);

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
