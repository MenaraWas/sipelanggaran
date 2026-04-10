<?php

namespace App\Filament\Resources\AlasanPelanggaranResource\Pages;

use App\Filament\Resources\AlasanPelanggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAlasanPelanggaran extends EditRecord
{
    protected static string $resource = AlasanPelanggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
