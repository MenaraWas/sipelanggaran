<div>
    <div class="eb-wrapper">
        <x-md3-top-bar 
            :title="$appName" 
            :subtitle="$instansiName" 
            icon="edit_square" 
            :user="$user"
            backUrl="/admin/barcode-harians"
        />

        <main class="eb-main">
            <div class="eb-grid">
                {{-- Main Form --}}
                <div class="eb-left">
                    <section class="eb-page-header">
                        <span class="eb-eyebrow">Update Token</span>
                        <h2 class="eb-title">Konfigurasi Barcode</h2>
                        <p class="eb-subtitle">Sesuaikan waktu kadaluarsa atau nilai default untuk token ini.</p>
                    </section>

                    <form wire:submit="save">
                        <div class="eb-card">
                            {{ $this->form }}

                            <div class="eb-actions">
                                <button type="submit" class="eb-btn-primary">
                                    <span class="material-symbols-outlined" style="font-size:20px">save</span>
                                    <span>Simpan Perubahan</span>
                                </button>
                                
                                <div class="flex gap-2">
                                    <button type="button" wire:click="mountAction('delete')" class="eb-btn-delete">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                    <a href="/admin/barcode-harians" class="eb-btn-cancel text-xs font-bold uppercase tracking-widest">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Sidebar Metadata --}}
                <div class="eb-right">
                    <div class="eb-meta-card">
                        <h4 class="text-[10px] font-extrabold text-[#515c71] uppercase tracking-widest mb-4">Metadata Barcode</h4>
                        
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="eb-meta-icon"><span class="material-symbols-outlined">fingerprint</span></div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 leading-none">TOKEN ID</p>
                                    <p class="text-xs font-mono font-bold text-slate-700 mt-1 uppercase">{{ substr($record->token, 0, 12) }}...</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="eb-meta-icon"><span class="material-symbols-outlined">history</span></div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 leading-none">DIBUAT PADA</p>
                                    <p class="text-xs font-bold text-slate-700 mt-1">{{ $record->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="eb-meta-icon"><span class="material-symbols-outlined">person</span></div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 leading-none">OLEH</p>
                                    <p class="text-xs font-bold text-slate-700 mt-1">{{ $record->creator->name ?? 'Admin' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-100">
                            <a href="{{ route('barcode.show', $record->token) }}" target="_blank" class="eb-btn-qr-view">
                                <span class="material-symbols-outlined">qr_code_2</span>
                                <span>Lihat QR Code Aktif</span>
                            </a>
                        </div>
                    </div>

                    <div class="eb-stats-card mt-6">
                        <h4 class="text-[10px] font-extrabold text-blue-800 uppercase tracking-widest mb-1">Total Scan</h4>
                        <div class="flex items-end gap-2">
                            <span class="text-4xl font-black text-blue-900 leading-none">{{ $record->pelanggaran()->count() }}</span>
                            <span class="text-[10px] font-bold text-blue-700 mb-1">PENGGUNA</span>
                        </div>
                    </div>
                </div>
            </div>

            <x-filament-actions::modals />
        </main>
    </div>

    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        @media (max-width: 1023px) { .fi-topbar { display: none !important; } }

        .eb-wrapper { font-family: 'Inter', sans-serif; background: #f8fafc; min-height: 100vh; margin: -1.5rem; }
        .eb-main { padding: 1rem 1.5rem 100px; max-width: 1000px; margin: 0 auto; }
        
        .eb-grid { display: grid; grid-template-columns: 1fr; gap: 2rem; }
        @media (min-width: 1024px) { .eb-grid { grid-template-columns: 2fr 1fr; } }

        .eb-page-header { margin-bottom: 2rem; }
        .eb-eyebrow { font-size: 10px; font-weight: 800; color: #515c71; text-transform: uppercase; letter-spacing: 0.12em; }
        .eb-title { font-size: 32px; font-weight: 900; color: #1e293b; letter-spacing: -0.04em; margin-top: 4px; }
        .eb-subtitle { font-size: 13px; color: #64748b; margin-top: 4px; line-height: 1.5; }

        .eb-card { background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); border: 1.5px solid #f1f5f9; }
        
        /* Filament Form Overrides */
        .eb-card .fi-fo-field-wrp label { font-size: 13px !important; font-weight: 600 !important; color: #475569 !important; margin-bottom: 0.5rem !important; }
        .eb-card input, .eb-card select, .eb-card .fi-input-wrp {
            background: #f1f5f9 !important; border: 2px solid transparent !important; border-radius: 14px !important; transition: all 0.2s !important;
        }
        .eb-card input:focus, .eb-card .fi-input-wrp:focus-within {
            background: white !important; border-color: #515c71 !important; box-shadow: 0 0 0 4px rgba(81,92,113,0.08) !important;
        }

        .eb-actions { display: flex; flex-direction: column; gap: 12px; margin-top: 2rem; }
        .eb-btn-primary { 
            height: 54px; background: #515c71; color: white; font-weight: 700; border-radius: 16px; border: none;
            display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer;
            box-shadow: 0 4px 12px rgba(81,92,113,0.2);
        }
        .eb-btn-delete { width: 54px; height: 54px; background: #ffdad6; color: #ba1a1a; border-radius: 16px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; }
        .eb-btn-cancel { height: 54px; display: flex; align-items: center; justify-content: center; color: #64748b; font-weight: 700; text-decoration: none; padding: 0 1rem; }
        @media (min-width: 640px) {
            .eb-actions { flex-direction: row-reverse; justify-content: space-between; }
            .eb-btn-primary { flex: 1; max-width: 250px; }
        }

        /* Sidebar Styles */
        .eb-meta-card { background: white; padding: 1.5rem; border-radius: 24px; border: 1.5px solid #f1f5f9; }
        .eb-meta-icon { width: 32px; height: 32px; background: #f8fafc; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b; flex-shrink: 0; }
        .eb-btn-qr-view { 
            width: 100%; height: 48px; background: #e0e7ff; color: #3730a3; border-radius: 12px;
            font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; 
            display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none;
            transition: all 0.2s;
        }
        .eb-btn-qr-view:hover { background: #c7d2fe; transform: scale(1.02); }

        .eb-stats-card { background: #dbeafe; padding: 1.5rem; border-radius: 24px; border: 1px solid #bfdbfe; }

        @media (min-width: 1024px) {
            .eb-topbar { display: none; }
            .eb-wrapper { margin: -1.5rem -1.5rem 0; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</div>
