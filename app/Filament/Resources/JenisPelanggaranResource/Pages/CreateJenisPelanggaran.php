<?php

namespace App\Filament\Resources\JenisPelanggaranResource\Pages;

use App\Filament\Resources\JenisPelanggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisPelanggaran extends CreateRecord
{
    protected static string $resource = JenisPelanggaranResource::class;

    protected static string $view = 'filament.pages.create-jenis-pelanggaran';

    public function getViewData(): array
    {
        $setting = \App\Models\Setting::first();
        $appName = $setting->app_name ?? 'Sipelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $user = auth()->user();

        return compact('appName', 'instansiName', 'user');
    }
}
