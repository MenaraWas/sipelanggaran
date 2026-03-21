<div>
    <div class="dah-wrapper md3-animate-page">
        <x-md3-top-bar 
            :title="$appName" 
            :subtitle="$instansiName" 
            icon="scale" 
            :user="$user" 
        />

        <main class="dah-main">
            <section class="dah-page-header">
                <div>
                    <span class="dah-eyebrow">Parameter Disiplin</span>
                    <h2 class="dah-title">Aturan & Hukuman</h2>
                    <p class="dah-subtitle">Konfigurasi poin dan sanksi berdasarkan jenis pelanggaran.</p>
                </div>
            </section>

            <div class="dah-list">
                @php
                    $groupedAturan = \App\Models\AturanHukum::with('jenisPelanggaran')->get()->groupBy('jenis_pelanggaran_id');
                @endphp

                @forelse($groupedAturan as $jpId => $rules)
                    @php $jp = $rules->first()->jenisPelanggaran; @endphp
                    <div class="dah-group">
                        <div class="dah-group-header">
                            <span class="material-symbols-outlined dah-group-icon">label</span>
                            <h3 class="dah-group-name">{{ $jp->nama ?? 'Umum' }}</h3>
                        </div>

                        <div class="dah-grid">
                            @foreach($rules as $item)
                                <a href="/admin/aturan-hukums/{{ $item->id }}/edit" class="dah-card">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="dah-range">
                                            <span class="dah-range-label">Rentang Nilai</span>
                                            <p class="dah-range-value">
                                                {{ $item->min_nilai }} — {{ $item->max_nilai ?? '∞' }}
                                            </p>
                                        </div>
                                        <div class="dah-points">
                                            +{{ $item->poin_pelanggaran }}
                                        </div>
                                    </div>
                                    
                                    <div class="dah-hukuman">
                                        <p class="dah-hukuman-text">{{ $item->hukuman }}</p>
                                    </div>

                                    <div class="dah-card-footer">
                                        <span class="material-symbols-outlined text-[14px]">edit_square</span>
                                        <span>Edit Parameter</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="dah-empty">
                        <span class="material-symbols-outlined text-[48px]">rule</span>
                        <p class="dah-empty-title">Belum ada aturan hukuman yang terdaftar</p>
                        <a href="/admin/aturan-hukums/create" class="dah-empty-btn">Buat Aturan Pertama</a>
                    </div>
                @endforelse
            </div>
        </main>

        <a href="/admin/aturan-hukums/create" class="dah-fab">
            <span class="material-symbols-outlined">add</span>
        </a>
    </div>

    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        
        .dah-wrapper { font-family: 'Inter', sans-serif; background: #f8fafc; min-height: 100vh; margin: -1.5rem; }
        @media (min-width: 1024px) {
            .dah-wrapper { margin: 0; background: transparent; min-height: auto; }
        }
        .dah-main { max-width: 900px; margin: 0 auto; padding: 1rem 1.5rem 100px; }
        
        .dah-page-header { margin-bottom: 2rem; }
        .dah-eyebrow { font-size: 10px; font-weight: 800; color: #515c71; text-transform: uppercase; letter-spacing: 0.12em; }
        .dah-title { font-size: 32px; font-weight: 900; color: #1e293b; letter-spacing: -0.04em; margin-top: 4px; }
        .dah-subtitle { font-size: 13px; color: #64748b; margin-top: 4px; }

        .dah-group { margin-bottom: 2.5rem; }
        .dah-group-header { display: flex; align-items: center; gap: 8px; margin-bottom: 1rem; padding-bottom: 8px; border-bottom: 1.5px solid #edf2f7; }
        .dah-group-icon { font-size: 18px; color: #515c71; }
        .dah-group-name { font-size: 14px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; }

        .dah-grid { display: grid; grid-template-columns: 1fr; gap: 12px; }
        @media (min-width: 640px) { .dah-grid { grid-template-columns: 1fr 1fr; } }

        .dah-card {
            background: white; border-radius: 20px; padding: 1.25rem;
            border: 1.5px solid #f1f5f9; text-decoration: none; color: inherit;
            transition: all 0.2s ease; display: flex; flex-direction: column;
        }
        .dah-card:hover { transform: translateY(-2px); border-color: #cbd5e1; box-shadow: 0 8px 24px rgba(0,0,0,0.05); }

        .dah-range-label { font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; }
        .dah-range-value { font-size: 15px; font-weight: 800; color: #1e293b; }
        
        .dah-points { 
            background: #ffdad6; color: #ba1a1a; font-size: 12px; font-weight: 800; 
            padding: 4px 10px; border-radius: 10px; flex-shrink: 0;
        }

        .dah-hukuman { background: #f8fafc; padding: 0.75rem; border-radius: 12px; margin-bottom: 1rem; flex-grow: 1; }
        .dah-hukuman-text { font-size: 12px; font-weight: 500; color: #475569; line-height: 1.5; }

        .dah-card-footer { 
            display: flex; align-items: center; gap: 6px; font-size: 11px; font-weight: 700; color: #515c71; text-transform: uppercase;
        }

        .dah-fab {
            position: fixed; right: 20px; bottom: 88px; width: 56px; height: 56px;
            background: #515c71; color: white; border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 6px 20px rgba(81,92,113,0.3); transition: all 0.2s;
            z-index: 40;
        }
        .dah-fab:active { transform: scale(0.9); }

        .dah-empty { padding: 80px 0; text-align: center; color: #94a3b8; display: flex; flex-direction: column; align-items: center; gap: 12px; }
        .dah-empty-title { font-size: 14px; font-weight: 600; }
        .dah-empty-btn { 
            background: #edf2f7; color: #515c71; padding: 10px 20px; border-radius: 12px; 
            font-size: 13px; font-weight: 700; text-decoration: none; transition: background 0.2s;
        }
        .dah-empty-btn:hover { background: #e2e8f0; }

        @media (min-width: 1024px) {
            .dah-wrapper { margin: -1.5rem -1.5rem 0; }
            .dah-fab { right: 40px; bottom: 40px; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</div>
