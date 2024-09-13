<?php

namespace App\Models;

use App\Models\Programa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coordinador extends Model
{
    use HasFactory;

    protected $table = 'coordinadores';

    protected $fillable = [
        'nombre',
        'identificacion',
        'direccion',
        'telefono',
        'correo',
        'genero',
        'fecha_nacimiento',
        'fecha_vinculacion',
        'acuerdo_nombramiento'
    ];

    public function programas()
    {
        return $this->hasMany(Programa::class);
    }

    public function asistentes()
    {
        return $this->hasOne(Asistente::class, 'coordinador_id');
    }
}
