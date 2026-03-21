<div>
    {{-- Custom Edit Pelanggaran - Material Design 3 --}}
    <div class="ep-wrapper">

        {{-- TopAppBar --}}
        <x-md3-top-bar 
            :title="$appName" 
            :subtitle="$instansiName" 
            icon="gavel" 
            :user="$user"
            backUrl="/admin/pelanggaran-siswas"
        />

        {{-- Content --}}
        <main class="ep-main">

            {{-- Bento Layout --}}
            <div class="ep-grid">

                {{-- Left: Form --}}
                <div class="ep-left">
                    <form wire:submit="save">
                        <section class="ep-form-card">
                            <div class="ep-form-header">
                                <h2 class="ep-form-title">Detail Pelanggaran</h2>
                                <p class="ep-form-subtitle">Ubah data pelanggaran yang tercatat untuk siswa ini.</p>
                            </div>

                            {{ $this->form }}
                        </section>

                        {{-- Action Buttons --}}
                        <div class="ep-actions">
                            <div class="ep-actions-left">
                                <button type="button"
                                        wire:click="mountAction('delete')"
                                        class="ep-btn-delete">
                                    <span class="material-symbols-outlined" style="font-size:20px">delete</span>
                                    <span>Hapus</span>
                                </button>
                            </div>
                            <div class="ep-actions-right">
                                <a href="/admin/pelanggaran-siswas" class="ep-btn-cancel">Batal</a>
                                <button type="submit" class="ep-btn-primary">
                                    <span class="material-symbols-outlined" style="font-size:20px">check</span>
                                    <span>Simpan Perubahan</span>
                                </button>
                            </div>
                        </div>
                    </form>

                    <x-filament-actions::modals />
                </div>

                {{-- Right: Info Cards --}}
                <div class="ep-right">

                    {{-- Automation Info Card --}}
                    <aside class="ep-info-card">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[#54647a]">info</span>
                            <div>
                                <h3 class="ep-info-title">SISTEM OTOMATIS</h3>
                                <p class="ep-info-desc">
                                    Mengubah nilai poin akan otomatis menghitung ulang skor kumulatif siswa.
                                    Jika total melebihi batas, sistem akan memperbarui hukuman secara otomatis.
                                </p>
                            </div>
                        </div>
                    </aside>

                    {{-- Record Metadata --}}
                    <div class="ep-meta-card">
                        <h4 class="ep-meta-heading">Metadata Catatan</h4>
                        <div class="ep-meta-rows">
                            <div class="ep-meta-row">
                                <span class="ep-meta-label">Waktu Scan</span>
                                <span class="ep-meta-value">{{ $record->scan_at?->translatedFormat('d M Y, H:i') ?? '-' }}</span>
                            </div>
                            <div class="ep-meta-row">
                                <span class="ep-meta-label">Jenis Pelanggaran</span>
                                <span class="ep-meta-value">{{ $record->barcode?->jenisPelanggaran?->nama ?? '-' }}</span>
                            </div>
                            <div class="ep-meta-row">
                                <span class="ep-meta-label">Hukuman Aktif</span>
                                <span class="ep-meta-value">{{ $record->hukuman_aktif }}</span>
                            </div>
                            <div class="ep-meta-row">
                                <span class="ep-meta-label">Terakhir Diubah</span>
                                <span class="ep-meta-value">{{ $record->updated_at?->translatedFormat('d M Y, H:i') ?? '-' }}</span>
                            </div>
                        </div>

                        {{-- Student Info --}}
                        <div class="ep-meta-student">
                            <div class="ep-meta-avatar">
                                {{ strtoupper(substr($record->siswa->nama ?? '?', 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-xs text-[#424754]">Siswa Aktif</p>
                                <p class="text-sm font-bold text-[#191c1e]">{{ $record->siswa->nama ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Severity Guide --}}
                    <div class="ep-severity-card">
                        <h4 class="ep-meta-heading" style="margin-bottom: 1rem;">Panduan Severity</h4>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-full" style="background:#d0e1fb;"></span>
                                <span class="text-xs text-[#424754]">1–4 Poin: Ringan</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-full" style="background:#bcc7de;"></span>
                                <span class="text-xs text-[#424754]">5–9 Poin: Sedang</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-full" style="background:#ffb3ad;"></span>
                                <span class="text-xs text-[#424754]">10+ Poin: Berat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <style>
        /* ===== EDIT PELANGGARAN STYLES ===== */

        /* Hide Filament's default header & breadcrumb */
        .fi-page-header { display: none !important; }

        @media (max-width: 1023px) {
            .fi-topbar { display: none !important; }
        }

        .ep-wrapper {
            font-family: 'Inter', sans-serif;
            margin: -1.5rem;
        }

        /* Main Content */
        .ep-main {
            padding: 1rem 1.5rem 7rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Bento Grid */
        .ep-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            align-items: start;
        }
        @media (min-width: 1024px) {
            .ep-grid {
                grid-template-columns: 2fr 1fr;
            }
        }

        /* Form card */
        .ep-form-card {
            background: #ffffff;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .ep-form-header {
            margin-bottom: 1.5rem;
        }
        .ep-form-title {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #191c1e;
            margin: 0;
        }
        .ep-form-subtitle {
            font-size: 13px;
            color: #424754;
            margin: 0.25rem 0 0;
        }

        /* ===== Filament Form Overrides ===== */
        .ep-form-card .fi-fo-field-wrp {
            margin-bottom: 0.25rem;
        }
        .ep-form-card .fi-fo-field-wrp label,
        .ep-form-card .fi-fo-field-wrp .fi-fo-field-wrp-label label {
            font-size: 13px !important;
            font-weight: 500 !important;
            color: #424754 !important;
            margin-bottom: 0.5rem !important;
        }
        .ep-form-card input[type="text"],
        .ep-form-card input[type="number"],
        .ep-form-card input[type="email"],
        .ep-form-card textarea,
        .ep-form-card select,
        .ep-form-card .fi-input,
        .ep-form-card .fi-select-input,
        .ep-form-card .fi-input-wrp {
            background: #e6e8ea !important;
            border: 2px solid transparent !important;
            border-radius: 14px !important;
            font-family: 'Inter', sans-serif !important;
            font-size: 14px !important;
            color: #191c1e !important;
            transition: all 0.2s !important;
        }
        .ep-form-card .fi-input-wrp { overflow: hidden; }
        .ep-form-card input:focus,
        .ep-form-card textarea:focus,
        .ep-form-card select:focus,
        .ep-form-card .fi-input-wrp:focus-within {
            background: #ffffff !important;
            border-color: rgba(81, 92, 113, 0.3) !important;
            box-shadow: 0 0 0 4px rgba(81, 92, 113, 0.08) !important;
        }
        .ep-form-card textarea { resize: none !important; }
        .ep-form-card .fi-fo-component-ctn { gap: 1.5rem !important; }
        .ep-form-card .fi-form-actions { display: none !important; }

        /* ===== Actions ===== */
        .ep-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding-top: 1.5rem;
        }
        @media (min-width: 768px) {
            .ep-actions {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        .ep-actions-left { order: 2; }
        .ep-actions-right {
            display: flex;
            gap: 0.75rem;
            order: 1;
            width: 100%;
        }
        @media (min-width: 768px) {
            .ep-actions-left { order: 1; }
            .ep-actions-right { order: 2; width: auto; }
        }

        .ep-btn-delete {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: rgba(182, 23, 34, 0.06);
            color: #b61722;
            font-weight: 600;
            font-size: 14px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.15s;
        }
        .ep-btn-delete:hover {
            background: rgba(182, 23, 34, 0.12);
        }
        .ep-btn-delete:active {
            transform: scale(0.97);
        }

        .ep-btn-cancel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 1.5rem;
            height: 48px;
            color: #424754;
            font-weight: 500;
            font-size: 14px;
            border-radius: 14px;
            text-decoration: none;
            transition: all 0.15s;
        }
        .ep-btn-cancel:hover {
            background: #eceef0;
        }

        .ep-btn-primary {
            flex: 1;
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
            box-shadow: 0 2px 8px rgba(81, 92, 113, 0.3);
            transition: all 0.15s;
        }
        .ep-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(81, 92, 113, 0.4);
        }
        .ep-btn-primary:active { transform: scale(0.97); }
        @media (min-width: 768px) {
            .ep-btn-primary { flex: none; }
        }

        /* ===== Right Column Cards ===== */
        .ep-info-card {
            background: rgba(208, 225, 251, 0.2);
            padding: 1.5rem;
            border-radius: 1rem;
            border: 1px solid rgba(208, 225, 251, 0.5);
        }
        .ep-info-title {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.06em;
            color: #54647a;
            margin: 0 0 0.5rem;
        }
        .ep-info-desc {
            font-size: 12px;
            color: rgba(84, 100, 122, 0.8);
            line-height: 1.6;
            margin: 0;
        }

        .ep-meta-card {
            background: #f2f4f6;
            padding: 1.5rem;
            border-radius: 1rem;
        }
        .ep-meta-heading {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #191c1e;
            opacity: 0.5;
            margin: 0 0 1rem;
        }
        .ep-meta-rows {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .ep-meta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .ep-meta-label {
            font-size: 12px;
            font-weight: 500;
            color: #424754;
        }
        .ep-meta-value {
            font-size: 12px;
            font-weight: 600;
            color: #191c1e;
            text-align: right;
            max-width: 60%;
        }

        .ep-meta-student {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding-top: 1rem;
            margin-top: 1rem;
            border-top: 1px solid rgba(194, 198, 214, 0.2);
        }
        .ep-meta-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e0e3e5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #424754;
            flex-shrink: 0;
        }

        .ep-severity-card {
            background: #f2f4f6;
            padding: 1.5rem;
            border-radius: 1rem;
        }

        .ep-right {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        /* Desktop -  hide mobile-only */
        @media (min-width: 1024px) {
            .ep-topbar { display: none; }
            .ep-wrapper { margin: -1.5rem -1.5rem 0 -1.5rem; }
        }
    </style>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</div>
