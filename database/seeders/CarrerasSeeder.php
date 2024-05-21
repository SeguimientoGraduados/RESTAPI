<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carreras = [
            ['nombre' => 'Ingeniería en Sistemas de Información','departamento_id' => 1],
            ['nombre' => 'Licenciatura en Informática','departamento_id' => 1],
            ['nombre' => 'Licenciatura en Economía','departamento_id' => 2],
            ['nombre' => 'Medicina','departamento_id' => 3],
            ['nombre' => 'Licenciatura en Letras','departamento_id' => 4],
            ['nombre' => 'Profesorado en Física','departamento_id' => 5],
        ];

        DB::table('carreras')->insert($carreras);
    }
}
