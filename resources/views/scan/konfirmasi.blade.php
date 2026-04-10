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
        .alasan-card input[type="radio"]:checked + label {
            border-color: #2563eb;
            background-color: #eff6ff;
            color: #1d4ed8;
        }
        .alasan-card input[type="radio"]:checked + label .radio-dot {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        .alasan-card input[type="radio"]:checked + label .radio-dot::after {
            content: '';
            display: block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
            margin: auto;
            margin-top: 3px;
        }
    </style>
</head>
<body class="min-h-screen bg-slate-100 flex flex-col">
    @php
        $setting = \App\Models\Setting::first();
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $daftarAlasan = $barcode->jenisPelanggaran->alasanPelanggaran ?? collect();
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

    <div class="flex-1 px-4 py-6 flex flex-col gap-4">

        {{-- Info Pelanggaran --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 text-center">
            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                </svg>
            </div>
            <h1 class="text-lg font-bold text-slate-800 mb-1">Pencatatan Baru</h1>
            <p class="text-sm text-slate-500">
                Sistem akan merekam pelanggaran <strong>{{ $barcode->jenisPelanggaran->nama }}</strong>
                atas nama <strong class="text-slate-700">{{ $siswa->nama }}</strong>.
            </p>
        </div>

        {{-- Form Alasan --}}
        <form id="form-konfirmasi" action="{{ route('scan.proses', $barcode->token) }}" method="POST">
            @csrf

            @if($daftarAlasan->isNotEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
                <h2 class="text-sm font-bold text-slate-700 mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Apa alasanmu? <span class="text-slate-400 font-normal">(opsional)</span>
                </h2>

                <div class="flex flex-col gap-2">
                    {{-- Pilihan alasan dari admin --}}
                    @foreach($daftarAlasan as $alasan)
                    <div class="alasan-card">
                        <input type="radio" name="alasan_id" id="alasan_{{ $alasan->id }}" value="{{ $alasan->id }}" class="hidden" onchange="toggleLainnya(this)">
                        <label for="alasan_{{ $alasan->id }}" class="flex items-center gap-3 border-2 border-slate-200 rounded-xl px-4 py-3 cursor-pointer transition-all text-sm font-medium text-slate-700">
                            <span class="radio-dot w-5 h-5 rounded-full border-2 border-slate-300 flex-shrink-0 transition-all"></span>
                            {{ $alasan->teks }}
                        </label>
                    </div>
                    @endforeach

                    {{-- Opsi Lainnya --}}
                    <div class="alasan-card">
                        <input type="radio" name="alasan_id" id="alasan_lainnya" value="lainnya" class="hidden" onchange="toggleLainnya(this)">
                        <label for="alasan_lainnya" class="flex items-center gap-3 border-2 border-slate-200 rounded-xl px-4 py-3 cursor-pointer transition-all text-sm font-medium text-slate-700">
                            <span class="radio-dot w-5 h-5 rounded-full border-2 border-slate-300 flex-shrink-0 transition-all"></span>
                            Lainnya...
                        </label>
                    </div>
                </div>

                {{-- Input custom alasan (muncul jika pilih "Lainnya") --}}
                <div id="custom-alasan-wrapper" class="hidden mt-3">
                    <textarea
                        id="alasan_custom"
                        name="alasan_custom"
                        rows="2"
                        placeholder="Tuliskan alasanmu di sini..."
                        class="w-full border-2 border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 focus:outline-none focus:border-blue-400 transition-colors resize-none"
                    ></textarea>
                </div>
            </div>
            @endif

            {{-- Tombol aksi --}}
            <div class="flex flex-col gap-3 mt-1">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-bold py-3 px-4 rounded-xl transition-all shadow-sm">
                    Ya, Saya Melanggar
                </button>
                <a href="#" onclick="window.history.back(); return false;" class="block w-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold py-3 px-4 rounded-xl transition-colors text-center">
                    Batalkan
                </a>
            </div>
        </form>
    </div>

    <script>
        function toggleLainnya(radio) {
            const wrapper = document.getElementById('custom-alasan-wrapper');
            const textarea = document.getElementById('alasan_custom');
            if (radio.value === 'lainnya') {
                wrapper.classList.remove('hidden');
                textarea.focus();
            } else {
                wrapper.classList.add('hidden');
                textarea.value = '';
            }
        }
    </script>
</body>
</html>
