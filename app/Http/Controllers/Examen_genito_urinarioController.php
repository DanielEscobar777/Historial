<?php

namespace App\Http\Controllers;

use App\Models\Examen_genito_urinario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Examen_genito_urinarioController extends Controller
{
    public function update(Request $request, $id_examen_genitourinario)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'punio_percusion_renal',
                'palpacion_renal',
                'puntos_ureterales',
                'genitales'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Examen_genito_urinario::findOrFail($id_examen_genitourinario);

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
