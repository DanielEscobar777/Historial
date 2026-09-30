<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motivo_de_internacion extends Model
{
    protected $table = 'motivo_de_internacion';
     protected $fillable = [
        'id_historial',
        'motivo_internacion',
        'id_usuario'
    ];
     protected $primaryKey = 'id_motivo_internacion';
  
}
