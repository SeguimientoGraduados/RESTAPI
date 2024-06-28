<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadesSeeder extends Seeder
{
    public function run()
    {
        $ciudades = [
            ['nombre' => 'Río de Janeiro', 'latitud' => -22.9068, 'longitud' => -43.1729, 'pais_id' => 4],
            ['nombre' => 'Bahía Blanca', 'latitud' => -38.7183, 'longitud' => -62.2660, 'pais_id' => 1],
            ['nombre' => 'Buenos Aires', 'latitud' => -34.6037, 'longitud' => -58.3816, 'pais_id' => 1],
            ['nombre' => 'Nueva York', 'latitud' => 40.7128, 'longitud' => -74.0060, 'pais_id' => 2],
            ['nombre' => 'Roma', 'latitud' => 41.9028, 'longitud' => 12.4964, 'pais_id' => 3],
            ['nombre' => 'Los Ángeles', 'latitud' => 34.0522, 'longitud' => -118.2437, 'pais_id' => 2],
        ];

        DB::table('ciudades')->insert($ciudades);
    }
}
