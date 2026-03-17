<?php
namespace App\Filament\Resources;

use App\Filament\Resources\AturanHukumResource\Pages;
use App\Models\AturanHukum;
use App\Models\JenisPelanggaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AturanHukumResource extends Resource
{
    protected static ?string $model = AturanHukum::class;
    protected static ?string $navigationIcon = 'heroicon-o-scale';
    protected static ?string $navigationLabel = 'Aturan Hukuman';
    protected static ?string $pluralModelLabel = 'Aturan Hukuman';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('jenis_pelanggaran_id')
                ->label('Jenis Pelanggaran')
                ->required()
                ->options(JenisPelanggaran::pluck('nama', 'id'))
                ->searchable(),
            Forms\Components\TextInput::make('min_nilai')
                ->label('Nilai Minimum')
                ->required()
                ->numeric()
                ->helperText('Menit / jumlah akumulasi minimum'),
            Forms\Components\TextInput::make('max_nilai')
                ->label('Nilai Maksimum')
                ->numeric()
                ->nullable()
                ->helperText('Kosongkan jika tidak ada batas atas'),
            Forms\Components\Textarea::make('hukuman')
                ->label('Hukuman')
                ->required()
                ->rows(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jenisPelanggaran.nama')
                    ->label('Jenis Pelanggaran')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('min_nilai')
                    ->label('Min'),
                Tables\Columns\TextColumn::make('max_nilai')
                    ->label('Max')
                    ->default('∞'),
                Tables\Columns\TextColumn::make('hukuman')
                    ->label('Hukuman')
                    ->limit(50),
            ])
            ->defaultSort('jenis_pelanggaran_id')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAturanHukums::route('/'),
            'create' => Pages\CreateAturanHukum::route('/create'),
            'edit' => Pages\EditAturanHukum::route('/{record}/edit'),
        ];
    }
}