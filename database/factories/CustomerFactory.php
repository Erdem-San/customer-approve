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
            'voornaam' => $this->faker->firstName,
            'tussenvoegsel' => $this->faker->optional()->lastName, // Ara isim için, isteğe bağlı
            'achternaam' => $this->faker->lastName,
            'straatnaam' => $this->faker->streetName,
            'email' => $this->faker->email,
            'geboortedatum' => $this->faker->birthday,
            'huisnummer' => $this->faker->buildingNumber,
            'toevoeging' => $this->faker->optional()->secondaryAddress, // Ev no ek için
            'postcode' => $this->faker->postcode,
            'woonplaats' => $this->faker->city,
            'telefoonnummer' => $this->faker->phoneNumber,
        ];
    }
}

