<?php

namespace App\Filament\Pages;

use App\Models\PelanggaranSiswa;
use App\Models\Setting;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;

class CustomDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard';
    protected static ?string $slug = 'dashboard';
    protected static ?int $navigationSort = -2;

    protected static string $view = 'filament.pages.custom-dashboard';

    public function getViewData(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Statistik Mingguan
        $weeklyTotal = PelanggaranSiswa::whereBetween('scan_at', [$startOfWeek, $endOfWeek])->count();

        // Breakdown per-status
        $pending = PelanggaranSiswa::where('status', 'pending')->count();
        $selesai = PelanggaranSiswa::where('status', 'selesai')->count();
        $dikecualikan = PelanggaranSiswa::where('status', 'dikecualikan')->count();

        // Bar chart: pelanggaran per hari minggu ini
        $dailyCounts = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $dailyCounts[] = PelanggaranSiswa::whereDate('scan_at', $date)->count();
        }
        $maxDaily = max(array_merge($dailyCounts, [1])); // avoid /0

        // Recent Activity (5 terbaru)
        $recentViolations = PelanggaranSiswa::with(['siswa', 'barcode.jenisPelanggaran'])
            ->latest('scan_at')
            ->take(5)
            ->get();

        // Setting
        $setting = Setting::first();
        $appName = $setting->app_name ?? 'Sistem Pelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';

        // User info
        $user = auth()->user();

        return compact(
            'weeklyTotal',
            'pending',
            'selesai',
            'dikecualikan',
            'dailyCounts',
            'maxDaily',
            'recentViolations',
            'appName',
            'instansiName',
            'user'
        );
    }
}
