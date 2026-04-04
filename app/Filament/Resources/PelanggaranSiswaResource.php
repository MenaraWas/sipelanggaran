<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PelanggaranSiswaResource\Pages;
use App\Models\PelanggaranSiswa;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PelanggaranSiswaResource extends Resource
{
    protected static ?string $model = PelanggaranSiswa::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Rekap Pelanggaran';
    protected static ?string $pluralModelLabel = 'Pelanggaran Siswa';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('siswa_id')
                ->label('Siswa')
                ->options(fn() => Siswa::query()->pluck('nama', 'id'))
                ->searchable()
                ->required(),
            Forms\Components\TextInput::make('nilai')
                ->label('Nilai')
                ->numeric()
                ->required(),
            Forms\Components\Textarea::make('hukuman_override')
                ->label('Override Hukuman')
                ->helperText('Isi jika ingin mengganti hukuman otomatis')
                ->nullable(),
            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Pending',
                    'selesai' => 'Selesai',
                    'dikecualikan' => 'Dikecualikan',
                ])
                ->default('pending'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('3s')
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('siswa.kelas')
                    ->label('Kelas')
                    ->badge(),
                Tables\Columns\TextColumn::make('barcode.jenisPelanggaran.nama')
                    ->label('Jenis Pelanggaran'),
                Tables\Columns\TextColumn::make('nilai')
                    ->label('Nilai'),
                Tables\Columns\TextColumn::make('hukuman_aktif')
                    ->label('Hukuman')
                    ->limit(40),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'selesai',
                        'gray' => 'dikecualikan',
                    ]),
                Tables\Columns\TextColumn::make('scan_at')
                    ->label('Waktu Scan')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'selesai' => 'Selesai',
                        'dikecualikan' => 'Dikecualikan',
                    ]),
                Tables\Filters\Filter::make('tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('dari'),
                        Forms\Components\DatePicker::make('sampai'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['dari'], fn($q) => $q->whereDate('scan_at', '>=', $data['dari']))
                            ->when($data['sampai'], fn($q) => $q->whereDate('scan_at', '<=', $data['sampai']));
                    }),
            ])
            ->defaultSort('scan_at', 'desc')
            ->actions([
                Tables\Actions\Action::make('selesaikan')
                    ->label('Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Selesai?')
                    ->modalDescription('Apakah Anda yakin ingin menandai pelanggaran ini sebagai sudah selesai?')
                    ->action(fn(PelanggaranSiswa $record) => $record->update(['status' => 'selesai']))
                    ->visible(fn(PelanggaranSiswa $record) => $record->status === 'pending'),

                Tables\Actions\Action::make('kecualikan')
                    ->label('Kecualikan')
                    ->icon('heroicon-o-x-circle')
                    ->color('gray')
                    ->requiresConfirmation()
                    ->modalHeading('Kecualikan Pelanggaran?')
                    ->modalDescription('Pelanggaran ini akan dikecualikan dan tidak dihitung.')
                    ->action(fn(PelanggaranSiswa $record) => $record->update(['status' => 'dikecualikan']))
                    ->visible(fn(PelanggaranSiswa $record) => $record->status === 'pending'),

                Tables\Actions\Action::make('pending')
                    ->label('Batalkan')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Kembalikan ke Pending?')
                    ->modalDescription('Status pelanggaran akan dikembalikan ke pending.')
                    ->action(fn(PelanggaranSiswa $record) => $record->update(['status' => 'pending']))
                    ->visible(fn(PelanggaranSiswa $record) => in_array($record->status, ['selesai', 'dikecualikan'])),

                Tables\Actions\EditAction::make()
                    ->iconButton(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelanggaranSiswas::route('/'),
            'create' => Pages\CreatePelanggaranSiswa::route('/create'),
            'edit' => Pages\EditPelanggaranSiswa::route('/{record}/edit'),
        ];
    }
}