<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostico_sindromatico extends Model
{
    protected $table = 'diagnostico_sindromatico';
    protected $primaryKey = 'id_diagnostico';
    protected $fillable = [
        'diagnostico_sindromatico',
        'id_usuario'
    ];
}
