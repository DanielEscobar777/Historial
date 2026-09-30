<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examenes_complementarios extends Model
{  protected $table = 'examenes_complementarios';
    protected $primaryKey = 'id_examenes_complementarios';
     protected $fillable = [
        'id_historial',
        'examenes_complementarios',
        'id_usuario'
    ];

}
