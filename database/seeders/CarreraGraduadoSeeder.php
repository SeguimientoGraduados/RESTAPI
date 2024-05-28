<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CarreraGraduadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relacion = [
            ['graduado_id' => 1,'carrera_id' => 1, 'anio_graduacion' => '2018'],
            ['graduado_id' => 2,'carrera_id' => 4, 'anio_graduacion' => '2021'],
            ['graduado_id' => 3,'carrera_id' => 5, 'anio_graduacion' => '2020']
        ];

        DB::table('carrera_graduado')->insert($relacion);
    }
}
