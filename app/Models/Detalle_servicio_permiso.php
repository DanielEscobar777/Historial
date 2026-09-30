<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permisos_historia;

class Detalle_servicio_permiso extends Model
{
    /** @use HasFactory<\Database\Factories\ServiciosFactory> */
    use HasFactory;
     protected $fillable = [
        'id_servicio',
        'id_permisos_historias'
    ];
    public function permiso()
    {
        return $this->belongsTo(Permisos_historia::class, 'id_permisos_historia', 'id_permisos_historia');
    }

}
