<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\PelanggaranSiswa;
use App\Models\Siswa;
use App\Models\BarcodeHarian;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Pelanggaran Hari Ini', PelanggaranSiswa::whereDate('scan_at', today())->count())
                ->description('Total scan pelanggaran')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('danger'),
            Stat::make('Siswa Melanggar Hari Ini', PelanggaranSiswa::whereDate('scan_at', today())->distinct('siswa_id')->count('siswa_id'))
                ->description('Siswa unik yang tercatat')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),
            Stat::make('Barcode Aktif Hari Ini', BarcodeHarian::whereDate('tanggal', today())->where('expired_at', '>', now())->count())
                ->description('QR Code yang masih bisa discan')
                ->descriptionIcon('heroicon-m-qr-code')
                ->color('success'),
        ];
    }
}
