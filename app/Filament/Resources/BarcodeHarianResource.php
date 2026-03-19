<?php
namespace App\Filament\Resources;

use App\Filament\Resources\BarcodeHarianResource\Pages;
use App\Models\BarcodeHarian;
use App\Models\JenisPelanggaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class BarcodeHarianResource extends Resource
{
    protected static ?string $model = BarcodeHarian::class;
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $navigationLabel = 'QR Code Harian';
    protected static ?string $pluralModelLabel = 'QR Code Harian';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('jenis_pelanggaran_id')
                ->label('Jenis Pelanggaran')
                ->required()
                ->options(JenisPelanggaran::pluck('nama', 'id'))
                ->searchable(),
            Forms\Components\DatePicker::make('tanggal')
                ->label('Tanggal Berlaku')
                ->required()
                ->default(today()),
            Forms\Components\TextInput::make('nilai_default')
                ->label('Nilai Default')
                ->numeric()
                ->nullable()
                ->helperText('Opsional — dipakai jika siswa tidak input nilai saat scan'),
            Forms\Components\TimePicker::make('expired_at')
                ->label('Expired Pada Pukul')
                ->required()
                ->default('23:59')
                ->helperText('Barcode tidak bisa dipakai setelah jam ini'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jenisPelanggaran.nama')
                    ->label('Jenis Pelanggaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('expired_at')
                    ->label('Expired')
                    ->time('H:i'),
                Tables\Columns\IconColumn::make('is_expired')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-x-circle')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('danger')
                    ->falseColor('success')
                    ->getStateUsing(fn($record) => $record->isExpired()),
                Tables\Columns\TextColumn::make('pelanggaran_count')
                    ->label('Total Scan')
                    ->counts('pelanggaran')
                    ->badge(),
            ])
            ->defaultSort('tanggal', 'desc')
            ->actions([
                Tables\Actions\Action::make('lihat_qr')
                    ->label('Lihat QR')
                    ->icon('heroicon-o-qr-code')
                    ->color('success')
                    ->url(fn($record) => route('barcode.show', $record->token))
                    ->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBarcodeHarians::route('/'),
            'create' => Pages\CreateBarcodeHarian::route('/create'),
        ];
    }
}