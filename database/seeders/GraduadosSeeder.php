<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GraduadosSeeder extends Seeder
{
    public function run()
    {
        $graduados = [
            [
                'nombre' => 'Lionel Messi',
                'dni' => '12345678',
                'fecha_nacimiento' => Carbon::parse('1987-06-24'),
                'anio_graduacion' => '2012',
                'ciudad_id' => 1,
                'contacto' => 'leo.messi10@goat.com',
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Microsoft',
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Trabaja como ingeniero de software en el departamento de desarrollo.',
                'experiencia_anios' => 'de_5_a_10',
                'experiencia_informacion_adicional' => 'Ha trabajado en varios proyectos internacionales.',
                'habilidades_competencias' => 'PHP, Laravel, JavaScript, React',
                'cv'=> null,
                'interes_comunidad' => true,
                'interes_oferta' => false,
                'interes_demanda' => true,
                'validado' => true
            ],
            [
                'nombre' => 'Get Malone',
                'dni' => '23456789',
                'fecha_nacimiento' => Carbon::parse('1995-07-04'),
                'anio_graduacion' => '2022',
                'ciudad_id' => 2,
                'contacto' => 'postie@music.com',
                'ocupacion_trabajo' => 'autonomo',
                'ocupacion_empresa' => null,
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Se dedica a la consultoría en marketing digital.',
                'experiencia_anios' => 'menos_2',
                'experiencia_informacion_adicional' => 'Ha ayudado a más de 50 empresas a mejorar su presencia online.',
                'habilidades_competencias' => 'SEO, SEM, Content Marketing, Analytics',
                'cv'=> null,
                'interes_comunidad' => false,
                'interes_oferta' => true,
                'interes_demanda' => true,
                'validado' => true
            ],
            [
                'nombre' => 'Momo Benavidez',
                'dni' => '34567890',
                'fecha_nacimiento' => Carbon::parse('1989-04-11'),
                'anio_graduacion' => '2020',
                'ciudad_id' => 3,
                'contacto' => 'momo.buenardo@nashe.com',
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Gobierno Local',
                'ocupacion_sector' => 'publico',
                'ocupacion_informacion_adicional' => 'Trabaja en la Corte Suprema de La Plata.',
                'experiencia_anios' => 'de_2_a_5',
                'experiencia_informacion_adicional' => 'Ha participado en varios juicios.',
                'habilidades_competencias' => 'Represento la bandera de puta madre',
                'cv'=> null,
                'interes_comunidad' => true,
                'interes_oferta' => false,
                'interes_demanda' => false,
                'validado' => true
            ]
        ];

        DB::table('graduados')->insert($graduados);
    }
}
