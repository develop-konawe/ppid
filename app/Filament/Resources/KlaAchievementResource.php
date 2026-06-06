<?php

namespace App\Filament\Resources;

use App\Filament\Traits\HasKlaAccess;

use App\Filament\Resources\KlaAchievementResource\Pages;
use App\Models\KlaAchievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KlaAchievementResource extends Resource
{
    use HasKlaAccess;
    protected static ?string $model = KlaAchievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $modelLabel = 'Prestasi/Penghargaan KLA';
    protected static ?string $pluralModelLabel = 'Prestasi/Penghargaan KLA';
    protected static ?string $navigationGroup = 'KLA - Informasi & Publikasi';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Nama Penghargaan')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('year')
                    ->label('Tahun')
                    ->required()
                    ->numeric()
                    ->default(date('Y')),

                Forms\Components\TextInput::make('awarded_by')
                    ->label('Pemberi Penghargaan')
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif/Tampilkan')
                    ->default(true)
                    ->inline(false),

                Forms\Components\FileUpload::make('image')
                    ->label('Foto/Sertifikat')
                    ->image()
                    ->disk('public')
                    ->directory('kla/penghargaan')
                    ->visibility('public')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Foto')->disk('public')->rounded(),
                Tables\Columns\TextColumn::make('title')->label('Penghargaan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('year')->label('Tahun')->sortable(),
                Tables\Columns\TextColumn::make('awarded_by')->label('Pemberi')->limit(40),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean()->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('year', 'desc')
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
            'index'  => Pages\ListKlaAchievements::route('/'),
            'create' => Pages\CreateKlaAchievement::route('/create'),
            'edit'   => Pages\EditKlaAchievement::route('/{record}/edit'),
        ];
    }
}
