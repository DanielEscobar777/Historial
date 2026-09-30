<?php

namespace App\Http\Controllers;

use App\Models\Examen_fisico_general;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Examen_fisico_generalController extends Controller
{
    public function update(Request $request, $id_examen_general)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];

        // Solo validar los campos que vienen en el request
        foreach (['estado_de_conciencia', 'color_piel_mucosa', 'constitucion', 'marcha', 'posicion', 'estado_hidratacion','biotipo',
        'facies','tension_arterial', 'tension_arterial_media', 'frecuencia_cardiaca','frecuencia_respiratoria','temperatura',
        'peso','talla','imc','spo2','sato2','fio2','sc','apgar','silverman','edad_por_capurro','pa','somatometria','saturacion',
        'perimetro_cefalico','perimetro_toracico','perimetro_abdominal','examen_fisico_general'] as $field) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }

        // Validar solo los campos presentes
        $validated = $request->validate($rules, $messages);

        // Obtener el registro a actualizar
        $antecedentes = Examen_fisico_general::findOrFail($id_examen_general);

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
