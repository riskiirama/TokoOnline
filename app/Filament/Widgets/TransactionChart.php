<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class TransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Transaksi 14 Hari Terakhir';
    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 'full';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = collect();
        $labels = [];

        // Ambil 14 hari terakhir (termasuk hari ini)
        for ($i = 13; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->format('d M');

            $count = Transaction::whereDate('created_at', $date)->count();
            $data->push($count);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi',
                    'data' => $data,
                   'backgroundColor' => 'rgba(234, 179, 8, 0.5)',   // warna kuning semi transparan
'                   borderColor'     => 'rgba(234, 179, 8, 1)',     // warna kuning solid
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
