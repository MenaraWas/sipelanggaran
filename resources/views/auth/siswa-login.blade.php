@php
    $setting = \App\Models\Setting::first();
    $appName = $setting->app_name ?? 'Portal Siswa';
    $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
    $logoUrl = $setting && $setting->instansi_logo ? asset('storage/' . $setting->instansi_logo) : null;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="theme-color" content="#1E3A5F">
    <title>{{ $appName }} - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { -webkit-tap-highlight-color: transparent; }
        input, button { font-size: 16px !important; }
    </style>
</head>
<body class="min-h-screen bg-slate-100 flex flex-col justify-center px-4 py-8">

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center mb-6">
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="Logo" class="w-20 h-20 object-contain mx-auto mb-4 drop-shadow-sm">
            @else
                <div class="w-16 h-16 bg-[#1E3A5F] rounded-2xl mx-auto flex items-center justify-center shadow-lg mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
            @endif
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-800">
                {{ $appName }}
            </h2>
            <p class="text-sm text-slate-500 mt-1">Gunakan akun {{ $instansiName }} Anda untuk melanjutkan</p>
        </div>

        <div class="bg-white py-8 px-6 shadow rounded-2xl sm:px-10 border border-slate-200">
            <form action="{{ route('siswa.login.post') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email Utama</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                            class="block w-full appearance-none rounded-xl border border-slate-300 px-4 py-3 placeholder-slate-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 transition 
                            {{ $errors->has('email') ? 'border-red-500 bg-red-50' : '' }}">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Kata Sandi</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full appearance-none rounded-xl border border-slate-300 px-4 py-3 placeholder-slate-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 transition">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-2 mb-4">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 rounded border-slate-300 text-[#1E3A5F] focus:ring-[#1E3A5F]">
                        <label for="remember" class="ml-2 block text-sm text-slate-700">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-xl bg-[#1E3A5F] px-4 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-[#152d4a] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#1E3A5F] transition">
                        Masuk ke Portal
                    </button>
                </div>
            </form>
        </div>
        
        <p class="text-center text-xs text-slate-400 mt-6">
            Sistem Pelanggaran Siswa &copy; MAN 2 Bantul
        </p>
    </div>

</body>
</html>
