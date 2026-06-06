<?php

namespace App\Filament\Resources;

use App\Filament\Traits\HasKlaAccess;

use App\Filament\Resources\KlaStatisticResource\Pages;
use App\Models\KlaStatistic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KlaStatisticResource extends Resource
{
    use HasKlaAccess;
    protected static ?string $model = KlaStatistic::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $modelLabel = 'Statistik Anak';
    protected static ?string $pluralModelLabel = 'Statistik Anak';
    protected static ?string $navigationGroup = 'KLA - Evaluasi & Indikator';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('label')
                    ->label('Label / Nama Statistik')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('value')
                    ->label('Nilai (contoh: 12.500, 98%, dsb)')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('icon')
                    ->label('Ikon (Font Awesome class)')
                    ->placeholder('contoh: fa-solid fa-child-reaching')
                    ->maxLength(100),

                Forms\Components\TextInput::make('color')
                    ->label('Warna (hex)')
                    ->placeholder('contoh: #1F3A8A')
                    ->maxLength(50),

                Forms\Components\TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->inline(false),

                Forms\Components\Textarea::make('description')
                    ->label('Keterangan')
                    ->rows(2)
                    ->maxLength(500)
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')->label('Urutan')->sortable(),
                Tables\Columns\TextColumn::make('label')->label('Label')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('value')->label('Nilai')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->filters([])
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKlaStatistics::route('/'),
            'create' => Pages\CreateKlaStatistic::route('/create'),
            'edit'   => Pages\EditKlaStatistic::route('/{record}/edit'),
        ];
    }
}
