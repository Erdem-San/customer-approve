<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApprovedCustomer>
 */
class ApprovedCustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ad' => $this->faker->firstName,
            'soyad' => $this->faker->lastName,
            'ev_no' => $this->faker->buildingNumber,
            'posta_kodu' => $this->faker->postcode,
            'sehir' => $this->faker->city,
            'mail' => $this->faker->email,
            'tel_no' => $this->faker->phoneNumber,
        ];
    }
}
