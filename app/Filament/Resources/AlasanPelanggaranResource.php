<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlasanPelanggaranResource\Pages;
use App\Models\AlasanPelanggaran;
use App\Models\JenisPelanggaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AlasanPelanggaranResource extends Resource
{
    protected static ?string $model = AlasanPelanggaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $navigationLabel = 'Alasan Pelanggaran';
    protected static ?string $pluralModelLabel = 'Alasan Pelanggaran';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('jenis_pelanggaran_id')
                ->label('Jenis Pelanggaran')
                ->options(fn() => JenisPelanggaran::pluck('nama', 'id'))
                ->searchable()
                ->required(),
            Forms\Components\TextInput::make('teks')
                ->label('Teks Alasan')
                ->placeholder('Contoh: Macet, Bangun kesiangan, Hujan...')
                ->required()
                ->maxLength(100),
            Forms\Components\TextInput::make('urutan')
                ->label('Urutan Tampil')
                ->numeric()
                ->default(0)
                ->helperText('Angka kecil tampil lebih dulu'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jenisPelanggaran.nama')
                    ->label('Jenis Pelanggaran')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('teks')
                    ->label('Teks Alasan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('urutan')
                    ->label('Urutan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pelanggaranSiswas_count')
                    ->label('Dipakai')
                    ->counts('pelanggaranSiswas')
                    ->badge()
                    ->color('gray'),
            ])
            ->defaultSort('jenis_pelanggaran_id')
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_pelanggaran_id')
                    ->label('Jenis Pelanggaran')
                    ->options(fn() => JenisPelanggaran::pluck('nama', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlasanPelanggarans::route('/'),
            'create' => Pages\CreateAlasanPelanggaran::route('/create'),
            'edit' => Pages\EditAlasanPelanggaran::route('/{record}/edit'),
        ];
    }
}
