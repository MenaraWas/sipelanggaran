<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSiswa extends CreateRecord
{
    protected static string $resource = SiswaResource::class;

    protected static string $view = 'filament.pages.create-siswa';

    public function getViewData(): array
    {
        $setting = \App\Models\Setting::first();
        $appName = $setting->app_name ?? 'Sistem Pelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $user = auth()->user();

        return compact('appName', 'instansiName', 'user');
    }
}
