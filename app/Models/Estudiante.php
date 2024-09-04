<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'nombre',
        'identificacion',
        'codigo_estudiantil',
        'fotografia',
        'direccion',
        'telefono',
        'correo',
        'genero',
        'fecha_nacimiento',
        'semestre',
        'estado_civil',
        'fecha_ingreso',
        'fecha_egreso',
        'cohorte_id',
        'programa_id'
    ];

    public function cohorte()
    {
        return $this->belongsTo(Cohorte::class);
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }
}
