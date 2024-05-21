<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departamentos = [
            ['nombre' => 'Departamento de Ciencias e Ingeniería en Computación'],
            ['nombre' => 'Departamento de Economía'],
            ['nombre' => 'Departamento de Salud'],
            ['nombre' => 'Departamento de Humanidades'],
            ['nombre' => 'Departamento de Física'],
        ];

        DB::table('departamentos')->insert($departamentos);
    }
}
