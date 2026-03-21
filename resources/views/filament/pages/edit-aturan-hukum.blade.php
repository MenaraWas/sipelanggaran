<div>
    <div class="eah-wrapper">
        <x-md3-top-bar 
            :title="$appName" 
            :subtitle="$instansiName" 
            icon="edit_note" 
            :user="$user"
            backUrl="/admin/aturan-hukums"
        />

        <main class="eah-main">
            <section class="eah-header">
                <div>
                    <span class="eah-eyebrow">Parameter Disiplin</span>
                    <h2 class="eah-title">Edit Aturan</h2>
                    <p class="eah-subtitle">Perbarui rentang nilai atau sanksi untuk aturan ini.</p>
                </div>
            </section>

            <form wire:submit="save">
                <div class="eah-card">
                    {{ $this->form }}

                    <div class="eah-actions">
                        <button type="submit" class="eah-btn-primary">
                            <span class="material-symbols-outlined" style="font-size:20px">save</span>
                            <span>Simpan Perubahan</span>
                        </button>
                        
                        <div class="flex gap-2">
                            <button type="button" wire:click="mountAction('delete')" class="eah-btn-delete">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                            <a href="/admin/aturan-hukums" class="eah-btn-cancel">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        .eah-wrapper { font-family: 'Inter', sans-serif; background: #f8fafc; min-height: 100vh; margin: -1.5rem; }
        .eah-main { padding: 1rem 1.5rem 100px; max-width: 640px; margin: 0 auto; }
        
        .eah-header { margin-bottom: 2rem; }
        .eah-eyebrow { font-size: 10px; font-weight: 800; color: #515c71; text-transform: uppercase; letter-spacing: 0.12em; }
        .eah-title { font-size: 32px; font-weight: 900; color: #1e293b; letter-spacing: -0.04em; margin-top: 4px; }
        .eah-subtitle { font-size: 13px; color: #64748b; margin-top: 4px; }

        .eah-card { background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); border: 1.5px solid #f1f5f9; }
        
        /* Form Overrides */
        .eah-card .fi-fo-field-wrp label { font-size: 13px !important; font-weight: 600 !important; color: #475569 !important; margin-bottom: 0.5rem !important; }
        .eah-card input, .eah-card select, .eah-card textarea, .eah-card .fi-input-wrp {
            background: #f1f5f9 !important; border: 2px solid transparent !important; border-radius: 14px !important; transition: all 0.2s !important;
        }
        .eah-card input:focus, .eah-card select:focus, .eah-card textarea:focus, .eah-card .fi-input-wrp:focus-within {
            background: white !important; border-color: #515c71 !important; box-shadow: 0 0 0 4px rgba(81,92,113,0.08) !important;
        }

        .eah-actions { display: flex; flex-direction: column; gap: 12px; margin-top: 2.5rem; }
        .eah-btn-primary { 
            height: 54px; background: #515c71; color: white; font-weight: 700; border-radius: 16px; border: none;
            display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer;
            box-shadow: 0 4px 12px rgba(81,92,113,0.2);
        }
        .eah-btn-delete { width: 54px; height: 54px; background: #ffdad6; color: #ba1a1a; border-radius: 16px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; }
        .eah-btn-cancel { height: 54px; display: flex; align-items: center; justify-content: center; color: #64748b; font-weight: 600; text-decoration: none; padding: 0 1rem; }
        
        @media (min-width: 640px) {
            .eah-actions { flex-direction: row-reverse; justify-content: space-between; }
            .eah-btn-primary { flex: 1; max-width: 250px; }
        }

        @media (min-width: 1024px) {
            .eah-wrapper { margin: -1.5rem -1.5rem 0; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</div>
