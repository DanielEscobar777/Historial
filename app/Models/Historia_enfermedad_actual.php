<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class historia_enfermedad_actual extends Model
{
    protected $table = 'historia_enfermedad_actual';

    protected $primaryKey = 'id_historia_enfermedad';
    protected $fillable = [
        'id_historial',
        'historia_de_enfermedad_actual',
        'id_usuario'
    ];
    protected $attributes = [
        'historia_de_enfermedad_actual' => null,       // Cadena vacía
    ];
}
