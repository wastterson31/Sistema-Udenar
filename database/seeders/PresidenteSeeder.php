<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Presidente;

class PresidenteSeeder extends Seeder
{
    public function run()
    {
        Presidente::create([
            'nombre' => 'Jose Wastterson Preciado Ulloa',
            'identificacion' => '123456789',
            'direccion' => '123 Calle Principal',
            'telefono' => '555-1234',
            'correo' => 'josewastterson@udenar.edu.co',
            'genero' => 'masculino',
            'fecha_nacimiento' => '1970-01-01',
            'fecha_vinculacion' => '2023-01-01',
            'acuerdo_nombramiento' => null
        ]);
    }
}
