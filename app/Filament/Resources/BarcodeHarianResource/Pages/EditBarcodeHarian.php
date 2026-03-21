<?php

namespace App\Filament\Resources\BarcodeHarianResource\Pages;

use App\Filament\Resources\BarcodeHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBarcodeHarian extends EditRecord
{
    protected static string $resource = BarcodeHarianResource::class;

    protected static string $view = 'filament.pages.edit-barcode';

    public function getViewData(): array
    {
        $setting = \App\Models\Setting::first();
        $appName = $setting->app_name ?? 'Sipelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $user = auth()->user();

        return compact('appName', 'instansiName', 'user');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
