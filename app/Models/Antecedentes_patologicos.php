<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antecedentes_patologicos extends Model
{
     protected $fillable = [
        'id_historial',
        'clinicos',
        'quirurjicos',
        'alergicos',
        'otros',
        'internaciones',
        'cirujias',
        'transfusio_de_sangre',
        'iras',
        'gastroenteritis',
        'traumatismos',
        'medicamentos',
        'enfermedades',
        'id_usuario'
    ];
   protected $primaryKey = 'id_antecedentes_patologicos';
}
