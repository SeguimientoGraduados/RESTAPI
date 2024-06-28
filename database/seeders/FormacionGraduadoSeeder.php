<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormacionGraduadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formaciones = [
            [
                'graduado_id' => 2,
                'institucion' => 'Universidad de Buenos Aires',
                'titulo' => 'Doctorado en Bioquímica',
                'nivel' => 'universitario'
            ],
            [
                'graduado_id' => 5,
                'institucion' => 'Autodesk',
                'titulo' => 'Curso de AutoCAD',
                'nivel' => 'otro'
            ],
            [
                'graduado_id' => 9,
                'institucion' => 'Universidad del CEMA',
                'titulo' => 'Licenciatura en Economía Empresarial',
                'nivel' => 'universitario'
            ]
        ];
        

        DB::table('formacion_graduados')->insert($formaciones);
    }
}
