<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pembayaran;
use App\Models\Pemesanan;


class PembayaransTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemesanans = Pemesanan::all();

        foreach ($pemesanans as $pemesanan) {
            if (rand(0, 1)) {
                Pembayaran::create([
                    'metode' => fake()->randomElement(['Transfer Bank', 'E-Wallet', 'Kartu Kredit']),
                    'jumlah' => $pemesanan->jumlah,
                    'tanggal' => fake()->dateTimeBetween($pemesanan->tanggal, 'now'),
                    'bukti' => fake()->imageUrl(),
                    'status' => fake()->randomElement(['pending', 'accepted', 'rejected']),
                    'id_pemesanan' => $pemesanan->id,
                ]);
            }
            else {
                $pemesanan->status = 'cancelled';
                $pemesanan->save();

                foreach ($pemesanan->itemPemesanans as $itemPemesanan) {
                    $itemPemesanan->hewanQurban->tersedia = 'tersedia';
                    $itemPemesanan->hewanQurban->save();
                }
            }
        }
    }
}
