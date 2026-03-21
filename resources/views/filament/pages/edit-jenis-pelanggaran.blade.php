<div>
    <div class="ejp-wrapper">
        <header class="ejp-topbar">
            <div class="flex items-center gap-3">
                <a href="/admin/jenis-pelanggarans" class="jp-back-btn">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h1 class="jp-topbar-title">Edit Jenis Pelanggaran</h1>
            </div>
            <div class="jp-topbar-avatar">
                {{ strtoupper(substr($user->name ?? 'AD', 0, 2)) }}
            </div>
        </header>

        <main class="ejp-main">
            <div class="ejp-grid">
                
                {{-- Left: Main Form --}}
                <div class="ejp-left">
                    <section class="ejp-form-section">
                        <div class="ejp-header flex justify-between items-start">
                            <div>
                                <h2 class="ejp-title">Data Kategori</h2>
                                <p class="ejp-subtitle">Perbarui informasi dasar pelanggaran ini.</p>
                            </div>
                            <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2 py-1 rounded">ID: #{{ $record->id }}</span>
                        </div>

                        <form wire:submit="save">
                            <div class="ejp-card">
                                {{ $this->form }}

                                <div class="ejp-actions">
                                    <button type="submit" class="ejp-btn-primary">
                                        <span class="material-symbols-outlined" style="font-size:20px">check</span>
                                        <span>Simpan Perubahan</span>
                                    </button>
                                    
                                    <div class="flex gap-2">
                                        <button type="button" wire:click="mountAction('delete')" class="ejp-btn-delete">
                                            <span class="material-symbols-outlined" style="font-size:20px">delete</span>
                                        </button>
                                        <a href="/admin/jenis-pelanggarans" class="ejp-btn-cancel">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

                {{-- Right: Integration / Info --}}
                <div class="ejp-right">
                    <div class="ejp-info-card">
                        <h4 class="ejp-info-title">SISTEM SKORING</h4>
                        <p class="ejp-info-desc">
                            Pastikan Anda telah mengisi <strong>Aturan Hukuman</strong> untuk kategori ini agar sistem dapat menghitung poin secara otomatis saat scan dilakukan.
                        </p>
                    </div>
                </div>

            </div>

            {{-- Relation Managers (Aturan Hukum) --}}
            <div class="mt-8">
                <h3 class="text-sm font-bold text-slate-700 mb-4 px-2 uppercase tracking-wider">Aturan Poin & Hukuman</h3>
                
                <div class="fi-resource-relation-managers flex flex-col gap-y-6">
                    @foreach ($this->getRelationManagers() as $relationManager)
                        @livewire($relationManager, [
                            'ownerRecord' => $record,
                            'pageClass' => static::class,
                        ], key($relationManager))
                    @endforeach
                </div>
            </div>

            <x-filament-actions::modals />
        </main>
    </div>

    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        @media (max-width: 1023px) { .fi-topbar { display: none !important; } }

        .ejp-wrapper { font-family: 'Inter', sans-serif; background: #f7f9fb; min-height: 100vh; margin: -1.5rem; }
        .ejp-topbar {
            position: sticky; top: 0; z-index: 45; height: 60px; padding: 0 20px;
            background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.04);
            display: flex; align-items: center; justify-content: space-between;
        }
        .jp-back-btn { p: 8px; border-radius: 10px; color: #424754; transition: background 0.2s; display: flex; }
        .jp-back-btn:hover { background: #f1f3f5; }
        .jp-topbar-title { font-size: 16px; font-weight: 700; color: #191c1e; }
        .jp-topbar-avatar { width: 34px; height: 34px; border-radius: 50%; background: #515c71; color: white; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; }

        .ejp-main { padding: 2rem 1.5rem; max-width: 1000px; margin: 0 auto; }
        
        .ejp-grid { display: grid; grid-template-columns: 1fr; gap: 1.5rem; }
        @media (min-width: 1024px) { .ejp-grid { grid-template-columns: 2fr 1fr; } }

        .ejp-header { margin-bottom: 1.5rem; }
        .ejp-title { font-size: 24px; font-weight: 900; color: #191c1e; letter-spacing: -0.03em; }
        .ejp-subtitle { font-size: 13px; color: #727785; }

        .ejp-card { background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
        
        /* Overrides */
        .ejp-card .fi-fo-field-wrp label { font-size: 13px !important; font-weight: 600 !important; color: #424754 !important; margin-bottom: 0.5rem !important; }
        .ejp-card input, .ejp-card select, .ejp-card .fi-input-wrp {
            background: #f1f3f5 !important; border: 2px solid transparent !important; border-radius: 14px !important; transition: all 0.2s !important;
        }
        .ejp-card input:focus, .ejp-card .fi-input-wrp:focus-within {
            background: white !important; border-color: #515c71 !important; box-shadow: 0 0 0 4px rgba(81,92,113,0.08) !important;
        }

        .ejp-actions { display: flex; flex-direction: column; gap: 1rem; margin-top: 2rem; }
        .ejp-btn-primary { 
            height: 52px; background: #515c71; color: white; font-weight: 700; border-radius: 16px; border: none;
            display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer;
        }
        .ejp-btn-delete { width: 52px; height: 52px; background: #ffdad6; color: #ba1a1a; border-radius: 16px; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; }
        .ejp-btn-cancel {
            height: 52px; display: flex; align-items: center; justify-content: center; color: #727785; font-weight: 600; text-decoration: none; padding: 0 1rem;
        }
        @media (min-width: 640px) {
            .ejp-actions { flex-direction: row-reverse; justify-content: space-between; }
            .ejp-btn-primary { flex: 1; max-width: 250px; }
        }

        .ejp-info-card { background: #d3e4fe; padding: 1.5rem; border-radius: 20px; }
        .ejp-info-title { font-size: 11px; font-weight: 800; color: #3c475a; margin-bottom: 4px; }
        .ejp-info-desc { font-size: 12px; color: #516076; line-height: 1.5; }

        /* Relation Manager Styling */
        .fi-resource-relation-managers { background: white; border-radius: 20px; padding: 1rem; border: 1.5px solid #f0f2f5; }
        .fi-resource-relation-managers .fi-ta-header { padding: 0 1rem 1rem; }
        .fi-resource-relation-managers .fi-ta-header-heading { font-size: 14px; font-weight: 800; }

        @media (min-width: 1024px) {
            .ejp-topbar { display: none; }
            .ejp-wrapper { margin: -1.5rem -1.5rem 0; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</div>
