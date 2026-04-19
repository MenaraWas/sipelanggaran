<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Forms\Components\TextInput::make('nis')
                            ->label('NISN')
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ]),
                    ])->columns(2),

                Forms\Components\Section::make('Kelahiran & Alamat')
                    ->schema([
                        Forms\Components\TextInput::make('tempat_lahir'),
                        Forms\Components\DatePicker::make('tanggal_lahir'),
                        Forms\Components\Textarea::make('alamat')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Akademik')
                    ->schema([
                        Forms\Components\TextInput::make('kelas')
                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('jurusan')
                            ->maxLength(50),
                    ])->columns(2),

                Forms\Components\Section::make('Kontak & Orang Tua')
                    ->schema([
                        Forms\Components\TextInput::make('no_telepon')
                            ->tel(),
                        Forms\Components\TextInput::make('nama_ayah'),
                        Forms\Components\TextInput::make('nama_ibu'),
                        Forms\Components\TextInput::make('nama_wali'),
                    ])->columns(2),

                Forms\Components\Section::make('Akun & Keamanan')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => filled($state) ? \Illuminate\Support\Facades\Hash::make($state) : null)
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create')
                            ->placeholder(fn(string $context): string => $context === 'edit' ? 'Kosongkan jika tidak ingin mengubah' : ''),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('3s')
            ->columns([
                Tables\Columns\TextColumn::make('nis')
                    ->searchable()
                    ->badge()
                    ->color(fn(?string $state): string => str_starts_with((string) $state, 'REG-') ? 'warning' : 'gray')
                    ->tooltip(fn(?string $state): ?string => str_starts_with((string) $state, 'REG-') ? 'NIS sementara — perlu diperbarui admin' : null),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jurusan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->default('-')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_verified')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->tooltip(fn($record) => $record->is_verified ? 'Terverifikasi' : 'Belum Diverifikasi'),
                Tables\Columns\TextColumn::make('pelanggaran_count')
                    ->label('Total Pelanggaran')
                    ->counts([
                        'pelanggaran' => fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('status', '!=', 'dikecualikan'),
                    ])
                    ->sortable()
                    ->badge()
                    ->color('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kelas')
                    ->options(fn() => Siswa::distinct()->pluck('kelas', 'kelas')),
                Tables\Filters\SelectFilter::make('jurusan')
                    ->options(fn() => Siswa::distinct()->pluck('jurusan', 'jurusan')),
                Tables\Filters\TernaryFilter::make('is_verified')
                    ->label('Status Akun')
                    ->trueLabel('Terverifikasi')
                    ->falseLabel('Belum Diverifikasi')
                    ->placeholder('Semua'),
            ])
            ->actions([
                Tables\Actions\Action::make('verifikasi')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Verifikasi Akun Siswa?')
                    ->modalDescription('Akun ini akan ditandai sebagai terverifikasi.')
                    ->action(fn(Siswa $record) => $record->update(['is_verified' => true]))
                    ->visible(fn(Siswa $record) => !$record->is_verified),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('import_profil')
                    ->label('Import Profil (Excel 1)')
                    ->icon('heroicon-o-document-arrow-up')
                    ->color('info')
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->label('Pilih File Excel Profil')
                            ->required()
                            ->disk('local')
                            ->directory('temp-imports')
                            ->visibility('private')
                    ])
                    ->action(function (array $data) {
                        try {
                            $file = storage_path('app/' . $data['file']);
                            \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\SiswaImport, $file);
                            \Filament\Notifications\Notification::make()
                                ->title('Import Berhasil')
                                ->body('Data profil siswa telah diperbarui/ditambahkan.')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            \Filament\Notifications\Notification::make()
                                ->title('Import Gagal')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
                Tables\Actions\Action::make('update_email')
                    ->label('Update Email (Excel 2)')
                    ->icon('heroicon-o-envelope')
                    ->color('warning')
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->label('Pilih File Excel Akun Email')
                            ->required()
                            ->disk('local')
                            ->directory('temp-imports')
                    ])
                    ->action(function (array $data) {
                        try {
                            $file = storage_path('app/' . $data['file']);
                            $import = new \App\Imports\SiswaEmailUpdate;
                            \Maatwebsite\Excel\Facades\Excel::import($import, $file);
                            
                            $msg = "Berhasil update {$import->updatedCount} email.";
                            if ($import->skippedCount > 0) {
                                $msg .= " Melewati {$import->skippedCount} data.";
                            }

                            \Filament\Notifications\Notification::make()
                                ->title('Proses Selesai')
                                ->body($msg)
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            \Filament\Notifications\Notification::make()
                                ->title('Terjadi Kesalahan')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('verifikasi_terpilih')
                        ->label('Verifikasi Terpilih')
                        ->icon('heroicon-o-check-badge')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn($records) => $records->each->update(['is_verified' => true])),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
