<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class GraduadosExport implements FromCollection, WithHeadings
{
    protected $graduadosList;

    public function __construct($graduadosList)
    {
        $this->graduadosList = $graduadosList;
    }

    public function collection()
    {
        return new Collection($this->graduadosList);
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Contacto',
        ];
    }
}
