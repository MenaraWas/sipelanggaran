<?php

namespace App\Filament\Resources\JenisPelanggaranResource\Pages;

use App\Filament\Resources\JenisPelanggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisPelanggaran extends EditRecord
{
    protected static string $resource = JenisPelanggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
