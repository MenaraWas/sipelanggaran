<?php

namespace App\Filament\Resources\JenisPelanggaranResource\Pages;

use App\Filament\Resources\JenisPelanggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisPelanggarans extends ListRecords
{
    protected static string $resource = JenisPelanggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
