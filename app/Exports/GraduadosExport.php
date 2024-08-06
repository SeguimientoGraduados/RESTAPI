<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

ini_set('memory_limit', '-1');
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
