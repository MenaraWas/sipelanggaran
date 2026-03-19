<?php

namespace App\Filament\Resources\PelanggaranSiswaResource\Pages;

use App\Filament\Resources\PelanggaranSiswaResource;
use App\Models\PelanggaranSiswa;
use App\Models\Setting;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListPelanggaranSiswas extends ListRecords
{
    protected static string $resource = PelanggaranSiswaResource::class;

    protected static string $view = 'filament.pages.rekap-pelanggaran';

    public string $search = '';

    public function getViewData(): array
    {
        $query = PelanggaranSiswa::with(['siswa', 'barcode.jenisPelanggaran', 'aturan'])
            ->orderBy('scan_at', 'desc');

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('siswa', fn($sq) => $sq->where('nama', 'like', "%{$search}%"))
                  ->orWhereHas('barcode.jenisPelanggaran', fn($sq) => $sq->where('nama', 'like', "%{$search}%"));
            });
        }

        $pelanggaran = $query->get();

        // Setting
        $setting = Setting::first();
        $appName = $setting->app_name ?? 'Sistem Pelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';

        $user = auth()->user();

        return compact('pelanggaran', 'appName', 'instansiName', 'user');
    }
}
