<?php

namespace App\Imports;

use App\Models\Subscriber\Subscriber;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Subscriber([
            'raisonsociale' => $row['raisonsociale'] ?? null,
            'ste_part' => $row["ste_part"] ?? null,
            'responsable' => $row["responsable"] ?? null,
            'telephone' => $row["telephone"] ?? null,
            'email' => $row["mail"] ?? null,
            'compte' => $row["compte"] ?? null,
            'groupement' => $row["groupement"] ?? null,
        ]);
    }
}
