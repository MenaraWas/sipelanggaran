<div>
    {{-- Custom Login Page - Material Design 3 Style --}}

    @php
        $setting = \App\Models\Setting::first();
        $appName = $setting->app_name ?? 'Sistem Pelanggaran Siswa';
        $instansiName = $setting->instansi_name ?? '';
        $logoUrl = $setting && $setting->instansi_logo ? asset('storage/' . $setting->instansi_logo) : null;
    @endphp

    <style>
        /* Override Filament's login layout completely */
        .fi-simple-layout {
            background: #f7f9fb !important;
        }

        .fi-simple-main-ctn {
            max-width: 100% !important;
            width: 100% !important;
        }

        .fi-simple-main {
            padding: 0 !important;
            box-shadow: none !important;
            background: transparent !important;
            border: none !important;
        }

        .fi-simple-header {
            display: none !important;
        }

        .fi-logo {
            display: none !important;
        }

        .cl-wrapper {
            font-family: 'Inter', sans-serif;
            min-height: 90dvh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .cl-main {
            width: 100%;
            max-width: 420px;
        }

        .cl-icon-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            background: #f2f4f6;
            border-radius: 0.75rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .cl-card {
            background: white;
            border-radius: 0.75rem;
            padding: 2rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        @media (min-width: 768px) {
            .cl-card {
                padding: 2.5rem;
            }
        }

        .cl-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            color: #424754;
            margin-left: 4px;
            margin-bottom: 0.5rem;
        }

        .cl-input-wrap {
            position: relative;
        }

        .cl-input-wrap .cl-input-icon {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            padding-left: 1rem;
            display: flex;
            align-items: center;
            pointer-events: none;
            color: #727785;
            transition: color 0.15s;
        }

        .cl-input-wrap:focus-within .cl-input-icon {
            color: #515c71;
        }

        .cl-input {
            width: 100%;
            background: #e6e8ea;
            border: none;
            border-radius: 0.75rem;
            padding: 0.875rem 1rem 0.875rem 3rem;
            font-size: 14px;
            font-weight: 500;
            color: #191c1e;
            outline: none;
            transition: all 0.2s;
        }

        .cl-input::placeholder {
            color: rgba(114, 119, 133, 0.6);
        }

        .cl-input:focus {
            box-shadow: 0 0 0 2px rgba(81, 92, 113, 0.3);
            background: white;
        }

        .cl-btn {
            width: 100%;
            padding: 1rem;
            border-radius: 0.75rem;
            border: none;
            color: white;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.025em;
            background: linear-gradient(135deg, #515c71 0%, #6a758a 100%);
            box-shadow: 0 4px 14px rgba(81, 92, 113, 0.2);
            cursor: pointer;
            transition: all 0.2s;
        }

        .cl-btn:hover {
            box-shadow: 0 6px 20px rgba(81, 92, 113, 0.3);
            transform: translateY(-1px);
        }

        .cl-btn:active {
            transform: scale(0.98);
        }

        .cl-divider {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 0.5rem;
            opacity: 0.6;
        }

        .cl-divider-line {
            height: 1px;
            background: #c2c6d6;
            width: 3rem;
            opacity: 0.3;
        }

        .cl-divider-text {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #424754;
        }

        /* Hide Filament default form elements */
        .fi-fo-field-wrp>.fi-fo-field-wrp-label {
            display: none !important;
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <div class="cl-wrapper">
        <div class="cl-main space-y-10">

            {{-- Header --}}
            <header class="text-center space-y-5">
                <div class="cl-icon-box mx-auto">
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" alt="Logo" class="w-10 h-10 object-contain rounded">
                    @else
                        <span class="material-symbols-outlined text-[#515c71]" style="font-size:32px">shield</span>
                    @endif
                </div>
                <div class="space-y-2">
                    <h1 class="text-3xl font-extrabold tracking-tight text-[#191c1e]"
                        style="font-family:'Inter',sans-serif">Selamat Datang</h1>
                    <p class="text-sm font-medium text-[#424754]">Silakan masuk ke panel administrasi</p>
                    @if($instansiName)
                        <p class="text-xs font-semibold text-[#727785] uppercase tracking-wider">{{ $instansiName }}</p>
                    @endif
                </div>
            </header>

            {{-- Login Form --}}
            <div class="cl-card">
                <form wire:submit="authenticate" class="space-y-6">
                    {{ $this->form }}

                    {{-- Custom styled submit button --}}
                    <button type="submit" class="cl-btn">
                        Masuk Sekarang
                    </button>
                </form>
            </div>

            {{-- Footer divider --}}
            <div class="cl-divider">
                <div class="cl-divider-line"></div>
                <span class="cl-divider-text">{{ $appName }}</span>
                <div class="cl-divider-line"></div>
            </div>
        </div>

        {{-- Copyright --}}
        <footer class="mt-auto pt-8">
            <p class="text-[11px] font-medium tracking-wider" style="color: rgba(66,71,84,0.4)">
                © {{ date('Y') }} {{ $instansiName ?: $appName }}
            </p>
        </footer>
    </div>
</div>