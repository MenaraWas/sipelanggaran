<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $brandName = 'Sistem Pelanggaran Siswa';
        $brandLogo = null;

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $setting = \App\Models\Setting::first();
                if ($setting) {
                    if ($setting->app_name)
                        $brandName = $setting->app_name;
                    if ($setting->instansi_logo)
                        $brandLogo = asset('storage/' . $setting->instansi_logo);
                }
            }
        } catch (\Throwable $th) {
            // Abaikan error saat artisan migrate awal
        }

        $panel = $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName($brandName);

        if ($brandLogo) {
            $panel->brandLogo($brandLogo)->brandLogoHeight('2.5rem');
        }

        return $panel
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->profile(\App\Filament\Pages\CustomProfile::class, isSimple: false)
            ->darkMode(false)
            ->colors([
                'primary' => Color::Green,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->renderHook(
                'panels::head.end',
                fn() => new \Illuminate\Support\HtmlString('
                    <link rel="manifest" href="/manifest.json">
                    <meta name="theme-color" content="#1E3A5F">
                    <meta name="apple-mobile-web-app-capable" content="yes">
                    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
                    <meta name="apple-mobile-web-app-title" content="SIPELANGGARAN">
                    <link rel="apple-touch-icon" href="/icons/icon-192.png">
                    <script>
                        if ("serviceWorker" in navigator) {
                            navigator.serviceWorker.register("/sw.js");
                        }
                    </script>
                '),
            )
            ->renderHook(
                'panels::body.end',
                fn() => view('components.bottom-nav'),
            );
    }
}
