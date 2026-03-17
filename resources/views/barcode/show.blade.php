<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code — {{ $barcode->jenisPelanggaran->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-sm w-full text-center">

        <h1 class="text-2xl font-bold text-gray-800 mb-1">
            {{ $barcode->jenisPelanggaran->nama }}
        </h1>
        <p class="text-gray-500 text-sm mb-6">
            {{ $barcode->tanggal->format('d F Y') }} &bull;
            Expired pukul {{ $barcode->expired_at->format('H:i') }}
        </p>

        @if($barcode->isExpired())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                <p class="text-red-600 font-semibold">Barcode sudah expired</p>
            </div>
        @else
            <div class="flex justify-center mb-6">
                {!! $qrCode !!}
            </div>
            <p class="text-xs text-gray-400 mb-6 break-all">{{ $scanUrl }}</p>
        @endif

        <div class="flex gap-3 justify-center">
            <button onclick="window.print()"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
                🖨️ Print
            </button>
            <a href="{{ url()->previous() }}"
                class="bg-gray-100 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium hover:bg-gray-200">
                ← Kembali
            </a>
        </div>
    </div>
</body>
</html>