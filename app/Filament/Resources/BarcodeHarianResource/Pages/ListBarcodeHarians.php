<?php

namespace App\Filament\Resources\BarcodeHarianResource\Pages;

use App\Filament\Resources\BarcodeHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBarcodeHarians extends ListRecords
{
    protected static string $resource = BarcodeHarianResource::class;

    protected static string $view = 'filament.pages.barcode-management';

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function getViewData(): array
    {
        $query = \App\Models\BarcodeHarian::with(['jenisPelanggaran', 'pelanggaran'])
            ->latest('tanggal');

        if ($this->search) {
            $query->whereHas('jenisPelanggaran', function ($q) {
                $q->where('nama', 'like', "%{$this->search}%");
            });
        }

        $barcodes = $query->get();

        $activeCount = \App\Models\BarcodeHarian::where('expired_at', '>', now())->count();
        $scannedToday = \App\Models\PelanggaranSiswa::whereDate('scan_at', today())->count();
        $totalToday = \App\Models\BarcodeHarian::whereDate('tanggal', today())->count();

        return compact('barcodes', 'activeCount', 'scannedToday', 'totalToday');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Buat Barcode')
                ->icon('heroicon-o-plus'),
        ];
    }
}
