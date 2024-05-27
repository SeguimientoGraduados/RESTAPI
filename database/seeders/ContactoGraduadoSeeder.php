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
            [
                'graduado_id' => 1,
                'rrss' => 'linkedin',
                'url' => 'https://www.linkedin.com/in/lionel-messi/'
            ],
            [
                'graduado_id' => 1,
                'rrss' => 'twitter',
                'url' => 'https://twitter.com/leomessi'
            ],
            [
                'graduado_id' => 2,
                'rrss' => 'facebook',
                'url' => 'https://www.facebook.com/post.malone'
            ],
            [
                'graduado_id' => 3,
                'rrss' => 'linkedin',
                'url' => 'https://www.linkedin.com/in/momo-benavidez/'
            ]
        ];

        DB::table('contacto_graduados')->insert($contactos);
    }
}
