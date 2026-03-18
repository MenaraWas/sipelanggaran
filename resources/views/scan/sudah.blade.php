<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="theme-color" content="#1E3A5F">
    <title>Sudah Tercatat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>* { -webkit-tap-highlight-color: transparent; }</style>
</head>
<body class="min-h-screen bg-slate-100 flex flex-col items-center justify-center p-4">

    <div class="w-full max-w-sm text-center space-y-4">
        <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto">
            <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
        </div>
        <div>
            <h1 class="text-xl font-bold text-slate-800">Sudah Tercatat</h1>
            <p class="text-sm text-slate-500 mt-1">
                <span class="font-semibold text-slate-700">{{ $siswa->nama }}</span>,
                kamu sudah scan barcode ini hari ini.
            </p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-4 text-left">
            <div class="flex justify-between text-sm">
                <span class="text-slate-500">Pelanggaran</span>
                <span class="font-semibold text-slate-700">{{ $barcode->jenisPelanggaran->nama }}</span>
            </div>
            <div class="flex justify-between text-sm mt-2">
                <span class="text-slate-500">Tanggal</span>
                <span class="font-semibold text-slate-700">{{ $barcode->tanggal->format('d F Y') }}</span>
            </div>
        </div>
        <p class="text-xs text-slate-400">Hubungi kesiswaan jika ada kesalahan data.</p>
    </div>

</body>
</html>