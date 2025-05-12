<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'alamat' => $this->faker->streetAddress().', '.$this->faker->randomElement(['Jakarta', 'Bogor', 'Depok', 'Tanggerang', 'Bekasi']),
            'no_telp' => $this->faker->phoneNumber(),
        ];
    }
}
