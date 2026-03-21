<div class="ap-wrapper md3-animate-page">
    <x-md3-top-bar 
        :title="$appName" 
        :subtitle="$instansiName" 
        icon="analytics" 
        :user="$user" 
    />

    <main class="ap-main">
        {{-- Header --}}
        <section class="ap-header">
            <div>
                <span class="ap-eyebrow">Laporan Analitik</span>
                <h2 class="ap-title">Statistik Sekolah</h2>
                <p class="ap-subtitle">Data kedisiplinan siswa berbasis waktu dan kategori.</p>
            </div>
        </section>

        {{-- Trends Section --}}
        <div class="ap-grid">
            {{-- Weekly Chart --}}
            <div class="ap-card">
                <div class="ap-card-header">
                    <h3 class="ap-card-title">Tren Mingguan</h3>
                    <span class="ap-card-badge">7 Hari Terakhir</span>
                </div>
                <div class="ap-chart-container">
                    @php $maxW = collect($weeklyStats)->max('count') ?: 1; @endphp
                    <div class="ap-chart">
                        @foreach($weeklyStats as $stat)
                            <div class="ap-chart-col">
                                <span class="ap-chart-val">{{ $stat['count'] }}</span>
                                <div class="ap-chart-bar {{ $stat['count'] == $maxW ? 'active' : '' }}" 
                                     style="height: {{ ($stat['count'] / $maxW) * 100 }}%">
                                </div>
                                <span class="ap-chart-label">{{ $stat['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Monthly Chart --}}
            <div class="ap-card">
                <div class="ap-card-header">
                    <h3 class="ap-card-title">Tren Bulanan</h3>
                    <span class="ap-card-badge">4 Minggu Terakhir</span>
                </div>
                <div class="ap-chart-container">
                    @php $maxM = collect($monthlyStats)->max('count') ?: 1; @endphp
                    <div class="ap-chart">
                        @foreach($monthlyStats as $stat)
                            <div class="ap-chart-col">
                                <span class="ap-chart-val">{{ $stat['count'] }}</span>
                                <div class="ap-chart-bar" style="height: {{ ($stat['count'] / $maxM) * 100 }}%">
                                </div>
                                <span class="ap-chart-label">{{ $stat['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Categories & Ranking --}}
        <div class="ap-grid-v2">
            {{-- Top Violations --}}
            <div class="ap-card-v2">
                <div class="ap-card-header-v2">
                    <h3 class="ap-card-title-v2">Pelanggaran Terbanyak</h3>
                </div>
                <div class="ap-list">
                    @foreach($topViolations as $v)
                        <div class="ap-list-item">
                            <div class="flex-1 min-w-0">
                                <p class="ap-item-title">{{ $v->nama }}</p>
                                <div class="ap-progress-bg">
                                    <div class="ap-progress-bar" style="width: {{ ($v->total_count / ($topViolations->first()->total_count ?: 1)) * 100 }}%"></div>
                                </div>
                            </div>
                            <span class="ap-item-val">{{ $v->total_count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Class Leaderboard --}}
            <div class="ap-card-v2">
                <div class="ap-card-header-v2">
                    <h3 class="ap-card-title-v2">Kelas Terbersih</h3>
                </div>
                <div class="ap-list">
                    @foreach($classRanking as $index => $rank)
                        <div class="ap-list-item">
                            <div class="ap-rank-num {{ $index < 3 ? 'top-rank' : '' }}">{{ $index + 1 }}</div>
                            <div class="flex-1">
                                <p class="ap-item-title-v2">{{ $rank->kelas }}</p>
                                <p class="ap-item-sub">{{ $rank->total_kasus }} Kasus</p>
                            </div>
                            <div class="text-right">
                                <span class="ap-item-val-v2">{{ (int)$rank->total_poin }}</span>
                                <p class="text-[10px] font-bold text-slate-400">POIN</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        @media (max-width: 1023px) { 
            .fi-topbar { display: none !important; }
            .fi-sidebar, .fi-sidebar-close-overlay { display: none !important; }
        }

        .ap-wrapper { font-family: 'Inter', sans-serif; background: #fdfdfd; min-height: 100vh; margin: -1.5rem; }
        @media (min-width: 1024px) {
            .ap-wrapper { margin: 0; background: transparent; min-height: auto; }
        }

        .ap-main { max-width: 1000px; margin: 0 auto; padding: 1rem 1.5rem 100px; }
        @media (min-width: 1024px) { .ap-main { padding: 2rem 0 100px; } }

        .ap-header { margin-bottom: 2rem; }
        .ap-eyebrow { font-size: 11px; font-weight: 800; color: #515c71; text-transform: uppercase; letter-spacing: 0.12em; }
        .ap-title { font-size: 32px; font-weight: 900; color: #1e293b; letter-spacing: -0.04em; margin-top: 4px; }
        .ap-subtitle { font-size: 13px; color: #64748b; margin-top: 4px; }

        .ap-grid { display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        @media (min-width: 768px) { .ap-grid { grid-template-columns: 1fr 1fr; } }

        .ap-card { background: white; border-radius: 24px; padding: 1.5rem; border: 1.5px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
        .ap-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .ap-card-title { font-size: 14px; font-weight: 800; color: #1e293b; }
        .ap-card-badge { font-size: 10px; font-weight: 700; background: #f1f5f9; color: #64748b; padding: 3px 10px; border-radius: 99px; }

        .ap-chart-container { height: 160px; display: flex; align-items: flex-end; }
        .ap-chart { display: flex; width: 100%; height: 100%; align-items: flex-end; gap: 8px; }
        .ap-chart-col { flex: 1; display: flex; flex-direction: column; align-items: center; height: 100%; justify-content: flex-end; gap: 4px; }
        .ap-chart-val { font-size: 10px; font-weight: 800; color: #515c71; margin-bottom: 4px; }
        .ap-chart-bar { width: 100%; background: #eceef2; border-radius: 6px 6px 2px 2px; transition: all 0.5s ease; min-height: 4px; }
        .ap-chart-bar.active { background: #515c71; }
        .ap-chart-label { font-size: 10px; font-weight: 700; color: #94a3b8; margin-top: 4px; text-transform: uppercase; }

        .ap-grid-v2 { display: grid; grid-template-columns: 1fr; gap: 1.5rem; }
        @media (min-width: 768px) { .ap-grid-v2 { grid-template-columns: 1fr 1fr; } }
        
        .ap-card-v2 { background: white; border-radius: 24px; border: 1.5px solid #f1f5f9; overflow: hidden; }
        .ap-card-header-v2 { padding: 1.5rem 1.5rem 1rem; border-bottom: 1.5px solid #f1f5f9; }
        .ap-card-title-v2 { font-size: 15px; font-weight: 800; color: #1e293b; }
        
        .ap-list { padding: 0.5rem; }
        .ap-list-item { display: flex; align-items: center; gap: 12px; padding: 12px 1rem; border-radius: 16px; transition: background 0.2s; }
        .ap-list-item:hover { background: #f8fafc; }
        
        .ap-item-title { font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
        .ap-progress-bg { height: 4px; background: #f1f5f9; border-radius: 2px; width: 100%; }
        .ap-progress-bar { height: 100%; background: #515c71; border-radius: 2px; }
        .ap-item-val { font-size: 14px; font-weight: 900; color: #1e293b; }

        .ap-rank-num { width: 32px; height: 32px; border-radius: 10px; background: #f1f5f9; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 800; flex-shrink: 0; }
        .ap-rank-num.top-rank { background: #515c71; color: white; }
        
        .ap-item-title-v2 { font-size: 14px; font-weight: 800; color: #1e293b; }
        .ap-item-sub { font-size: 11px; font-weight: 600; color: #94a3b8; }
        .ap-item-val-v2 { font-size: 18px; font-weight: 900; color: #1e293b; line-height: 1; }
    </style>
</div>
