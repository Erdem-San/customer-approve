<?php

namespace Database\Seeders;

use App\Models\ApprovedCustomer;
use App\Models\Customer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::create([
            'name' => 'Erdem',
            'email' => 'erdem@gmail.com',
            'password' => Hash::make('123123123'),
        ]);

        // Customer::factory()->count(50)->create();

        // // Onaylanmış müşteri verilerini oluştur
        // ApprovedCustomer::factory()->count(20)->create();

    }
}
