<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class VisitsChart extends ChartWidget
{
    protected static ?string $heading = 'Kunjungan Bulanan';

    protected function getData(): array
    {
        $visits = getLastVisitCount();

        $visitMap = $visits->pluck('visit_count', 'date')->toArray();

        $labels = [];
        $data = [];
        for ($i = 0; $i < 30; $i++) {
            $date = Carbon::now()->subDays(29 - $i)->toDateString();
            $labels[] = $date;
            $data[] = $visitMap[$date] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'data' => $data,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.4)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'ticks' => [
                        'display' => false,
                    ],
                ],
                'y' => [
                    'ticks' => [
                        'stepSize' => 1,
                        'beginAtZero' => true,
                    ]
                ]
            ],
        ];
    }

}
