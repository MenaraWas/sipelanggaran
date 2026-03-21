@auth
    <nav id="bottom-nav" class="bn-nav lg:hidden">
        <div class="bn-inner">

            {{-- Home --}}
            <a href="{{ route('filament.admin.pages.dashboard') }}"
                class="bn-item {{ request()->routeIs('filament.admin.pages.dashboard') ? 'bn-active' : '' }}">
                @if(request()->routeIs('filament.admin.pages.dashboard'))
                    <svg class="bn-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                    </svg>
                @else
                    <svg class="bn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="3" width="7" height="9" rx="1.5" />
                        <rect x="3" y="15" width="7" height="6" rx="1.5" />
                        <rect x="13" y="3" width="8" height="6" rx="1.5" />
                        <rect x="13" y="12" width="8" height="9" rx="1.5" />
                    </svg>
                @endif
                <span class="bn-label">Home</span>
            </a>

            {{-- Rekap --}}
            <a href="{{ route('filament.admin.resources.pelanggaran-siswas.index') }}"
                class="bn-item {{ request()->routeIs('filament.admin.resources.pelanggaran-siswas.*') ? 'bn-active' : '' }}">
                @if(request()->routeIs('filament.admin.resources.pelanggaran-siswas.*'))
                    <svg class="bn-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M19 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2zm-7 3a1 1 0 110 2 1 1 0 010-2zm-4 0H7a1 1 0 110-2h1a1 1 0 010 2zm9 12H7a1 1 0 010-2h10a1 1 0 010 2zm0-4H7a1 1 0 010-2h10a1 1 0 010 2zm0-4H7a1 1 0 110-2h10a1 1 0 010 2z" />
                    </svg>
                @else
                    <svg class="bn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="4" y="4" width="16" height="16" rx="2" />
                        <line x1="8" y1="9" x2="16" y2="9" />
                        <line x1="8" y1="13" x2="16" y2="13" />
                        <line x1="8" y1="17" x2="12" y2="17" />
                    </svg>
                @endif
                <span class="bn-label">Rekap</span>
            </a>

            

            {{-- Barcode (center, elevated) --}}
            <a href="{{ route('filament.admin.resources.barcode-harians.index') }}"
                class="bn-item bn-item-center {{ request()->routeIs('filament.admin.resources.barcode-harians.*') ? 'bn-center-active' : '' }}">
                <div class="bn-center-pill">
                    <svg class="bn-icon-center" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 7V5a2 2 0 012-2h2M17 3h2a2 2 0 012 2v2M21 17v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2" />
                        <rect x="7" y="7" width="3" height="3" rx="0.5" />
                        <rect x="14" y="7" width="3" height="3" rx="0.5" />
                        <rect x="7" y="14" width="3" height="3" rx="0.5" />
                        <rect x="14" y="14" width="3" height="3" rx="0.5" />
                    </svg>
                </div>
                <span class="bn-label bn-label-center">Barcode</span>
            </a>

            {{-- Statistik --}}
            <a href="{{ route('filament.admin.pages.statistik-pelanggaran') }}"
                class="bn-item {{ request()->routeIs('filament.admin.pages.statistik-pelanggaran') ? 'bn-active' : '' }}">
                @if(request()->routeIs('filament.admin.pages.statistik-pelanggaran'))
                    <svg class="bn-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 9.2h3V19H5zM10.6 5h2.8v14h-2.8zm5.6 8H19v6h-2.8z"/>
                    </svg>
                @else
                    <svg class="bn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h4v6H3zm6-8h4v14H9zm6 8h4v6h-4z"/>
                    </svg>
                @endif
                <span class="bn-label">Statistik</span>
            </a>

            {{-- Lainnya --}}
            @php
                $isMoreActive = request()->is('admin/more') ||
                    request()->routeIs('filament.admin.resources.siswas.*') ||
                    request()->routeIs('filament.admin.resources.jenis-pelanggarans.*') ||
                    request()->routeIs('filament.admin.resources.aturan-hukums.*') ||
                    request()->routeIs('filament.admin.pages.statistik-pelanggaran') ||
                    request()->is('admin/manage-site-settings') ||
                    request()->is('admin/profile') ||
                    request()->routeIs('filament.admin.pages.export-laporan');
            @endphp
            <a href="/admin/more" class="bn-item {{ $isMoreActive ? 'bn-active' : '' }}">
                @if($isMoreActive)
                    <svg class="bn-icon" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="5" cy="12" r="2" />
                        <circle cx="12" cy="12" r="2" />
                        <circle cx="19" cy="12" r="2" />
                    </svg>
                @else
                    <svg class="bn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="5" cy="12" r="1.5" />
                        <circle cx="12" cy="12" r="1.5" />
                        <circle cx="19" cy="12" r="1.5" />
                    </svg>
                @endif
                <span class="bn-label">Lainnya</span>
            </a>

        </div>
    </nav>

    <style>
        /* ── BOTTOM NAV ── */
        .bn-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 999;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-top: 1px solid rgba(0, 0, 0, 0.07);
            padding-bottom: env(safe-area-inset-bottom, 0px);
        }

        .bn-inner {
            display: flex;
            align-items: center;
            justify-content: space-around;
            height: 64px;
            padding: 0 8px;
            max-width: 480px;
            margin: 0 auto;
        }

        /* ── ITEM ── */
        .bn-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 6px 4px;
            border-radius: 12px;
            text-decoration: none;
            color: #9da3ae;
            transition: all 0.15s ease;
            -webkit-tap-highlight-color: transparent;
            min-width: 0;
        }

        .bn-item:active {
            transform: scale(0.92);
        }

        .bn-active {
            color: #515c71;
            background: #f0f2f6;
        }

        /* ── ICONS ── */
        .bn-icon {
            width: 22px;
            height: 22px;
            flex-shrink: 0;
        }

        /* ── LABEL ── */
        .bn-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.01em;
            font-family: 'Inter', sans-serif;
            white-space: nowrap;
            line-height: 1;
        }

        /* ── CENTER ITEM (Barcode) ── */
        .bn-item-center {
            flex: 1;
            gap: 4px;
            padding-top: 0;
            color: #9da3ae;
            margin-top: -20px;
        }

        .bn-center-pill {
            width: 52px;
            height: 52px;
            background: #515c71;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(81, 92, 113, 0.35);
            transition: all 0.15s ease;
            border: 3px solid white;
        }

        .bn-item-center:active .bn-center-pill {
            transform: scale(0.93);
        }

        .bn-center-active .bn-center-pill {
            background: #3e4a5e;
            box-shadow: 0 6px 18px rgba(81, 92, 113, 0.45);
        }

        .bn-icon-center {
            width: 22px;
            height: 22px;
            color: white;
            flex-shrink: 0;
        }

        .bn-label-center {
            color: #515c71;
            font-weight: 700;
        }

        /* ── FILAMENT OVERRIDES ── */
        @media (max-width: 1023px) {

            .fi-sidebar-close-overlay,
            .fi-sidebar {
                display: none !important;
            }

            button[x-on\:click="$store.sidebar.open()"],
            button[x-on\:click\.stop="$store.sidebar.open()"] {
                display: none !important;
            }

            .fi-layout {
                padding-bottom: 5rem !important;
            }

            .fi-topbar {
                position: sticky;
                top: 0;
                z-index: 40;
            }
        }

        @media (min-width: 1024px) {
            #bottom-nav {
                display: none !important;
            }
        }

        /* ── MORE MENU LINK ── */
        .more-menu-link {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.625rem 0.75rem;
            border-radius: 0.875rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #334155;
            transition: background 0.15s;
            text-decoration: none;
        }

        .more-menu-link:hover,
        .more-menu-link:active {
            background: #f8fafc;
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideUp 0.25s ease-out;
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&display=swap" rel="stylesheet">
@endauth