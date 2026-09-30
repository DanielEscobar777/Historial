<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspecialidadSection extends Model
{
    protected $table = 'especialidad_section';

    protected $fillable = [
        'id_servicio',
        'id_section',
    ];
}
