<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ImpayesSubsImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new ImpayesImport(),
            1 => new ContactImport(),
        ];
    }
}
