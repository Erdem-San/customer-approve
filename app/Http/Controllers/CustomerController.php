<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ApprovedCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($file));

        foreach ($csvData as $row) {
            Customer::create([
                'ad' => $row[0],
                'soyad' => $row[1],
                'ev_no' => $row[2],
                'posta_kodu' => $row[3],
                'sehir' => $row[4],
                'mail' => $row[5],
                'tel_no' => $row[6],
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'CSV dosyası başarıyla içe aktarıldı.');
    }

    public function show(Customer $customer)
    {
        return view('customer.show', ['customer' => $customer]);
    }
}
