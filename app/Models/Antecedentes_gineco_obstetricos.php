<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antecedentes_gineco_obstetricos extends Model
{
    protected $fillable = [
        'id_historial',
        'menarca',
        'ritmo_menstrual',
        'menopausia',
        'gestaciones',
        'partos',
        'cesareas',
        'abortos',
        'hijos_macrosomicos',
        'preeclampsia_eclampsia',
        'metodos_anticonceptivos',
        'pap',
        'fuab',
        'fecha_ultima_menstruacion',
        'fecha_ultima_mamografia',
        'fecha_ultima_densitometria',
        'id_usuario',
        'fecha_ultimo_aborto'
    ];
   protected $primaryKey = 'id_antecedentes_gineco';
}
