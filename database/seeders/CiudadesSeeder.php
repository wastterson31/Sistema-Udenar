<?php

namespace Database\Seeders;

use App\Models\Pais;
use App\Models\Ciudad;
use Illuminate\Database\Seeder;



class CiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colombia = Pais::where('codigo_iso', 'COL')->first();

        if ($colombia) {
            Ciudad::create([
                'nombre' => 'Bogotá',
                'pais_id' => $colombia->id,
            ]);
            Ciudad::create([
                'nombre' => 'Medellín',
                'pais_id' => $colombia->id,
            ]);
        } else {
            $this->command->info('No se encontró el país Colombia en la base de datos.');
        }
    }
}
