<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR — {{ $barcode->jenisPelanggaran->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }
        }

        /* Paksa SVG QR code ikut lebar container */
        svg {
            width: 100% !important;
            height: auto !important;
            display: block;
        }
    </style>
</head>

<body class="min-h-screen bg-[#1E3A5F] flex items-center justify-center p-6">

    <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-xs w-full text-center">

        {{-- Header --}}
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-1">MAN 2 Bantul</p>
        <h1 class="text-xl font-bold text-slate-800 mb-0.5">
            {{ $barcode->jenisPelanggaran->nama }}
        </h1>
        <p class="text-sm text-slate-500 mb-5">
            {{ $barcode->tanggal->translatedFormat('l, d F Y') }}
        </p>

        @if($barcode->isExpired())
            <div class="bg-red-50 border-2 border-red-200 rounded-2xl p-5 mb-5">
                <svg class="w-10 h-10 text-red-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-red-600 font-semibold text-sm">Barcode Sudah Expired</p>
            </div>
        @else
            {{-- QR Code --}}
            <div class="bg-white border-4 border-slate-100 rounded-2xl p-3 mb-4 w-full">
                {!! $qrCode !!}
            </div>

            {{-- Expired info --}}
            <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-2 mb-5">
                <p class="text-xs text-amber-700">
                    Berlaku hingga pukul
                    <span class="font-bold">{{ $barcode->expired_at->format('H:i') }} WIB</span>
                </p>
            </div>
        @endif

        {{-- Tombol --}}
        <div class="flex gap-2 no-print">
            <button onclick="window.print()"
                class="flex-1 bg-[#1E3A5F] text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#152d4a] transition">
                🖨️ Print
            </button>
            <a href="{{ url()->previous() }}"
                class="flex-1 bg-slate-100 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-200 transition text-center">
                ← Kembali
            </a>
        </div>

    </div>

</body>

</html>