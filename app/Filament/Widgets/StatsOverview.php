<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Transaction;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $pendapatan = Transaction::incomes()->get()->sum('jumlah');
        $pengeluaran = Transaction::expenses()->get()->sum('jumlah');


        return [


            Card::make('Pendapatan', $pendapatan),
            Card::make('Pengeluaran', $pengeluaran),
            Card::make('Selisih', $pendapatan - $pengeluaran),
        ];
    }
}
