<div>
    <div class="cb-wrapper">
        <x-md3-top-bar 
            :title="$appName" 
            :subtitle="$instansiName" 
            icon="qr_code" 
            :user="$user"
            backUrl="/admin/barcode-harians"
        />

        <main class="cb-main">
            <section class="cb-page-header">
                <div>
                    <span class="cb-eyebrow">Generator Token</span>
                    <h2 class="cb-title">Barcode Baru</h2>
                    <p class="cb-subtitle">Terbitkan QR code harian untuk kategori pelanggaran tertentu.</p>
                </div>
            </section>

            <form wire:submit="create">
                <div class="cb-card">
                    {{ $this->form }}

                    <div class="cb-actions">
                        <button type="submit" class="cb-btn-primary">
                            <span class="material-symbols-outlined" style="font-size:20px">qr_code</span>
                            <span>Terbitkan Barcode</span>
                        </button>
                        <a href="/admin/barcode-harians" class="cb-btn-cancel">Batal</a>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        @media (max-width: 1023px) { .fi-topbar { display: none !important; } }

        .cb-wrapper { font-family: 'Inter', sans-serif; background: #f8fafc; min-height: 100vh; margin: -1.5rem; }
        .cb-main { padding: 1rem 1.5rem 100px; max-width: 640px; margin: 0 auto; }
        .cb-page-header { margin-bottom: 2rem; }
        .cb-eyebrow { font-size: 10px; font-weight: 800; color: #515c71; text-transform: uppercase; letter-spacing: 0.12em; }
        .cb-title { font-size: 32px; font-weight: 900; color: #1e293b; letter-spacing: -0.04em; margin-top: 4px; }
        .cb-subtitle { font-size: 13px; color: #64748b; margin-top: 4px; line-height: 1.5; }

        .cb-card { background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); border: 1.5px solid #f1f5f9; }
        
        /* Filament Form Overrides */
        .cb-card .fi-fo-field-wrp label { font-size: 13px !important; font-weight: 600 !important; color: #475569 !important; margin-bottom: 0.5rem !important; }
        .cb-card input, .cb-card select, .cb-card .fi-input-wrp {
            background: #f1f5f9 !important; border: 2px solid transparent !important; border-radius: 14px !important; transition: all 0.2s !important;
        }
        .cb-card input:focus, .cb-card .fi-input-wrp:focus-within {
            background: white !important; border-color: #515c71 !important; box-shadow: 0 0 0 4px rgba(81,92,113,0.08) !important;
        }

        .cb-actions { display: flex; flex-direction: column; gap: 12px; margin-top: 2rem; }
        .cb-btn-primary { 
            height: 54px; background: #515c71; color: white; font-weight: 700; border-radius: 16px; border: none;
            display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer;
            box-shadow: 0 4px 12px rgba(81,92,113,0.2);
        }
        .cb-btn-cancel { height: 54px; display: flex; align-items: center; justify-content: center; color: #64748b; font-weight: 600; text-decoration: none; }
        @media (min-width: 640px) {
            .cb-actions { flex-direction: row-reverse; }
            .cb-btn-primary { flex: 1.5; }
            .cb-btn-cancel { flex: 1; }
        }

        @media (min-width: 1024px) {
            .cb-topbar { display: none; }
            .cb-wrapper { margin: -1.5rem -1.5rem 0; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</div>
