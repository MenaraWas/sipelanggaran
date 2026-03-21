<div>
    <div class="ds-wrapper">

        <x-md3-top-bar 
        :title="$appName" 
        :subtitle="$instansiName" 
        icon="groups" 
        :user="$user" 
    />

        {{-- Main Content --}}
        <main class="ds-main">

            {{-- Page Header --}}
            <section class="ds-page-header">
                <div class="ds-page-header-left">
                    <span class="ds-eyebrow">Database Siswa</span>
                    <h2 class="ds-title">Daftar Siswa</h2>
                    <p class="ds-subtitle">Tahun Pelajaran 2023/2024</p>
                </div>

                {{-- Search --}}
                <div class="ds-search-wrap">
                    <div class="ds-search-inner">
                        <svg class="ds-search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input
                            type="text"
                            wire:model.live.debounce.400ms="search"
                            class="ds-search-input"
                            placeholder="Cari nama, NIS, atau kelas..."
                        />
                    </div>
                </div>
            </section>

            {{-- Mobile Action Buttons --}}
            <div class="ds-mobile-actions">
                <button class="ds-btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="18" height="18">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>
                    Filter
                </button>
                <a href="/admin/siswas/create" class="ds-btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="18" height="18">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Siswa Baru
                </a>
            </div>

            {{-- Student List --}}
            <div class="ds-list">
                @forelse ($siswas as $siswa)
                    @php
                        $vCount = $siswa->pelanggaran_count ?? 0;
                        if ($vCount > 10) {
                            $badgeClass = 'ds-badge-high';
                            $badgeLabel = 'Tinggi';
                        } elseif ($vCount > 0) {
                            $badgeClass = 'ds-badge-medium';
                            $badgeLabel = 'Ada';
                        } else {
                            $badgeClass = 'ds-badge-low';
                            $badgeLabel = 'Bersih';
                        }
                    @endphp

                    <a href="/admin/siswas/{{ $siswa->id }}/edit" class="ds-card">
                        <div class="ds-card-top">
                            <div class="ds-card-identity">
                                <span class="ds-student-nis">NIS {{ $siswa->nis }}</span>
                                <h3 class="ds-student-name">{{ $siswa->nama }}</h3>
                            </div>
                            <div class="ds-violation-badge {{ $badgeClass }}">
                                {{ $vCount }} &nbsp;pelanggaran
                            </div>
                        </div>

                        <div class="ds-card-details">
                            <div class="ds-detail-item">
                                <span class="ds-detail-label">Kelas</span>
                                <span class="ds-detail-value">{{ $siswa->kelas }}</span>
                            </div>
                            <div class="ds-detail-divider"></div>
                            <div class="ds-detail-item">
                                <span class="ds-detail-label">Jurusan</span>
                                <span class="ds-detail-value">{{ $siswa->jurusan }}</span>
                            </div>
                            <div class="ds-card-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="16" height="16">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="ds-empty">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" width="48" height="48">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="ds-empty-title">Tidak ada siswa ditemukan</p>
                        <p class="ds-empty-sub">Coba ubah kata kunci pencarian</p>
                    </div>
                @endforelse
            </div>

            {{-- Footer count --}}
            @if ($siswas->count() > 0)
                <p class="ds-count-text">Menampilkan {{ $siswas->count() }} siswa</p>
            @endif

        </main>

        {{-- FAB --}}
        <a href="/admin/siswas/create" class="ds-fab" title="Tambah Siswa Baru">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" width="22" height="22">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </a>

    </div>

    <style>
        /* ── RESET FILAMENT ── */
        .fi-page-header,
        .fi-page-header + div { display: none !important; }
        @media (max-width: 1023px) {
            .fi-topbar { display: none !important; }
        }

        /* ── WRAPPER ── */
        .ds-wrapper {
            font-family: 'Inter', 'DM Sans', sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            margin: -1.5rem;
            -webkit-font-smoothing: antialiased;
        }

        /* ── MAIN ── */
        .ds-main {
            max-width: 860px;
            margin: 0 auto;
            padding: 28px 20px 120px;
        }

        @media (min-width: 768px) {
            .ds-main { padding: 40px 32px 100px; }
        }

        @media (min-width: 1024px) {
            .ds-topbar { display: none; }
            .ds-wrapper { margin: -1.5rem -1.5rem 0; }
            .ds-main { padding: 40px 40px 80px; }
        }

        /* ── PAGE HEADER ── */
        .ds-page-header {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 24px;
        }

        @media (min-width: 640px) {
            .ds-page-header {
                flex-direction: row;
                align-items: flex-end;
                justify-content: space-between;
                gap: 24px;
            }
        }

        .ds-eyebrow {
            display: block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #515c71;
            margin-bottom: 6px;
        }

        .ds-title {
            font-size: clamp(28px, 6vw, 36px);
            font-weight: 900;
            letter-spacing: -0.04em;
            color: #191c1e;
            line-height: 1;
        }

        .ds-subtitle {
            font-size: 12px;
            color: #9da3ae;
            font-weight: 500;
            margin-top: 5px;
        }

        /* ── SEARCH ── */
        .ds-search-wrap { flex-shrink: 0; width: 100%; }

        @media (min-width: 640px) {
            .ds-search-wrap { width: 300px; }
        }

        .ds-search-inner {
            position: relative;
            width: 100%;
        }

        .ds-search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px; height: 18px;
            color: #9da3ae;
            pointer-events: none;
        }

        .ds-search-input {
            width: 100%;
            background: #eceef2;
            border: 2px solid transparent;
            border-radius: 14px;
            padding: 11px 16px 11px 44px;
            font-size: 14px;
            font-weight: 500;
            color: #191c1e;
            outline: none;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .ds-search-input::placeholder { color: #b0b6c0; font-weight: 400; }

        .ds-search-input:focus {
            background: #ffffff;
            border-color: #515c71;
            box-shadow: 0 0 0 4px rgba(81, 92, 113, 0.08);
        }

        /* ── MOBILE ACTIONS ── */
        .ds-mobile-actions {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        @media (min-width: 768px) {
            .ds-mobile-actions { display: none; }
        }

        .ds-btn-outline {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 16px;
            background: white;
            border: 1.5px solid #e0e3e8;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            color: #515c71;
            cursor: pointer;
            transition: all 0.15s;
            font-family: inherit;
        }

        .ds-btn-outline:active { transform: scale(0.97); }

        .ds-btn-primary {
            flex: 2;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 20px;
            background: #515c71;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            transition: all 0.15s;
        }

        .ds-btn-primary:hover { background: #3e4a5e; }
        .ds-btn-primary:active { transform: scale(0.97); }

        /* ── LIST ── */
        .ds-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* ── CARD ── */
        .ds-card {
            display: block;
            background: #ffffff;
            border-radius: 16px;
            padding: 18px 20px;
            border: 1.5px solid #f0f2f5;
            text-decoration: none;
            color: inherit;
            transition: all 0.2s ease;
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
        }

        .ds-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.07);
            border-color: #d8dde6;
        }

        .ds-card:active { transform: scale(0.99); }

        /* Card Top */
        .ds-card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }

        .ds-student-nis {
            display: block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: #9da3ae;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .ds-student-name {
            font-size: 16px;
            font-weight: 800;
            color: #191c1e;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        /* Badge */
        .ds-violation-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .ds-badge-high {
            background: #fff0f0;
            color: #c0392b;
            border: 1px solid #ffd6d6;
        }

        .ds-badge-medium {
            background: #fff8ec;
            color: #b7651a;
            border: 1px solid #fde8c4;
        }

        .ds-badge-low {
            background: #edfaf4;
            color: #1e8a52;
            border: 1px solid #c6ead8;
        }

        /* Card Details */
        .ds-card-details {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-top: 14px;
            border-top: 1px solid #f2f4f6;
        }

        .ds-detail-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .ds-detail-label {
            font-size: 10px;
            font-weight: 600;
            color: #b0b6c0;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .ds-detail-value {
            font-size: 13px;
            font-weight: 700;
            color: #2d3240;
        }

        .ds-detail-divider {
            width: 1px;
            height: 28px;
            background: #eceef2;
            flex-shrink: 0;
        }

        .ds-card-arrow {
            margin-left: auto;
            color: #c8ccd4;
            display: flex;
            align-items: center;
        }

        /* ── EMPTY STATE ── */
        .ds-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            color: #b0b6c0;
            text-align: center;
            gap: 10px;
        }

        .ds-empty-title {
            font-size: 15px;
            font-weight: 700;
            color: #6b7280;
            margin-top: 4px;
        }

        .ds-empty-sub {
            font-size: 13px;
            color: #b0b6c0;
            font-weight: 400;
        }

        /* ── COUNT TEXT ── */
        .ds-count-text {
            text-align: center;
            padding: 32px 0 8px;
            font-size: 12px;
            color: #b0b6c0;
            font-style: italic;
        }

        /* ── FAB ── */
        .ds-fab {
            position: fixed;
            right: 20px;
            bottom: 88px;
            width: 56px;
            height: 56px;
            background: #515c71;
            color: white;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 20px rgba(81, 92, 113, 0.35);
            z-index: 40;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .ds-fab:hover {
            background: #3e4a5e;
            transform: scale(1.05);
            box-shadow: 0 8px 28px rgba(81, 92, 113, 0.45);
        }

        .ds-fab:active { transform: scale(0.93); }

        @media (min-width: 768px) {
            .ds-fab { right: 32px; bottom: 40px; }
        }

        @media (min-width: 1024px) {
            .ds-fab { right: 40px; bottom: 40px; }
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</div>