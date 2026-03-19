<div>
    @php
        $setting = \App\Models\Setting::first();
        $appName = $setting->app_name ?? 'Sistem Pelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
    @endphp

    {{-- Custom Rekap Pelanggaran - Material Design 3 --}}
    <div class="rp-wrapper">

        {{-- TopAppBar --}}
        <header class="rp-topbar">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-slate-700" style="font-size:28px">gavel</span>
                <div>
                    <h1 class="text-lg font-bold tracking-tight text-slate-900">{{ $appName }}</h1>
                    <p class="text-[11px] text-slate-400 font-medium -mt-0.5">{{ $instansiName }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-full bg-[#6a758a] flex items-center justify-center text-white font-bold text-xs shadow-sm">
                    {{ strtoupper(substr($user->name ?? 'AD', 0, 2)) }}
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="rp-main">

            {{-- Editorial Header --}}
            <section class="rp-header-section">
                <div class="rp-header-content">
                    <div>
                        <span class="rp-eyebrow">Catatan Administrasi</span>
                        <h2 class="rp-title">Rekap Pelanggaran</h2>
                    </div>
                    {{-- Search Bar --}}
                    <div class="rp-search-bar">
                        <div class="rp-search-input-wrap">
                            <span class="material-symbols-outlined rp-search-icon">search</span>
                            <input
                                type="text"
                                wire:model.live.debounce.400ms="search"
                                class="rp-search-input"
                                placeholder="Cari siswa atau jenis pelanggaran..."
                            />
                        </div>
                    </div>
                </div>
            </section>

            {{-- Violation List --}}
            <div class="rp-list">
                @forelse ($pelanggaran as $item)
                    @php
                        $nilai = $item->nilai ?? 0;
                        if ($nilai >= 10) {
                            $severityLabel = 'Berat';
                            $severityClass = 'rp-badge-high';
                        } elseif ($nilai >= 5) {
                            $severityLabel = 'Sedang';
                            $severityClass = 'rp-badge-medium';
                        } else {
                            $severityLabel = 'Ringan';
                            $severityClass = 'rp-badge-low';
                        }

                        $statusLabel = match($item->status) {
                            'pending' => 'Pending',
                            'selesai' => 'Selesai',
                            'dikecualikan' => 'Dikecualikan',
                            default => $item->status,
                        };
                        $statusClass = match($item->status) {
                            'pending' => 'rp-status-pending',
                            'selesai' => 'rp-status-selesai',
                            'dikecualikan' => 'rp-status-gray',
                            default => 'rp-status-gray',
                        };
                    @endphp

                    <a href="/admin/pelanggaran-siswas/{{ $item->id }}/edit" class="rp-card" style="text-decoration:none; color:inherit;">
                        <div class="rp-card-left">
                            <div class="rp-avatar">
                                {{ strtoupper(substr($item->siswa->nama ?? '?', 0, 2)) }}
                            </div>
                            <div class="rp-card-info">
                                <div class="rp-card-name-row">
                                    <h3 class="rp-card-name">{{ $item->siswa->nama ?? '-' }}</h3>
                                    <span class="rp-kelas-badge">{{ $item->siswa->kelas ?? '-' }}</span>
                                </div>
                                <p class="rp-card-meta">
                                    {{ $item->scan_at?->translatedFormat('d M Y') }} • {{ $item->scan_at?->format('H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="rp-card-right">
                            <div class="rp-card-type">
                                <span class="rp-type-label">Jenis</span>
                                <span class="rp-type-value">{{ $item->barcode?->jenisPelanggaran?->nama ?? '-' }}</span>
                            </div>
                            <div class="rp-badges">
                                <span class="rp-badge {{ $severityClass }}">{{ $severityLabel }}</span>
                                <span class="rp-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="rp-empty">
                        <span class="material-symbols-outlined" style="font-size:48px; color:#c2c6d6;">inbox</span>
                        <p>Belum ada data pelanggaran tercatat.</p>
                    </div>
                @endforelse
            </div>

            {{-- End of records --}}
            @if ($pelanggaran->count() > 0)
                <div class="rp-end-text">
                    <p>Menampilkan {{ $pelanggaran->count() }} catatan pelanggaran</p>
                </div>
            @endif
        </main>

        {{-- FAB - Add New Record --}}
        <a href="/admin/pelanggaran-siswas/create" class="rp-fab">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0, 'wght' 600;">add</span>
        </a>
    </div>

    <style>
        /* ===== REKAP PELANGGARAN STYLES ===== */

        /* Hide Filament's default header & breadcrumb */
        .fi-page-header { display: none !important; }

        /* Hide Filament topbar on mobile */
        @media (max-width: 1023px) {
            .fi-topbar { display: none !important; }
        }

        .rp-wrapper {
            font-family: 'Inter', sans-serif;
            margin: -1.5rem;
        }

        /* Top Bar */
        .rp-topbar {
            position: sticky;
            top: 0;
            z-index: 45;
            background: rgba(248, 250, 252, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
        }

        /* Main Content */
        .rp-main {
            padding: 1.5rem;
            padding-bottom: 7rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Editorial Header */
        .rp-header-section {
            margin-bottom: 2rem;
            margin-top: 2rem;
        }
        .rp-header-content {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        @media (min-width: 768px) {
            .rp-header-content {
                flex-direction: row;
                align-items: flex-end;
                justify-content: space-between;
            }
        }
        .rp-eyebrow {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #727785;
            display: block;
            margin-bottom: 0.25rem;
        }
        .rp-title {
            font-family: 'Inter', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: #191c1e;
            line-height: 1.1;
        }

        /* Search */
        .rp-search-bar {
            flex-shrink: 0;
        }
        .rp-search-input-wrap {
            position: relative;
            width: 100%;
        }
        @media (min-width: 768px) {
            .rp-search-input-wrap { width: 280px; }
        }
        .rp-search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #727785;
            pointer-events: none;
        }
        .rp-search-input {
            width: 100%;
            background: #eceef0;
            border: 2px solid transparent;
            border-radius: 14px;
            padding: 12px 16px 12px 42px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #191c1e;
            outline: none;
            transition: all 0.2s;
        }
        .rp-search-input:focus {
            border-color: rgba(81, 92, 113, 0.3);
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(81, 92, 113, 0.08);
        }
        .rp-search-input::placeholder {
            color: #727785;
        }

        /* Card List */
        .rp-list {
            display: flex;
            flex-direction: column;
            gap: 0.625rem;
        }
        .rp-card {
            background: #ffffff;
            border-radius: 1rem;
            padding: 1.125rem 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.875rem;
            transition: transform 0.12s, box-shadow 0.15s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            cursor: pointer;
        }
        @media (min-width: 768px) {
            .rp-card {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }
        .rp-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
            transform: translateY(-1px);
        }
        .rp-card:active {
            transform: scale(0.985);
        }

        /* Card Left */
        .rp-card-left {
            display: flex;
            align-items: flex-start;
            gap: 0.875rem;
        }
        .rp-avatar {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: #eceef0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #727785;
            flex-shrink: 0;
        }
        .rp-card-info {
            min-width: 0;
        }
        .rp-card-name-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .rp-card-name {
            font-size: 15px;
            font-weight: 600;
            color: #191c1e;
            margin: 0;
        }
        .rp-kelas-badge {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            background: #eceef0;
            color: #424754;
            padding: 2px 8px;
            border-radius: 4px;
        }
        .rp-card-meta {
            font-size: 12px;
            font-weight: 500;
            color: #727785;
            margin-top: 3px;
        }

        /* Card Right */
        .rp-card-right {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        @media (min-width: 768px) {
            .rp-card-right {
                justify-content: flex-end;
                min-width: 280px;
            }
        }

        .rp-card-type {
            display: none;
        }
        @media (min-width: 768px) {
            .rp-card-type {
                display: block;
                text-align: right;
                margin-right: 0.5rem;
            }
        }
        .rp-type-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #c2c6d6;
            display: block;
        }
        .rp-type-value {
            font-size: 13px;
            font-weight: 600;
            color: #191c1e;
        }

        /* Badges */
        .rp-badges {
            display: flex;
            gap: 0.375rem;
            flex-shrink: 0;
            flex-wrap: wrap;
        }
        .rp-badge {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            padding: 4px 12px;
            border-radius: 100px;
            white-space: nowrap;
        }

        /* Severity Badges */
        .rp-badge-high {
            background: rgba(182, 23, 34, 0.1);
            color: #b61722;
        }
        .rp-badge-medium {
            background: rgba(81, 92, 113, 0.1);
            color: #515c71;
        }
        .rp-badge-low {
            background: rgba(80, 95, 118, 0.08);
            color: #505f76;
        }

        /* Status Badges */
        .rp-status-pending {
            background: #FEF3C7;
            color: #92400E;
        }
        .rp-status-selesai {
            background: #DCFCE7;
            color: #166534;
        }
        .rp-status-gray {
            background: #F3F4F6;
            color: #6B7280;
        }

        /* Empty State */
        .rp-empty {
            text-align: center;
            padding: 4rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
        }
        .rp-empty p {
            font-size: 14px;
            font-weight: 500;
            color: #727785;
        }

        /* End Text */
        .rp-end-text {
            text-align: center;
            padding: 2.5rem 1rem;
        }
        .rp-end-text p {
            font-size: 13px;
            font-weight: 500;
            font-style: italic;
            color: #727785;
            opacity: 0.6;
        }

        /* FAB */
        .rp-fab {
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
        .rp-fab:hover { transform: scale(1.05); }
        .rp-fab:active { transform: scale(0.92); }

        /* Desktop: hide mobile-only elements */
        @media (min-width: 1024px) {
            .rp-topbar { display: none; }
            .rp-fab { display: none; }
            .rp-wrapper { margin: -1.5rem -1.5rem 0 -1.5rem; }
        }
    </style>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</div>
