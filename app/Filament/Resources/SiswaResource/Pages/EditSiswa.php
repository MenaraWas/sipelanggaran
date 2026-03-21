<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiswa extends EditRecord
{
    protected static string $resource = SiswaResource::class;

    protected static string $view = 'filament.pages.edit-siswa';

    public function getViewData(): array
    {
        $setting = \App\Models\Setting::first();
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
