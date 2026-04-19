<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use App\Imports\SiswaImport;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListSiswas extends ListRecords
{
    protected static string $resource = SiswaResource::class;

    protected static string $view = 'filament.pages.daftar-siswa';

    public string $search = '';

    // Filter States
    public $filterKelas = null;
    public $filterGender = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterKelas' => ['except' => null],
        'filterGender' => ['except' => null],
    ];

    public function updatedSearch() { $this->resetPage(); }
    public function updatedFilterKelas() { $this->resetPage(); }
    public function updatedFilterGender() { $this->resetPage(); }

    public function getViewData(): array
    {
        $query = \App\Models\Siswa::query()
            ->withCount('pelanggaran')
            ->orderBy('nama', 'asc');

        // Search Logic
        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%");
            });
        }

        // Filter Logic
        if ($this->filterKelas) {
            $query->where('kelas', $this->filterKelas);
        }

        if ($this->filterGender) {
            $query->where('jenis_kelamin', $this->filterGender);
        }

        $siswas = $query->paginate(12);

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
            Actions\Action::make('import_profil')
                ->label('Import Profil (Excel 1)')
                ->icon('heroicon-o-document-arrow-up')
                ->color('info')
                ->form([
                    FileUpload::make('file')
                        ->label('Pilih File Excel Profil')
                        ->required()
                        ->multiple() // Mendukung banyak file sekaligus
                        ->disk('local')
                        ->directory('temp-imports')
                ])
                ->action(function (array $data) {
                    set_time_limit(0);
                    $files = (array) $data['file'];
                    $count = 0;

                    try {
                        foreach ($files as $filePath) {
                            $file = storage_path('app/' . $filePath);
                            Excel::import(new \App\Imports\SiswaImport, $file);
                            $count++;
                        }

                        Notification::make()
                            ->title('Import Profil Berhasil')
                            ->body("Berhasil memproses {$count} file profil.")
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Gagal: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            Actions\Action::make('update_email')
                ->label('Update Email (Excel 2)')
                ->icon('heroicon-o-envelope')
                ->color('warning')
                ->form([
                    FileUpload::make('file')
                        ->label('Pilih File Excel Email')
                        ->required()
                        ->multiple() // Mendukung banyak file sekaligus
                        ->disk('local')
                        ->directory('temp-imports')
                ])
                ->action(function (array $data) {
                    set_time_limit(0);
                    $files = (array) $data['file'];
                    $totalUpdated = 0;
                    $totalSkipped = 0;
                    $totalSkippedLog = [];
                    $fileCount = 0;

                    try {
                        foreach ($files as $filePath) {
                            $file = storage_path('app/' . $filePath);
                            $import = new \App\Imports\SiswaEmailUpdate;
                            Excel::import($import, $file);
                            
                            $totalUpdated += $import->updatedCount;
                            $totalSkipped += $import->skippedCount;
                            $totalSkippedLog = array_merge($totalSkippedLog, $import->skippedLog);
                            $fileCount++;
                        }

                        $body = "Berhasil memproses {$fileCount} file. Total update: {$totalUpdated}. Total skip: {$totalSkipped}.";
                        if (!empty($totalSkippedLog)) {
                            $limit = 5;
                            $body .= "\n\nHasil Skip (Contoh {$limit}):\n- " . implode("\n- ", array_slice($totalSkippedLog, 0, $limit));
                        }

                        Notification::make()
                            ->title('Email Berhasil Diupdate')
                            ->body($body)
                            ->warning() // Gunakan warning jika ada yang diskip
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Gagal: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            Actions\Action::make('filter')
                ->label('Filter')
                ->icon('heroicon-o-funnel')
                ->color('secondary')
                ->form([
                    \Filament\Forms\Components\Select::make('kelas')
                        ->label('Pilih Kelas')
                        ->options(\App\Models\Siswa::distinct()->pluck('kelas', 'kelas')->toArray())
                        ->placeholder('Semua Kelas')
                        ->default($this->filterKelas),
                    \Filament\Forms\Components\Select::make('gender')
                        ->label('Jenis Kelamin')
                        ->options([
                            'Laki-laki' => 'Laki-laki',
                            'Perempuan' => 'Perempuan',
                        ])
                        ->placeholder('Semua Gender')
                        ->default($this->filterGender),
                ])
                ->action(function (array $data) {
                    $this->filterKelas = $data['kelas'];
                    $this->filterGender = $data['gender'];
                    $this->resetPage();
                })
                ->modalSubmitActionLabel('Terapkan Filter')
                ->extraAttributes([
                    'class' => 'justify-center',
                ]),
            Actions\CreateAction::make()
                ->label('Siswa Baru'),
        ];
    }
}
