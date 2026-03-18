<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="theme-color" content="#1E3A5F">
    <title>Catat Pelanggaran — {{ $barcode->jenisPelanggaran->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { -webkit-tap-highlight-color: transparent; }
        input, button { font-size: 16px !important; } /* Cegah auto-zoom iOS */
    </style>
</head>
<body class="min-h-screen bg-slate-100 flex flex-col">

    {{-- Top bar --}}
    <div class="bg-[#1E3A5F] text-white px-4 py-3 flex items-center gap-3">
        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs text-white/60 leading-none">MAN 2 Bantul</p>
            <p class="text-sm font-semibold leading-tight">Sistem Pelanggaran Siswa</p>
        </div>
    </div>

    {{-- Card utama --}}
    <div class="flex-1 px-4 py-6 flex flex-col gap-4">

        {{-- Info pelanggaran --}}
        <div class="bg-red-50 border border-red-200 rounded-2xl p-4 flex items-center gap-3">
            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-red-800 text-base leading-tight">
                    {{ $barcode->jenisPelanggaran->nama }}
                </p>
                <p class="text-xs text-red-500 mt-0.5">
                    {{ $barcode->tanggal->format('d F Y') }} &bull;
                    Expired {{ $barcode->expired_at->format('H:i') }} WIB
                </p>
            </div>
        </div>

        {{-- Form --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
            <p class="text-sm font-semibold text-slate-700 mb-4">Isi data kamu</p>

            <form action="{{ route('scan.proses', $barcode->token) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">
                        Nomor Induk Siswa (NIS)
                    </label>
                    <input
                        type="text"
                        name="nis"
                        required
                        inputmode="numeric"
                        placeholder="Masukkan NIS kamu"
                        autocomplete="off"
                        value="{{ old('nis') }}"
                        class="w-full border-2 rounded-xl px-4 py-3.5 text-slate-800 placeholder-slate-300 focus:outline-none focus:border-blue-500 transition
                            {{ $errors->has('nis') ? 'border-red-400 bg-red-50' : 'border-slate-200' }}"
                    >
                    @error('nis')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                @if($barcode->jenisPelanggaran->satuan === 'menit')
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">
                        Keterlambatan
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            name="nilai"
                            min="1"
                            inputmode="numeric"
                            placeholder="Contoh: 15"
                            value="{{ old('nilai') }}"
                            class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 pr-16 text-slate-800 placeholder-slate-300 focus:outline-none focus:border-blue-500 transition"
                        >
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm text-slate-400 font-medium">
                            menit
                        </span>
                    </div>
                </div>
                @endif

                <button
                    type="submit"
                    class="w-full bg-[#1E3A5F] active:bg-[#152d4a] text-white font-semibold py-4 rounded-xl transition text-sm tracking-wide mt-2">
                    Konfirmasi Pelanggaran
                </button>
            </form>
        </div>

        {{-- Info tambahan --}}
        <p class="text-center text-xs text-slate-400 px-4">
            Pastikan NIS yang kamu masukkan benar. Data pelanggaran akan tercatat secara permanen.
        </p>

    </div>

</body>
</html>