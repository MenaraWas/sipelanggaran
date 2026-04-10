<?php

namespace App\Filament\Resources\AlasanPelanggaranResource\Pages;

use App\Filament\Resources\AlasanPelanggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAlasanPelanggarans extends ListRecords
{
    protected static string $resource = AlasanPelanggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
