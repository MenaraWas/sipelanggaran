<div>
    <div class="cjp-wrapper">
        <x-md3-top-bar 
            :title="$appName" 
            :subtitle="$instansiName" 
            icon="add_box" 
            :user="$user"
            backUrl="/admin/jenis-pelanggarans"
        />

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
        .cjp-main { padding: 1rem 1.5rem 100px; max-width: 640px; margin: 0 auto; }
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
