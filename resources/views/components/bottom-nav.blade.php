@auth
    {{-- Bottom Navigation Bar (Mobile Only) - Material Design 3 Style --}}
    <nav id="bottom-nav"
        class="fixed bottom-0 w-full z-[999] rounded-t-xl bg-white shadow-[0_-1px_3px_0_rgba(0,0,0,0.05)] lg:hidden">
        <div class="flex justify-around items-center w-full px-2 py-3">
            {{-- Home --}}
            <a href="{{ route('filament.admin.pages.dashboard') }}"
                class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-transform active:scale-90
                      {{ request()->routeIs('filament.admin.pages.dashboard') ? 'bg-slate-100 text-slate-900' : 'text-slate-500' }}">
                <span class="material-symbols-outlined" style="font-size:24px; {{ request()->routeIs('filament.admin.pages.dashboard') ? "font-variation-settings: 'FILL' 1" : "" }}">dashboard</span>
                <span class="text-[11px] font-medium tracking-wide"
                    style="font-family:'Inter',sans-serif">Home</span>
            </a>
            {{-- Siswa (removed as per user request, it's in Lainnya) --}}
            
            {{-- Pelanggaran --}}
            <a href="{{ route('filament.admin.resources.pelanggaran-siswas.index') }}"
                class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-transform active:scale-90
                      {{ request()->routeIs('filament.admin.resources.pelanggaran-siswas.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500' }}">
                <span class="material-symbols-outlined" style="font-size:24px; {{ request()->routeIs('filament.admin.resources.pelanggaran-siswas.*') ? "font-variation-settings: 'FILL' 1" : "" }}">list_alt</span>
                <span class="text-[11px] font-medium tracking-wide"
                    style="font-family:'Inter',sans-serif">Rekap</span>
            </a>
            {{-- Barcode --}}
            <a href="{{ route('filament.admin.resources.barcode-harians.index') }}"
                class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-transform active:scale-90
                      {{ request()->routeIs('filament.admin.resources.barcode-harians.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500' }}">
                <span class="material-symbols-outlined" style="font-size:24px; {{ request()->routeIs('filament.admin.resources.barcode-harians.*') ? "font-variation-settings: 'FILL' 1" : "" }}">qr_code_scanner</span>
                <span class="text-[11px] font-medium tracking-wide"
                    style="font-family:'Inter',sans-serif">Barcode</span>
            </a>
            {{-- Lainnya --}}
            @php
                $isMoreActive = request()->is('admin/more') || 
                               request()->routeIs('filament.admin.resources.siswas.*') || 
                               request()->routeIs('filament.admin.resources.jenis-pelanggarans.*') || 
                               request()->routeIs('filament.admin.resources.aturan-hukums.*') ||
                               request()->is('admin/manage-site-settings') ||
                               request()->is('admin/profile') ||
                               request()->routeIs('filament.admin.pages.export-laporan');
            @endphp
            <a href="/admin/more"
                class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-transform active:scale-90
                      {{ $isMoreActive ? 'bg-slate-100 text-slate-900' : 'text-slate-500' }}">
                <span class="material-symbols-outlined" style="font-size:24px; {{ $isMoreActive ? "font-variation-settings: 'FILL' 1" : "" }}">more_horiz</span>
                <span class="text-[11px] font-medium tracking-wide"
                    style="font-family:'Inter',sans-serif">Lainnya</span>
            </a>
        </div>
    </nav>

    <style>
        /* Styling link menu "Lainnya" */
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

        /* Animasi slide-up */
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

        /* ---- MOBILE ONLY: sembunyikan sidebar, kasih ruang bottom nav ---- */
        @media (max-width: 1023px) {

            /* Sembunyikan sidebar & topbar hamburger overlay */
            .fi-sidebar-close-overlay,
            .fi-sidebar {
                display: none !important;
            }

            /* Sembunyikan tombol hamburger open sidebar */
            .fi-topbar nav button[x-on\:click="$store.sidebar.open()"],
            button[x-on\:click\.stop="$store.sidebar.open()"] {
                display: none !important;
            }

            /* Tambah ruang di bawah agar konten tidak ketutupan bottom nav */
            .fi-layout {
                padding-bottom: 5rem !important;
            }

            /* Tampilan topbar lebih compact */
            .fi-topbar {
                position: sticky;
                top: 0;
                z-index: 40;
            }
        }

        /* Desktop: sembunyikan bottom nav (sudah di-handle oleh lg:hidden tapi safety) */
        @media (min-width: 1024px) {

            #bottom-nav,
            #more-menu-overlay {
                display: none !important;
            }
        }
    </style>
@endauth