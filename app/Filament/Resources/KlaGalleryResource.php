<?php

namespace App\Filament\Resources;

use App\Filament\Traits\HasKlaAccess;

use App\Filament\Resources\KlaGalleryResource\Pages;
use App\Models\KlaGallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KlaGalleryResource extends Resource
{
    use HasKlaAccess;
    protected static ?string $model = KlaGallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $modelLabel = 'Galeri KLA';
    protected static ?string $pluralModelLabel = 'Galeri KLA';
    protected static ?string $navigationGroup = 'KLA - Informasi & Publikasi';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Tipe Media')
                    ->options([
                        'photo' => 'Foto',
                        'video' => 'Video',
                    ])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('media_url', null)),

                Forms\Components\TextInput::make('caption')
                    ->label('Keterangan')
                    ->maxLength(255)
                    ->nullable(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif/Tampilkan')
                    ->default(true)
                    ->inline(false),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->maxLength(65535)
                    ->nullable(),

                Forms\Components\TextInput::make('media_url')
                    ->label('URL Video (YouTube/Vimeo)')
                    ->maxLength(255)
                    ->required(fn (callable $get) => $get('type') === 'video')
                    ->visible(fn (callable $get) => $get('type') === 'video')
                    ->url(),

                Forms\Components\FileUpload::make('media_path')
                    ->label('Upload Foto')
                    ->disk('public')
                    ->directory('kla/galeri')
                    ->visibility('public')
                    ->image()
                    ->required(fn (callable $get) => $get('type') === 'photo')
                    ->visible(fn (callable $get) => $get('type') === 'photo'),
            ])->columns([
                'sm' => 1,
                'md' => 1,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')->label('Tipe')->sortable(),
                Tables\Columns\ImageColumn::make('media_path')->label('Foto')->disk('public')->rounded(),
                Tables\Columns\TextColumn::make('caption')->label('Keterangan')->limit(50)->searchable(),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean()->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index'  => Pages\ListKlaGalleries::route('/'),
            'create' => Pages\CreateKlaGallery::route('/create'),
            'edit'   => Pages\EditKlaGallery::route('/{record}/edit'),
        ];
    }
}
