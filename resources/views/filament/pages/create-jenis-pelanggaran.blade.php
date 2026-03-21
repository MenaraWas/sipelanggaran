<div>
    <div class="cjp-wrapper">
        <header class="cjp-topbar">
            <div class="flex items-center gap-3">
                <a href="/admin/jenis-pelanggarans" class="jp-back-btn">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h1 class="jp-topbar-title">Tambah Jenis Pelanggaran</h1>
            </div>
            <div class="jp-topbar-avatar">
                {{ strtoupper(substr($user->name ?? 'AD', 0, 2)) }}
            </div>
        </header>

        <main class="cjp-main">
            <section class="cjp-form-section">
                <div class="cjp-header">
                    <h2 class="cjp-title">Kategori Baru</h2>
                    <p class="cjp-subtitle">Definisikan tipe pelanggaran baru dalam sistem.</p>
                </div>

                <form wire:submit="create">
                    <div class="cjp-card">
                        {{ $this->form }}

                        <div class="cjp-actions">
                            <button type="submit" class="cjp-btn-primary">
                                <span class="material-symbols-outlined" style="font-size:20px">check</span>
                                <span>Simpan Kategori</span>
                            </button>
                            <a href="/admin/jenis-pelanggarans" class="cjp-btn-cancel">Batal</a>
                        </div>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        @media (max-width: 1023px) { .fi-topbar { display: none !important; } }

        .cjp-wrapper { font-family: 'Inter', sans-serif; background: #f7f9fb; min-height: 100vh; margin: -1.5rem; }
        .cjp-topbar {
            position: sticky; top: 0; z-index: 45; height: 60px; padding: 0 20px;
            background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.04);
            display: flex; align-items: center; justify-content: space-between;
        }
        .jp-back-btn { p: 8px; border-radius: 10px; color: #424754; transition: background 0.2s; display: flex; }
        .jp-back-btn:hover { background: #f1f3f5; }
        .jp-topbar-title { font-size: 16px; font-weight: 700; color: #191c1e; }
        .jp-topbar-avatar { width: 34px; height: 34px; border-radius: 50%; background: #515c71; color: white; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; }

        .cjp-main { padding: 2rem 1.5rem; max-width: 600px; margin: 0 auto; }
        .cjp-header { margin-bottom: 1.5rem; }
        .cjp-title { font-size: 24px; font-weight: 900; color: #191c1e; letter-spacing: -0.03em; }
        .cjp-subtitle { font-size: 13px; color: #727785; }

        .cjp-card { background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
        
        /* Overrides */
        .cjp-card .fi-fo-field-wrp label { font-size: 13px !important; font-weight: 600 !important; color: #424754 !important; margin-bottom: 0.5rem !important; }
        .cjp-card input, .cjp-card select, .cjp-card .fi-input-wrp {
            background: #f1f3f5 !important; border: 2px solid transparent !important; border-radius: 14px !important; transition: all 0.2s !important;
        }
        .cjp-card input:focus, .cjp-card .fi-input-wrp:focus-within {
            background: white !important; border-color: #515c71 !important; box-shadow: 0 0 0 4px rgba(81,92,113,0.08) !important;
        }

        .cjp-actions { display: flex; flex-direction: column; gap: 1rem; margin-top: 2rem; }
        .cjp-btn-primary { 
            height: 52px; background: #515c71; color: white; font-weight: 700; border-radius: 16px; border: none;
            display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer;
        }
        .cjp-btn-cancel {
            height: 52px; display: flex; align-items: center; justify-content: center; color: #727785; font-weight: 600; text-decoration: none;
        }
        @media (min-width: 640px) {
            .cjp-actions { flex-direction: row-reverse; }
            .cjp-btn-primary { flex: 1; }
            .cjp-btn-cancel { flex: 1; }
        }

        @media (min-width: 1024px) {
            .cjp-topbar { display: none; }
            .cjp-wrapper { margin: -1.5rem -1.5rem 0; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</div>
