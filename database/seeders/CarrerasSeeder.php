<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carreras = [
            ['nombre' => 'Ingenieria Agrónomo', 'departamento_id' => 1],
            ['nombre' => 'Doctorado en Agronomía', 'departamento_id' => 1],
            ['nombre' => 'Magister en Ciencias Agrarias', 'departamento_id' => 1],
            ['nombre' => 'Tecnicatura Superior Agrario en Suelos y Aguas', 'departamento_id' => 1],
            ['nombre' => 'Tecnicatura Universitaria Apícola', 'departamento_id' => 1],
            ['nombre' => 'Tecnicatura Universitaria en Manejo y Comercialización de Granos', 'departamento_id' => 1],
            ['nombre' => 'Tecnicatura Universitaria en Parques y Jardines', 'departamento_id' => 1],

            ['nombre' => 'Bioquímica', 'departamento_id' => 2],
            ['nombre' => 'Farmacia', 'departamento_id' => 2],
            ['nombre' => 'Licenciatura en Ciencias Biológicas', 'departamento_id' => 2],
            ['nombre' => 'Profesorado en Ciencias Biológicas', 'departamento_id' => 2],
            ['nombre' => 'Doctorado en Biología', 'departamento_id' => 2],
            ['nombre' => 'Doctorado en Bioquímica', 'departamento_id' => 2],
            ['nombre' => 'Doctorado en Farmacia', 'departamento_id' => 2],
            ['nombre' => 'Especialista en Bioquímica Clínica Área Parasitología', 'departamento_id' => 2],
            ['nombre' => 'Magíster en Farmacia', 'departamento_id' => 2],

            ['nombre' => 'Contador Público', 'departamento_id' => 3],
            ['nombre' => 'Licenciatura en Gestión Universitaria', 'departamento_id' => 3],
            ['nombre' => 'Licenciatura en Administración', 'departamento_id' => 3],
            ['nombre' => 'Profesorado en Educación Secundaria en Ciencias de la Administración', 'departamento_id' => 3],
            ['nombre' => 'Profesorado En Educación Secundaria y Superior en Ciencias de la Administración', 'departamento_id' => 3],
            ['nombre' => 'Doctorado en Ciencias de la Administración', 'departamento_id' => 3],
            ['nombre' => 'Especialista en Comercio Internacional', 'departamento_id' => 3],
            ['nombre' => 'Especialista en Contabilidad Superior, Control y Auditoría', 'departamento_id' => 3],
            ['nombre' => 'Especialista en Gestión de Recursos Humanos', 'departamento_id' => 3],
            ['nombre' => 'Especialista en Sindicatura Concursal', 'departamento_id' => 3],
            ['nombre' => 'Especialista en Tributación', 'departamento_id' => 3],
            ['nombre' => 'Magister en Administración', 'departamento_id' => 3],
            ['nombre' => 'Magíster en Administración Financiera de Negocios', 'departamento_id' => 3],
            ['nombre' => 'Tecnicatura Universitaria en Creación y Gestión de Pequeñas y Medianas Empresas', 'departamento_id' => 3],
            ['nombre' => 'Tecnicatura Universitaria en Administración y Gestión de recursos para Instituciones Universitarias', 'departamento_id' => 3],

            ['nombre' => 'Licenciatura en Ciencias de la Educación', 'departamento_id' => 4],
            ['nombre' => 'Profesorado de Educación Inicial', 'departamento_id' => 4],
            ['nombre' => 'Profesorado de Educación Primaria', 'departamento_id' => 4],

            ['nombre' => 'Licenciatura en Obstetricia', 'departamento_id' => 5],
            ['nombre' => 'Licenciatura en Enfermería', 'departamento_id' => 5],
            ['nombre' => 'Medicina', 'departamento_id' => 5],
            ['nombre' => 'Especialista en Educación para Profesionales de la Salud', 'departamento_id' => 5],
            ['nombre' => 'Magister en Salud Colectiva', 'departamento_id' => 5],
            ['nombre' => 'Tecnicatura Universitaria en Acompañamiento Terapéutico', 'departamento_id' => 5],
            ['nombre' => 'Enfermería', 'departamento_id' => 5],

            ['nombre' => 'Ingenieria en Computación', 'departamento_id' => 6],
            ['nombre' => 'Ingenieria en Sistemas de Computación', 'departamento_id' => 6],
            ['nombre' => 'Ingenieria en Sistemas de Información', 'departamento_id' => 6],
            ['nombre' => 'Licenciatura en Ciencias de la Computación', 'departamento_id' => 6],
            ['nombre' => 'Doctorado en Ciencias de la Computación', 'departamento_id' => 6],
            ['nombre' => 'Especialista en Ciencia de Datos', 'departamento_id' => 6],
            ['nombre' => 'Especialista en Tecnologías de Información para Gobierno Digital', 'departamento_id' => 6],
            ['nombre' => 'Magister en Ciencias de la Computación', 'departamento_id' => 6],

            ['nombre' => 'Licenciatura en Seguridad Pública', 'departamento_id' => 7],
            ['nombre' => 'Abogado', 'departamento_id' => 7],
            ['nombre' => 'Doctorado en Derecho', 'departamento_id' => 7],
            ['nombre' => 'Especialista en Derecho de Familia, Infancia y Adolescencia', 'departamento_id' => 7],
            ['nombre' => 'Especialista en Derecho Empresario', 'departamento_id' => 7],
            ['nombre' => 'Especialista en Derecho Penal', 'departamento_id' => 7],
            ['nombre' => 'Magister en Derecho', 'departamento_id' => 7],
            ['nombre' => 'Magister en Derecho con orientación en Análisis Económico del Derecho', 'departamento_id' => 7],
            ['nombre' => 'Magister en Derecho con orientación en Derecho Penal', 'departamento_id' => 7],
            ['nombre' => 'Magister en Derecho con orientación en Derecho Privado Patrimonial', 'departamento_id' => 7],
            ['nombre' => 'Martillero y Corredor Público', 'departamento_id' => 7],

            ['nombre' => 'Licenciatura en Economía', 'departamento_id' => 8],
            ['nombre' => 'Profesorado en Economía', 'departamento_id' => 8],
            ['nombre' => 'Profesorado en Economía para la Enseñanza Secundaria', 'departamento_id' => 8],
            ['nombre' => 'Profesorado para el Tercer Ciclo de la EGB y de la Eduación Polimodal en Economía', 'departamento_id' => 8],
            ['nombre' => 'Doctorado en Economía', 'departamento_id' => 8],
            ['nombre' => 'Especialista en Economía y Gestión de los Servicios de Salud', 'departamento_id' => 8],
            ['nombre' => 'Especialista en Gestión de la Tecnología y la Innovación', 'departamento_id' => 8],
            ['nombre' => 'Magister en Economía', 'departamento_id' => 8],
            ['nombre' => 'Magister en Economía Agraria y Administración Rural', 'departamento_id' => 8],
            ['nombre' => 'Magister en Políticas y Estrategias', 'departamento_id' => 8],
            ['nombre' => 'Magister en Sociología', 'departamento_id' => 8],
            ['nombre' => 'Tecnicatura Universitaria en Asuntos Municipales', 'departamento_id' => 8],
            ['nombre' => 'Tecnicatura Universitaria en Economía y Gestión de Empresas Alimentarias', 'departamento_id' => 8],
            ['nombre' => 'Tecnicatura Universitaria en Emprendimientos Agropecuarios', 'departamento_id' => 8],

            ['nombre' => 'Licenciatura en Física', 'departamento_id' => 9],
            ['nombre' => 'Licenciatura en Geofísica', 'departamento_id' => 9],
            ['nombre' => 'Licenciatura en Óptica y Contactología', 'departamento_id' => 9],
            ['nombre' => 'Profesorado en Física', 'departamento_id' => 9],
            ['nombre' => 'Doctorado en Física', 'departamento_id' => 9],
            ['nombre' => 'Tecnicatura Universitaria en Óptica', 'departamento_id' => 9],

            ['nombre' => 'Arquitecto', 'departamento_id' => 10],
            ['nombre' => 'Licenciatura en Geografía', 'departamento_id' => 10],
            ['nombre' => 'Licenciatura en Oceanografía', 'departamento_id' => 10],
            ['nombre' => 'Licenciatura en Turismo', 'departamento_id' => 10],
            ['nombre' => 'Profesorado en Geografía', 'departamento_id' => 10],
            ['nombre' => 'Doctorado en Geografía', 'departamento_id' => 10],
            ['nombre' => 'Especialista en Turismo Rural y Comunitario', 'departamento_id' => 10],
            ['nombre' => 'Magister en Desarrollo y Gestión Territorial', 'departamento_id' => 10],
            ['nombre' => 'Magister en Geografía', 'departamento_id' => 10],
            ['nombre' => 'Magister en Procesos Locales de Innovación y Desarrollo Rural', 'departamento_id' => 10],
            ['nombre' => 'Tecnicatura Universitaria en Cartografía, Teledetección y Sistemas de Información Geográfica', 'departamento_id' => 10],
            ['nombre' => 'Tecnicatura Universitaria en Emprendimientos Turísticos', 'departamento_id' => 10],
            ['nombre' => 'Tecnicatura Universitaria en Gestión Cultural y Emprendimientos Culturales', 'departamento_id' => 10],

            ['nombre' => 'Licenciatura en Ciencias Geológicas', 'departamento_id' => 11],
            ['nombre' => 'Profesorado en Geociencias', 'departamento_id' => 11],
            ['nombre' => 'Doctorado en Geología', 'departamento_id' => 11],
            ['nombre' => 'Tecnicatura Universitaria en Medio Ambiente', 'departamento_id' => 11],


            ['nombre' => 'Licenciatura en Filosofía', 'departamento_id' => 12],
            ['nombre' => 'Licenciatura en Historia', 'departamento_id' => 12],
            ['nombre' => 'Licenciatura en Letras', 'departamento_id' => 12],
            ['nombre' => 'Profesorado en Filosofía', 'departamento_id' => 12],
            ['nombre' => 'Profesorado en Historia', 'departamento_id' => 12],
            ['nombre' => 'Profesorado en Letras', 'departamento_id' => 12],
            ['nombre' => 'Doctorado en Filosofía', 'departamento_id' => 12],
            ['nombre' => 'Doctorado en Historia', 'departamento_id' => 12],
            ['nombre' => 'Doctorado en Letras', 'departamento_id' => 12],

            ['nombre' => 'Agrimensor', 'departamento_id' => 13],
            ['nombre' => 'Ingenieria Agrimensor', 'departamento_id' => 13],
            ['nombre' => 'Ingenieria Civil', 'departamento_id' => 13],
            ['nombre' => 'Ingenieria Industrial', 'departamento_id' => 13],
            ['nombre' => 'Ingenieria Mecánico', 'departamento_id' => 13],

            ['nombre' => 'Ingenieria Electricista', 'departamento_id' => 14],
            ['nombre' => 'Ingenieria Electrónico', 'departamento_id' => 14],
            ['nombre' => 'Especialista en Tecnologías Digitales Configurables', 'departamento_id' => 14],
            ['nombre' => 'Tecnicatura Universitaria en Emprendimientos Audiovisuales', 'departamento_id' => 14],
            ['nombre' => 'Tecnicatura Universitaria en Sistemas Electrónicos Industriales Inteligentes', 'departamento_id' => 14],

            ['nombre' => 'Ingenieria en Alimentos', 'departamento_id' => 15],
            ['nombre' => 'Ingenieria Química', 'departamento_id' => 15],
            ['nombre' => 'Doctorado en Ingeniería de Productos y Procesos de la Industria Alimentaria', 'departamento_id' => 15],
            ['nombre' => 'Doctorado en Ingeniería Química', 'departamento_id' => 15],
            ['nombre' => 'Magister en Ingeniería de Procesos Petroquímicos', 'departamento_id' => 15],
            ['nombre' => 'Magister en Ingeniería Química', 'departamento_id' => 15],
            ['nombre' => 'Tecnicatura Universitaria en Emprendimientos Agroalimentarios', 'departamento_id' => 15],
            ['nombre' => 'Tecnicatura Universitaria en Operaciones Industriales', 'departamento_id' => 15],

            ['nombre' => 'Licenciatura en Matemática', 'departamento_id' => 16],
            ['nombre' => 'Profesorado en Matemática', 'departamento_id' => 16],
            ['nombre' => 'Doctorado en Matemática', 'departamento_id' => 16],
            ['nombre' => 'Magister en Matemática', 'departamento_id' => 16],

            ['nombre' => 'Licenciatura en Ciencias Ambientales', 'departamento_id' => 17],
            ['nombre' => 'Licenciatura en Química', 'departamento_id' => 17],
            ['nombre' => 'Profesorado en Química', 'departamento_id' => 17],
            ['nombre' => 'Profesorado en Química de la Enseñanza Media', 'departamento_id' => 17],
            ['nombre' => 'Doctorado en Química', 'departamento_id' => 17],
            ['nombre' => 'Especialista en Control de Calidad de los Alimentos', 'departamento_id' => 17],
            ['nombre' => 'Magister en Química', 'departamento_id' => 17],
            ['nombre' => 'Química', 'departamento_id' => 17],
            ['nombre' => 'Tecnicatura Química Universitaria', 'departamento_id' => 17],
         

        ];

        DB::table('carreras')->insert($carreras);
    }
}
