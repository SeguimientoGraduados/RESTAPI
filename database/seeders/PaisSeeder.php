<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paises = [
            [
                'nombre' => 'Argentina',
            ],
            [
                'nombre' => 'Estados Unidos',
            ],
            [
                'nombre' => 'Italia',
            ],
        ];

        DB::table('paises')->insert($paises);
    }
}
