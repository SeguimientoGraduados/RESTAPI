<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OcupacionGraduadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ocupaciones = [
            [
                'graduado_id' => 1,
                'ocupacion_trabajo' => 'autonomo',
                'ocupacion_empresa' => null,
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Consultora de TI especializada en ciberseguridad.',
            ],
            [
                'graduado_id' => 2,
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Dow',
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Bioquímico en la planta de DOW.',
            ],
            [
                'graduado_id' => 3,
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Farmacity',
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => null,
            ],
            [
                'graduado_id' => 4,
                'ocupacion_trabajo' => 'autonomo',
                'ocupacion_empresa' => null,
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Contabilidad para Monotributistas y pymes.',
            ],
            [
                'graduado_id' => 5,
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Ministerio de Obras Públicas',
                'ocupacion_sector' => 'publico',
                'ocupacion_informacion_adicional' => null,
            ],
            [
                'graduado_id' => 6,
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Escuela Don Bosco',
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => null,
            ],
            [
                'graduado_id' => 7,
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Hospital Municipal',
                'ocupacion_sector' => 'publico',
                'ocupacion_informacion_adicional' => 'Medico Clínico',
            ],
            [
                'graduado_id' => 8,
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Spotify',
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => null,
            ],
            [
                'graduado_id' => 9,
                'ocupacion_trabajo' => 'autonomo',
                'ocupacion_empresa' => null,
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Gestiono un emprendimiento personal',
            ],
            [
                'graduado_id' => 10,
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Escuela Don Bosco',
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Profesor de Física de 4to año',
            ],
            [
                'graduado_id' => 11,
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Assertia',
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Desarrollador full-stack',
            ],
            [
                'graduado_id' => 12,
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Codimat',
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Pasante en el area de IT.',
            ]
        ];

        DB::table('ocupacion_graduados')->insert($ocupaciones);

    }
}
