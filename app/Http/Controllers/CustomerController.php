<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CustomerController extends Controller
{
    private $columnMapping = [
        'Geslacht' => 'geslacht',
        'Voornaam' => 'voornaam',
        'Tussenvoegsel' => 'tussenvoegsel',
        'Achternaam' => 'achternaam',
        'Straatnaam' => 'straatnaam',
        'Huisnummer' => 'huisnummer',
        'Toevoeging' => 'toevoeging',
        'Postcode' => 'postcode',
        'Woonplaats' => 'woonplaats',
        'Geboortedatum' => 'geboortedatum', // Yeni eklenen alan
        'Iban' => 'iban',
        'Tenaamstell\'ng' => 'tenaamstellng', // Düzeltildi
        'Email' => 'email', // Yeni eklenen alan
        'Tel1' => 'tel1',
        'Tel2' => 'tel2',
        'Leverancier' => 'leverancier',
        'Saledatum' => 'saledatum',
        'Aanbod' => 'aanbod',
    ];

    public function import(Request $request)
    {
        $request->validate([
            'xlsx_file' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('xlsx_file');

        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $headers = array_shift($rows);

        $columnMap = $this->mapHeadersToColumns($headers);

        foreach ($rows as $row) {
            $data = $this->mapRowToColumns($row, $columnMap);
            $data['unique_link'] = Str::uuid()->toString();

            // Verileri temizle
            $data = $this->cleanData($data);

            Customer::create($data);
        }

        return redirect()->route('dashboard')->with('success', 'XLSX dosyası başarıyla içe aktarıldı.');
    }

    private function mapHeadersToColumns($headers)
    {
        $columnMap = [];
        foreach ($headers as $index => $header) {
            $header = trim($header);  // Başlıktaki fazladan boşlukları kaldır
            if (isset($this->columnMapping[$header])) {
                $columnMap[$index] = $this->columnMapping[$header];
            }
        }
        return $columnMap;
    }

    private function mapRowToColumns($row, $columnMap)
    {
        $mappedRow = [];
        foreach ($columnMap as $excelIndex => $dbColumn) {
            if (isset($row[$excelIndex])) {
                $mappedRow[$dbColumn] = $row[$excelIndex];
            }
        }
        return $mappedRow;
    }

    private function cleanData($data)
    {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = trim($value);
            }
        }
        return $data;
    }

    public function show(Customer $customer)
    {
        return view('customer.show', ['customer' => $customer]);
    }

    public function export()
    {
        $customers = Customer::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Başlıkları ekleyelim
        $header = [
            'Geslacht', 'Voornaam', 'Tussenvoegsel', 'Achternaam',
            'Straatnaam', 'Huisnummer', 'Toevoeging', 'Postcode', 'Woonplaats',
            'Geboortedatum', 'Iban', 'Tenaamstelling', 'Email', 'Tel1', 'Tel2',
            'Leverancier', 'Saledatum', 'Aanbod', 'Link'
        ];

        $sheet->fromArray($header, null, 'A1');

        // Müşteri verilerini ekleyelim
        $rowNumber = 2; // Başlık satırından sonra başlıyoruz
        foreach ($customers as $customer) {
            $sheet->fromArray([
                $customer->geslacht,
                $customer->voornaam,
                $customer->tussenvoegsel,
                $customer->achternaam,
                $customer->straatnaam,
                $customer->huisnummer,
                $customer->toevoeging,
                $customer->postcode,
                $customer->woonplaats,
                $customer->geboortedatum, // Yeni alan
                $customer->iban,
                $customer->tenaamstellng, // Düzeltilmiş alan
                $customer->email, // Yeni alan
                $customer->tel1,
                $customer->tel2,
                $customer->leverancier,
                $customer->saledatum,
                $customer->aanbod,
                $customer->unique_link,
            ], null, 'A' . $rowNumber);
            $rowNumber++;
        }

        $filename = "customers_" . now()->format('Y-m-d_H-i-s') . ".xlsx";
        $writer = new Xlsx($spreadsheet);

        $path = storage_path('app/public/' . $filename);
        $writer->save($path);

        return response()->download($path)->deleteFileAfterSend(true);
    }
}
