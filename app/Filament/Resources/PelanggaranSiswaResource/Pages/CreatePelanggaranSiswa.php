<?php

namespace App\Filament\Resources\PelanggaranSiswaResource\Pages;

use App\Filament\Resources\PelanggaranSiswaResource;
use App\Models\Setting;
use Filament\Resources\Pages\CreateRecord;

class CreatePelanggaranSiswa extends CreateRecord
{
    protected static string $resource = PelanggaranSiswaResource::class;

    protected static string $view = 'filament.pages.create-pelanggaran';

    public function getViewData(): array
    {
        $setting = Setting::first();
        $appName = $setting->app_name ?? 'Sistem Pelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $user = auth()->user();

        return compact('appName', 'instansiName', 'user');
    }
}
