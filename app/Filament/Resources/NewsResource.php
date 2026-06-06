<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Traits\HasPpidAccess;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsResource extends Resource
{
    use HasPpidAccess;
    protected static ?string $model = News::class;
    protected static ?string $pluralLabel = "Berita";

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Berita';
    protected static ?string $navigationGroup = 'Publikasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                'categori_id',
//                'title',
//                'slug',
//                'content',
//                'image',
                Forms\Components\Select::make('opd_id')
                    ->label('OPD')
                    ->relationship('opd', 'nama_opd')
                    ->searchable()
                    ->visible(fn () => auth()->user()->isSuperAdmin()),

                TextInput::make('title')
                    ->label('Judul Berita')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->maxLength(255),

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
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('news/content')
                    ->fileAttachmentsVisibility('private'),
            ])->columns(1);
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
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Unggulan')
                    ->visible(fn () => auth()->user()->hasRole('admin_utama')),
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
                Tables\Actions\DeleteAction::make(),
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
                    ->successNotification(null)
                    ->visible(fn () => auth()->user()->hasRole('admin_utama')),
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
