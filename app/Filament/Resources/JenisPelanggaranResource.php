<?php
namespace App\Filament\Resources;

use App\Filament\Resources\JenisPelanggaranResource\Pages;
use App\Models\JenisPelanggaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JenisPelanggaranResource extends Resource
{
    protected static ?string $model = JenisPelanggaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static ?string $navigationLabel = 'Jenis Pelanggaran';
    protected static ?string $pluralModelLabel = 'Jenis Pelanggaran';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')
                ->label('Nama Pelanggaran')
                ->required()
                ->maxLength(100),
            Forms\Components\Select::make('kategori')
                ->label('Kategori')
                ->required()
                ->options([
                    'terlambat' => 'Keterlambatan',
                    'sholat'    => 'Bolos Sholat',
                    'seragam'   => 'Seragam',
                    'kustom'    => 'Kustom',
                ]),
            Forms\Components\Select::make('satuan')
                ->label('Satuan Nilai')
                ->required()
                ->options([
                    'menit'    => 'Menit',
                    'kali'     => 'Kali',
                    'langsung' => 'Langsung',
                ])
                ->default('langsung'),
            Forms\Components\Toggle::make('is_akumulatif')
                ->label('Hukuman Akumulatif?')
                ->helperText('Aktifkan jika hukuman dihitung dari total pelanggaran sebelumnya'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Pelanggaran')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('kategori')
                    ->label('Kategori')
                    ->colors([
                        'warning' => 'terlambat',
                        'danger'  => 'sholat',
                        'info'    => 'seragam',
                        'gray'    => 'kustom',
                    ]),
                Tables\Columns\TextColumn::make('satuan')
                    ->label('Satuan'),
                Tables\Columns\IconColumn::make('is_akumulatif')
                    ->label('Akumulatif')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListJenisPelanggarans::route('/'),
            'create' => Pages\CreateJenisPelanggaran::route('/create'),
            'edit'   => Pages\EditJenisPelanggaran::route('/{record}/edit'),
        ];
    }
}