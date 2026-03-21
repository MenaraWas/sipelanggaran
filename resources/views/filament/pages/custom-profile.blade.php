<div>
    <div class="cp-wrapper md3-animate-page">
        <x-md3-top-bar 
            :title="$appName" 
            :subtitle="$instansiName" 
            icon="account_circle" 
            :user="$user"
            backUrl="/admin/more"
        />

        <main class="cp-main">
            <section class="cp-header">
                <div>
                    <span class="cp-eyebrow">Akun Saya</span>
                    <h2 class="cp-title">Profil Pengguna</h2>
                    <p class="cp-subtitle">Kelola informasi identitas dan keamanan akun Anda.</p>
                </div>
            </section>

            <form wire:submit="save">
                <div class="cp-grid">
                    <div class="cp-card">
                        {{ $this->form }}

                        <div class="cp-actions">
                            <button type="submit" class="cp-btn-primary">
                                <span class="material-symbols-outlined" style="font-size:20px">save</span>
                                <span>Simpan Perubahan</span>
                            </button>
                            <a href="/admin/more" class="cp-btn-cancel">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        @media (max-width: 1023px) {
            .fi-topbar { display: none !important; }
            .fi-sidebar, .fi-sidebar-close-overlay { display: none !important; }
        }
        .cp-wrapper { font-family: 'Inter', sans-serif; background: #fdfdfd; min-height: 100vh; margin: -1.5rem; }
        @media (min-width: 1024px) {
            .cp-wrapper { margin: 0; background: transparent; min-height: auto; }
            .cp-main { padding: 2rem 0 80px; }
        }
        .cp-main { padding: 1rem 1.5rem 100px; max-width: 640px; margin: 0 auto; }
        
        .cp-header { margin-bottom: 2rem; }
        .cp-eyebrow { font-size: 10px; font-weight: 800; color: #515c71; text-transform: uppercase; letter-spacing: 0.12em; }
        .cp-title { font-size: 32px; font-weight: 900; color: #1e293b; letter-spacing: -0.04em; margin-top: 4px; }
        .cp-subtitle { font-size: 13px; color: #64748b; margin-top: 4px; }

        .cp-card { background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); border: 1.5px solid #f1f5f9; }
        
        /* Form Overrides to match MD3 */
        .cp-card .fi-section { border: none !important; box-shadow: none !important; padding: 0 !important; margin-bottom: 2rem !important; background: transparent !important; }
        .cp-card .fi-section-header { margin-bottom: 1.5rem !important; border-bottom: 1.5px solid #f1f5f9 !important; padding-bottom: 1rem !important; }
        .cp-card .fi-section-header-heading { font-size: 16px !important; font-weight: 800 !important; color: #1e293b !important; }
        .cp-card .fi-section-header-description { font-size: 12px !important; color: #64748b !important; }

        .cp-card label { font-size: 13px !important; font-weight: 600 !important; color: #475569 !important; margin-bottom: 0.5rem !important; }
        .cp-card input, .cp-card select, .cp-card textarea, .cp-card .fi-input-wrp {
            background: #f1f5f9 !important; border: 2px solid transparent !important; border-radius: 14px !important; transition: all 0.2s !important;
        }
        .cp-card input:focus, .cp-card select:focus, .cp-card textarea:focus, .cp-card .fi-input-wrp:focus-within {
            background: white !important; border-color: #515c71 !important; box-shadow: 0 0 0 4px rgba(81,92,113,0.08) !important;
        }

        .cp-actions { display: flex; flex-direction: column; gap: 12px; margin-top: 1rem; }
        .cp-btn-primary { 
            height: 54px; background: #515c71; color: white; font-weight: 700; border-radius: 16px; border: none;
            display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer;
            box-shadow: 0 4px 12px rgba(81,92,113,0.2);
        }
        .cp-btn-cancel { height: 54px; display: flex; align-items: center; justify-content: center; color: #64748b; font-weight: 600; text-decoration: none; }
        
        @media (min-width: 640px) {
            .cp-actions { flex-direction: row-reverse; }
            .cp-btn-primary { flex: 1.5; }
            .cp-btn-cancel { flex: 1; }
        }

        @media (min-width: 1024px) {
            .cp-wrapper { margin: -1.5rem -1.5rem 0; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</div>
