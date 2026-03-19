<div>
    {{-- Custom Create Pelanggaran - Material Design 3 --}}
    <div class="cp-wrapper">

        {{-- TopAppBar --}}
        <header class="cp-topbar">
            <div class="flex items-center gap-3">
                <a href="/admin/pelanggaran-siswas"
                   class="hover:bg-slate-100 transition-colors p-2 rounded-lg active:scale-95 duration-200 text-slate-700">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h1 class="font-semibold text-lg tracking-tight text-slate-700">Buat Pelanggaran</h1>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-full bg-[#6a758a] flex items-center justify-center text-white font-bold text-xs shadow-sm">
                    {{ strtoupper(substr($user->name ?? 'AD', 0, 2)) }}
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="cp-main">

            {{-- Breadcrumb / Context --}}
            <div class="cp-header">
                <h2 class="cp-title">Buat Pelanggaran Siswa</h2>
                <p class="cp-subtitle">Lengkapi formulir di bawah untuk mencatat data pelanggaran baru.</p>
            </div>

            {{-- Form Container --}}
            <form wire:submit="create">
                <div class="cp-form-card">
                    {{ $this->form }}

                    {{-- Action Buttons --}}
                    <div class="cp-actions">
                        <button type="submit" class="cp-btn-primary">
                            <span class="material-symbols-outlined" style="font-size:20px">check</span>
                            <span>Simpan</span>
                        </button>

                        <button type="button"
                                wire:click="createAnother"
                                class="cp-btn-secondary">
                            Simpan & Buat Lagi
                        </button>

                        <a href="/admin/pelanggaran-siswas" class="cp-btn-cancel">
                            Batal
                        </a>
                    </div>
                </div>
            </form>

            {{-- Helping Hint Card --}}
            <div class="cp-hint-card">
                <div class="cp-hint-icon">
                    <span class="material-symbols-outlined">auto_awesome</span>
                </div>
                <div>
                    <h4 class="cp-hint-title">Sistem Otomatisasi</h4>
                    <p class="cp-hint-desc">Hukuman akan dikalkulasi secara otomatis berdasarkan akumulasi poin pelanggaran siswa kecuali jika kolom override diisi.</p>
                </div>
            </div>
        </main>
    </div>

    <style>
        /* ===== CREATE PELANGGARAN STYLES ===== */

        /* Hide Filament's default header & breadcrumb */
        .fi-page-header { display: none !important; }

        /* Hide Filament topbar on mobile */
        @media (max-width: 1023px) {
            .fi-topbar { display: none !important; }
        }

        .cp-wrapper {
            font-family: 'Inter', sans-serif;
            margin: -1.5rem;
        }

        /* Top Bar */
        .cp-topbar {
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

        /* Main Content */
        .cp-main {
            padding: 2rem 1.5rem 7rem;
            max-width: 720px;
            margin: 0 auto;
        }

        /* Header */
        .cp-header {
            margin-bottom: 2rem;
        }
        .cp-title {
            font-size: 1.875rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: #191c1e;
            margin: 0 0 0.5rem;
            line-height: 1.15;
        }
        .cp-subtitle {
            font-size: 14px;
            font-weight: 500;
            color: #424754;
            margin: 0;
        }

        /* Form Card */
        .cp-form-card {
            background: #ffffff;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        /* ===== Override Filament Form Styles ===== */

        /* Form field wrappers */
        .cp-form-card .fi-fo-field-wrp {
            margin-bottom: 0.25rem;
        }

        /* Labels */
        .cp-form-card .fi-fo-field-wrp label,
        .cp-form-card .fi-fo-field-wrp .fi-fo-field-wrp-label label {
            font-size: 14px !important;
            font-weight: 600 !important;
            color: #191c1e !important;
            margin-bottom: 0.5rem !important;
            margin-left: 0.25rem !important;
        }

        /* Text inputs & Select fields */
        .cp-form-card input[type="text"],
        .cp-form-card input[type="number"],
        .cp-form-card input[type="email"],
        .cp-form-card textarea,
        .cp-form-card select,
        .cp-form-card .fi-input,
        .cp-form-card .fi-select-input,
        .cp-form-card .fi-input-wrp {
            background: #e6e8ea !important;
            border: 2px solid transparent !important;
            border-radius: 14px !important;
            font-family: 'Inter', sans-serif !important;
            font-size: 14px !important;
            color: #191c1e !important;
            transition: all 0.2s !important;
        }

        .cp-form-card .fi-input-wrp {
            overflow: hidden;
        }

        .cp-form-card input:focus,
        .cp-form-card textarea:focus,
        .cp-form-card select:focus,
        .cp-form-card .fi-input-wrp:focus-within {
            background: #ffffff !important;
            border-color: rgba(81, 92, 113, 0.3) !important;
            box-shadow: 0 0 0 4px rgba(81, 92, 113, 0.08) !important;
        }

        /* Select component wrapper */
        .cp-form-card .choices,
        .cp-form-card .fi-select-wrp {
            border-radius: 14px !important;
        }

        /* Textarea */
        .cp-form-card textarea {
            resize: none !important;
            min-height: 80px !important;
        }

        /* Helper text */
        .cp-form-card .fi-fo-field-wrp-helper-text,
        .cp-form-card .text-xs.text-gray-500 {
            font-size: 12px !important;
            color: #424754 !important;
            margin-top: 0.5rem !important;
            display: flex !important;
            align-items: center !important;
            gap: 0.25rem !important;
        }

        /* Grid layout for form fields like mockup */
        .cp-form-card .fi-fo-component-ctn {
            gap: 1.5rem !important;
        }

        /* ===== Action Buttons ===== */
        .cp-actions {
            padding-top: 1.75rem;
            margin-top: 0.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
        }
        @media (min-width: 640px) {
            .cp-actions {
                flex-direction: row-reverse;
            }
        }

        .cp-btn-primary {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0 2rem;
            height: 48px;
            background: linear-gradient(to bottom, #515c71, #6a758a);
            color: white;
            font-weight: 700;
            font-size: 14px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.15s;
            box-shadow: 0 2px 8px rgba(81, 92, 113, 0.3);
        }
        .cp-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(81, 92, 113, 0.4);
        }
        .cp-btn-primary:active {
            transform: scale(0.97);
        }
        @media (min-width: 640px) {
            .cp-btn-primary { width: auto; }
        }

        .cp-btn-secondary {
            width: 100%;
            padding: 0 1.5rem;
            height: 48px;
            background: transparent;
            color: #515c71;
            font-weight: 600;
            font-size: 14px;
            border-radius: 14px;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.15s;
        }
        .cp-btn-secondary:hover {
            background: #f2f4f6;
            border-color: rgba(194, 198, 214, 0.3);
        }
        @media (min-width: 640px) {
            .cp-btn-secondary { width: auto; }
        }

        .cp-btn-cancel {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 1.5rem;
            height: 48px;
            background: transparent;
            color: #727785;
            font-weight: 500;
            font-size: 14px;
            border-radius: 14px;
            text-decoration: none;
            transition: all 0.15s;
        }
        .cp-btn-cancel:hover {
            color: #b61722;
        }
        @media (min-width: 640px) {
            .cp-btn-cancel { width: auto; }
        }

        /* ===== Hint Card ===== */
        .cp-hint-card {
            margin-top: 2rem;
            background: #eceef0;
            padding: 1.5rem;
            border-radius: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }
        .cp-hint-icon {
            background: #d0e1fb;
            padding: 0.75rem;
            border-radius: 0.75rem;
            color: #54647a;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .cp-hint-title {
            font-size: 14px;
            font-weight: 700;
            color: #191c1e;
            margin: 0 0 0.25rem;
        }
        .cp-hint-desc {
            font-size: 12px;
            color: #424754;
            line-height: 1.6;
            margin: 0;
        }

        /* Desktop: hide mobile-only elements */
        @media (min-width: 1024px) {
            .cp-topbar { display: none; }
            .cp-wrapper { margin: -1.5rem -1.5rem 0 -1.5rem; }
        }

        /* Hide Filament's default form actions */
        .cp-form-card .fi-form-actions {
            display: none !important;
        }
    </style>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</div>
