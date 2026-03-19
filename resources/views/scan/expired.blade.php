<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="theme-color" content="#1E3A5F">
    <title>Barcode Expired</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            -webkit-tap-highlight-color: transparent;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-100 flex flex-col items-center justify-center p-4">

    <div class="w-full max-w-sm text-center space-y-4">
        <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto">
            <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h1 class="text-xl font-bold text-slate-800">
                {{ isset($customMessage) ? 'Belum Waktunya' : 'Barcode Expired' }}</h1>
            <p class="text-sm text-slate-500 mt-1">
                {{ $customMessage ?? 'Barcode ini sudah tidak berlaku. Hubungi pihak kesiswaan.' }}
            </p>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-2xl p-4">
            <p class="text-xs text-red-600">
                {{ isset($customMessage) ? 'Pelanggaran otomatis hanya dapat dicatat jika waktu scan sudah melampaui batas.' : 'Barcode hanya berlaku pada hari yang ditentukan dan sebelum jam expired.' }}
            </p>
        </div>
    </div>

</body>

</html>