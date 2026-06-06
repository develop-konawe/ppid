<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarouselResource\Pages;
use App\Filament\Resources\CarouselResource\RelationManagers;
use App\Filament\Traits\HasPpidAccess;
use App\Models\Carousel;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarouselResource extends Resource
{
    use HasPpidAccess;
    protected static ?string $model = Carousel::class;

    protected static ?string $pluralLabel = "Hero Banner";

    // Atur urutan ke-8 di sidebar
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-view-columns';
    protected static ?string $modelLabel = 'Banner Utama';
    protected static ?string $pluralModelLabel = 'Banner Utama';
    protected static ?string $navigationGroup = 'Pengaturan Tampilan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->label('Judul')->required(),
                TextInput::make('caption')->label('Keterangan'),
                // Beri validasi dengan filament form minimal dimensi gambar 1910x875
                FileUpload::make('image')
                    ->label("Foto Banner")
                    ->image()
                    ->disk('public')
                    ->directory('banners')
//                    ->maxWidth("500px")
                    ->visibility('public')
                    ->required()
//                    ->imageResizeMode('cover')
//                    ->imageCropAspectRatio('1910:875')
//                    ->imagePreviewHeight('300')
                    ->helperText('Dimensi gambar ideal: 1910x875 px.'),

                // TextInput::make('sort_order')->label('Urutan Tampil')->default(0)->numeric()->required(),
                // validasi order agar tidak menginput urutan yang sudah ada
                TextInput::make('sort_order')
                    ->label('Urutan Tampil')
                    ->default(0)
                    ->numeric()
                    ->required()
                    ->rule(function (callable $get) {
                        return 'unique:carousels,sort_order,' . ($get('id') ?? 'NULL') . ',id';
                    })
                    ->helperText('Pastikan urutan tampil tidak duplikat dengan banner lain.'),

                Select::make('is_active')
                    ->label('Status Aktif')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',
                    ])->default(1)->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // buat list preview banner
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto Banner')
                    ->disk('public')
                    ->rounded()
                ->width(200)
                ,
                Tables\Columns\TextColumn::make('title')->label('Judul')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('caption')->label('Keterangan')->limit(50)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('sort_order')->label('Urutan Tampil')->sortable(),
                Tables\Columns\BooleanColumn::make('is_active')->label('Aktif')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCarousels::route('/'),
            'create' => Pages\CreateCarousel::route('/create'),
            'edit' => Pages\EditCarousel::route('/{record}/edit'),
        ];
    }
}
