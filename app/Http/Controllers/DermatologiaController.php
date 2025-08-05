<?php

namespace App\Http\Controllers;

use App\Models\Dermatologia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DermatologiaController extends Controller
{
    public function update(Request $request, $id_dermatologia)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'piel',
                'pelo',
                'unias',
                'mucosas',
                'topografia',
                'iconografia',
                'morfologia'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string|max:255';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Dermatologia::findOrFail($id_dermatologia);

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
