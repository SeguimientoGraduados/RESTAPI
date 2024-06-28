<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactoGraduadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contactos = [
            ['graduado_id' => 1, 'rrss' => 'linkedin', 'url' => 'https://www.linkedin.com/in/ana-perez/'],
            ['graduado_id' => 1, 'rrss' => 'twitter', 'url' => 'https://www.x.com/ana-perez/'],
            ['graduado_id' => 1, 'rrss' => 'facebook', 'url' => 'https://www.facebook.com/ana-perez/'],
            ['graduado_id' => 4, 'rrss' => 'linkedin', 'url' => 'https://www.linkedin.com/in/diego-fernandez/'],
            ['graduado_id' => 5, 'rrss' => 'twitter', 'url' => 'https://www.x.com/elena-martinez/'],
            ['graduado_id' => 7, 'rrss' => 'linkedin', 'url' => 'https://www.linkedin.com/in/gabriela-sanchez/'],
            ['graduado_id' => 10, 'rrss' => 'facebook', 'url' => 'https://www.facebook.com/juan-rodriguez/']
        ];
        
        DB::table('contacto_graduados')->insert($contactos);
    }
}
