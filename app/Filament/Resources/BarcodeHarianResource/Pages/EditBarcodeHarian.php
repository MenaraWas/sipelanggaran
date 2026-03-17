<?php

namespace App\Filament\Resources\BarcodeHarianResource\Pages;

use App\Filament\Resources\BarcodeHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBarcodeHarian extends EditRecord
{
    protected static string $resource = BarcodeHarianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
