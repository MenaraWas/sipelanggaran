<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiswas extends ListRecords
{
    protected static string $resource = SiswaResource::class;

    protected static string $view = 'filament.pages.daftar-siswa';

    public string $search = '';

    public function getViewData(): array
    {
        $query = \App\Models\Siswa::query()
            ->withCount('pelanggaran')
            ->orderBy('nama', 'asc');

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%");
            });
        }

        $siswas = $query->get();

        // UI Context
        $setting = \App\Models\Setting::first();
        $appName = $setting->app_name ?? 'Sistem Pelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $user = auth()->user();

        return compact('siswas', 'appName', 'instansiName', 'user');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
