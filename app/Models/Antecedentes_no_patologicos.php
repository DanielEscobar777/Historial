<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antecedentes_no_patologicos extends Model
{
     protected $fillable = [
        'id_historial',
        'vacunas',
        'vacunas_hpv',
        'habitos_toxicos',
        'alimentacion',
        'habito_miccional',
        'habito_intestinal',
        'vivienda_servicio_basico',
        'habito_alcoholico',
        'habito_tabaquico',
        'exposicion_biomasa',
        'contacto_con_tuberculosis',
        'contacto_triatoma_infestans',
        'toxicomanias_drogas',
        'inmunizaciones',
        'antecedentes_sexuales',
        'id_usuario'
    ];
protected $primaryKey = 'id_antecedentes_nopatologicos';
}
