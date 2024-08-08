<?php

use App\Http\Controllers\ApprovedCustomerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/consumentenvoorwaarden', function () {
    return view('privacy.consumentenvoorwaarden');
});
Route::get('/privacy-policy', function () {
    return view('privacy.privacy');
});
Route::get('/klachtenprocedure', function () {
    return view('privacy.klachtenprocedure');
});

// Route::get('/customers', function () {
//     return view('customers.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard route'u
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/approved', [ApprovedCustomerController::class, 'index'])->name('approved');
    // CSV import route'u
    Route::post('/import', [CustomerController::class, 'import'])->name('import.process');
    // Müşteri onaylama route'u
    Route::get('/approved-customers/export', [ApprovedCustomerController::class, 'export'])->name('approved.customers.export');
    // Müşteri dashboard route'u
    Route::get('/dashboard/export', [CustomerController::class, 'export'])->name('customers.export');
    // Müşteri tabloyu sil
    Route::delete('/customers/delete-all', [CustomerController::class, 'deleteAll'])->name('customers.delete_all');
    // Müşteri tablosu arama
    Route::get('/customers/search', [CustomerController::class, 'search'])->name('customers.search');
    // Müşteri Onay Tablosu arama
    Route::get('/approved/search', [ApprovedCustomerController::class, 'search'])->name('approved.customers.search');
});

Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

Route::post('/customer/{uniqueLink}/approve', [ApprovedCustomerController::class, 'store'])->name('customer.approve');
Route::get('/customer/{customer}', [CustomerController::class, 'show'])->name('customer.show');

require __DIR__.'/auth.php';
