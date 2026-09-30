<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialSection extends Model
{
    protected $table = 'historial_sections';

    protected $fillable = ['nombre', 'descripcion', 'es_requerido'];
}
