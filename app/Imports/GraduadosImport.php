<?php

namespace App\Imports;

use App\Models\GraduadoImportado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;


class GraduadosImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithChunkReading, WithBatchInserts
{
    public function model(array $row)
    {
        if (empty($row['nombre_final']) && empty($row['fecha_egreso']) && empty($row['carrera'])) {
            return null; 
        }
        
        return new GraduadoImportado([
            'nombre_final'   => $row['nombre_final'],
            'fecha_egreso'   => $this->formatearFecha($row['fecha_egreso']),
            'carrera'        => $this->limpiarCarrera($row['carrera']),
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function batchSize(): int
    {
        return 100;
    }
    private function formatearFecha($fecha)
    {
        try {

            if (is_numeric($fecha)) {
                $carbonDate = Carbon::instance(Date::excelToDateTimeObject($fecha));
            } else {
                $carbonDate = Carbon::parse($fecha);
            }

            return $carbonDate->format('Y-m-d');
        } catch (\Exception $e) {
            Log::error("Error parseando fecha: " . print_r($fecha, true));
            return null;
        }
    }


    private function limpiarCarrera($carrera)
    {
        $partes = explode('-', $carrera, 2);
        return isset($partes[1]) ? trim($partes[1]) : trim($carrera);
    }
}
