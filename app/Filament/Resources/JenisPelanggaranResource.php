<?php
namespace App\Filament\Resources;

use App\Filament\Resources\JenisPelanggaranResource\Pages;
use App\Filament\Resources\JenisPelanggaranResource\RelationManagers;
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
            Forms\Components\Select::make('tipe_perhitungan')
                ->label('Tipe Perhitungan')
                ->required()
                ->options([
                    'langsung' => 'Langsung Beri Poin',
                    'otomatis_waktu' => 'Otomatis (Hitung Waktu Keterlambatan)',
                ])
                ->default('langsung')
                ->live(),
            Forms\Components\TimePicker::make('jam_batas_masuk')
                ->label('Batas Jam Masuk')
                ->displayFormat('H:i')
                ->visible(fn(Forms\Get $get) => $get('tipe_perhitungan') === 'otomatis_waktu')
                ->required(fn(Forms\Get $get) => $get('tipe_perhitungan') === 'otomatis_waktu')
                ->helperText('Hanya diisi jika tipe perhitungan otomatis waktu.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Pelanggaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipe_perhitungan')
                    ->label('Tipe')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'langsung' => 'Langsung',
                        'otomatis_waktu' => 'Otomatis Waktu',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('jam_batas_masuk')
                    ->label('Batas Jam')
                    ->default('-'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AturanHukumRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJenisPelanggarans::route('/'),
            'create' => Pages\CreateJenisPelanggaran::route('/create'),
            'edit' => Pages\EditJenisPelanggaran::route('/{record}/edit'),
        ];
    }
}