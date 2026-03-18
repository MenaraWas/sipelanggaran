<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\PelanggaranSiswa;

class PelanggaranChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pelanggaran (7 Hari Terakhir)';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $data = Trend::model(PelanggaranSiswa::class)
            ->between(
                start: now()->subDays(6),
                end: now(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pelanggaran',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                    'borderColor' => '#f87171',
                    'backgroundColor' => 'rgba(248, 113, 113, 0.2)',
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => \Carbon\Carbon::parse($value->date)->format('d M')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
