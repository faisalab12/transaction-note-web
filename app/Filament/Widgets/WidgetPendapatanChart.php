<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Transaction;

class WidgetPendapatanChart extends LineChartWidget
{
    protected static ?string $heading = 'Pendapatan/Pemasukkan';

    protected function getData(): array
    {
        $data = Trend::query(Transaction::incomes())
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('jumlah');

        return [
            'datasets' => [
                [
                    'label' => 'Grafik Pendapatan/Pemasukkan',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
}
