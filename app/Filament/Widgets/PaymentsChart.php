<?php

namespace App\Filament\Widgets;

use App\Models\Pembayaran;
use Filament\Widgets\ChartWidget;

class PaymentsChart extends ChartWidget
{
    protected static ?string $heading = 'Pembayaran Bulanan';

    protected function getData(): array
    {
        $data = Pembayaran::selectRaw('MONTH(tanggal) as month, SUM(jumlah) as total')
            ->where('status', 'accepted')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(fn ($item) => [date('F', mktime(0, 0, 0, $item->month, 1)) => $item->total])
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pembayaran',
                    'data' => array_values($data),
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // or 'line', 'pie', etc.
    }
}

