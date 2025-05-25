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
        // Ambil pelanggan yang ada atau buat baru
        $pelanggan = Pelanggan::inRandomOrder()->first() ?? Pelanggan::factory()->create();

        return [
            'tanggal' => $this->faker->dateTimeBetween('-1 year', '-1 week'),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'id_pelanggan' => $pelanggan->id,
            'nama' => $pelanggan->nama,
            'alamat' => $pelanggan->alamat,
            'no_telp' => $pelanggan->no_telp,
            'metode' => $this->faker->randomElement([
                'qris', 'transfer_mandiri', 'transfer_bsi', 'transfer_bca', 'transfer_bni', 'transfer_bri'
            ]),
            'jumlah' => $this->faker->randomFloat(2, 100000, 1000000),
        ];
    }
}
