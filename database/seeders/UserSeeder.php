<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'jose wastterson preciado ulloa',
            'email' => 'jose@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
