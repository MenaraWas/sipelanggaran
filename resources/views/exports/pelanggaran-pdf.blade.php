<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 1cm 1.5cm; } /* Atas/bawah 1cm, Kanan/kiri 1.5cm */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #1f2937;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #1E3A5F;
        }

        .header h1 {
            font-size: 16px;
            color: #1E3A5F;
            font-weight: bold;
        }

        .header p {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
        }

        .meta {
            width: 100%;
            margin-bottom: 16px;
        }

        .meta td {
            font-size: 10px;
            color: #6b7280;
        }

        .meta td span {
            font-weight: bold;
            color: #1f2937;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            border: 1px solid #e5e7eb;
        }

        .data-table thead tr {
            background-color: #1E3A5F;
            color: white;
        }

        .data-table thead th {
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .data-table tbody td {
            padding: 6px 8px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 10px;
            vertical-align: middle;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-pending {
            background: #FEF3C7;
            color: #92400E;
        }

        .badge-selesai {
            background: #DCFCE7;
            color: #166534;
        }

        .badge-dikecualikan {
            background: #F3F4F6;
            color: #374151;
        }

        .footer {
            margin-top: 20px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
            width: 100%;
        }

        .footer td {
            font-size: 10px;
            color: #9ca3af;
        }

        .summary {
            width: 100%;
            margin-bottom: 16px;
        }

        .summary-box {
            flex: 1;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 8px 12px;
        }

        .summary-box .num {
            font-size: 20px;
            font-weight: bold;
            color: #1E3A5F;
        }

        .summary-box .label {
            font-size: 9px;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN PELANGGARAN SISWA</h1>
        <p>MAN 2 Bantul — {{ now()->format('d F Y') }}</p>
    </div>

    <table class="meta">
        <tr>
            <td style="text-align: left;">
                Kelas: <span>{{ $kelas ?? 'Semua Kelas' }}</span>
            </td>
            <td style="text-align: center;">
                Periode: <span>{{ $dari ?? '-' }} s/d {{ $sampai ?? '-' }}</span>
            </td>
            <td style="text-align: right;">
                Dicetak: <span>{{ now()->format('d M Y, H:i') }}</span>
            </td>
        </tr>
    </table>

    <table class="summary">
        <tr>
            <td style="width: 25%; padding-right: 6px;">
                <div class="summary-box">
                    <div class="num">{{ $pelanggaran->count() }}</div>
                    <div class="label">Total Pelanggaran</div>
                </div>
            </td>
            <td style="width: 25%; padding: 0 6px;">
                <div class="summary-box">
                    <div class="num">{{ $pelanggaran->unique('siswa_id')->count() }}</div>
                    <div class="label">Siswa Terlibat</div>
                </div>
            </td>
            <td style="width: 25%; padding: 0 6px;">
                <div class="summary-box">
                    <div class="num">{{ $pelanggaran->where('status', 'pending')->count() }}</div>
                    <div class="label">Belum Diselesaikan</div>
                </div>
            </td>
            <td style="width: 25%; padding-left: 6px;">
                <div class="summary-box">
                    <div class="num">{{ $pelanggaran->where('status', 'selesai')->count() }}</div>
                    <div class="label">Sudah Diselesaikan</div>
                </div>
            </td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Pelanggaran</th>
                <th>Nilai</th>
                <th>Hukuman</th>
                <th>Status</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelanggaran as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->siswa->nis }}</td>
                    <td>{{ $p->siswa->nama }}</td>
                    <td>{{ $p->siswa->kelas }}</td>
                    <td>{{ $p->barcode->jenisPelanggaran->nama }}</td>
                    <td>{{ $p->nilai }} {{ $p->barcode->jenisPelanggaran->satuan }}</td>
                    <td>{{ $p->hukuman_aktif }}</td>
                    <td>
                        <span class="badge badge-{{ $p->status }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td>{{ $p->scan_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center; color:#9ca3af; padding: 20px;">
                        Tidak ada data pelanggaran
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="footer">
        <tr>
            <td style="text-align: left;">Sistem Pelanggaran Siswa — MAN 2 Bantul</td>
            <td style="text-align: right;">Total: {{ $pelanggaran->count() }} data</td>
        </tr>
    </table>
</body>

</html>