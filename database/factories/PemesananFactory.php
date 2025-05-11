<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pelanggan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemesanan>
 */
class PemesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' => $this->faker->dateTimeBetween('-1 year', '-1 week'),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'id_pelanggan' => Pelanggan::inRandomOrder()->first()?->id ?? Pelanggan::factory(),
            'jumlah' => $this->faker->randomFloat(2, 100000, 1000000),
        ];
    }
}
