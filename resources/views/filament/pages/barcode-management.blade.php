<div class="bm-wrapper md3-animate-page">
    {{-- TopAppBar --}}
    <x-md3-top-bar 
        :title="$appName" 
        :subtitle="$instansiName" 
        icon="qr_code_scanner" 
        :user="$user" 
    />
    {{-- Custom Styles --}}
    <style>
        .fi-page-header, .fi-page-header + div { display: none !important; }
        @media (max-width: 1023px) {
            .fi-topbar { display: none !important; }
            .fi-sidebar, .fi-sidebar-close-overlay { display: none !important; }
        }
        .bm-wrapper { font-family: 'Inter', sans-serif; margin: -1.5rem; background: #f7f9fb; min-height: 100vh; }
        @media (min-width: 1024px) {
            .bm-wrapper { margin: 0; background: transparent; min-height: auto; }
            .bm-main { padding: 2rem 0 80px; }
            .bm-fab { display: none; }
        }
        .bm-main {
            padding: 2.5rem 1.5rem 100px;
            max-width: 1024px;
            margin: 0 auto;
        }
        

        /* Header Section */
        .bm-header {
            margin-bottom: 2.5rem;
        }
        .bm-title {
            font-size: 1.875rem;
            font-weight: 800;
            letter-spacing: -0.05em;
            color: #191c1e;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        .bm-subtitle {
            font-size: 0.875rem;
            font-weight: 500;
            color: #424754;
        }

        /* Stats Grid */
        .bm-stats {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        @media (min-width: 768px) {
            .bm-stats { grid-template-columns: repeat(3, 1fr); }
        }
        .bm-stat-card {
            background: #ffffff;
            padding: 1.25rem;
            border-radius: 1.25rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.03), 0 4px 12px rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            height: 110px;
            border: 1px solid rgba(0,0,0,0.03);
        }
        .bm-stat-card.featured {
            border-left: 4px solid #515c71;
        }
        .bm-stat-label {
            font-size: 10px;
            font-weight: 700;
            color: #727785;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 0.25rem;
        }
        .bm-stat-value {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: #191c1e;
            line-height: 1;
        }
        .bm-stat-value.primary { color: #515c71; }
        .bm-stat-value.secondary { color: #505f76; }

        /* Search Bar */
        .bm-search-wrap {
            margin-bottom: 2rem;
        }
        .bm-search-input {
            width: 100%;
            background: #ffffff;
            border: 1px solid #c2c6d6;
            border-radius: 1.25rem;
            padding: 0.875rem 1rem 0.875rem 3.25rem;
            font-size: 14px;
            transition: all 0.2s;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        }
        .bm-search-input:focus {
            border-color: #515c71;
            box-shadow: 0 0 0 4px rgba(81, 92, 113, 0.15);
            outline: none;
        }
        .bm-search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #727785;
            font-variation-settings: 'wght' 500;
        }

        /* List Section */
        .bm-list-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            padding: 0 0.25rem;
        }
        .bm-list-title {
            font-size: 10px;
            font-weight: 800;
            color: #727785;
            text-transform: uppercase;
            letter-spacing: 0.25em;
        }

        .bm-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .bm-card {
            background: #ffffff;
            border-radius: 1.25rem;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 2px rgba(0,0,0,0.03);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            color: inherit;
            border: 1px solid transparent;
        }
        .bm-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(0,0,0,0.1);
            border-color: rgba(81, 92, 113, 0.1);
        }
        .bm-card.alt {
            background: #f8fafc;
        }

        .bm-card-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .bm-card-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #515c71;
            flex-shrink: 0;
        }
        .bm-card-name {
            font-weight: 700;
            font-size: 0.9375rem;
            color: #1e293b;
            letter-spacing: -0.01em;
        }
        .bm-card-meta {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            margin-top: 0.125rem;
        }
        .bm-card-id {
            font-size: 11px;
            font-weight: 500;
            color: #64748b;
        }
        .bm-badge {
            padding: 1px 8px;
            border-radius: 6px;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }
        .bm-badge-success { background: #dcfce7; color: #166534; }
        .bm-badge-danger { background: #fee2e2; color: #991b1b; }

        /* Barcode Preview */
        .bm-barcode-wrap {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.375rem;
            flex-shrink: 0;
        }
        .bm-barcode-strip {
            height: 36px;
            width: 100px;
            background: #ffffff;
            border-left: 1px solid rgba(0,0,0,0.05);
            padding: 0 0.5rem;
            display: flex;
            align-items: center;
        }
        .qr-pattern {
            width: 100%;
            height: 20px;
            background-image: 
                conic-gradient(#1e293b 90deg, transparent 90deg 180deg, #1e293b 180deg 270deg, transparent 270deg),
                conic-gradient(#1e293b 90deg, transparent 90deg 180deg, #1e293b 180deg 270deg, transparent 270deg);
            background-size: 4px 4px, 4px 4px;
            background-position: 0 0, 2px 2px;
            opacity: 0.9;
        }
        .bm-barcode-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 9px;
            font-weight: 600;
            color: #64748b;
            letter-spacing: 0.25em;
        }

        /* FAB */
        .bm-fab {
            position: fixed;
            bottom: 6rem;
            right: 1.5rem;
            background: #1e293b;
            color: #ffffff;
            padding: 0.875rem 1.5rem;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 10px 25px -5px rgba(30, 41, 59, 0.4);
            border: none;
            cursor: pointer;
            z-index: 40;
            transition: all 0.2s;
            text-decoration: none;
        }
        .bm-fab:hover {
            background: #0f172a;
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(30, 41, 59, 0.4);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .bm-card { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .bm-barcode-wrap { align-items: flex-start; width: 100%; }
            .bm-barcode-strip { width: 100%; border-left: none; border-top: 1px solid rgba(0,0,0,0.05); padding: 0.5rem 0; }
        }
    </style>

    <main class="bm-main">
        {{-- Header --}}
        <header class="bm-header">
            <h2 class="bm-title">QR Code Management</h2>
            <p class="bm-subtitle">Penerbitan dan pengawasan token identifikasi aktif untuk akses administratif kampus.</p>
        </header>

        {{-- Stats --}}
        <div class="bm-stats">
            <div class="bm-stat-card">
                <span class="bm-stat-value primary">{{ $activeCount }}</span>
                <span class="bm-stat-label">QR Aktif</span>
            </div>
            <div class="bm-stat-card">
                <span class="bm-stat-value">{{ $scannedToday }}</span>
                <span class="bm-stat-label">Scan Hari Ini</span>
            </div>
            <div class="bm-stat-card featured">
                <span class="bm-stat-value secondary">{{ sprintf('%02d', $totalToday) }}</span>
                <span class="bm-stat-label">QR Code Baru</span>
            </div>
        </div>

        {{-- Search --}}
        <div class="bm-search-wrap relative">
            <span class="material-symbols-outlined bm-search-icon">search</span>
            <input type="text" 
                   wire:model.live.debounce.300ms="search"
                   placeholder="Cari QR code..." 
                   class="bm-search-input">
        </div>

        {{-- List --}}
        <section class="bm-list-wrap">
            <div class="bm-list-header">
                <h3 class="bm-list-title">Riwayat QR Code</h3>
                <a href="#" class="text-[10px] font-bold text-[#515c71] hover:underline">LIHAT SEMUA</a>
            </div>

            <div class="bm-list">
                @foreach($barcodes as $index => $barcode)
                    @php
                        $isExpired = $barcode->isExpired();
                        $isAlt = $index % 2 !== 0;
                    @endphp
                    <a href="{{ route('barcode.show', $barcode->token) }}" 
                       target="_blank"
                       class="bm-card {{ $isAlt ? 'alt' : '' }}">
                        <div class="bm-card-info">
                            <div class="bm-card-icon">
                                <span class="material-symbols-outlined">qr_code_2</span>
                            </div>
                            <div>
                                <h4 class="bm-card-name">{{ $barcode->jenisPelanggaran->nama }}</h4>
                                <div class="bm-card-meta">
                                    <span class="bm-card-id">{{ $barcode->tanggal->format('d M Y') }}</span>
                                    <span class="bm-badge {{ $isExpired ? 'bm-badge-danger' : 'bm-badge-success' }}">
                                        {{ $isExpired ? 'Expired' : 'Active' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="bm-barcode-wrap">
                            <div class="bm-barcode-strip">
                                <div class="qr-pattern"></div>
                            </div>
                            <span class="bm-barcode-label">QR-{{ substr($barcode->token, 0, 6) }}</span>
                        </div>
                    </a>
                @endforeach

                @if($barcodes->isEmpty())
                    <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                        <span class="material-symbols-outlined text-slate-300 text-6xl">qr_code_scanner</span>
                        <p class="mt-4 text-slate-500 font-medium">Tidak ada barcode ditemukan.</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- Load More --}}
        @if($barcodes->count() >= 10)
            <div class="mt-12 flex justify-center">
                <button class="px-8 py-3 text-xs font-bold tracking-widest text-[#515c71] hover:text-[#191c1e] transition-colors border-b-2 border-transparent hover:border-[#515c71]">
                    LOAD MORE RECORDS
                </button>
            </div>
        @endif
    </main>

    {{-- FAB --}}
    <a href="{{ route('filament.admin.resources.barcode-harians.create') }}" class="bm-fab">
        <span class="material-symbols-outlined">add_circle</span>
        <span class="font-bold tracking-tight text-xs uppercase">Buat QR Code Baru</span>
    </a>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</div>
