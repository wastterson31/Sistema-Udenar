<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docentes';

    protected $fillable = [
        'nombre',
        'identificacion',
        'direccion',
        'telefono',
        'correo',
        'genero',
        'fecha_nacimiento',
        'formacion_academica',
        'areas_conocimiento',
        'programa_id',
        'acuerdo_nombramiento',
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }
}
