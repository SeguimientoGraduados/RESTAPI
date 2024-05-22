<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            CiudadesSeeder::class,
            GraduadosSeeder::class,
            DepartamentosSeeder::class,
            CarrerasSeeder::class,
            CarrerasDeGraduadosSeeder::class,
        ]);
    }
}
