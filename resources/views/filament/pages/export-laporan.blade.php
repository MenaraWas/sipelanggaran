<div>
    <div class="el-wrapper">
        {{-- TopAppBar --}}
        <x-md3-top-bar 
            :title="$appName" 
            :subtitle="$instansiName" 
            icon="download" 
            :user="$user" 
        />

        <main class="el-main">
            <section class="el-page-header">
                <span class="el-eyebrow">Laporan & Arsip</span>
                <h2 class="el-title">Export Laporan</h2>
                <p class="el-subtitle">Unduh rekap data pelanggaran dalam format Excel atau PDF.</p>
            </section>

            <div class="el-form-card">
                <form wire:submit="exportExcel">
                    <div class="el-form-body">
                        {{ $this->form }}
                    </div>

                    <div class="el-actions">
                        {{-- Excel Button --}}
                        <button type="submit" class="el-btn-excel">
                            <span class="material-symbols-outlined">table_view</span>
                            <span>Download Excel</span>
                        </button>

                        {{-- PDF Button --}}
                        <button type="button" wire:click="exportPdf" class="el-btn-pdf">
                            <span class="material-symbols-outlined">picture_as_pdf</span>
                            <span>Download PDF</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="el-hint-card mt-6">
                <div class="flex gap-4">
                    <span class="material-symbols-outlined text-blue-500">info</span>
                    <div>
                        <h4 class="text-sm font-bold text-slate-700">Tips Export</h4>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                            Gunakan filter Kelas atau Nama Siswa untuk laporan yang lebih spesifik. Rentang tanggal default adalah satu bulan terakhir.
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        @media (max-width: 1023px) { .fi-topbar { display: none !important; } }

        .el-wrapper { font-family: 'Inter', sans-serif; background: #f8fafc; min-height: 100vh; margin: -1.5rem; }
        .el-main { padding: 1rem 1.5rem 100px; max-width: 640px; margin: 0 auto; }
        .el-page-header { margin-bottom: 24px; }
        .el-eyebrow { font-size: 10px; font-weight: 800; color: #515c71; text-transform: uppercase; letter-spacing: 0.12em; }
        .el-title { font-size: 32px; font-weight: 900; color: #191c1e; letter-spacing: -0.04em; margin-top: 4px; }
        .el-subtitle { font-size: 13px; color: #9da3ae; margin-top: 4px; line-height: 1.5; }

        .el-form-card { background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); border: 1.5px solid #f0f2f5; }
        .el-form-body { margin-bottom: 2rem; }

        /* Overrides */
        .el-form-card .fi-fo-field-wrp label { font-size: 13px !important; font-weight: 600 !important; color: #424754 !important; }
        .el-form-card input, .el-form-card select, .el-form-card .fi-input-wrp {
            background: #f1f3f5 !important; border: 2px solid transparent !important; border-radius: 14px !important; transition: all 0.2s !important;
        }
        .el-form-card input:focus, .el-form-card .fi-input-wrp:focus-within {
            background: white !important; border-color: #515c71 !important; box-shadow: 0 0 0 4px rgba(81,92,113,0.08) !important;
        }

        .el-actions { display: flex; flex-direction: column; gap: 12px; }
        @media (min-width: 640px) { .el-actions { flex-direction: row; } }

        .el-btn-excel { 
            flex: 1; height: 54px; background: #e8f5e9; color: #2e7d32; border-radius: 16px; border: 1.5px solid #c8e6c9;
            font-weight: 700; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer;
            transition: all 0.2s;
        }
        .el-btn-excel:hover { background: #c8e6c9; transform: translateY(-1px); }
        .el-btn-excel:active { transform: scale(0.98); }

        .el-btn-pdf { 
            flex: 1; height: 54px; background: #ffebee; color: #c62828; border-radius: 16px; border: 1.5px solid #ffcdd2;
            font-weight: 700; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer;
            transition: all 0.2s;
        }
        .el-btn-pdf:hover { background: #ffcdd2; transform: translateY(-1px); }
        .el-btn-pdf:active { transform: scale(0.98); }

        .el-hint-card { background: #eff6ff; padding: 1.25rem; border-radius: 20px; border: 1px solid #dbeafe; }

        @media (min-width: 1024px) {
            .el-topbar { display: none; }
            .el-wrapper { margin: -1.5rem -1.5rem 0; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</div>