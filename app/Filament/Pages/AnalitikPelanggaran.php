<?php

namespace App\Filament\Pages;

use App\Models\PelanggaranSiswa;
use App\Models\Siswa;
use App\Models\JenisPelanggaran;
use App\Models\Setting;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AnalitikPelanggaran extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    protected static ?string $navigationLabel = 'Statistik';
    protected static ?string $title = 'Statistik Pelanggaran';
    protected static ?string $slug = 'statistik-pelanggaran';
    protected static ?int $navigationSort = -1;

    protected static string $view = 'filament.pages.analistik-pelanggaran';

    public function getViewData(): array
    {
        $now = Carbon::now();
        
        // 1. Statistik Mingguan (7 Hari Terakhir)
        $weeklyStats = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i);
            $count = PelanggaranSiswa::whereDate('scan_at', $date)->count();
            $weeklyStats[] = [
                'label' => $date->translatedFormat('D'),
                'count' => $count,
                'full_date' => $date->toDateString(),
            ];
        }

        // 2. Statistik Bulanan (30 Hari Terakhir / Grouped by Week)
        $monthlyStats = [];
        for ($i = 3; $i >= 0; $i--) {
             $start = $now->copy()->subWeeks($i)->startOfWeek();
             $end = $now->copy()->subWeeks($i)->endOfWeek();
             $count = PelanggaranSiswa::whereBetween('scan_at', [$start, $end])->count();
             $monthlyStats[] = [
                 'label' => 'Mgg ' . (4 - $i),
                 'count' => $count,
             ];
        }

        // 3. Jenis Pelanggaran Terbanyak
        $topViolations = JenisPelanggaran::withCount(['pelanggaran as total_count'])
            ->orderByDesc('total_count')
            ->take(5)
            ->get();

        // 4. Ranking Kelas Terbersih (Poin Terkecil)
        // Kita hitung total poin per kelas dari tabel Siswa dan PelanggaranSiswa
        $classRanking = DB::table('siswas')
            ->leftJoin('pelanggaran_siswas', 'siswas.id', '=', 'pelanggaran_siswas.siswa_id')
            ->select('siswas.kelas', DB::raw('SUM(pelanggaran_siswas.nilai) as total_poin'), DB::raw('COUNT(pelanggaran_siswas.id) as total_kasus'))
            ->groupBy('siswas.kelas')
            ->orderBy('total_poin', 'asc')
            ->take(10)
            ->get();

        // General Info
        $setting = Setting::first();
        $appName = $setting->app_name ?? 'Sistem Pelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $user = auth()->user();

        return compact(
            'weeklyStats',
            'monthlyStats',
            'topViolations',
            'classRanking',
            'appName',
            'instansiName',
            'user'
        );
    }
}
