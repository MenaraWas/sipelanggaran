<?php

namespace App\Filament\Resources\BarcodeHarianResource\Pages;

use App\Filament\Resources\BarcodeHarianResource;
use Filament\Actions;
use Filament\Notifications\Notification;
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

        $setting = \App\Models\Setting::first();
        $appName = $setting->app_name ?? 'Sipelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $user = auth()->user();

        return compact('barcodes', 'activeCount', 'scannedToday', 'totalToday', 'appName', 'instansiName', 'user');
    }

    public function deleteBarcode($id)
    {
        $barcode = \App\Models\BarcodeHarian::findOrFail($id);
        $barcode->delete();

        Notification::make()
            ->title('Barcode Berhasil Dihapus')
            ->success()
            ->send();
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
