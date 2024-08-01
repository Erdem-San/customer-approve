<?php

use App\Http\Controllers\ApprovedCustomerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard route'u
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/approved', [ApprovedCustomerController::class, 'index'])->name('approved');
    // CSV import route'u
    Route::post('/import', [CustomerController::class, 'import'])->name('import.process');
    // Müşteri onaylama route'u
});

Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

Route::post('/customer/{uniqueLink}/approve', [ApprovedCustomerController::class, 'store'])->name('customer.approve');
Route::get('/customer/{customer}', [CustomerController::class, 'show'])->name('customer.show');

require __DIR__.'/auth.php';
