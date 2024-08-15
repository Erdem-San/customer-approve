<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CustomerController extends Controller
{
    private $columnMapping = [
        'Voornaam' => 'voornaam',
        'Tussenvoegsel' => 'tussenvoegsel',
        'Achternaam' => 'achternaam',
        'Straatnaam' => 'straatnaam',
        'Huisnummer' => 'huisnummer',
        'Toevoeging' => 'toevoeging',
        'Postcode' => 'postcode',
        'Woonplaats' => 'woonplaats',
        'Geboortedatum' => 'geboortedatum',
        'E-mail' => 'email',
        'Telefoonnummer' => 'telefoonnummer',
        'Email' => 'email',
    ];

    public function index()
    {
        $customers = Customer::latest()->paginate(10); // Her sayfada 10 müşteri gösterilecek
        return view('customers.index', compact('customers'));
    }

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

        return redirect()->route('customers.index')->with('success', 'XLSX dosyası başarıyla içe aktarıldı.');
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
        return view('customers.show', ['customer' => $customer]);
    }

    public function export()
    {
        $customers = Customer::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Başlıkları ekleyelim
        $header = [
            'Voornaam', 'Tussenvoegsel', 'Achternaam',
            'Straatnaam', 'Huisnummer', 'Toevoeging', 'Postcode', 'Woonplaats',
            'Geboortedatum', 'E-mail', 'Telefoonnummer', 'Link'
        ];

        $sheet->fromArray($header, null, 'A1');

        // Müşteri verilerini ekleyelim
        $rowNumber = 2; // Başlık satırından sonra başlıyoruz
        foreach ($customers as $customer) {
            $sheet->fromArray([
                $customer->voornaam,
                $customer->tussenvoegsel,
                $customer->achternaam,
                $customer->straatnaam,
                $customer->huisnummer,
                $customer->toevoeging,
                $customer->postcode,
                $customer->woonplaats,
                $customer->geboortedatum,
                $customer->email,
                $customer->telefoonnummer,
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

    public function deleteAll()
    {
        Customer::truncate(); // Bu yöntem, tüm kayıtları siler
        return redirect()->route('customers.index')->with('success', 'Tüm müşteriler başarıyla silindi.');
    }

    public function search(Request $request)
    {
        $query = $request->search_string;

        $customers = Customer::where('voornaam', 'like', "%{$query}%")
                ->orWhere('tussenvoegsel', 'like', "%{$query}%")
                ->orWhere('achternaam', 'like', "%{$query}%")
                ->orWhere('straatnaam', 'like', "%{$query}%")
                ->orWhere('huisnummer', 'like', "%{$query}%")
                ->orWhere('toevoeging', 'like', "%{$query}%")
                ->orWhere('postcode', 'like', "%{$query}%")
                ->orWhere('woonplaats', 'like', "%{$query}%")
                ->orWhere('geboortedatum', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('telefoonnummer', 'like', "%{$query}%")
                ->latest()
                ->paginate(10);

        if ($customers->count() >= 1) {
            return view('customers.partials.customer-table', compact('customers'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found',
            ]);
        }
    }
}
