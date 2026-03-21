<div>
    <div class="jp-wrapper">

        {{-- TopAppBar --}}
        <x-md3-top-bar 
        :title="$appName" 
        :subtitle="$instansiName" 
        icon="label" 
        :user="$user" 
    />

        {{-- Main Content --}}
        <main class="jp-main">

            {{-- Page Header --}}
            <section class="jp-page-header">
                <div>
                    <span class="jp-eyebrow">Konfigurasi Sistem</span>
                    <h2 class="jp-title">Jenis Pelanggaran</h2>
                    <p class="jp-subtitle">Atur kategori pelanggaran dan cara perhitungannya.</p>
                </div>
            </section>

            {{-- List of Cards --}}
            <div class="jp-list">
                @forelse (\App\Models\JenisPelanggaran::all() as $item)
                    <a href="/admin/jenis-pelanggarans/{{ $item->id }}/edit" class="jp-card">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="jp-card-title">{{ $item->nama }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="jp-type-pill {{ $item->tipe_perhitungan === 'otomatis_waktu' ? 'pill-auto' : 'pill-direct' }}">
                                        {{ $item->tipe_perhitungan === 'otomatis_waktu' ? 'Otomatis Waktu' : 'Langsung' }}
                                    </span>
                                    @if($item->jam_batas_masuk)
                                        <span class="text-[10px] font-bold text-slate-400">Batas: {{ $item->jam_batas_masuk }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="jp-card-arrow">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </div>
                        </div>
                        
                        <div class="jp-card-footer">
                            <span class="material-symbols-outlined text-[14px]">scale</span>
                            <span>{{ $item->aturanHukum()->count() }} Aturan Poin</span>
                        </div>
                    </a>
                @empty
                    <div class="jp-empty">
                        <span class="material-symbols-outlined text-[48px]">warning_off</span>
                        <p class="jp-empty-title">Belum ada jenis pelanggaran</p>
                    </div>
                @endforelse
            </div>
        </main>

        {{-- FAB --}}
        <a href="/admin/jenis-pelanggarans/create" class="jp-fab">
            <span class="material-symbols-outlined">add</span>
        </a>

    </div>

    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        @media (max-width: 1023px) { .fi-topbar { display: none !important; } }

        .jp-wrapper {
            font-family: 'Inter', sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            margin: -1.5rem;
        }

        .jp-main { max-width: 800px; margin: 0 auto; padding: 1rem 20px 100px; }
        
        .jp-page-header { margin-bottom: 24px; }
        .jp-eyebrow { font-size: 11px; font-weight: 700; color: #515c71; text-transform: uppercase; letter-spacing: 0.1em; }
        .jp-title { font-size: 32px; font-weight: 900; color: #191c1e; letter-spacing: -0.04em; margin-top: 4px; }
        .jp-subtitle { font-size: 13px; color: #9da3ae; margin-top: 4px; }

        .jp-list { display: grid; grid-template-columns: 1fr; gap: 12px; }
        @media (min-width: 640px) { .jp-list { grid-template-columns: 1fr 1fr; } }

        .jp-card {
            background: white; border-radius: 20px; padding: 20px;
            border: 1.5px solid #f0f2f5; text-decoration: none; color: inherit;
            transition: all 0.2s ease;
        }
        .jp-card:hover { transform: translateY(-2px); border-color: #d8dde6; box-shadow: 0 8px 24px rgba(0,0,0,0.05); }

        .jp-card-title { font-size: 16px; font-weight: 800; color: #191c1e; }
        .jp-type-pill { 
            font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 100px; border: 1px solid transparent; text-transform: uppercase;
        }
        .pill-auto { background: #fff8ec; color: #b7651a; border-color: #fde8c4; }
        .pill-direct { background: #edfaf4; color: #1e8a52; border-color: #c6ead8; }

        .jp-card-arrow { color: #c8ccd4; }
        .jp-card-footer { 
            margin-top: 12px; padding-top: 12px; border-top: 1px solid #f2f4f6;
            display: flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 600; color: #727785;
        }

        .jp-fab {
            position: fixed; right: 20px; bottom: 88px; width: 56px; height: 56px;
            background: #515c71; color: white; border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 6px 20px rgba(81,92,113,0.3); transition: all 0.2s;
        }

        .jp-empty { padding: 60px 0; text-align: center; color: #b0b6c0; display: flex; flex-direction: column; align-items: center; gap: 8px; }
        .jp-empty-title { font-size: 14px; font-weight: 600; }

        @media (min-width: 1024px) {
            .jp-topbar { display: none; }
            .jp-wrapper { margin: -1.5rem -1.5rem 0; }
            .jp-fab { right: 40px; bottom: 40px; }
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</div>
