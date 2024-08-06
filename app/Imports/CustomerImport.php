<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class CustomerImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // Başlıkları loglama
        $headers = $rows->first()->keys()->toArray();
        Log::info('Headers:', $headers);

        foreach ($rows as $row) {
            $data = [];
            foreach ($row as $header => $value) {
                // Başlıkları küçük harf yapıp boşlukları ve özel karakterleri kaldırarak veritabanı alanına dönüştürme
                $column = $this->mapHeaderToColumn(Str::lower($header));
                Log::info('Mapping Header:', ['header' => $header, 'column' => $column, 'value' => $value]); // Başlık ve değer eşlemesini logla

                // Eşleşmeyen başlıklar için hata kontrolü
                if ($column) {
                    $data[$column] = $value;
                }
            }

            // Verileri veritabanına ekleme
            if (!empty($data)) {
                Customer::create($data);
            }
        }
    }

    /**
     * Map header names to column names in the database.
     *
     * @param string $header
     * @return string|null
     */
    private function mapHeaderToColumn($header)
    {
        $mapping = [
            'Geslacht' => 'geslacht',
            'Voornaam' => 'voornaam',
            'Tussenvoegsel' => 'tussenvoegsel',
            'Achternaam' => 'achternaam',
            'Straatnaam' => 'straatnaam',
            'Huisnummer' => 'huisnummer',
            'Toevoeging' => 'toevoeging',
            'Postcode' => 'postcode',
            'Woonplaats' => 'woonplaats',
            'Iban' => 'iban',
            'Tenaamstellng' => 'tenaamstellng',
            'Tel 1' => 'tel1',
            'Tel 2' => 'tel2',
            'Leverancier' => 'leverancier',
            'Saledatum' => 'saledatum',
            'Aanbod' => 'aanbod',
        ];

        return $mapping[$header] ?? null;
    }
}
