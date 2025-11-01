<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\Category;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;
    protected static ?string $pluralLabel = "Berita";

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                'categori_id',
//                'title',
//                'slug',
//                'content',
//                'image',
                TextInput::make('title')
                    ->label('Judul Berita')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                TextInput::make('slug')->hidden(),

                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->searchable(),

                FileUpload::make('image')
                    ->label("Foto Berita")
                    ->image()
                    ->disk('public')
                    ->directory('berita')
                    ->maxWidth("500px")
                    ->visibility('public'),

                RichEditor::make('content')
                    ->label('Konten Berita')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'link',
                        'bulletList',
                        'numberedList',
                        'blockquote',
                        'codeBlock',
                        'insertTable',
                        'undo',
                        'redo',
                    ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Unggulan'),
                Tables\Columns\TextColumn::make('title')->label('Judul Berita')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori')->searchable()->sortable(),
                Tables\Columns\ImageColumn::make('image')->label('Foto Berita')->disk('public')->rounded(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('toggleFeatured')
                    ->label(fn (News $record) => $record->is_featured ? 'Batalkan Unggulan' : 'Jadikan Unggulan')
                    ->icon('heroicon-o-star')
                    ->modalHeading('Konfirmasi Perubahan')
                    ->modalDescription('Apakah Anda yakin ingin mengubah status unggulan berita ini?')
                    ->modalSubmitActionLabel('Ya, ubah')
                    ->modalCancelActionLabel('Batal')
                    ->action(function (News $record) {

                        if (!$record->is_featured) {
                            // Cek apakah sudah ada 2 berita unggulan
                            $count = News::where('is_featured', true)->count();
                            if ($count >= 2) {
                                Notification::make()
                                    ->title('Maksimal 2 berita unggulan.')
                                    ->danger()
                                    ->send();
                                return;
                            }
                        }

                        $record->update([
                            'is_featured' => !$record->is_featured,
                        ]);

                        Notification::make()
                            ->title($record->is_featured ? 'Berita dijadikan unggulan' : 'Berita dihapus dari unggulan')
                            ->success()
                            ->id($record->id)
                            ->send();
                    })
                    ->color(fn (News $record) => $record->is_featured ? 'success' : 'gray')
                    ->successNotification(null),
            ], Tables\Enums\ActionsPosition::BeforeColumns)
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
