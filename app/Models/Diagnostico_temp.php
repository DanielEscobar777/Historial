<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostico_temp extends Model
{
    public $timestamps = false; // Esto desactiva los timestamps
    
    protected $table = 'diagnostico_temp';
     protected $primaryKey = 'id_temporal';
    protected $fillable = [
        'diagnostico',
        'id_usuario',
        'id_historial',
        'navegador'
    ];
}


