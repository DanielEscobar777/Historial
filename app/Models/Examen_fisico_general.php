<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen_fisico_general extends Model
{
    protected $fillable = [
        'id_historial',
        'estado_de_conciencia',
        'color_piel_mucosa',
        'constitucion',
        'marcha',
        'posicion',
        'estado_hidratacion',
        'biotipo',
        'facies',
        'tension_arterial',
        'tension_arterial_media',
        'frecuencia_cardiaca',
        'frecuencia_respiratoria',
        'temperatura',
        'peso',
        'talla',
        'imc',
        'spo2',
        'sato2',
        'fio2',
        'sc',
        'apgar',
        'silverman',
        'edad_por_capurro',
        'somatometria',
        'saturacion',
        'pa',
        'perimetro_cefalico',
        'perimetro_toracico',
        'perimetro_abdominal',
        'examen_fisico_general',
        'id_usuario'
    ];
    protected $primaryKey = 'id_examen_general';
    
    public static function examen_general($id_historial) // Nota el cambio de nombre a camelCase
    {
        return self::where('id_historial', $id_historial)
            ->first();
    }
}
