<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Illuminate\Foundation\Auth\User;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TransactionStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
           return [
            Card::make('Total Customer', User::where('role', 'customer')->count())
                ->description('Jumlah pelanggan terdaftar')
                ->color('secondary'),
            Card::make('Transaksi Hari Ini', Transaction::whereDate('created_at', today())->count())
                ->description('Total dibuat hari ini')
                ->color('success'),

            Card::make('Total Transaksi', Transaction::count())
                ->description('Semua transaksi')
                ->color('primary'),
            Card::make('Transaksi Minggu Ini', Transaction::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count())
                ->description('Total 7 hari ini')
                ->color('info'),
            Card::make('Pending', Transaction::where('status', 'pending')->count())
                ->description('Menunggu pembayaran')
                ->color('warning'),

            Card::make('Paid', Transaction::where('status', 'paid')->count())
                ->description('Sudah dibayar')
                ->color('info'),

            Card::make('Shipped', Transaction::where('status', 'shipped')->count())
                ->description('Sedang dikirim')
                ->color('secondary'),

            Card::make('Completed', Transaction::where('status', 'completed')->count())
                ->description('Selesai')
                ->color('success'),

            Card::make('Canceled', Transaction::where('status', 'canceled')->count())
                ->description('Dibatalkan')
                ->color('danger'),
        ];
    }
}
