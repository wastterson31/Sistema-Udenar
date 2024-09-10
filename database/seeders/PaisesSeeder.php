<?php

namespace Database\Seeders;

use App\Models\Pais;
use Illuminate\Database\Seeder;

class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Pais::create([
            'nombre' => 'Colombia',
            'codigo_iso' => 'COL',
        ]);

        Pais::create([
            'nombre' => 'Estados Unidos',
            'codigo_iso' => 'USA',
        ]);
    }
}
