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
                'graduado_id' => 1, 
                'institucion' => 'Universidad de Barcelona',
                'titulo' => 'Ingeniero de Software',
                'nivel' => 'universitario'
            ],
            [
                'graduado_id' => 2,
                'institucion' => 'Universidad de Texas',
                'titulo' => 'Marketing Digital',
                'nivel' => 'universitario'
            ],
            [
                'graduado_id' => 3,
                'institucion' => 'Universidad Nacional de La Plata',
                'titulo' => 'Abogado',
                'nivel' => 'universitario'
            ]
        ];

        DB::table('formacion_graduados')->insert($formaciones);
    }
}
