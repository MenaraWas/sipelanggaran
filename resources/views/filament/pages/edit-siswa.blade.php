<div>
    {{-- Custom Edit Siswa - Material Design 3 --}}
    <div class="es-wrapper">

        <x-md3-top-bar 
            :title="$appName" 
            :subtitle="$instansiName" 
            icon="edit" 
            :user="$user"
            backUrl="/admin/siswas"
        />

        {{-- Content --}}
        <main class="es-main">

            {{-- Bento Layout --}}
            <div class="es-grid">

                {{-- Left: Edit Form --}}
                <div class="es-left">
                    <form wire:submit="save">
                        <section class="es-form-card">
                            <div class="es-form-header">
                                <h2 class="es-form-title">Informasi Akademik</h2>
                                <p class="es-form-subtitle">Perbarui data diri, kelas, atau jurusan siswa ini.</p>
                            </div>

                            {{ $this->form }}
                        </section>

                        {{-- Action Buttons --}}
                        <div class="es-actions">
                            <div class="es-actions-left">
                                <button type="button"
                                        wire:click="mountAction('delete')"
                                        class="es-btn-delete">
                                    <span class="material-symbols-outlined" style="font-size:20px">delete</span>
                                    <span>Hapus Siswa</span>
                                </button>
                            </div>
                            <div class="es-actions-right">
                                <a href="/admin/siswas" class="es-btn-cancel">Batal</a>
                                <button type="submit" class="es-btn-primary">
                                    <span class="material-symbols-outlined" style="font-size:20px">check</span>
                                    <span>Simpan Perubahan</span>
                                </button>
                            </div>
                        </div>
                    </form>

                    <x-filament-actions::modals />
                </div>

                {{-- Right: Info Cards --}}
                <div class="es-right">

                    {{-- Violation Summary Card --}}
                    <aside class="es-meta-card">
                        <h4 class="es-meta-heading">Ringkasan Disiplin</h4>
                        <div class="es-stats-row">
                            <div class="es-stat">
                                <span class="es-stat-label">Total Pelanggaran</span>
                                <span class="es-stat-value @if($record->pelanggaran_count > 0) text-[#ba1a1a] @endif">
                                    {{ $record->pelanggaran_count }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="es-meta-rows mt-4 border-t border-slate-200 pt-4">
                            <div class="es-meta-row">
                                <span class="es-meta-label">Status</span>
                                <span class="es-meta-value text-[#166534] bg-[#dcfce7] px-2 py-0.5 rounded text-[10px] font-bold">AKTIF</span>
                            </div>
                            <div class="es-meta-row mt-2">
                                <span class="es-meta-label">Terdaftar Sejak</span>
                                <span class="es-meta-value">{{ $record->created_at?->format('d M Y') ?? '-' }}</span>
                            </div>
                            <div class="es-meta-row mt-2">
                                <span class="es-meta-label">Update Terakhir</span>
                                <span class="es-meta-value">{{ $record->updated_at?->diffForHumans() ?? '-' }}</span>
                            </div>
                        </div>
                    </aside>

                    {{-- Privacy Warning --}}
                    <div class="es-info-card">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[#54647a]">lock</span>
                            <div>
                                <h3 class="es-info-title">KEAMANAN DATA</h3>
                                <p class="es-info-desc">
                                    Hapus siswa akan menghapus seluruh riwayat pelanggaran terkait. Pastikan Anda sudah membackup data jika diperlukan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <style>
        /* ===== EDIT SISWA STYLES (MD3) ===== */

        .fi-page-header { display: none !important; }

        @media (max-width: 1023px) {
            .fi-topbar { display: none !important; }
        }

        .es-wrapper {
            font-family: 'Inter', sans-serif;
            margin: -1.5rem;
            background: #f7f9fb;
            min-height: 100vh;
        }

        .es-main {
            padding: 1rem 1.5rem 7rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .es-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        @media (min-width: 1024px) {
            .es-grid { grid-template-columns: 2fr 1fr; }
        }

        .es-form-card {
            background: #ffffff;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .es-form-header { margin-bottom: 1.5rem; }
        .es-form-title { font-size: 1.25rem; font-weight: 800; color: #191c1e; margin: 0; }
        .es-form-subtitle { font-size: 13px; color: #424754; margin: 0.25rem 0 0; }

        /* Form overrides */
        .es-form-card .fi-fo-field-wrp label { font-size: 13px !important; font-weight: 600 !important; color: #424754 !important; margin-bottom: 0.5rem !important; }
        .es-form-card input, .es-form-card select, .es-form-card .fi-input-wrp {
            background: #e6e8ea !important;
            border: 2px solid transparent !important;
            border-radius: 14px !important;
            font-size: 14px !important;
        }
        .es-form-card input:focus, .es-form-card .fi-input-wrp:focus-within {
            background: #ffffff !important;
            border-color: rgba(81, 92, 113, 0.3) !important;
            box-shadow: 0 0 0 4px rgba(81, 92, 113, 0.08) !important;
        }
        .es-form-card .fi-fo-component-ctn { gap: 1.5rem !important; }
        .es-form-card .fi-form-actions { display: none !important; }

        .es-actions { display: flex; flex-direction: column; gap: 1rem; padding-top: 2rem; }
        @media (min-width: 768px) {
            .es-actions { flex-direction: row; justify-content: space-between; align-items: center; }
        }

        .es-actions-left { order: 2; }
        .es-actions-right { order: 1; display: flex; gap: 0.75rem; width: 100%; }
        @media (min-width: 768px) {
            .es-actions-left { order: 1; }
            .es-actions-right { order: 2; width: auto; }
        }

        .es-btn-delete {
            display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem;
            background: #ffdad6; color: #ba1a1a; font-weight: 700; border-radius: 14px; border: none; cursor: pointer;
        }
        .es-btn-cancel { height: 48px; padding: 0 1.5rem; display: flex; align-items: center; color: #424754; font-weight: 600; text-decoration: none; border-radius: 14px; }
        .es-btn-primary {
            flex: 1; height: 48px; background: linear-gradient(to bottom, #515c71, #6a758a);
            color: white; font-weight: 700; border-radius: 14px; border: none;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            box-shadow: 0 2px 8px rgba(81, 92, 113, 0.3);
        }
        @media (min-width: 768px) { .es-btn-primary { flex: none; width: 220px; } }

        /* Meta Cards */
        .es-meta-card { background: #ffffff; padding: 1.5rem; border-radius: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
        .es-meta-heading { font-size: 11px; font-weight: 800; text-transform: uppercase; color: #727785; margin: 0 0 1.25rem; }
        .es-stat-label { display: block; font-size: 12px; color: #424754; margin-bottom: 2px; }
        .es-stat-value { font-size: 2rem; font-weight: 900; color: #191c1e; line-height: 1; }
        .es-meta-row { display: flex; justify-content: space-between; align-items: center; }
        .es-meta-label { font-size: 12px; font-weight: 500; color: #727785; }
        .es-meta-value { font-size: 13px; font-weight: 700; color: #191c1e; }

        .es-info-card { background: #d3e4fe; padding: 1.5rem; border-radius: 1.5rem; }
        .es-info-title { font-size: 12px; font-weight: 800; color: #38485d; margin: 0 0 4px; }
        .es-info-desc { font-size: 12px; color: #505f76; line-height: 1.5; margin: 0; }

        .es-right { display: flex; flex-direction: column; gap: 1.25rem; }

        @media (min-width: 1024px) {
            .es-topbar { display: none; }
            .es-wrapper { margin: -1.5rem -1.5rem 0 -1.5rem; }
        }

        .es-form-card .fi-form-actions { display: none !important; }
    </style>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</div>
