<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadesSeeder extends Seeder
{
    public function run()
    {
        $ciudades = [
            ['nombre' => 'Bahía Blanca', 'latitud' => -38.7183, 'longitud' => -62.2660],
            ['nombre' => 'Córdoba', 'latitud' => -31.4201, 'longitud' => -64.1888],
            ['nombre' => 'Rosario', 'latitud' => -32.9442, 'longitud' => -60.6505],
            ['nombre' => 'Mendoza', 'latitud' => -32.8895, 'longitud' => -68.8458],
            ['nombre' => 'La Plata', 'latitud' => -34.9212, 'longitud' => -57.9544],
            ['nombre' => 'Buenos Aires', 'latitud' => -34.6037, 'longitud' => -58.3816],
            ['nombre' => 'Ciudad de México', 'latitud' => 19.4326, 'longitud' => -99.1332],
            ['nombre' => 'Madrid', 'latitud' => 40.4168, 'longitud' => -3.7038],
            ['nombre' => 'Nueva York', 'latitud' => 40.7128, 'longitud' => -74.0060],
            ['nombre' => 'Londres', 'latitud' => 51.5074, 'longitud' => -0.1278],
            ['nombre' => 'Tokio', 'latitud' => 35.6895, 'longitud' => 139.6917],
            ['nombre' => 'París', 'latitud' => 48.8566, 'longitud' => 2.3522],
            ['nombre' => 'Roma', 'latitud' => 41.9028, 'longitud' => 12.4964],
            ['nombre' => 'Sídney', 'latitud' => -33.8688, 'longitud' => 151.2093],
            ['nombre' => 'Toronto', 'latitud' => 43.65107, 'longitud' => -79.347015],
            ['nombre' => 'Berlín', 'latitud' => 52.5200, 'longitud' => 13.4050],
            ['nombre' => 'Hong Kong', 'latitud' => 22.3193, 'longitud' => 114.1694],
            ['nombre' => 'Singapur', 'latitud' => 1.3521, 'longitud' => 103.8198],
            ['nombre' => 'San Pablo', 'latitud' => -23.5505, 'longitud' => -46.6333],
            ['nombre' => 'Seúl', 'latitud' => 37.5665, 'longitud' => 126.9780],
            ['nombre' => 'Los Ángeles', 'latitud' => 34.0522, 'longitud' => -118.2437],
        ];

        DB::table('ciudades')->insert($ciudades);
    }
}
