<?php

namespace App\Filament\Resources\AturanHukumResource\Pages;

use App\Filament\Resources\AturanHukumResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAturanHukum extends EditRecord
{
    protected static string $resource = AturanHukumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
