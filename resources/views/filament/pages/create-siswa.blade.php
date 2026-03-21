<div>
    {{-- Custom Create Siswa - Material Design 3 --}}
    <div class="cs-wrapper">

        {{-- TopAppBar --}}
        <header class="cs-topbar">
            <div class="flex items-center gap-3">
                <a href="/admin/siswas"
                   class="hover:bg-slate-100 transition-colors p-2 rounded-lg active:scale-95 duration-200 text-slate-700">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h1 class="font-semibold text-lg tracking-tight text-slate-700">Tambah Siswa</h1>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-full bg-[#6a758a] flex items-center justify-center text-white font-bold text-xs shadow-sm">
                    {{ strtoupper(substr($user->name ?? 'AD', 0, 2)) }}
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="cs-main">

            {{-- Header --}}
            <div class="cs-header">
                <h2 class="cs-title">Registrasi Siswa Baru</h2>
                <p class="cs-subtitle">Masukkan data lengkap siswa untuk mendaftarkannya ke dalam sistem.</p>
            </div>

            {{-- Form Container --}}
            <form wire:submit="create">
                <div class="cs-form-card">
                    {{ $this->form }}

                    {{-- Action Buttons --}}
                    <div class="cs-actions">
                        <button type="submit" class="cs-btn-primary">
                            <span class="material-symbols-outlined" style="font-size:20px">check</span>
                            <span>Simpan Siswa</span>
                        </button>

                        <button type="button"
                                wire:click="createAnother"
                                class="cs-btn-secondary">
                            Simpan & Buat Lagi
                        </button>

                        <a href="/admin/siswas" class="cs-btn-cancel">
                            Batal
                        </a>
                    </div>
                </div>
            </form>

            {{-- Feature Hint --}}
            <div class="cs-hint-card">
                <div class="cs-hint-icon">
                    <span class="material-symbols-outlined">shield_person</span>
                </div>
                <div>
                    <h4 class="cs-hint-title">Data Terenkripsi</h4>
                    <p class="cs-hint-desc">Kata sandi yang Anda masukkan akan dienkripsi secara aman. Pastikan NIS yang dimasukkan unik dan sesuai dengan database sekolah.</p>
                </div>
            </div>
        </main>
    </div>

    <style>
        /* ===== CREATE SISWA STYLES (MD3) ===== */

        .fi-page-header { display: none !important; }

        @media (max-width: 1023px) {
            .fi-topbar { display: none !important; }
        }

        .cs-wrapper {
            font-family: 'Inter', sans-serif;
            margin: -1.5rem;
            background: #f7f9fb;
            min-height: 100vh;
        }

        .cs-topbar {
            position: sticky;
            top: 0;
            z-index: 45;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
        }

        .cs-main {
            padding: 2rem 1.5rem 7rem;
            max-width: 720px;
            margin: 0 auto;
        }

        .cs-header { margin-bottom: 2rem; }
        .cs-title {
            font-size: 1.875rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: #191c1e;
            margin: 0 0 0.5rem;
        }
        .cs-subtitle {
            font-size: 14px;
            font-weight: 500;
            color: #424754;
        }

        .cs-form-card {
            background: #ffffff;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        /* ===== Filament Form Overrides ===== */
        .cs-form-card .fi-fo-field-wrp label {
            font-size: 13px !important;
            font-weight: 600 !important;
            color: #424754 !important;
            margin-bottom: 0.5rem !important;
        }

        .cs-form-card input, .cs-form-card select, .cs-form-card .fi-input-wrp {
            background: #e6e8ea !important;
            border: 2px solid transparent !important;
            border-radius: 14px !important;
            font-size: 14px !important;
            transition: all 0.2s !important;
        }

        .cs-form-card input:focus, .cs-form-card .fi-input-wrp:focus-within {
            background: #ffffff !important;
            border-color: rgba(81, 92, 113, 0.3) !important;
            box-shadow: 0 0 0 4px rgba(81, 92, 113, 0.08) !important;
        }

        .cs-actions {
            padding-top: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        @media (min-width: 640px) {
            .cs-actions { flex-direction: row-reverse; align-items: center; }
        }

        .cs-btn-primary {
            width: 100%;
            height: 52px;
            background: linear-gradient(to bottom, #515c71, #6a758a);
            color: white;
            font-weight: 700;
            border-radius: 16px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 4px 12px rgba(81, 92, 113, 0.3);
            cursor: pointer;
            transition: all 0.2s;
        }
        .cs-btn-primary:active { transform: scale(0.97); }

        .cs-btn-secondary {
            background: transparent;
            color: #515c71;
            font-weight: 600;
            padding: 0 1.5rem;
            height: 52px;
            border-radius: 16px;
            border: 2px solid #e0e3e5;
            cursor: pointer;
            width: 100%;
        }

        .cs-btn-cancel {
            text-align: center;
            color: #727785;
            font-weight: 500;
            padding: 0 1.5rem;
            text-decoration: none;
            width: 100%;
        }

        @media (min-width: 640px) {
            .cs-btn-primary, .cs-btn-secondary, .cs-btn-cancel { width: auto; }
        }

        .cs-hint-card {
            margin-top: 2.5rem;
            background: #eceef0;
            padding: 1.5rem;
            border-radius: 1.25rem;
            display: flex;
            gap: 1rem;
            align-items: flex-start;
        }
        .cs-hint-icon {
            background: #d8e3fb;
            color: #3c475a;
            padding: 0.75rem;
            border-radius: 12px;
            display: flex;
        }
        .cs-hint-title { font-size: 14px; font-weight: 800; color: #191c1e; margin: 0 0 4px; }
        .cs-hint-desc { font-size: 12px; color: #424754; line-height: 1.6; margin: 0; }

        @media (min-width: 1024px) {
            .cs-topbar { display: none; }
            .cs-wrapper { margin: -1.5rem -1.5rem 0 -1.5rem; }
        }

        .cs-form-card .fi-form-actions { display: none !important; }
    </style>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</div>
