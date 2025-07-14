<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    /** @use HasFactory<\Database\Factories\ServiciosFactory> */
    use HasFactory;
    protected $primaryKey = 'id_servicio'; 
    protected $fillable = [
        'nombre_servicio',
        'id_usuario',
        'last_used_at',
        'expires_at',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'servicio_user', 'servicio_id', 'user_id');
    }
    public function permisos()
    {
        return $this->belongsToMany(Permisos_historia::class, 'detalle_servicio_permisos', 'id_servicio', 'id_permisos_historia');
    }

    public static function permisos_n1($id_servicio)
    {
        return self::join('detalle_servicio_permisos as dp', 'servicios.id_servicio', '=', 'dp.id_servicio')
            ->join('permisos_historias as ph', 'dp.id_permisos_historia', '=', 'ph.id_permisos_historia')
            ->where('servicios.id_servicio', $id_servicio)
            ->where('ph.nivel', 1)
            ->select('ph.nombre_permiso') // S
            ->get();
    }
}
