<div class="ap-wrapper md3-animate-page">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <x-md3-top-bar :title="$appName" :subtitle="$instansiName" icon="analytics" :user="$user" />

    <main class="ap-main">
        {{-- Header --}}
        <section class="ap-header">
            <div>
                <span class="ap-eyebrow">Laporan Analitik</span>
                <h2 class="ap-title">Statistik Sekolah</h2>
                <p class="ap-subtitle">Data kedisiplinan siswa berbasis waktu dan kategori.</p>
            </div>
            <div class="ap-header-filters">
                <div class="ap-filter-group">
                    <label>Dari Tanggal</label>
                    <input type="date" wire:model.live="dateFrom">
                </div>
                <div class="ap-filter-group">
                    <label>Sampai Tanggal</label>
                    <input type="date" wire:model.live="dateTo">
                </div>
            </div>
        </section>

        {{-- Trends Section --}}
        <div class="ap-trend-section" 
             x-data="chartManager(@js($dailyStats))"
             x-init="initCharts()"
             x-effect="updateCharts(@js($dailyStats))">
            {{-- Trend Utama --}}
            <div class="ap-card ap-full-width">
                <div class="ap-card-header">
                    <h3 class="ap-card-title">Tren Pelanggaran</h3>
                    <span class="ap-card-badge">Periode Terpilih</span>
                </div>
                <div class="ap-chart-container-v2">
                    <canvas id="mainTrendChart"></canvas>
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
                                    <div class="ap-progress-bar"
                                        style="width: {{ ($v->total_count / ($topViolations->first()->total_count ?: 1)) * 100 }}%">
                                    </div>
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
                                <span class="ap-item-val-v2">{{ (int) $rank->total_poin }}</span>
                                <p class="text-[10px] font-bold text-slate-400">POIN</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Statistik Alasan Pelanggaran --}}
        <div class="ap-alasan-card">
            <div class="ap-alasan-header">
                <div>
                    <h3 class="ap-alasan-title">Alasan Pelanggaran Terbanyak</h3>
                    <p style="font-size:11px; color:#94a3b8; margin-top:2px;">Berdasarkan alasan yang dipilih siswa saat
                        konfirmasi</p>
                </div>
                <div class="ap-alasan-filter">
                    <select wire:model.live="filterJenis">
                        <option value="">Semua Jenis Pelanggaran</option>
                        @foreach($jenisList as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if($topAlasan->isEmpty())
                <div class="ap-empty-state">
                    Belum ada data alasan yang tercatat pada periode ini.
                </div>
            @else
                <table class="ap-alasan-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Alasan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $maxAlasan = $topAlasan->first()->total ?: 1; @endphp
                        @foreach($topAlasan as $index => $item)
                            <tr>
                                <td style="width:56px;">
                                    <span class="ap-alasan-rank {{ $index < 3 ? 'top' : '' }}">{{ $index + 1 }}</span>
                                </td>
                                <td>
                                    <div style="font-weight:700; margin-bottom:5px;">{{ $item->alasan }}</div>
                                    <div class="ap-progress-bg" style="max-width:320px;">
                                        <div class="ap-progress-bar" style="width: {{ ($item->total / $maxAlasan) * 100 }}%">
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->total }}×</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </main>

    <style>
        .fi-page-header,
        .fi-page-header+div {
            display: none !important;
        }

        @media (max-width: 1023px) {
            .fi-topbar {
                display: none !important;
            }

            .fi-sidebar,
            .fi-sidebar-close-overlay {
                display: none !important;
            }
        }

        .ap-wrapper {
            font-family: 'Inter', sans-serif;
            background: #fdfdfd;
            min-height: 100vh;
            margin: -1.5rem;
        }

        @media (min-width: 1024px) {
            .ap-wrapper {
                margin: 0;
                background: transparent;
                min-height: auto;
            }
        }

        .ap-main {
            max-width: 1000px;
            margin: 0 auto;
            padding: 1rem 1.5rem 100px;
        }

        @media (min-width: 1024px) {
            .ap-main {
                padding: 2rem 0 100px;
            }
        }

        .ap-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .ap-eyebrow {
            font-size: 11px;
            font-weight: 800;
            color: #515c71;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }

        .ap-title {
            font-size: 32px;
            font-weight: 900;
            color: #1e293b;
            letter-spacing: -0.04em;
            margin-top: 4px;
        }

        .ap-subtitle {
            font-size: 13px;
            color: #64748b;
            margin-top: 4px;
        }

        .ap-header-filters {
            display: flex;
            gap: 1rem;
            background: #f8fafc;
            padding: 12px 16px;
            border-radius: 16px;
            border: 1.5px solid #f1f5f9;
        }

        .ap-filter-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .ap-filter-group label {
            font-size: 10px;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
        }

        .ap-filter-group input {
            background: white;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 4px 8px;
            font-size: 12px;
            font-weight: 700;
            color: #1e293b;
            outline: none;
        }

        .ap-card {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            border: 1.5px solid #f1f5f9;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .ap-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .ap-card-title {
            font-size: 14px;
            font-weight: 800;
            color: #1e293b;
        }

        .ap-card-badge {
            font-size: 10px;
            font-weight: 700;
            background: #f1f5f9;
            color: #64748b;
            padding: 3px 10px;
            border-radius: 99px;
        }

        .ap-trend-section {
            margin-bottom: 2rem;
            margin-top: 1rem;
        }

        .ap-full-width {
            grid-column: 1 / -1;
        }

        .ap-chart-container-v2 {
            position: relative;
            height: 320px;
            width: 100%;
        }

        .ap-grid-v2 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .ap-grid-v2 {
                grid-template-columns: 1fr 1fr;
            }
        }

        .ap-card-v2 {
            background: white;
            border-radius: 24px;
            border: 1.5px solid #f1f5f9;
            overflow: hidden;
        }

        .ap-card-header-v2 {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1.5px solid #f1f5f9;
        }

        .ap-card-title-v2 {
            font-size: 15px;
            font-weight: 800;
            color: #1e293b;
        }

        .ap-list {
            padding: 0.5rem;
        }

        .ap-list-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 1rem;
            border-radius: 16px;
            transition: background 0.2s;
        }

        .ap-list-item:hover {
            background: #f8fafc;
        }

        .ap-item-title {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .ap-progress-bg {
            height: 4px;
            background: #f1f5f9;
            border-radius: 2px;
            width: 100%;
        }

        .ap-progress-bar {
            height: 100%;
            background: #515c71;
            border-radius: 2px;
        }

        .ap-item-val {
            font-size: 14px;
            font-weight: 900;
            color: #1e293b;
        }

        .ap-rank-num {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .ap-rank-num.top-rank {
            background: #515c71;
            color: white;
        }

        .ap-item-title-v2 {
            font-size: 14px;
            font-weight: 800;
            color: #1e293b;
        }

        .ap-item-sub {
            font-size: 11px;
            font-weight: 600;
            color: #94a3b8;
        }

        .ap-item-val-v2 {
            font-size: 18px;
            font-weight: 900;
            color: #1e293b;
            line-height: 1;
        }

        .ap-alasan-card {
            background: white;
            border-radius: 24px;
            border: 1.5px solid #f1f5f9;
            overflow: hidden;
            margin-top: 1.5rem;
        }

        .ap-alasan-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1.5px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .ap-alasan-title {
            font-size: 15px;
            font-weight: 800;
            color: #1e293b;
        }

        .ap-alasan-filter select {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 6px 12px;
            outline: none;
            cursor: pointer;
        }

        .ap-alasan-table {
            width: 100%;
            border-collapse: collapse;
        }

        .ap-alasan-table th {
            font-size: 10px;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 10px 1.5rem;
            text-align: left;
            background: #fafafa;
        }

        .ap-alasan-table th:last-child {
            text-align: right;
        }

        .ap-alasan-table td {
            padding: 12px 1.5rem;
            border-top: 1px solid #f1f5f9;
            font-size: 13px;
            color: #1e293b;
            vertical-align: middle;
        }

        .ap-alasan-table td:last-child {
            text-align: right;
            font-weight: 900;
            color: #1e293b;
        }

        .ap-alasan-table tr:hover td {
            background: #f8fafc;
        }

        .ap-alasan-rank {
            display: inline-flex;
            width: 26px;
            height: 26px;
            border-radius: 8px;
            background: #f1f5f9;
            color: #64748b;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 800;
        }

        .ap-alasan-rank.top {
            background: #515c71;
            color: white;
        }

        .ap-empty-state {
            padding: 2.5rem;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            font-weight: 600;
        }
    </style>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('chartManager', (initialData) => ({
                chart: null,
                initCharts() {
                    const ctx = document.getElementById('mainTrendChart').getContext('2d');
                    this.chart = new Chart(ctx, {
                        type: 'line',
                        data: this.formatData(initialData),
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#1e293b',
                                    titleFont: { weight: 'bold' },
                                    padding: 12,
                                    cornerRadius: 12,
                                    displayColors: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: { stepSize: 1, color: '#94a3b8', font: { weight: 'bold', size: 10 } },
                                    grid: { color: '#f1f5f9' }
                                },
                                x: {
                                    ticks: { color: '#94a3b8', font: { weight: 'bold', size: 10 } },
                                    grid: { display: false }
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index',
                            },
                        }
                    });
                },
                formatData(data) {
                    return {
                        labels: data.map(d => d.label),
                        datasets: [{
                            label: 'Jumlah Pelanggaran',
                            data: data.map(d => d.count),
                            borderColor: '#515c71',
                            backgroundColor: 'rgba(81, 92, 113, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointBackgroundColor: '#fff',
                            pointBorderColor: '#515c71',
                            pointBorderWidth: 2
                        }]
                    };
                },
                updateCharts(newData) {
                    if (this.chart) {
                        this.chart.data = this.formatData(newData);
                        this.chart.update();
                    }
                }
            }));
        });
    </script>
</div>