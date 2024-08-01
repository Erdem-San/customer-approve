<?php

namespace App\Http\Controllers;

use App\Models\ApprovedCustomer;
use Illuminate\Http\Request;

class ApprovedCustomerController extends Controller
{

    public function index()
    {
        $customers = ApprovedCustomer::latest()->paginate(10); // Her sayfada 10 müşteri gösterilecek
        return view('approved', compact('customers'));
    }

    public function store(Request $request, $uniqueLink)
    {
        // Yeni onaylı müşteri oluştur
        $approvedCustomer = new ApprovedCustomer();
        $approvedCustomer->ad = $request->ad;
        $approvedCustomer->soyad = $request->soyad;
        $approvedCustomer->ev_no = $request->ev_no;
        $approvedCustomer->posta_kodu = $request->posta_kodu;
        $approvedCustomer->sehir = $request->sehir;
        $approvedCustomer->mail = $request->mail;
        $approvedCustomer->tel_no = $request->tel_no;
        $approvedCustomer->save();

        // Onaylama işlemi başarılı mesajı ve yönlendirme
        return redirect()->route('thanks');
    }
}

