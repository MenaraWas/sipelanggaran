<?php
namespace App\Filament\Resources\BarcodeHarianResource\Pages;

use App\Filament\Resources\BarcodeHarianResource;
use App\Models\BarcodeHarian;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateBarcodeHarian extends CreateRecord
{
    protected static string $resource = BarcodeHarianResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Gabungkan tanggal + jam expired menjadi full timestamp
        $data['expired_at'] = $data['tanggal'] . ' ' . $data['expired_at'];
        $data['token'] = BarcodeHarian::generateToken();
        $data['dibuat_oleh'] = Auth::id();
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        // Setelah buat barcode, langsung redirect ke halaman QR
        $record = $this->getRecord();
        return route('barcode.show', $record->token);
    }
}