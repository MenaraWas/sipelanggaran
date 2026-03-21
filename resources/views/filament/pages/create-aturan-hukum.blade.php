<div>
    <div class="cah-wrapper">
        <x-md3-top-bar 
            :title="$appName" 
            :subtitle="$instansiName" 
            icon="add_circle" 
            :user="$user"
            backUrl="/admin/aturan-hukums"
        />

        <main class="cah-main">
            <section class="cah-header">
                <div>
                    <span class="cah-eyebrow">Definisi Parameter</span>
                    <h2 class="cah-title">Aturan Baru</h2>
                    <p class="cah-subtitle">Tentukan rentang nilai, poin, dan hukuman untuk kategori pelanggaran.</p>
                </div>
            </section>

            <form wire:submit="create">
                <div class="cah-card">
                    {{ $this->form }}

                    <div class="cah-actions">
                        <button type="submit" class="cah-btn-primary">
                            <span class="material-symbols-outlined" style="font-size:20px">save</span>
                            <span>Simpan Aturan</span>
                        </button>
                        <a href="/admin/aturan-hukums" class="cah-btn-cancel">Batal</a>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        .cah-wrapper { font-family: 'Inter', sans-serif; background: #f8fafc; min-height: 100vh; margin: -1.5rem; }
        .cah-main { padding: 1rem 1.5rem 100px; max-width: 640px; margin: 0 auto; }
        
        .cah-header { margin-bottom: 2rem; }
        .cah-eyebrow { font-size: 10px; font-weight: 800; color: #515c71; text-transform: uppercase; letter-spacing: 0.12em; }
        .cah-title { font-size: 32px; font-weight: 900; color: #1e293b; letter-spacing: -0.04em; margin-top: 4px; }
        .cah-subtitle { font-size: 13px; color: #64748b; margin-top: 4px; }

        .cah-card { background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); border: 1.5px solid #f1f5f9; }
        
        /* Form Overrides */
        .cah-card .fi-fo-field-wrp label { font-size: 13px !important; font-weight: 600 !important; color: #475569 !important; margin-bottom: 0.5rem !important; }
        .cah-card input, .cah-card select, .cah-card textarea, .cah-card .fi-input-wrp {
            background: #f1f5f9 !important; border: 2px solid transparent !important; border-radius: 14px !important; transition: all 0.2s !important;
        }
        .cah-card input:focus, .cah-card select:focus, .cah-card textarea:focus, .cah-card .fi-input-wrp:focus-within {
            background: white !important; border-color: #515c71 !important; box-shadow: 0 0 0 4px rgba(81,92,113,0.08) !important;
        }

        .cah-actions { display: flex; flex-direction: column; gap: 12px; margin-top: 2.5rem; }
        .cah-btn-primary { 
            height: 54px; background: #515c71; color: white; font-weight: 700; border-radius: 16px; border: none;
            display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer;
            box-shadow: 0 4px 12px rgba(81,92,113,0.2);
        }
        .cah-btn-cancel { height: 54px; display: flex; align-items: center; justify-content: center; color: #64748b; font-weight: 600; text-decoration: none; }
        
        @media (min-width: 640px) {
            .cah-actions { flex-direction: row-reverse; }
            .cah-btn-primary { flex: 1.5; }
            .cah-btn-cancel { flex: 1; }
        }

        @media (min-width: 1024px) {
            .cah-wrapper { margin: -1.5rem -1.5rem 0; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</div>
