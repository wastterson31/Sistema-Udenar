<?php

use App\Models\Presidente;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PaisesSeeder;
use Database\Seeders\CiudadesSeeder;
use Database\Seeders\CategoriaSeeder;
use Database\Seeders\ViajesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Presidente::class,
        ]);
    }
}
