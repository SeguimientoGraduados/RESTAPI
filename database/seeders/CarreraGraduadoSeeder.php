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
        $carreras = [
            ['graduado_id' => 1, 'carrera_id' => 44, 'anio_graduacion' => '2014'],
            ['graduado_id' => 1, 'carrera_id' => 47, 'anio_graduacion' => '2018'],
            ['graduado_id' => 2, 'carrera_id' => 8, 'anio_graduacion' => '2016'],
            ['graduado_id' => 3, 'carrera_id' => 9, 'anio_graduacion' => '2015'],
            ['graduado_id' => 4, 'carrera_id' => 17, 'anio_graduacion' => '2017'],
            ['graduado_id' => 5, 'carrera_id' => 81, 'anio_graduacion' => '2020'],
            ['graduado_id' => 6, 'carrera_id' => 33, 'anio_graduacion' => '2019'],
            ['graduado_id' => 7, 'carrera_id' => 37, 'anio_graduacion' => '2012'],
            ['graduado_id' => 8, 'carrera_id' => 51, 'anio_graduacion' => '2022'],
            ['graduado_id' => 9, 'carrera_id' => 61, 'anio_graduacion' => '2013'],
            ['graduado_id' => 10, 'carrera_id' => 75, 'anio_graduacion' => '2021'],
            ['graduado_id' => 11, 'carrera_id' => 44, 'anio_graduacion' => '2024'],
            ['graduado_id' => 12, 'carrera_id' => 44, 'anio_graduacion' => '2024']
        ];

        DB::table('carrera_graduado')->insert($carreras);
    }
}
