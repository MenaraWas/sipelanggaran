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
                Forms\Components\TextInput::make('nis')
                    ->maxLength(20)
                    ->nullable()
                    ->unique(ignoreRecord: true)
                    ->helperText('Kosongkan jika belum diketahui (siswa daftar sendiri).'),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('kelas')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('jurusan')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => \Illuminate\Support\Facades\Hash::make($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context): bool => $context === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('3s')
            ->columns([
                Tables\Columns\TextColumn::make('nis')
                    ->searchable(),
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
