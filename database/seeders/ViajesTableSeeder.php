<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViajesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $viajes = [
            [
                'ciudad_origen_id' => 1,
                'ciudad_destino_id' => 1,
                'hora_salida' => now()->addDays(1),
                'hora_llegada' => now()->addDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ciudad_origen_id' => 1,
                'ciudad_destino_id' => 1,
                'hora_salida' => now()->addDays(1),
                'hora_llegada' => now()->addDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];


        DB::table('viajes')->insert($viajes);
    }
}
