<?php

namespace App\Filament\Resources\PelanggaranSiswaResource\Pages;

use App\Filament\Resources\PelanggaranSiswaResource;
use App\Models\Setting;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPelanggaranSiswa extends EditRecord
{
    protected static string $resource = PelanggaranSiswaResource::class;

    protected static string $view = 'filament.pages.edit-pelanggaran';

    public function getViewData(): array
    {
        $setting = Setting::first();
        $appName = $setting->app_name ?? 'Sistem Pelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $user = auth()->user();

        $record = $this->record;

        return compact('appName', 'instansiName', 'user', 'record');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
