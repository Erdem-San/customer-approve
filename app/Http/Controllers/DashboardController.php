<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10); // Her sayfada 10 müşteri gösterilecek
        return view('dashboard', compact('customers'));
    }
}
