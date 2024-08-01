<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

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
