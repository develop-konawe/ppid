<?php

namespace App\Filament\Resources;

use App\Filament\Traits\HasKlaAccess;

use App\Filament\Resources\KlaAboutResource\Pages;
use App\Models\KlaAbout;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KlaAboutResource extends Resource
{
    use HasKlaAccess;
    protected static ?string $model = KlaAbout::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $modelLabel = 'Tentang KLA';
    protected static ?string $pluralModelLabel = 'Tentang KLA';
    protected static ?string $navigationGroup = 'KLA - Profil & Pengaturan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->inline(false),

                Forms\Components\RichEditor::make('description')
                    ->label('Deskripsi')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('kla/content')
                    ->fileAttachmentsVisibility('public')
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('vision')
                    ->label('Visi')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('kla/content')
                    ->fileAttachmentsVisibility('public')
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('mission')
                    ->label('Misi')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('kla/content')
                    ->fileAttachmentsVisibility('public')
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('goals')
                    ->label('Tujuan')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('kla/content')
                    ->fileAttachmentsVisibility('public')
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
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
            'index'  => Pages\ListKlaAbouts::route('/'),
            'create' => Pages\CreateKlaAbout::route('/create'),
            'edit'   => Pages\EditKlaAbout::route('/{record}/edit'),
        ];
    }
}
