<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HewanQurban>
 */
class HewanQurbanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hewan = [
            'Sapi Bali',
            'Sapi Madura',
            'Sapi Limosin',
            'Sapi Simmental',
            'Sapi Brahman',
            'Sapi Ongole',
            'Kambing Kacang',
            'Kambing Etawa',
            'Kambing Boer',
            'Kambing Jawa Randu',
            'Kambing Gembrong',
            'Domba Garut',
            'Domba Priangan',
            'Domba Ekor Gemuk',
            'Domba Ekor Tipis',
            'Domba Merino',
            'Domba Texel',
            'Kerbau Lumpur',
            'Kerbau Bule',
            'Unta Dromedaris',
            'Unta Baktria'
        ];

        return [
            'jenis' => $this->faker->randomElement($hewan),
            'bobot' => $this->faker->numberBetween(100, 500),
            'harga' => $this->faker->numberBetween(1000000, 10000000),
            'kelamin' => $this->faker->randomElement(['Jantan', 'Betina']),
            'deskripsi' => $this->faker->sentence(),
            'lokasi' => $this->faker->streetAddress().', '.$this->faker->randomElement(['Jakarta', 'Bogor', 'Depok', 'Tanggerang', 'Bekasi']),
            'foto' => asset('images/hewan-placeholder.jpg'),
        ];
    }
}
