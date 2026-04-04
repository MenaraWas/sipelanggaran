<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="theme-color" content="#1E3A5F">
    <title>Pelanggaran Tercatat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            -webkit-tap-highlight-color: transparent;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-100 flex flex-col">

    @php
        $setting = \App\Models\Setting::first();
        $appName = $setting->app_name ?? 'Sistem Pelanggaran Siswa';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
    @endphp
    {{-- Top bar --}}
    <div class="bg-[#1E3A5F] text-white px-4 py-3 flex items-center gap-3">
        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <p class="text-xs text-white/60 leading-none">{{ $instansiName }}</p>
            <p class="text-sm font-semibold leading-tight">Pelanggaran Tercatat</p>
        </div>
    </div>

    <div class="flex-1 px-4 py-6 flex flex-col gap-4">

        @if(isset($status) && $status === 'error')
            {{-- Status Error --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h1 class="text-lg font-bold text-slate-800">Gagal Memproses</h1>
                <p class="text-sm text-slate-500 mt-2">{{ $message ?? 'Terjadi kesalahan sistem.' }}</p>
                <a href="/" class="mt-6 inline-block bg-slate-100 text-slate-700 hover:bg-slate-200 px-6 py-2 rounded-xl font-semibold transition-colors">Kembali ke Beranda</a>
            </div>
        @else
            {{-- Status berhasil --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 text-center">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-lg font-bold text-slate-800">Pelanggaran Tercatat</h1>
                <p class="text-xs text-slate-400 mt-1">{{ now()->format('d F Y, H:i') }} WIB</p>
            </div>

            {{-- Detail siswa --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-4 py-3 bg-slate-50 border-b border-slate-100">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Detail Pelanggaran</p>
                </div>
                <div class="divide-y divide-slate-100">
                    <div class="flex justify-between items-center px-4 py-3">
                        <span class="text-sm text-slate-500">Nama</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $siswa->nama }}</span>
                    </div>
                    <div class="flex justify-between items-center px-4 py-3">
                        <span class="text-sm text-slate-500">Kelas</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $siswa->kelas }}</span>
                    </div>
                    <div class="flex justify-between items-center px-4 py-3">
                        <span class="text-sm text-slate-500">Pelanggaran</span>
                        <span class="text-sm font-semibold text-slate-800">
                            {{ $barcode->jenisPelanggaran->nama }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center px-4 py-3 bg-red-50">
                        <span class="text-sm font-bold text-red-600 uppercase tracking-wider">Skor Poin</span>
                        <span class="text-lg font-bold text-red-700">
                            +{{ $pelanggaran->nilai }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Hukuman --}}
            @if($aturan ?? null)
                <div class="bg-red-50 border-2 border-red-200 rounded-2xl p-4">
                    <p class="text-xs font-bold text-red-400 uppercase tracking-widest mb-1">Hukuman</p>
                    <p class="text-base font-bold text-red-700">{{ $aturan->hukuman }}</p>
                </div>
            @else
                <div class="bg-amber-50 border-2 border-amber-200 rounded-2xl p-4">
                    <p class="text-xs font-bold text-amber-400 uppercase tracking-widest mb-1">Hukuman</p>
                    <p class="text-sm text-amber-700">Akan ditentukan oleh pihak kesiswaan.</p>
                </div>
            @endif

            {{-- Instruksi --}}
            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4 flex gap-3">
                <svg class="w-5 h-5 text-blue-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-xs text-blue-700 leading-relaxed">
                    Silakan temui <strong>guru piket</strong> atau <strong>pihak kesiswaan</strong>
                    untuk menyelesaikan hukuman yang diberikan.
                </p>
            </div>
        @endif

    </div>

</body>

</html>