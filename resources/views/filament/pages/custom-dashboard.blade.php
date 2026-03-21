<div>
    @php
        $dayLabels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        $todayIndex = now()->dayOfWeekIso - 1; // 0=Senin
    @endphp

    {{-- Custom Dashboard - Material Design 3 Style --}}
    <div class="custom-dashboard">

        {{-- Top App Bar --}}
        <x-md3-top-bar 
            :title="$appName" 
            :subtitle="$instansiName" 
            icon="dashboard" 
            :user="$user" 
        />

        {{-- Content --}}
        <main class="cd-main">

            {{-- Bento Grid --}}
            <section class="cd-bento">
                {{-- Main Stat Card --}}
                <div class="cd-card-main">
                    <div class="space-y-1">
                        <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">Pelanggaran Minggu Ini
                        </p>
                        <h2 class="text-5xl font-extrabold tracking-tight text-slate-900">{{ $weeklyTotal }}</h2>
                        <p class="text-sm text-slate-400">Total pelanggaran aktif tercatat minggu ini</p>
                    </div>
                    {{-- Bar Chart --}}
                    <div class="cd-chart">
                        @foreach($dailyCounts as $i => $count)
                            <div class="cd-chart-col">
                                <div class="cd-chart-bar {{ $i === $todayIndex ? 'cd-chart-bar-active' : '' }}"
                                    style="height: {{ $maxDaily > 0 ? max(($count / $maxDaily) * 100, 8) : 8 }}%"></div>
                                <span class="cd-chart-label">{{ $dayLabels[$i] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Severity Breakdown --}}
                <div class="cd-cards-side">
                    <div class="cd-stat-card">
                        <div>
                            <p class="cd-stat-label">Pending</p>
                            <p class="text-2xl font-bold text-amber-600">{{ $pending }}</p>
                        </div>
                        <div class="cd-stat-icon bg-amber-50">
                            <span class="material-symbols-outlined text-amber-500">schedule</span>
                        </div>
                    </div>
                    <div class="cd-stat-card">
                        <div>
                            <p class="cd-stat-label">Selesai</p>
                            <p class="text-2xl font-bold text-emerald-600">{{ $selesai }}</p>
                        </div>
                        <div class="cd-stat-icon bg-emerald-50">
                            <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                        </div>
                    </div>
                    <div class="cd-stat-card">
                        <div>
                            <p class="cd-stat-label">Dikecualikan</p>
                            <p class="text-2xl font-bold text-slate-500">{{ $dikecualikan }}</p>
                        </div>
                        <div class="cd-stat-icon bg-slate-100">
                            <span class="material-symbols-outlined text-slate-400">block</span>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Recent Activity --}}
            <section class="cd-section">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold tracking-tight text-slate-900">Aktivitas Terbaru</h3>
                    <a href="/admin/pelanggaran-siswas"
                        class="text-sm font-semibold text-[#515c71] hover:underline">Lihat
                        semua</a>
                </div>

                <div class="cd-activity-list">
                    {{-- Activity Items --}}
                    @forelse($recentViolations as $v)
                            <a href="/admin/pelanggaran-siswas/{{ $v->id }}/edit" class="cd-activity-item-v2"
                                style="text-decoration:none; color:inherit; display:block;">
                                <div class="flex items-center gap-3 min-w-0 flex-1">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-slate-100 flex-shrink-0 flex items-center justify-center text-xs font-bold text-slate-500">
                                        {{ strtoupper(substr($v->siswa->nama ?? '?', 0, 2)) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center justify-between gap-2">
                                            <span
                                                class="font-semibold text-slate-800 text-sm truncate">{{ $v->siswa->nama ?? '-' }}</span>
                                            @if($v->status === 'pending')
                                                <span class="cd-badge cd-badge-pending flex-shrink-0">Pending</span>
                                            @elseif($v->status === 'selesai')
                                                <span class="cd-badge cd-badge-selesai flex-shrink-0">Selesai</span>
                                            @else
                                                <span class="cd-badge cd-badge-gray flex-shrink-0">Dikecualikan</span>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-1.5 mt-0.5">
                                            <span class="text-xs text-slate-400">{{ $v->siswa->kelas ?? '-' }}</span>
                                            <span class="text-slate-300">·</span>
                                            <span
                                                class="text-xs text-slate-400 truncate">{{ $v->barcode?->jenisPelanggaran?->nama ?? '-' }}</span>
                                            <span class="text-slate-300">·</span>
                                            <span
                                                class="text-xs text-slate-400 flex-shrink-0">{{ $v->scan_at?->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                        </a>
                    @empty
                    <div class="px-6 py-12 text-center text-slate-400 text-sm">
                        <span class="material-symbols-outlined text-3xl mb-2 block">inbox</span>
                        Belum ada pelanggaran tercatat.
                    </div>
                @endforelse
    </div>
    </section>
    </main>

    {{-- Floating Action Button --}}
    <a href="/admin/barcode-harians/create" class="cd-fab">
        <span class="material-symbols-outlined">add</span>
    </a>
</div>

<style>
    /* ===== CUSTOM DASHBOARD STYLES ===== */

    /* Hide Filament's default header & breadcrumb on this page */
    .fi-page-header {
        display: none !important;
    }

    /* Main content area */
    .cd-main {
        padding: 1rem 1.5rem;
        padding-bottom: 7rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Bento Grid */
    .cd-bento {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    @media (min-width: 768px) {
        .cd-bento {
            grid-template-columns: 2fr 1fr;
        }
    }

    .cd-card-main {
        background: white;
        padding: 2rem;
        border-radius: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 260px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .cd-cards-side {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .cd-stat-card {
        background: #f0f2f4;
        padding: 1.25rem 1.5rem;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .cd-stat-label {
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #6b7280;
    }

    .cd-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Bar Chart */
    .cd-chart {
        display: flex;
        align-items: flex-end;
        gap: 0.5rem;
        height: 100px;
        margin-top: 1.5rem;
    }

    .cd-chart-col {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.375rem;
        height: 100%;
        justify-content: flex-end;
    }

    .cd-chart-bar {
        width: 100%;
        background: #e6e8ea;
        border-radius: 4px 4px 0 0;
        transition: height 0.4s ease;
    }

    .cd-chart-bar-active {
        background: #6a758a;
    }

    .cd-chart-label {
        font-size: 10px;
        font-weight: 600;
        color: #9ca3af;
    }

    /* Sections */
    .cd-section {
        margin-bottom: 2rem;
    }

    /* Activity List */
    .cd-activity-list {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .cd-activity-item-v2 {
        padding: 0.875rem 1.25rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        transition: background 0.15s;
    }

    .cd-activity-item-v2:hover {
        background: #fafbfc;
    }

    .cd-activity-item-v2:last-child {
        border-bottom: none;
    }

    /* Badges */
    .cd-badge {
        display: inline-flex;
        padding: 3px 10px;
        border-radius: 99px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: -0.02em;
    }

    .cd-badge-pending {
        background: #FEF3C7;
        color: #92400E;
    }

    .cd-badge-selesai {
        background: #DCFCE7;
        color: #166534;
    }

    .cd-badge-gray {
        background: #F3F4F6;
        color: #6B7280;
    }

    /* FAB */
    .cd-fab {
        position: fixed;
        right: 1.5rem;
        bottom: 6rem;
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #515c71, #6a758a);
        color: white;
        border-radius: 1rem;
        box-shadow: 0 4px 14px rgba(81, 92, 113, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 40;
        transition: transform 0.15s;
        text-decoration: none;
    }

    .cd-fab:hover {
        transform: scale(1.05);
    }

    .cd-fab:active {
        transform: scale(0.92);
    }

    @media (min-width: 1024px) {
        .cd-topbar {
            display: none;
        }

        .cd-fab {
            display: none;
        }

        .custom-dashboard {
            margin: -1.5rem -1.5rem 0 -1.5rem;
        }
    }
</style>

{{-- Material Symbols (diinject sekali) --}}
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
    rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</div>