<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            ['nombre' => 'Económica', 'cantidad_pasajeros' => 150],
            ['nombre' => 'Negocio', 'cantidad_pasajeros' => 50],
            ['nombre' => 'Primera Clase', 'cantidad_pasajeros' => 20],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
