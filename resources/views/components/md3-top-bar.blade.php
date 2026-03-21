@props([
    'title' => null,
    'subtitle' => null,
    'icon' => null,
    'user' => null,
    'backUrl' => null,
])

@php
    $user = $user ?? auth()->user();
@endphp

<header class="md3-topbar">
    <div class="flex items-center gap-3">
        @if($backUrl)
            <a href="{{ $backUrl }}" class="md3-back-btn">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
        @endif

        @if($icon)
            <div class="md3-topbar-icon">
                <span class="material-symbols-outlined">{{ $icon }}</span>
            </div>
        @endif

        <div>
            <h1 class="md3-topbar-title">{{ $title ?? 'Sipelanggaran' }}</h1>
            @if($subtitle)
                <p class="md3-topbar-sub">{{ $subtitle }}</p>
            @endif
        </div>
    </div>
    
    <div class="md3-topbar-avatar">
        {{ strtoupper(substr($user->name ?? 'AD', 0, 2)) }}
    </div>
</header>

<style>
    /* Hide default Filament Topbar and Sidebar on mobile/tablet */
    .fi-topbar, .fi-sidebar { display: none !important; }
    
    /* Ensure no double padding on main content */
    .fi-main { padding-top: 0 !important; }

    .md3-topbar {
        position: sticky; top: 0; z-index: 50; height: 64px; padding: 0 20px;
        background: rgba(255, 255, 255, 0.88); backdrop-filter: blur(16px);
        border-bottom: 2px solid #f1f5f9;
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1rem;
    }
    
    .md3-back-btn { padding: 8px; border-radius: 12px; color: #475569; transition: all 0.2s; display: flex; }
    .md3-back-btn:hover { background: #f1f5f9; color: #1e293b; }

    .md3-topbar-icon { 
        width: 38px; height: 38px; background: #515c71; border-radius: 12px; 
        display: flex; align-items: center; justify-content: center; color: white;
        box-shadow: 0 4px 10px rgba(81, 92, 113, 0.15);
    }
    .md3-topbar-title { font-size: 16px; font-weight: 800; color: #1e293b; line-height: 1.2; letter-spacing: -0.01em; }
    .md3-topbar-sub { font-size: 11px; font-weight: 600; color: #94a3b8; line-height: 1; margin-top: 1px; }
    
    .md3-topbar-avatar { 
        width: 36px; height: 36px; border-radius: 50%; background: #475569; color: white; 
        display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    @media (min-width: 1024px) {
        /* On desktop, keep the custom topbar width aligned if needed, but usually we cover full width now */
    }
</style>
