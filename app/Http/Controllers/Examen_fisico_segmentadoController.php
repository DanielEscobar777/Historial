<?php

namespace App\Http\Controllers;

use App\Models\Examen_fisico_segmentado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Examen_fisico_segmentadoController extends Controller
{
    public function update(Request $request, $id_examen_fisico_segmentado)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];

        // Solo validar los campos que vienen en el request
        foreach (['cabeza', 'frontales', 'cabellos', 'cara', 'apertura_ocular', 'ojos','nariz','fosas_nasales','piramide_nasal','coanas',
        'oidos','pabellon_auricular', 'curvatura', 'boca','apertura_bucal','paladar','mucosa_oral','pulmones','pulmones_inspeccion',
        'pulmones_palpacion','pulmones_percusion','pulmones_auscultacion','corazon','corazon_inspeccion','corazon_palpacion','corazon_percusion',
        'corazon_auscultacion','abdomen','abdomen_inspeccion','abdomen_palpacion','abdomen_percusion','abdomen_auscultacion','precordio',
        'cordon_umbilical','relacion_arteriovenosa','genitales_acuerdo_sexo_edad','pies','surcos_plantales','reflejos_succion','genitourinarios',
        'extremidades','neurologicos','craneo','cavidad_bucal','cuello','cuello_inspeccion','cuello_palpacion','cuello_auscultacion','torax',
        'torax_inspeccion_estatico','torax_inspeccion_dinamico','torax_palpacion','torax_percusion','torax_auscultacion','mamas'] as $field) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }

        // Validar solo los campos presentes
        $validated = $request->validate($rules, $messages);

        // Obtener el registro a actualizar
        $antecedentes = Examen_fisico_segmentado::findOrFail($id_examen_fisico_segmentado);

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
