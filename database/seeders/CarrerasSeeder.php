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
            ['nombre' => 'Ingeniero Agrónomo', 'departamento_id' => 1],
            ['nombre' => 'Doctor en Agronomía', 'departamento_id' => 1],
            ['nombre' => 'Magister en Ciencias Agrarias', 'departamento_id' => 1],
            ['nombre' => 'Técnico Superior Agrario en Suelos y Aguas', 'departamento_id' => 1],
            ['nombre' => 'Técnico Universitario Apícola', 'departamento_id' => 1],
            ['nombre' => 'Técnico Universitario en Manejo y Comercialización de Granos', 'departamento_id' => 1],
            ['nombre' => 'Técnico Universitario en Parques y Jardines', 'departamento_id' => 1],

            ['nombre' => 'Bioquímico', 'departamento_id' => 2],
            ['nombre' => 'Farmacéutico', 'departamento_id' => 2],
            ['nombre' => 'Licenciado en Ciencias Biológicas', 'departamento_id' => 2],
            ['nombre' => 'Profesor en Ciencias Biológicas', 'departamento_id' => 2],
            ['nombre' => 'Doctor en Biología', 'departamento_id' => 2],
            ['nombre' => 'Doctor en Bioquímica', 'departamento_id' => 2],
            ['nombre' => 'Doctor en Farmacia', 'departamento_id' => 2],
            ['nombre' => 'Especialista en Bioquímica Clínica Área Parasitología', 'departamento_id' => 2],
            ['nombre' => 'Magíster en Farmacia', 'departamento_id' => 2],

            ['nombre' => 'Contador Público', 'departamento_id' => 3],
            ['nombre' => 'Licenciado/a en Gestión Universitaria', 'departamento_id' => 3],
            ['nombre' => 'Licenciado en Administración', 'departamento_id' => 3],
            ['nombre' => 'Profesor en Educación Secundaria en Ciencias de la Administración', 'departamento_id' => 3],
            ['nombre' => 'Profesor En Educación Secundaria y Superior en Ciencias de la Administración', 'departamento_id' => 3],
            ['nombre' => 'Doctor en Ciencias de la Administración', 'departamento_id' => 3],
            ['nombre' => 'Especialista en Comercio Internacional', 'departamento_id' => 3],
            ['nombre' => 'Especialista en Contabilidad Superior, Control y Auditoría', 'departamento_id' => 3],
            ['nombre' => 'Especialista en Gestión de Recursos Humanos', 'departamento_id' => 3],
            ['nombre' => 'Especialista en Sindicatura Concursal', 'departamento_id' => 3],
            ['nombre' => 'Especialista en Tributación', 'departamento_id' => 3],
            ['nombre' => 'Magister en Administración', 'departamento_id' => 3],
            ['nombre' => 'Magíster en Administración Financiera de Negocios', 'departamento_id' => 3],
            ['nombre' => 'Técnico Universitario en Creación y Gestión de Pequeñas y Medianas Empresas', 'departamento_id' => 3],
            ['nombre' => 'Técnico/a Universitario/a en Administración y Gestión de recursos para Instituciones Universitarias', 'departamento_id' => 3],

            ['nombre' => 'Licenciado en Ciencias de la Educación', 'departamento_id' => 4],
            ['nombre' => 'Profesor de Educación Inicial', 'departamento_id' => 4],
            ['nombre' => 'Profesor de Educación Primaria', 'departamento_id' => 4],

            ['nombre' => 'Licenciado/a en Obstetricia', 'departamento_id' => 5],
            ['nombre' => 'Licenciado en Enfermería', 'departamento_id' => 5],
            ['nombre' => 'Médico', 'departamento_id' => 5],
            ['nombre' => 'Especialista en Educación para Profesionales de la Salud', 'departamento_id' => 5],
            ['nombre' => 'Magister en Salud Colectiva', 'departamento_id' => 5],
            ['nombre' => 'Técnico Universitario en Acompañamiento Terapéutico', 'departamento_id' => 5],
            ['nombre' => 'Enfermero', 'departamento_id' => 5],

            ['nombre' => 'Ingeniero en Computación', 'departamento_id' => 6],
            ['nombre' => 'Ingeniero en Sistemas de Computación', 'departamento_id' => 6],
            ['nombre' => 'Ingeniero en Sistemas de Información', 'departamento_id' => 6],
            ['nombre' => 'Licenciado en Ciencias de la Computación', 'departamento_id' => 6],
            ['nombre' => 'Doctor en Ciencias de la Computación', 'departamento_id' => 6],
            ['nombre' => 'Especialista en Ciencia de Datos', 'departamento_id' => 6],
            ['nombre' => 'Especialista en Tecnologías de Información para Gobierno Digital', 'departamento_id' => 6],
            ['nombre' => 'Magister en Ciencias de la Computación', 'departamento_id' => 6],

            ['nombre' => 'Licenciado en Seguridad Pública', 'departamento_id' => 7],
            ['nombre' => 'Abogado', 'departamento_id' => 7],
            ['nombre' => 'Doctora/or en Derecho', 'departamento_id' => 7],
            ['nombre' => 'Especialista en Derecho de Familia, Infancia y Adolescencia', 'departamento_id' => 7],
            ['nombre' => 'Especialista en Derecho Empresario', 'departamento_id' => 7],
            ['nombre' => 'Especialista en Derecho Penal', 'departamento_id' => 7],
            ['nombre' => 'Magister en Derecho', 'departamento_id' => 7],
            ['nombre' => 'Magister en Derecho con orientación en Análisis Económico del Derecho', 'departamento_id' => 7],
            ['nombre' => 'Magister en Derecho con orientación en Derecho Penal', 'departamento_id' => 7],
            ['nombre' => 'Magister en Derecho con orientación en Derecho Privado Patrimonial', 'departamento_id' => 7],
            ['nombre' => 'Martillero y Corredor Público', 'departamento_id' => 7],

            ['nombre' => 'Licenciado en Economía', 'departamento_id' => 8],
            ['nombre' => 'Profesor en Economía', 'departamento_id' => 8],
            ['nombre' => 'Profesor en Economía para la Enseñanza Secundaria', 'departamento_id' => 8],
            ['nombre' => 'Profesor para el Tercer Ciclo de la EGB y de la Eduación Polimodal en Economía', 'departamento_id' => 8],
            ['nombre' => 'Doctor en Economía', 'departamento_id' => 8],
            ['nombre' => 'Especialista en Economía y Gestión de los Servicios de Salud', 'departamento_id' => 8],
            ['nombre' => 'Especialista en Gestión de la Tecnología y la Innovación', 'departamento_id' => 8],
            ['nombre' => 'Magister en Economía', 'departamento_id' => 8],
            ['nombre' => 'Magister en Economía Agraria y Administración Rural', 'departamento_id' => 8],
            ['nombre' => 'Magister en Políticas y Estrategias', 'departamento_id' => 8],
            ['nombre' => 'Magister en Sociología', 'departamento_id' => 8],
            ['nombre' => 'Técnico Universitario en Asuntos Municipales', 'departamento_id' => 8],
            ['nombre' => 'Técnico Universitario en Economía y Gestión de Empresas Alimentarias', 'departamento_id' => 8],
            ['nombre' => 'Técnico Universitario en Emprendimientos Agropecuarios', 'departamento_id' => 8],

            ['nombre' => 'Licenciado en Física', 'departamento_id' => 9],
            ['nombre' => 'Licenciado en Geofísica', 'departamento_id' => 9],
            ['nombre' => 'Licenciado en Óptica y Contactología', 'departamento_id' => 9],
            ['nombre' => 'Profesor en Física', 'departamento_id' => 9],
            ['nombre' => 'Doctor en Física', 'departamento_id' => 9],
            ['nombre' => 'Técnico Universitario en Óptica', 'departamento_id' => 9],

            ['nombre' => 'Arquitecto', 'departamento_id' => 10],
            ['nombre' => 'Licenciado en Geografía', 'departamento_id' => 10],
            ['nombre' => 'Licenciado en Oceanografía', 'departamento_id' => 10],
            ['nombre' => 'Licenciado en Turismo', 'departamento_id' => 10],
            ['nombre' => 'Profesor en Geografía', 'departamento_id' => 10],
            ['nombre' => 'Doctor en Geografía', 'departamento_id' => 10],
            ['nombre' => 'Especialista en Turismo Rural y Comunitario', 'departamento_id' => 10],
            ['nombre' => 'Magister en Desarrollo y Gestión Territorial', 'departamento_id' => 10],
            ['nombre' => 'Magister en Geografía', 'departamento_id' => 10],
            ['nombre' => 'Magister en Procesos Locales de Innovación y Desarrollo Rural', 'departamento_id' => 10],
            ['nombre' => 'Técnico Universitario en Cartografía, Teledetección y Sistemas de Información Geográfica', 'departamento_id' => 10],
            ['nombre' => 'Técnico Universitario en Emprendimientos Turísticos', 'departamento_id' => 10],
            ['nombre' => 'Técnico Universitario en Gestión Cultural y Emprendimientos Culturales', 'departamento_id' => 10],

            ['nombre' => 'Licenciado en Ciencias Geológicas', 'departamento_id' => 11],
            ['nombre' => 'Profesor en Geociencias', 'departamento_id' => 11],
            ['nombre' => 'Doctor en Geología', 'departamento_id' => 11],
            ['nombre' => 'Técnico Universitario en Medio Ambiente', 'departamento_id' => 11],


            ['nombre' => 'Licenciado en Filosofía', 'departamento_id' => 12],
            ['nombre' => 'Licenciado en Historia', 'departamento_id' => 12],
            ['nombre' => 'Licenciado en Letras', 'departamento_id' => 12],
            ['nombre' => 'Profesor en Filosofía', 'departamento_id' => 12],
            ['nombre' => 'Profesor en Historia', 'departamento_id' => 12],
            ['nombre' => 'Profesor en Letras', 'departamento_id' => 12],
            ['nombre' => 'Doctor en Filosofía', 'departamento_id' => 12],
            ['nombre' => 'Doctor en Historia', 'departamento_id' => 12],
            ['nombre' => 'Doctor en Letras', 'departamento_id' => 12],

            ['nombre' => 'Agrimensor', 'departamento_id' => 13],
            ['nombre' => 'Ingeniero Agrimensor', 'departamento_id' => 13],
            ['nombre' => 'Ingeniero Civil', 'departamento_id' => 13],
            ['nombre' => 'Ingeniero Industrial', 'departamento_id' => 13],
            ['nombre' => 'Ingeniero Mecánico', 'departamento_id' => 13],

            ['nombre' => 'Ingeniero Electricista', 'departamento_id' => 14],
            ['nombre' => 'Ingeniero Electrónico', 'departamento_id' => 14],
            ['nombre' => 'Especialista en Tecnologías Digitales Configurables', 'departamento_id' => 14],
            ['nombre' => 'Técnico Universitario en Emprendimientos Audiovisuales', 'departamento_id' => 14],
            ['nombre' => 'Técnico Universitario en Sistemas Electrónicos Industriales Inteligentes', 'departamento_id' => 14],

            ['nombre' => 'Ingeniero en Alimentos', 'departamento_id' => 15],
            ['nombre' => 'Ingeniero Químico', 'departamento_id' => 15],
            ['nombre' => 'Doctor en Ingeniería de Productos y Procesos de la Industria Alimentaria', 'departamento_id' => 15],
            ['nombre' => 'Doctor en Ingeniería Química', 'departamento_id' => 15],
            ['nombre' => 'Magister en Ingeniería de Procesos Petroquímicos', 'departamento_id' => 15],
            ['nombre' => 'Magister en Ingeniería Química', 'departamento_id' => 15],
            ['nombre' => 'Técnico Universitario en Emprendimientos Agroalimentarios', 'departamento_id' => 15],
            ['nombre' => 'Técnico Universitario en Operaciones Industriales', 'departamento_id' => 15],

            ['nombre' => 'Licenciado en Matemática', 'departamento_id' => 16],
            ['nombre' => 'Profesor en Matemática', 'departamento_id' => 16],
            ['nombre' => 'Doctor en Matemática', 'departamento_id' => 16],
            ['nombre' => 'Magister en Matemática', 'departamento_id' => 16],

            ['nombre' => 'Licenciado en Ciencias Ambientales', 'departamento_id' => 17],
            ['nombre' => 'Licenciado en Química', 'departamento_id' => 17],
            ['nombre' => 'Profesor en Química', 'departamento_id' => 17],
            ['nombre' => 'Profesor en Química de la Enseñanza Media', 'departamento_id' => 17],
            ['nombre' => 'Doctor en Química', 'departamento_id' => 17],
            ['nombre' => 'Especialista en Control de Calidad de los Alimentos', 'departamento_id' => 17],
            ['nombre' => 'Magister en Química', 'departamento_id' => 17],
            ['nombre' => 'Químico', 'departamento_id' => 17],
            ['nombre' => 'Técnico Químico Universitario', 'departamento_id' => 17],
         

        ];

        DB::table('carreras')->insert($carreras);
    }
}
