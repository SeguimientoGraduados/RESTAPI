<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GraduadosSeeder extends Seeder
{
    public function run()
    {
        $graduados = [
            [
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'dni' => '12345678',
                'anio_graduacion' => '2015',
                'empresa' => 'Empresa XYZ',
                'ciudad_id' => 1,
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'Gómez',
                'dni' => '87654321',
                'anio_graduacion' => '2018',
                'empresa' => 'Empresa ABC',
                'ciudad_id' => 2,
            ],
            [
                'nombre' => 'Juan',
                'apellido' => 'Pérez Lopez',
                'dni' => '22345678',
                'anio_graduacion' => '2016',
                'empresa' => 'Empresa BB',
                'ciudad_id' => 1,
            ],
            [
                'nombre' => 'Paula',
                'apellido' => 'Chávez',
                'dni' => '87654322',
                'anio_graduacion' => '2019',
                'empresa' => 'Empresa BSAS',
                'ciudad_id' => 6,
            ],
            [
                'nombre' => 'Luis Luis',
                'apellido' => 'Rodriguez',
                'dni' => '22355678',
                'anio_graduacion' => '2017',
                'empresa' => 'Empresa Yanqui',
                'ciudad_id' => 21,
            ],
            [
                'nombre' => 'Barba',
                'apellido' => 'Khan',
                'dni' => '77654322',
                'anio_graduacion' => '2022',
                'empresa' => 'Empresa Europea Foerte',
                'ciudad_id' => 10,
            ],
        ];

        DB::table('graduados')->insert($graduados);
    }
}
