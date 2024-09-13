<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{
    use HasFactory;

    protected $table = 'asistentes';

    protected $fillable = [
        'nombre',
        'identificacion',
        'direccion',
        'telefono',
        'correo',
        'genero',
        'fecha_nacimiento',
        'fecha_vinculacion',
        'coordinador_id'
    ];

    public function coordinador()
    {
        return $this->belongsTo(Coordinador::class, 'coordinador_id');
    }
}
