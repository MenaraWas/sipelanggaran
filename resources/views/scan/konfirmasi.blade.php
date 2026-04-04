<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="theme-color" content="#1E3A5F">
    <title>Konfirmasi Pelanggaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { -webkit-tap-highlight-color: transparent; }
    </style>
</head>
<body class="min-h-screen bg-slate-100 flex flex-col">
    @php
        $setting = \App\Models\Setting::first();
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
    @endphp
    
    <div class="bg-[#1E3A5F] text-white px-4 py-3 flex items-center gap-3">
        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <p class="text-xs text-white/60 leading-none">{{ $instansiName }}</p>
            <p class="text-sm font-semibold leading-tight">Konfirmasi Pencatatan</p>
        </div>
    </div>

    <div class="flex-1 px-4 py-8 flex flex-col gap-4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                </svg>
            </div>
            <h1 class="text-xl font-bold text-slate-800 mb-2">Pencatatan Baru</h1>
            <p class="text-sm text-slate-500 mb-6">Sistem akan merekam pelanggaran <strong>{{ $barcode->jenisPelanggaran->nama }}</strong> atas nama <strong class="text-slate-700">{{ $siswa->nama }}</strong>.</p>
            
            <form action="{{ route('scan.proses', $barcode->token) }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-sm mb-3">
                    Ya, Saya Melanggar
                </button>
                <a href="#" onclick="window.history.back(); return false;" class="block w-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold py-3 px-4 rounded-xl transition-colors">
                    Batalkan
                </a>
            </form>
        </div>
    </div>
</body>
</html>
