<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Pages\Page;

class MoreMenu extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-ellipsis-horizontal';
    protected static ?string $navigationLabel = 'Lainnya';
    protected static ?string $title = 'Lainnya';
    protected static ?string $slug = 'more';
    protected static ?int $navigationSort = 99;
    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.more-menu';

    public function getViewData(): array
    {
        $setting = Setting::first();
        $appName = $setting->app_name ?? 'Sistem Pelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $user = auth()->user();

        return compact('appName', 'instansiName', 'user');
    }
}
