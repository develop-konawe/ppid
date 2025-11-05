<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models\Announcement;
use App\Models\Menu;
use App\Models\News;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?int $navigationSort = 11;

    // Svg by name "o-menu" from set "heroicons" not found.
    //i want to use build-in icon
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Menu')
                    ->required(),

                Forms\Components\Select::make('type')
                    ->label('Tipe Menu')
                    ->options([
                        'custom' => 'Custom URL',
                        'page' => 'Halaman',
                        'news' => 'Berita',
                        'announcement' => 'Pengumuman',
                        'external' => 'Link Eksternal',
                    ])
                    ->reactive(),

                // === FIELD DINAMIS ===
                Forms\Components\TextInput::make('url')
                    ->label('URL')
                    ->visible(fn ($get) => in_array($get('type'), ['custom', 'external']))
                    ->placeholder('https://...'),

                Forms\Components\Select::make('page_id')
                    ->label('Pilih Halaman')
                    ->options(Page::pluck('title', 'id'))
                    ->searchable()
                    ->visible(fn ($get) => $get('type') === 'page'),

                Forms\Components\Select::make('news_id')
                    ->label('Pilih Berita')
                    ->options(News::pluck('title', 'id'))
                    ->searchable()
                    ->visible(fn ($get) => $get('type') === 'news'),

                Forms\Components\Select::make('announcement_id')
                    ->label('Pilih Pengumuman')
                    ->options(Announcement::pluck('title', 'id'))
                    ->searchable()
                    ->visible(fn ($get) => $get('type') === 'announcement'),

                Forms\Components\Select::make('parent_id')
                    ->label('Parent Menu')
                    ->options(function ($get, $record) {
                        return Menu::query()
                            ->whereNull('parent_id')
                            ->when($record, fn($q) => $q->where('id', '!=', $record->id))
                            ->pluck('name', 'id');
                    })
                    ->searchable()
                    ->nullable(),

                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Menu')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type')->label('Tipe Menu')->sortable(),
                Tables\Columns\TextColumn::make('parent.name')->label('Parent Menu')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('order')->label('Urutan')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tombol hapus yang hanya menampilkan modal
                Tables\Actions\Action::make('cannot_delete')
                    ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->visible(fn ($record) =>
                        $record->children()->exists()
                        &&
                        !in_array($record->id, [1,2,3,4,5,6,7])
                        )
                    ->requiresConfirmation() // wajib agar modal muncul
                    ->modalHeading('Menu Tidak Dapat Dihapus')
                    ->modalDescription('Menu ini memiliki sub-menu, sehingga tidak dapat dihapus. Silakan hapus sub-menu terlebih dahulu.')
                    ->modalSubmitActionLabel(false)
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->modalIcon('heroicon-o-exclamation-triangle')
                    ->modalIconColor('warning'),
                // Tombol hapus normal hanya muncul jika tidak ada anak
                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) =>
                    ! $record->children()->exists()
                    &&
                    !in_array($record->id, [1,2,3,4,5,6,7])
                    )
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
