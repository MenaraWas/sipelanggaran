<?php
namespace App\Exports;

use App\Models\PelanggaranSiswa;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PelanggaranExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithTitle,
    ShouldAutoSize
{
    public function __construct(
        protected ?string $kelas = null,
        protected ?string $dari = null,
        protected ?string $sampai = null,
        protected ?int $siswaId = null,
    ) {
    }

    public function query()
    {
        return PelanggaranSiswa::with(['siswa', 'barcode.jenisPelanggaran', 'aturan'])
            ->when(
                $this->kelas,
                fn($q) =>
                $q->whereHas('siswa', fn($q) => $q->where('kelas', $this->kelas))
            )
            ->when(
                $this->siswaId,
                fn($q) =>
                $q->where('siswa_id', $this->siswaId)
            )
            ->when(
                $this->dari,
                fn($q) =>
                $q->whereDate('scan_at', '>=', $this->dari)
            )
            ->when(
                $this->sampai,
                fn($q) =>
                $q->whereDate('scan_at', '<=', $this->sampai)
            )
            ->latest('scan_at');
    }

    public function headings(): array
    {
        return [
            'No',
            'NIS',
            'Nama Siswa',
            'Kelas',
            'Jurusan',
            'Jenis Pelanggaran',
            'Poin',
            'Hukuman',
            'Status',
            'Waktu Scan',
        ];
    }

    public function map($row): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $row->siswa->nis,
            $row->siswa->nama,
            $row->siswa->kelas,
            $row->siswa->jurusan,
            $row->barcode->jenisPelanggaran->nama,
            $row->nilai,
            $row->hukuman_aktif,
            ucfirst($row->status),
            $row->scan_at->format('d M Y, H:i'),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E3A5F']],
            ],
        ];
    }

    public function title(): string
    {
        return 'Rekap Pelanggaran';
    }
}