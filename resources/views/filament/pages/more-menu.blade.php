<div>
    {{-- Custom More Menu - Material Design 3 --}}
    <div class="mm-wrapper">

        {{-- TopAppBar --}}
        <header class="mm-topbar">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-slate-700" style="font-size:28px">gavel</span>
                <div>
                    <h1 class="text-lg font-bold tracking-tight text-slate-900">{{ $appName }}</h1>
                    <p class="text-[11px] text-slate-400 font-medium -mt-0.5">{{ $instansiName }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-slate-400 hover:bg-slate-100 transition-colors p-2 rounded-xl cursor-pointer">notifications</span>
            </div>
        </header>

        {{-- Content --}}
        <main class="mm-main">

            {{-- Admin Profile Section --}}
            <section class="mm-profile-section">
                <a href="/admin/profile" class="mm-profile-card">
                    <div class="mm-profile-avatar">
                        {{ strtoupper(substr($user->name ?? 'AD', 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h2 class="mm-profile-name">{{ $user->name ?? 'Admin' }}</h2>
                        <p class="mm-profile-role">{{ $user->email ?? 'Administrator' }}</p>
                    </div>
                    <span class="material-symbols-outlined text-[#727785]">chevron_right</span>
                </a>
            </section>

            {{-- Menu Categories --}}
            <div class="mm-menu-groups">

                {{-- Data Management --}}
                <div class="mm-menu-group">
                    <h3 class="mm-group-title">Data & Manajemen</h3>
                    <nav class="mm-menu-list">
                        <a href="{{ route('filament.admin.resources.siswas.index') }}" class="mm-menu-item">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-[#515c71]">school</span>
                                <span class="mm-menu-label">Data Siswa</span>
                            </div>
                            <span class="material-symbols-outlined text-[#c2c6d6] text-sm">chevron_right</span>
                        </a>
                        <a href="{{ route('filament.admin.resources.jenis-pelanggarans.index') }}" class="mm-menu-item">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-[#515c71]">label</span>
                                <span class="mm-menu-label">Jenis Pelanggaran</span>
                            </div>
                            <span class="material-symbols-outlined text-[#c2c6d6] text-sm">chevron_right</span>
                        </a>
                        <a href="{{ route('filament.admin.resources.aturan-hukums.index') }}" class="mm-menu-item">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-[#515c71]">menu_book</span>
                                <span class="mm-menu-label">Aturan Hukuman</span>
                            </div>
                            <span class="material-symbols-outlined text-[#c2c6d6] text-sm">chevron_right</span>
                        </a>
                        <a href="{{ route('filament.admin.pages.export-laporan') }}" class="mm-menu-item">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-[#515c71]">download</span>
                                <span class="mm-menu-label">Ekspor Laporan</span>
                            </div>
                            <span class="material-symbols-outlined text-[#c2c6d6] text-sm">chevron_right</span>
                        </a>
                    </nav>
                </div>

                {{-- Settings --}}
                <div class="mm-menu-group">
                    <h3 class="mm-group-title">Pengaturan</h3>
                    <nav class="mm-menu-list">
                        <a href="/admin/manage-site-settings" class="mm-menu-item">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-[#515c71]">settings</span>
                                <span class="mm-menu-label">Pengaturan Situs</span>
                            </div>
                            <span class="material-symbols-outlined text-[#c2c6d6] text-sm">chevron_right</span>
                        </a>
                        <a href="/admin/profile" class="mm-menu-item">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-[#515c71]">person</span>
                                <span class="mm-menu-label">Profil Saya</span>
                            </div>
                            <span class="material-symbols-outlined text-[#c2c6d6] text-sm">chevron_right</span>
                        </a>
                    </nav>
                </div>

                {{-- Logout --}}
                <div class="mm-menu-group">
                    <nav class="mm-menu-list">
                        <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                            @csrf
                            <button type="submit" class="mm-menu-item mm-logout-item w-full">
                                <div class="flex items-center gap-4">
                                    <span class="material-symbols-outlined text-[#b61722]">logout</span>
                                    <span class="mm-menu-label" style="color: #b61722; font-weight: 600;">Keluar</span>
                                </div>
                            </button>
                        </form>
                    </nav>
                </div>
            </div>

            {{-- Version Footer --}}
            <div class="mm-footer">
                <p>{{ $appName }} · {{ $instansiName }}</p>
            </div>
        </main>
    </div>

    <style>
        /* ===== MORE MENU STYLES ===== */
        .fi-page-header { display: none !important; }

        @media (max-width: 1023px) {
            .fi-topbar { display: none !important; }
        }

        .mm-wrapper {
            font-family: 'Inter', sans-serif;
            margin: -1.5rem;
        }

        /* Top Bar */
        .mm-topbar {
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

        .mm-main {
            padding: 1.5rem;
            padding-bottom: 7rem;
            max-width: 640px;
            margin: 0 auto;
        }

        /* Profile Section */
        .mm-profile-section {
            margin-bottom: 2.5rem;
            margin-top: 0.5rem;
        }
        .mm-profile-card {
            background: #ffffff;
            border-radius: 1rem;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            text-decoration: none;
            color: inherit;
            transition: transform 0.12s, box-shadow 0.15s;
        }
        .mm-profile-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
            transform: translateY(-1px);
        }
        .mm-profile-card:active {
            transform: scale(0.985);
        }
        .mm-profile-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #515c71, #6a758a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: 700;
            flex-shrink: 0;
        }
        .mm-profile-name {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #191c1e;
            margin: 0;
        }
        .mm-profile-role {
            font-size: 12px;
            font-weight: 500;
            color: #424754;
            text-transform: none;
            letter-spacing: 0;
            margin: 0.125rem 0 0;
        }

        /* Menu Groups */
        .mm-menu-groups {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .mm-group-title {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #424754;
            margin: 0 0 0.75rem 0.5rem;
        }
        .mm-menu-list {
            background: #eceef0;
            border-radius: 1rem;
            overflow: hidden;
            padding: 0.25rem;
        }
        .mm-menu-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.25rem;
            background: #ffffff;
            text-decoration: none;
            color: inherit;
            transition: background 0.15s;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
        }
        .mm-menu-item + .mm-menu-item {
            margin-top: 1px;
        }
        .mm-menu-item:first-child {
            border-radius: 0.75rem 0.75rem 0 0;
        }
        .mm-menu-item:last-child {
            border-radius: 0 0 0.75rem 0.75rem;
        }
        .mm-menu-item:only-child {
            border-radius: 0.75rem;
        }
        .mm-menu-item:hover {
            background: #e6e8ea;
        }
        .mm-menu-item:active {
            transform: scale(0.99);
        }
        .mm-menu-label {
            font-size: 14px;
            font-weight: 500;
            color: #191c1e;
        }

        /* Logout specific */
        .mm-logout-item:hover {
            background: rgba(255, 218, 215, 0.3);
        }

        /* Footer */
        .mm-footer {
            margin-top: 3rem;
            text-align: center;
        }
        .mm-footer p {
            font-size: 10px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #727785;
            margin: 0;
        }

        @media (min-width: 1024px) {
            .mm-topbar { display: none; }
            .mm-wrapper { margin: -1.5rem -1.5rem 0 -1.5rem; }
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</div>
