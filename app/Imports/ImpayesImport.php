<?php

namespace App\Imports;

use App\Models\Impayes\Impayes;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImpayesImport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Impayes([
            'exercice' => $row['exercice'] ?? null,
            'quitance' => $row["n_quittance"] ?? null,
            'cie' => $row["quit_cie"] ?? null,
            'souscripteur' => $row["souscripteur"] ?? null,
            'branche' => $row["branche"] ?? null,
            'categorie' => $row["categorie"] ?? null,
            'risque' => $row["risque"] ?? null,
            'police' => $row["police"] ?? null,
            'du' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["du"])) ?? null,
            'au' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["au"])) ?? null,
            'prime_total' => $row["p_totale"] ?? null,
            'mtt_ancaiss' => $row["mtt_encaiss"] ?? null,
            'ref_encaiss' => $row["ref_encaiss"] ?? null,
            'aperiteur' => $row["aperiteur"] ?? null,
            // 'id_client' => $row["aperiteur"] ?? null,
        ]);
    }
}
