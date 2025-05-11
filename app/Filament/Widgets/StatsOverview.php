<?php

namespace App\Filament\Widgets;

use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Pemesanan', Pemesanan::count()),
            Card::make('Total Pembayaran', Pembayaran::count()),
            Card::make('Total Uang Masuk', 'Rp ' . number_format(Pembayaran::where('status', 'accepted')->sum('jumlah'), 2, ',', '.')),
        ];
    }
}
