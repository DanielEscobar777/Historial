<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antecedentes_inmunizacion extends Model
{
     protected $fillable = [
        'id_historial',
        'antecedentes_inmunizacion',
        'id_usuario'
    ];
    protected $primaryKey = 'id_antecedentes_inmunizacion';
}
