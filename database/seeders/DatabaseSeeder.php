<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            PaisSeeder::class,
            CiudadesSeeder::class,
            GraduadosSeeder::class,
            DepartamentosSeeder::class,
            CarrerasSeeder::class,
            CarreraGraduadoSeeder::class,
            ContactoGraduadoSeeder::class,
            FormacionGraduadoSeeder::class,
        ]);
    }
}
