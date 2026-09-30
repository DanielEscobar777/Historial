<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sistema_sensitivo extends Model
{
    protected $table = 'sistema_sensitivo';
    protected $primaryKey = 'id_sistema_sensitivo';
    protected $fillable = [
        'id_historial',
        'sensibilidad_superficial',
        'sensibilidad_profunda_consciente',
        'sensibilidad_profunda_inconsciente',
        'sistema_vestibulo_cerebeloso',
        'signos_irritacion_meningea',
        'marcha',
        'id_usuario'
    ];
}
