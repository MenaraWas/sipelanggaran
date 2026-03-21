<div>
    <div class="ss-wrapper">
        {{-- TopAppBar --}}
        <x-md3-top-bar 
            :title="$appName" 
            :subtitle="$instansiName" 
            icon="settings" 
            :user="$user" 
        />

        <main class="ss-main">
            <section class="ss-page-header">
                <span class="ss-eyebrow">Administrasi Sistem</span>
                <h2 class="ss-title">Identitas Situs</h2>
                <p class="ss-subtitle">Konfigurasi nama aplikasi dan informasi instansi yang muncul di seluruh sistem.</p>
            </section>

            <div class="ss-form-card">
                <form wire:submit="save">
                    <div class="ss-form-body">
                        {{ $this->form }}
                    </div>

                    {{-- Action Button --}}
                    <div class="ss-actions">
                        <button type="submit" class="ss-btn-primary">
                            <span class="material-symbols-outlined">save</span>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="ss-footer-info mt-8">
                <p class="text-[10px] text-center text-slate-400 font-bold uppercase tracking-widest">
                    {{ $appName }} &copy; {{ date('Y') }}
                </p>
            </div>
        </main>
    </div>

    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        @media (max-width: 1023px) { .fi-topbar { display: none !important; } }

        .ss-wrapper { font-family: 'Inter', sans-serif; background: #fdfdfd; min-height: 100vh; margin: -1.5rem; }
        .ss-main { padding: 1rem 1.5rem 100px; max-width: 640px; margin: 0 auto; }
        .ss-page-header { margin-bottom: 24px; }
        .ss-eyebrow { font-size: 10px; font-weight: 800; color: #515c71; text-transform: uppercase; letter-spacing: 0.12em; }
        .ss-title { font-size: 32px; font-weight: 900; color: #191c1e; letter-spacing: -0.04em; margin-top: 4px; }
        .ss-subtitle { font-size: 13px; color: #9da3ae; margin-top: 4px; line-height: 1.5; }

        .ss-form-card { background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 1px 1px rgba(0,0,0,0.02); border: 1.5px solid #f2f4f6; }
        .ss-form-body { margin-bottom: 2rem; }

        /* Overrides */
        .ss-form-card .fi-section { border: none !important; box-shadow: none !important; padding: 0 !important; }
        .ss-form-card .fi-section-header { margin-bottom: 1.5rem !important; }
        .ss-form-card .fi-fo-field-wrp label { font-size: 13px !important; font-weight: 600 !important; color: #424754 !important; }
        .ss-form-card input, .ss-form-card select, .ss-form-card .fi-input-wrp {
            background: #f1f3f5 !important; border: 2px solid transparent !important; border-radius: 14px !important; transition: all 0.2s !important;
        }
        .ss-form-card input:focus, .ss-form-card .fi-input-wrp:focus-within {
            background: white !important; border-color: #515c71 !important; box-shadow: 0 0 0 4px rgba(81,92,113,0.08) !important;
        }
        
        /* File Upload Styling */
        .ss-form-card .fi-fo-file-upload { border: 2px dashed #e2e8f0 !important; border-radius: 18px !important; padding: 1.5rem !important; background: #fcfcfc !important; }

        .ss-actions { display: flex; flex-direction: column; }
        .ss-btn-primary { 
            height: 54px; background: #515c71; color: white; border-radius: 16px; border: none;
            font-weight: 700; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer;
            transition: all 0.2s; box-shadow: 0 4px 12px rgba(81,92,113,0.2);
        }
        .ss-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(81,92,113,0.3); }
        .ss-btn-primary:active { transform: scale(0.98); }

        @media (min-width: 1024px) {
            .ss-topbar { display: none; }
            .ss-wrapper { margin: -1.5rem -1.5rem 0; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</div>