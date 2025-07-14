<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ganglios_linfaticos extends Model
{
    protected $table = 'ganglios_linfaticos';
    protected $primaryKey = 'id_ganglios';
    protected $fillable = [
        'id_historial',
        'ganglios_linfaticos',
        'id_usuario'
    ];
}
