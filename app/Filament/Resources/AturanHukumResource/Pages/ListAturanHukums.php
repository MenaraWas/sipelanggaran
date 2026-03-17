<?php

namespace App\Filament\Resources\AturanHukumResource\Pages;

use App\Filament\Resources\AturanHukumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAturanHukums extends ListRecords
{
    protected static string $resource = AturanHukumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
