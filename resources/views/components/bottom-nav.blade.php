@auth
    {{-- Bottom Navigation Bar (Mobile Only) - Material Design 3 Style --}}
    <nav id="bottom-nav"
        class="fixed bottom-0 w-full z-[999] rounded-t-xl bg-white shadow-[0_-1px_3px_0_rgba(0,0,0,0.05)] lg:hidden">
        <div class="flex justify-around items-center w-full px-2 py-3">
            {{-- Home --}}
            <a href="{{ route('filament.admin.pages.dashboard') }}"
                class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-transform active:scale-90
                      {{ request()->routeIs('filament.admin.pages.dashboard') ? 'bg-slate-100 text-slate-900' : 'text-slate-500' }}">
                <span class="material-symbols-outlined" style="font-size:24px">dashboard</span>
                <span class="text-[11px] font-medium tracking-wide uppercase"
                    style="font-family:'Inter',sans-serif">Dashboard</span>
            </a>
            {{-- Pelanggaran --}}
            <a href="{{ route('filament.admin.resources.pelanggaran-siswas.index') }}"
                class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-transform active:scale-90
                      {{ request()->routeIs('filament.admin.resources.pelanggaran-siswas.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500' }}">
                <span class="material-symbols-outlined" style="font-size:24px">list_alt</span>
                <span class="text-[11px] font-medium tracking-wide uppercase"
                    style="font-family:'Inter',sans-serif">Violations</span>
            </a>
            {{-- Barcode --}}
            <a href="{{ route('filament.admin.resources.barcode-harians.index') }}"
                class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-transform active:scale-90
                      {{ request()->routeIs('filament.admin.resources.barcode-harians.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500' }}">
                <span class="material-symbols-outlined" style="font-size:24px">qr_code_scanner</span>
                <span class="text-[11px] font-medium tracking-wide uppercase"
                    style="font-family:'Inter',sans-serif">Barcode</span>
            </a>
            {{-- Lainnya --}}
            <button onclick="document.getElementById('more-menu-overlay').classList.toggle('hidden')"
                class="flex flex-col items-center justify-center py-1 px-3 rounded-xl text-slate-500 hover:text-slate-700 transition-transform active:scale-90">
                <span class="material-symbols-outlined" style="font-size:24px">more_horiz</span>
                <span class="text-[11px] font-medium tracking-wide uppercase"
                    style="font-family:'Inter',sans-serif">More</span>
            </button>
        </div>
    </nav>

    {{-- Slide-up "Lainnya" Menu --}}
    <div id="more-menu-overlay" class="hidden fixed inset-0 z-[1000] lg:hidden">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
            onclick="document.getElementById('more-menu-overlay').classList.add('hidden')"></div>

        {{-- Panel --}}
        <div
            class="absolute bottom-0 left-0 right-0 bg-white rounded-t-3xl shadow-2xl animate-slide-up max-h-[70vh] overflow-y-auto">
            <div class="flex justify-center pt-3 pb-1">
                <div class="w-10 h-1 bg-slate-300 rounded-full"></div>
            </div>
            <div class="px-5 pb-2">
                <h3 class="text-sm font-bold text-slate-800 mb-3">Menu Lainnya</h3>
            </div>
            <div class="px-3 pb-6 space-y-1">
                <a href="{{ route('filament.admin.resources.siswas.index') }}" class="more-menu-link">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <span>Data Siswa</span>
                </a>
                <a href="{{ route('filament.admin.resources.jenis-pelanggarans.index') }}" class="more-menu-link">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                    </div>
                    <span>Jenis Pelanggaran</span>
                </a>
                <a href="{{ route('filament.admin.resources.aturan-hukums.index') }}" class="more-menu-link">
                    <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <span>Aturan Hukuman</span>
                </a>
                <a href="{{ route('filament.admin.pages.export-laporan') }}" class="more-menu-link">
                    <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </div>
                    <span>Ekspor Laporan</span>
                </a>

                <div class="border-t border-slate-100 my-2"></div>

                <a href="/admin/manage-site-settings" class="more-menu-link">
                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span>Pengaturan Situs</span>
                </a>
                <a href="/admin/profile" class="more-menu-link">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span>Profil Saya</span>
                </a>

                <div class="border-t border-slate-100 my-2"></div>

                <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                    @csrf
                    <button type="submit" class="more-menu-link w-full text-red-600">
                        <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        </div>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

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