<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class GraduadosExport implements FromCollection
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
}
