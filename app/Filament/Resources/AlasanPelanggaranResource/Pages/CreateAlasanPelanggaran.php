<?php

namespace App\Filament\Resources\AlasanPelanggaranResource\Pages;

use App\Filament\Resources\AlasanPelanggaranResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAlasanPelanggaran extends CreateRecord
{
    protected static string $resource = AlasanPelanggaranResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
