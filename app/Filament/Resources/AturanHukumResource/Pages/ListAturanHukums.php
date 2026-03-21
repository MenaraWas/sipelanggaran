<?php

namespace App\Filament\Resources\AturanHukumResource\Pages;

use App\Filament\Resources\AturanHukumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAturanHukums extends ListRecords
{
    protected static string $resource = AturanHukumResource::class;

    protected static string $view = 'filament.pages.daftar-aturan-hukum';

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
            Actions\CreateAction::make(),
        ];
    }
}
