<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.manage-site-settings';

    public function getViewData(): array
    {
        $setting = \App\Models\Setting::first();
        $appName = $setting->app_name ?? 'Sipelanggaran';
        $instansiName = $setting->instansi_name ?? 'MAN 2 Bantul';
        $user = auth()->user();

        return compact('appName', 'instansiName', 'user');
    }

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?string $title = 'Pengaturan Situs';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = Setting::first();
        if ($setting) {
            $this->form->fill($setting->toArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Identitas Aplikasi & Instansi')
                    ->description('Atur nama aplikasi dan instansi yang akan ditampilkan di seluruh sistem.')
                    ->schema([
                        TextInput::make('app_name')
                            ->label('Nama Aplikasi')
                            ->placeholder('Misal: SIPELANGGARAN')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('instansi_name')
                            ->label('Nama Instansi / Sekolah')
                            ->placeholder('Misal: MAN 2 Bantul')
                            ->required()
                            ->maxLength(255),
                        FileUpload::make('instansi_logo')
                            ->label('Logo Instansi')
                            ->image()
                            ->directory('settings')
                            ->maxSize(2048)
                            ->columnSpanFull()
                            ->helperText('Format direkomendasikan: PNG transparan, JPG. Maksimal 2MB.'),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        $setting = Setting::first();
        if ($setting) {
            $setting->update($state);
        } else {
            Setting::create($state);
        }

        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }
}
