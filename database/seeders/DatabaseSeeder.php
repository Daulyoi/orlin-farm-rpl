<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Pelanggan;
use App\Models\HewanQurban;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminsTableSeeder::class,
            PelanggansTableSeeder::class,
            HewanQurbansTableSeeder::class,
            PemesanansTableSeeder::class,
            ItemPemesanansTableSeeder::class,
            PembayaransTableSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
