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
            ['nombre' => 'Departamento de Agronomía'],
            ['nombre' => 'Departamento de Biología, Bioquímica y Farmacia'],
            ['nombre' => 'Departamento de Ciencias de la Administración'],
            ['nombre' => 'Departamento de Ciencias de la Educación'],
            ['nombre' => 'Departamento de Ciencias de la Salud'],
            ['nombre' => 'Departamento de Ciencias e Ingeniería en Computación'],
            ['nombre' => 'Departamento de Derecho'],
            ['nombre' => 'Departamento de Economía'],
            ['nombre' => 'Departamento de Física'],
            ['nombre' => 'Departamento de Geografía y Turismo'],
            ['nombre' => 'Departamento de Geología'],
            ['nombre' => 'Departamento de Humanidades'],
            ['nombre' => 'Departamento de Ingeniería'],
            ['nombre' => 'Departamento de Ingeniería Eléctrica y de Computadoras'],
            ['nombre' => 'Departamento de Ingeniería Química'],
            ['nombre' => 'Departamento de Matemática'],
            ['nombre' => 'Departamento de Química'],

        ];

        DB::table('departamentos')->insert($departamentos);
    }
}
