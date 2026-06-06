<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Filament\Traits\HasPpidAccess;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryResource extends Resource
{
    use HasPpidAccess;
    protected static ?string $model = Gallery::class;

    protected static ?string $pluralLabel = "Galeri";
    // Atur urutan ke-6 di sidebar
    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $modelLabel = 'Galeri Foto & Video';
    protected static ?string $pluralModelLabel = 'Galeri Foto & Video';
    protected static ?string $navigationGroup = 'Publikasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//            Buatkan jika foto maka upload gambar jika type video maka upload link video
                Forms\Components\Select::make('opd_id')
                    ->label('OPD')
                    ->relationship('opd', 'nama_opd')
                    ->searchable()
                    ->preload()
                    ->visible(fn () => auth()->user()->isSuperAdmin()),

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

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->maxLength(65535)
                    ->nullable(),

                Forms\Components\TextInput::make('media_url')
                    ->label('URL Media')
                    ->maxLength(255)
                    ->required(fn (callable $get) => $get('type') === 'video')
                    ->visible(fn (callable $get) => $get('type') === 'video')
                    ->url(),

                Forms\Components\FileUpload::make('media_path')
                    ->label("Upload Foto")
                    ->disk('public')
                    ->directory('gallery')
                    ->visibility('public')
                    ->image()
                    ->required(fn (callable $get) => $get('type') === 'photo')
                    ->visible(fn (callable $get) => $get('type') === 'photo'),
            ])->columns([
                'sm' => 1,
                'md' => 1,
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        // Admin PPID Utama → lihat semua
        if ($user->hasRole('admin_utama')) {
            return parent::getEloquentQuery();
        }

        // PPID Pelaksana → hanya berita OPD sendiri
        if ($user->hasRole('ppid_pelaksana')) {
            return parent::getEloquentQuery()
                ->where('opd_id', $user->opd_id)
                ->where('source_type', 'ppid_pelaksana');
        }

        return parent::getEloquentQuery();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')->label('Tipe Media')->sortable(),
                Tables\Columns\TextColumn::make('caption')->label('Keterangan')->limit(50)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('media_url')->label('URL Media')->limit(50)->sortable()->searchable(),
                Tables\Columns\ImageColumn::make('media_path')->label('Foto')->disk('public')->rounded(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
