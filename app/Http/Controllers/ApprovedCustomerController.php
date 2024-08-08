<?php

namespace App\Http\Controllers;

use App\Models\ApprovedCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApprovedCustomerController extends Controller
{

    public function index()
    {
        $customers = ApprovedCustomer::latest()->paginate(10); // Her sayfada 10 müşteri gösterilecek
        return view('approved-customers.index', compact('customers'));
    }

    public function store(Request $request, $uniqueLink)
    {
        // Yeni onaylı müşteri oluştur
        $approvedCustomer = new ApprovedCustomer();
        $approvedCustomer->geslacht = $request->geslacht;
        $approvedCustomer->voornaam = $request->voornaam;
        $approvedCustomer->tussenvoegsel = $request->tussenvoegsel;
        $approvedCustomer->achternaam = $request->achternaam;
        $approvedCustomer->straatnaam = $request->straatnaam;
        $approvedCustomer->huisnummer = $request->huisnummer;
        $approvedCustomer->toevoeging = $request->toevoeging;
        $approvedCustomer->postcode = $request->postcode;
        $approvedCustomer->woonplaats = $request->woonplaats;
        $approvedCustomer->geboortedatum = $request->geboortedatum;
        $approvedCustomer->iban = $request->iban;
        $approvedCustomer->tenaamstellng = $request->tenaamstellng;
        $approvedCustomer->email = $request->email;
        $approvedCustomer->tel1 = $request->tel1;
        $approvedCustomer->tel2 = $request->tel2;
        $approvedCustomer->leverancier = $request->leverancier;
        $approvedCustomer->saledatum = $request->saledatum;
        $approvedCustomer->aanbod = $request->aanbod;

        $approvedCustomer->ip_address = $request->ip();
        $approvedCustomer->user_agent = $request->userAgent();
        $approvedCustomer->session_data = json_encode($request->session()->all());

        $approvedCustomer->save();

        // Onaylama işlemi başarılı mesajı ve yönlendirme
        return redirect()->route('thanks');
    }

    public function export()
    {
        $customers = ApprovedCustomer::all();

        $csvData = [];
        foreach ($customers as $customer) {
            $csvData[] = [
                'Ad' => $customer->ad,
                'Soyad' => $customer->soyad,
                'Ip Adresi' => $customer->ip_address,
                'Kullanıcı Araçları' => $customer->user_agent,
                'Ev No' => $customer->ev_no,
                'Posta Kodu' => $customer->posta_kodu,
                'Şehir' => $customer->sehir,
                'Mail' => $customer->mail,
                'Tel No' => $customer->tel_no,
                'Onaylanma Tarihi' => $customer->created_at,
            ];
        }

        $filename = "approved_customers_" . now()->format('Y-m-d_H-i-s') . ".csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array_keys($csvData[0]));

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);

        return Response::download($filename, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ])->deleteFileAfterSend(true);
    }

    public function search(Request $request)
    {
        $query = $request->search_string;

        $customers = ApprovedCustomer::where('geslacht', 'like', "%{$query}%")
                    ->orWhere('voornaam', 'like', "%{$query}%")
                    ->orWhere('tussenvoegsel', 'like', "%{$query}%")
                    ->orWhere('achternaam', 'like', "%{$query}%")
                    ->orWhere('straatnaam', 'like', "%{$query}%")
                    ->orWhere('huisnummer', 'like', "%{$query}%")
                    ->orWhere('toevoeging', 'like', "%{$query}%")
                    ->orWhere('postcode', 'like', "%{$query}%")
                    ->orWhere('woonplaats', 'like', "%{$query}%")
                    ->orWhere('geboortedatum', 'like', "%{$query}%")
                    ->orWhere('iban', 'like', "%{$query}%")
                    ->orWhere('tenaamstellng', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('tel1', 'like', "%{$query}%")
                    ->orWhere('tel2', 'like', "%{$query}%")
                    ->orWhere('leverancier', 'like', "%{$query}%")
                    ->orWhere('saledatum', 'like', "%{$query}%")
                    ->orWhere('aanbod', 'like', "%{$query}%")
                    ->latest()
                    ->paginate(10);

        if ($customers->count() >= 1) {
            return view('approved-customers.partials.customer-table', compact('customers'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found',
            ]);
        }
    }

}

