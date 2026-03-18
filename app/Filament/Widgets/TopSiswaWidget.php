<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

use App\Models\Siswa;

class TopSiswaWidget extends BaseWidget
{
    protected static ?string $heading = 'Top 5 Siswa Sering Melanggar';
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Siswa::query()
                    ->withCount('pelanggaran')
                    ->having('pelanggaran_count', '>', 0)
                    ->orderByDesc('pelanggaran_count')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('nis')
                    ->label('NIS'),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Siswa'),
                Tables\Columns\TextColumn::make('kelas')
                    ->label('Kelas')
                    ->badge(),
                Tables\Columns\TextColumn::make('pelanggaran_count')
                    ->label('Total Kasus')
                    ->badge()
                    ->color('danger'),
            ])
            ->paginated(false);
    }
}
