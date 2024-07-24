<?php

namespace App\Imports;

use App\Models\GraduadoImportado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GraduadosImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new GraduadoImportado([
            'dni' => $row['dni'],
            'carrera' => $row['carrera']
        ]);
    }
}
