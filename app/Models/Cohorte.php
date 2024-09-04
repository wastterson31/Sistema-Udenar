<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohorte extends Model
{
    use HasFactory;

    protected $table = 'cohortes';

    protected $fillable = [
        'codigo',
        'nombre',
        'fecha_inicio',
        'fecha_finalizacion',
        'numero_estudiantes',
        'programa_id'
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}
