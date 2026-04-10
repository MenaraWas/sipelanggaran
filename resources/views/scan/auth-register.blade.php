<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="theme-color" content="#1E3A5F">
    <title>Daftar Akun Siswa</title>
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs text-white/60 leading-none">{{ $instansiName }}</p>
            <p class="text-sm font-semibold leading-tight">Daftar Akun Baru</p>
        </div>
    </div>

    <div class="flex-1 px-4 py-6 flex flex-col gap-4">

        {{-- Badge email --}}
        <div class="bg-green-50 border border-green-200 rounded-2xl px-4 py-3 flex items-center gap-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-green-600 font-semibold">Email terdaftar</p>
                <p class="text-sm font-bold text-green-800">{{ $email }}</p>
            </div>
        </div>

        {{-- Form --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
            <h1 class="text-base font-bold text-slate-800 mb-1">Lengkapi Data Dirimu</h1>
            <p class="text-xs text-slate-400 mb-5">Email kamu belum terdaftar. Isi data berikut untuk membuat akun.</p>

            <form action="{{ route('scan.register.proses', $token) }}" method="POST" class="flex flex-col gap-4">
                @csrf

                {{-- Nama --}}
                <div>
                    <label for="nama" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Ahmad Fauzi"
                        autofocus
                        class="w-full border-2 {{ $errors->has('nama') ? 'border-red-400' : 'border-slate-200' }} rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-blue-400 transition-colors"
                    >
                    @error('nama')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kelas --}}
                <div>
                    <label for="kelas" class="block text-sm font-semibold text-slate-700 mb-1.5">Kelas</label>
                    <input
                        type="text"
                        id="kelas"
                        name="kelas"
                        value="{{ old('kelas') }}"
                        placeholder="Contoh: 10A, 11 IPS 2"
                        class="w-full border-2 {{ $errors->has('kelas') ? 'border-red-400' : 'border-slate-200' }} rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-blue-400 transition-colors"
                    >
                    @error('kelas')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jurusan --}}
                <div>
                    <label for="jurusan" class="block text-sm font-semibold text-slate-700 mb-1.5">Jurusan</label>
                    <input
                        type="text"
                        id="jurusan"
                        name="jurusan"
                        value="{{ old('jurusan') }}"
                        placeholder="Contoh: IPA, IPS, Bahasa"
                        class="w-full border-2 {{ $errors->has('jurusan') ? 'border-red-400' : 'border-slate-200' }} rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-blue-400 transition-colors"
                    >
                    @error('jurusan')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-bold py-3 px-4 rounded-xl transition-all shadow-sm mt-1">
                    Daftar & Lanjutkan →
                </button>

                <a href="{{ route('scan.auth', $token) }}" class="block text-center text-xs text-slate-400 hover:text-slate-600 transition-colors">
                    ← Kembali, ganti email
                </a>
            </form>
        </div>

        {{-- Info unverified --}}
        <div class="bg-amber-50 border border-amber-100 rounded-2xl px-4 py-3 flex gap-3">
            <svg class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <p class="text-xs text-amber-700 font-medium leading-relaxed">
                Akun baru akan ditandai <strong>belum diverifikasi</strong> hingga admin sekolah mengkonfirmasinya.
            </p>
        </div>
    </div>
</body>
</html>
