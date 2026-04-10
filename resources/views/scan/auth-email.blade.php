<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="theme-color" content="#1E3A5F">
    <title>Identifikasi Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>* { -webkit-tap-highlight-color: transparent; }</style>
</head>
<body class="min-h-screen bg-slate-100 flex flex-col">
    @php
        $setting = \App\Models\Setting::first();
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
    @endphp

    {{-- Header --}}
    <div class="bg-[#1E3A5F] text-white px-4 py-3 flex items-center gap-3">
        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs text-white/60 leading-none">{{ $instansiName }}</p>
            <p class="text-sm font-semibold leading-tight">Identifikasi Siswa</p>
        </div>
    </div>

    <div class="flex-1 px-4 py-8 flex flex-col gap-4">

        {{-- Card utama --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <h1 class="text-xl font-bold text-slate-800 text-center mb-1">Masukkan Email Kamu</h1>
            <p class="text-sm text-slate-500 text-center mb-6">Gunakan email sekolahmu untuk melanjutkan pencatatan.</p>

            <form action="{{ route('scan.auth.proses', $token) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@man2bantul.id"
                        autofocus
                        inputmode="email"
                        class="w-full border-2 {{ $errors->has('email') ? 'border-red-400' : 'border-slate-200' }} rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-blue-400 transition-colors"
                    >
                    @error('email')
                        <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-bold py-3 px-4 rounded-xl transition-all shadow-sm">
                    Lanjutkan →
                </button>
            </form>
        </div>

        {{-- Info --}}
        <div class="bg-blue-50 border border-blue-100 rounded-2xl px-4 py-3 flex gap-3">
            <svg class="w-4 h-4 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-xs text-blue-700 font-medium leading-relaxed">
                Email digunakan untuk mengidentifikasi dirimu sebagai siswa. Tidak diperlukan password.
            </p>
        </div>
    </div>
</body>
</html>
