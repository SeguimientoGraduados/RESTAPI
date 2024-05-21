<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CarrerasDeGraduadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relacion = [
            ['graduado_id' => 5,'carrera_id' => 1],
            ['graduado_id' => 6,'carrera_id' => 4],
            ['graduado_id' => 1,'carrera_id' => 5]
        ];

        DB::table('carrera_graduado')->insert($relacion);
    }
}
