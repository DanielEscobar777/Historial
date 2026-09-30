<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interpretacion_laboratorios extends Model
{
    protected $table = 'interpretacion_laboratorios_de_estudio_y_gabinetes';
    protected $primaryKey = 'id_interpretacion';
    protected $fillable = [
        'laboratorios_de_estudio_y_gabinete_solicitados',
        'id_usuario'
    ];
}
