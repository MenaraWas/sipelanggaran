<?php

namespace App\Filament\Resources\JenisPelanggaranResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AturanHukumRelationManager extends RelationManager
{
    protected static string $relationship = 'aturanHukum';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('min_nilai')
                    ->label('Rentang Minimal')
                    ->required()
                    ->numeric()
                    ->helperText('Batas menit keterlambatan / 1 jika tipe langsung.'),
                Forms\Components\TextInput::make('max_nilai')
                    ->label('Rentang Maksimal')
                    ->numeric()
                    ->nullable()
                    ->helperText('Kosongkan jika tidak ada batas atas.'),
                Forms\Components\TextInput::make('poin_pelanggaran')
                    ->label('Skor Poin')
                    ->required()
                    ->numeric()
                    ->default(10),
                Forms\Components\Textarea::make('hukuman')
                    ->label('Hukuman')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('hukuman')
            ->columns([
                Tables\Columns\TextColumn::make('min_nilai')
                    ->label('Min'),
                Tables\Columns\TextColumn::make('max_nilai')
                    ->label('Max')
                    ->default('~'),
                Tables\Columns\TextColumn::make('poin_pelanggaran')
                    ->label('Poin')
                    ->badge()
                    ->color('danger'),
                Tables\Columns\TextColumn::make('hukuman')
                    ->label('Hukuman')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Aturan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
