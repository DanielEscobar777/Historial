<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Detalle_servicio_permiso;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';
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



}
