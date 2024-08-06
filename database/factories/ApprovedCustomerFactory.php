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
            'geslacht' => $this->faker->randomElement(['Man', 'Vrouw']), // Cinsiyet için
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
            'iban' => $this->faker->iban('NL'), // Hollanda için IBAN
            'tenaamstellng' => $this->faker->name, // İlk Tenaamstellng için
            'tel1' => $this->faker->phoneNumber,
            'tel2' => $this->faker->optional()->phoneNumber, // İkinci telefon numarası, isteğe bağlı
            'leverancier' => $this->faker->company, // Tedarikçi için
            'saledatum' => $this->faker->date(), // Satış tarihi için
            'aanbod' => $this->faker->word, // Teklif için
        ];
    }
}
