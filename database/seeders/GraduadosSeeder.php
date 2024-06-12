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
                'ciudad_id' => 1,
                'contacto' => 'leo.messi10@goat.com',
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Microsoft',
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Trabaja como ingeniero de software en el departamento de desarrollo.',
                'experiencia_anios' => 'de_5_a_10',
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
                'ciudad_id' => 2,
                'contacto' => 'postie@music.com',
                'ocupacion_trabajo' => 'autonomo',
                'ocupacion_empresa' => null,
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Se dedica a la consultoría en marketing digital.',
                'experiencia_anios' => 'menos_2',
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
                'ciudad_id' => 3,
                'contacto' => 'momo.buenardo@nashe.com',
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Gobierno Local',
                'ocupacion_sector' => 'publico',
                'ocupacion_informacion_adicional' => 'Trabaja en la Corte Suprema de La Plata.',
                'experiencia_anios' => 'de_2_a_5',
                'habilidades_competencias' => 'Represento la bandera de puta madre',
                'cv'=> null,
                'interes_comunidad' => true,
                'interes_oferta' => false,
                'interes_demanda' => false,
                'validado' => true
            ],
            [
                'nombre' => 'LeBron James',
                'dni' => '56789012',
                'fecha_nacimiento' => Carbon::parse('1984-12-30'),
                'ciudad_id' => 6,
                'contacto' => 'lebron.james@nba.com',
                'ocupacion_trabajo' => 'rel_dependencia',
                'ocupacion_empresa' => 'Los Angeles Lakers',
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Jugador profesional de baloncesto.',
                'experiencia_anios' => 'mas_10',
                'habilidades_competencias' => 'Baloncesto, Liderazgo, Entrenamiento',
                'cv'=> null,
                'interes_comunidad' => true,
                'interes_oferta' => true,
                'interes_demanda' => false,
                'validado' => false
            ],
            [
                'nombre' => 'Serena Williams',
                'dni' => '67890123',
                'fecha_nacimiento' => Carbon::parse('1981-09-26'),
                'ciudad_id' => 7,
                'contacto' => 'serena.williams@wta.com',
                'ocupacion_trabajo' => 'autonomo',
                'ocupacion_empresa' => null,
                'ocupacion_sector' => 'privado',
                'ocupacion_informacion_adicional' => 'Tenista profesional.',
                'experiencia_anios' => 'mas_10',
                'habilidades_competencias' => 'Tenis, Entrenamiento, Motivación',
                'cv'=> null,
                'interes_comunidad' => true,
                'interes_oferta' => false,
                'interes_demanda' => true,
                'validado' => false
            ]
        ];

        DB::table('graduados')->insert($graduados);
    }
}
