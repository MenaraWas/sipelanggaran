<?php

namespace App\Filament\Pages;

use App\Models\PelanggaranSiswa;
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

    // Filter aktif
    public ?int $filterJenis = null;
    public ?string $dateFrom = null;
    public ?string $dateTo = null;

    public function mount()
    {
        $this->dateTo = now()->toDateString();
        $this->dateFrom = now()->subDays(30)->toDateString();
    }

    public function getViewData(): array
    {
        $start = Carbon::parse($this->dateFrom)->startOfDay();
        $end = Carbon::parse($this->dateTo)->endOfDay();
        
        // 1. Statistik Harian dalam Range (Max 31 hari untuk trend detail)
        $dailyStats = [];
        $diffDays = $start->diffInDays($end);
        
        // Jika range < 60 hari, tampilkan harian. Jika > 60 hari, tampilkan mingguan/bulanan.
        // Untuk sekarang kita asumsikan harian (karena default 30 hari)
        $tempStart = $start->copy();
        while ($tempStart <= $end) {
            $count = PelanggaranSiswa::whereDate('scan_at', $tempStart)->count();
            $dailyStats[] = [
                'label' => $tempStart->translatedFormat('d M'),
                'count' => $count,
                'full_date' => $tempStart->toDateString(),
            ];
            $tempStart->addDay();
        }

        // 2. Jenis Pelanggaran Terbanyak dalam Range
        $topViolations = JenisPelanggaran::withCount(['pelanggaran as total_count' => function($query) use ($start, $end) {
                $query->whereBetween('scan_at', [$start, $end]);
            }])
            ->orderByDesc('total_count')
            ->take(5)
            ->get();

        // 3. Ranking Kelas Terbersih dalam Range (Berdasarkan poin terkecil)
        $classRanking = DB::table('siswas')
            ->leftJoin('pelanggaran_siswas', 'siswas.id', '=', 'pelanggaran_siswas.siswa_id')
            ->where(function($q) use ($start, $end) {
                $q->whereBetween('pelanggaran_siswas.scan_at', [$start, $end])
                  ->orWhereNull('pelanggaran_siswas.id');
            })
            ->select('siswas.kelas', DB::raw('SUM(COALESCE(pelanggaran_siswas.nilai, 0)) as total_poin'), DB::raw('COUNT(pelanggaran_siswas.id) as total_kasus'))
            ->groupBy('siswas.kelas')
            ->orderBy('total_poin', 'asc')
            ->take(10)
            ->get();

        // 4. Top Alasan dalam Range
        $jenisList = JenisPelanggaran::orderBy('nama')->get();

        // Alasan dari daftar admin
        $queryAlasan = DB::table('pelanggaran_siswas')
            ->join('alasan_pelanggarans', 'pelanggaran_siswas.alasan_id', '=', 'alasan_pelanggarans.id')
            ->join('barcode_harians', 'pelanggaran_siswas.barcode_id', '=', 'barcode_harians.id')
            ->whereBetween('pelanggaran_siswas.scan_at', [$start, $end])
            ->select('alasan_pelanggarans.teks as alasan', DB::raw('COUNT(*) as total'))
            ->when($this->filterJenis, fn($q) => $q->where('barcode_harians.jenis_pelanggaran_id', $this->filterJenis))
            ->groupBy('alasan_pelanggarans.teks');

        // Alasan custom
        $queryCustom = DB::table('pelanggaran_siswas')
            ->join('barcode_harians', 'pelanggaran_siswas.barcode_id', '=', 'barcode_harians.id')
            ->whereBetween('pelanggaran_siswas.scan_at', [$start, $end])
            ->whereNull('pelanggaran_siswas.alasan_id')
            ->whereNotNull('pelanggaran_siswas.alasan_custom')
            ->where('pelanggaran_siswas.alasan_custom', '!=', '')
            ->select('pelanggaran_siswas.alasan_custom as alasan', DB::raw('COUNT(*) as total'))
            ->when($this->filterJenis, fn($q) => $q->where('barcode_harians.jenis_pelanggaran_id', $this->filterJenis))
            ->groupBy('pelanggaran_siswas.alasan_custom');

        $topAlasan = $queryAlasan->unionAll($queryCustom)
            ->orderByDesc('total')
            ->take(10)
            ->get();

        // General Info
        $setting = Setting::first();
        $appName = $setting->app_name ?? 'Sistem Pelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $user = auth()->user();

        return compact(
            'dailyStats',
            'topViolations',
            'classRanking',
            'topAlasan',
            'jenisList',
            'appName',
            'instansiName',
            'user'
        );
    }
}
