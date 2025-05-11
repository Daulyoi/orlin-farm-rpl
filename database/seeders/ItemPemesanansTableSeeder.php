<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ItemPemesanan;
use App\Models\Pemesanan;
use App\Models\HewanQurban;

class ItemPemesanansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemesanans = Pemesanan::all();
        $availableHewan = HewanQurban::where('tersedia', 'tersedia')->get();

        foreach ($pemesanans as $pemesanan) {
            $hewans = $availableHewan->random(1, min(3, $availableHewan->count()));
            $total = 0;

            foreach ($hewans as $hewan) {
                ItemPemesanan::create([
                    'id_pemesanan' => $pemesanan->id,
                    'id_hewan' => $hewan->id,
                ]);

                $hewan->tersedia = 'tidak';
                $hewan->save();

                $availableHewan = $availableHewan->filter(fn ($h) => $h->id !== $hewan->id);

                $total += $hewan->harga;
            }

            $pemesanan->jumlah = $total;
            $pemesanan->save();
        }
    }
}
