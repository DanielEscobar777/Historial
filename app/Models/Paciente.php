<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';

    // Si no vas a llenar todos los campos con fill() o update(), puedes proteger con fillable:
    protected $fillable = [
        'nombres',
        'p_apellido',
        's_apellido',
        'matricula_seguro',
        'sexo',
        'fecha_nacimiento',
        'ci',
        'complemento',
        'nacionalidad',
        'telefono',
        'residencia',
    ];

    // Laravel automáticamente maneja timestamps, pero si lo deseas explícito:
    public $timestamps = true;
}
