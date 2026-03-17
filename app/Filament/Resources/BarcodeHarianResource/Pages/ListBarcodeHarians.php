<?php

namespace App\Filament\Resources\BarcodeHarianResource\Pages;

use App\Filament\Resources\BarcodeHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBarcodeHarians extends ListRecords
{
    protected static string $resource = BarcodeHarianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
