<?php
namespace App\Filament\Pages;

use App\Exports\PelanggaranExport;
use App\Models\PelanggaranSiswa;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Maatwebsite\Excel\Facades\Excel;

class ExportLaporan extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';
    protected static ?string $navigationLabel = 'Export Laporan';
    protected static ?string $title = 'Export Laporan Pelanggaran';
    protected static ?int $navigationSort = 6;
    protected static string $view = 'filament.pages.export-laporan';

    public function getViewData(): array
    {
        $setting = \App\Models\Setting::first();
        $appName = $setting->app_name ?? 'Sipelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $user = auth()->user();

        return compact('appName', 'instansiName', 'user');
    }

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'dari' => now()->startOfMonth()->format('Y-m-d'),
            'sampai' => now()->format('Y-m-d'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kelas')
                    ->label('Kelas')
                    ->options(fn() => Siswa::distinct()->pluck('kelas', 'kelas'))
                    ->placeholder('Semua Kelas')
                    ->searchable(),
                Select::make('siswa_id')
                    ->label('Siswa (opsional)')
                    ->options(fn() => Siswa::pluck('nama', 'id'))
                    ->placeholder('Semua Siswa')
                    ->searchable(),
                DatePicker::make('dari')
                    ->label('Dari Tanggal')
                    ->required(),
                DatePicker::make('sampai')
                    ->label('Sampai Tanggal')
                    ->required(),
            ])
            ->columns(2)
            ->statePath('data');
    }

    public function exportExcel(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $data = $this->form->getState();

        Notification::make()
            ->title('Mengunduh Excel...')
            ->success()
            ->send();

        return Excel::download(
            new PelanggaranExport(
                kelas: $data['kelas'] ?? null,
                dari: $data['dari'] ?? null,
                sampai: $data['sampai'] ?? null,
                siswaId: $data['siswa_id'] ?? null,
            ),
            'laporan-pelanggaran-' . now()->format('Ymd') . '.xlsx'
        );
    }

    public function exportPdf()
    {
        $data = $this->form->getState();

        $query = PelanggaranSiswa::with(['siswa', 'barcode.jenisPelanggaran', 'aturan'])
            ->when(
                $data['kelas'] ?? null,
                fn($q) =>
                $q->whereHas('siswa', fn($q) => $q->where('kelas', $data['kelas']))
            )
            ->when(
                $data['siswa_id'] ?? null,
                fn($q) =>
                $q->where('siswa_id', $data['siswa_id'])
            )
            ->when(
                $data['dari'] ?? null,
                fn($q) =>
                $q->whereDate('scan_at', '>=', $data['dari'])
            )
            ->when(
                $data['sampai'] ?? null,
                fn($q) =>
                $q->whereDate('scan_at', '<=', $data['sampai'])
            )
            ->latest('scan_at')
            ->get();

        $pdf = Pdf::loadView('exports.pelanggaran-pdf', [
            'pelanggaran' => $query,
            'kelas' => $data['kelas'] ?? null,
            'dari' => $data['dari'] ?? null,
            'sampai' => $data['sampai'] ?? null,
        ])
            ->setPaper('a4', 'landscape')
            ->setOption(['margin-top' => 30, 'margin-right' => 30, 'margin-bottom' => 40, 'margin-left' => 40]);

        return response()->streamDownload(
            fn() => print ($pdf->output()),
            'laporan-pelanggaran-' . now()->format('Ymd') . '.pdf'
        );
    }
}