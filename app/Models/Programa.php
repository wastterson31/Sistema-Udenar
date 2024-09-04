<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $table = 'programas';

    protected $fillable = [
        'codigo_snies',
        'nombre',
        'descripcion',
        'logo',
        'correo',
        'lineas_trabajo',
        'numero_resolucion',
        'fecha_resolucion',
        'archivo_resolucion'
    ];

    public function coordinador()
    {
        return $this->belongsTo(Coordinador::class);
    }

    public function cohortes()
    {
        return $this->hasMany(Cohorte::class);
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}
