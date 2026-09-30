<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Permisos_historia extends Model
{
    protected $table = 'permisos_historias';

    protected $primaryKey = 'id_permisos_historia';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = ['nombre_campo', 'etiqueta', 'tipo', 'required'];

    public $timestamps = false;
    // En Permisos_historia.php
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'detalle_servicio_permisos', 'id_permisos_historia', 'id_servicio');
    }


    // En tu modelo Permisos_historia.php
public static function traerPermisos1($id_servicio) // Nota el cambio de nombre a camelCase
{
    return self::join('detalle_servicio_permisos as dsp', 'permisos_historias.id_permisos_historia', '=', 'dsp.id_permisos_historia')
        ->where('dsp.id_servicio', $id_servicio)
        ->where('permisos_historias.nivel', 2)
        ->get();
}

    public static function traer_permisos_2($id_servicio)
    {
       return self::join('detalle_servicio_permisos as dsp', 'permisos_historias.id_permisos_historia', '=', 'dsp.id_permisos_historia')
        ->where('dsp.id_servicio', $id_servicio)
        ->where('permisos_historias.nivel', 1)
        ->get();
    }
}
