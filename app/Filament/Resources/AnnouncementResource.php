<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnouncementResource\Pages;
use App\Filament\Resources\AnnouncementResource\RelationManagers;
use App\Models\Announcement;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $pluralLabel = "Pengumuman";

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';
    protected static ?string $modelLabel = 'Pengumuman';
    protected static ?string $pluralModelLabel = 'Pengumuman';
    protected static ?string $navigationGroup = 'Publikasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('opd_id')
                    ->label('OPD')
                    ->relationship('opd', 'nama_opd')
                    ->searchable()
                    ->preload()
                    ->visible(fn () => auth()->user()->isSuperAdmin()),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul')
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

                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\DateTimePicker::make('published_at')
                        ->required()
                        ->label('Tanggal Terbit'),

                    Forms\Components\Toggle::make('is_active')
                        ->default(true)
                        ->inline(false)
                        ->label('Active'),
                ])->columns(2),


                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->label('Deskripsi')
                    ->required()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('announcements/content')
                    ->fileAttachmentsVisibility('private'),

                // File path is optional, can be used for attachments
                // Bagikan menjadi dua bagian tampilan

                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label("Foto Berita")
                        ->image()
                        ->disk('public')
                        ->directory('berita')
                        ->maxWidth("500px")
                        ->visibility('public'),

                    Forms\Components\FileUpload::make('file_path')
                        ->label("File Lampiran")
                        ->disk('public')
                        ->directory('berita/lampiran')
                        ->visibility('public')
                        ->preserveFilenames()
                        ->acceptedFileTypes(['application/pdf', 'image/*'])
                        ->maxSize(10240), // 10 MB
                ]),

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
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori')->searchable()->sortable(),
                Tables\Columns\BooleanColumn::make('is_active')->label('Active')->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Terbit')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('views')->label('Views')->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('toggleFeatured')
                    ->label(fn (Announcement $record) => $record->is_featured ? 'Batalkan Unggulan' : 'Jadikan Unggulan')
                    ->icon('heroicon-o-star')
                    ->modalHeading('Konfirmasi Perubahan')
                    ->modalDescription('Apakah Anda yakin ingin mengubah status unggulan pengumuman ini?')
                    ->modalSubmitActionLabel('Ya, ubah')
                    ->modalCancelActionLabel('Batal')
                    ->action(function (Announcement $record) {

                        if (!$record->is_featured) {
                            // Cek apakah sudah ada 2 berita unggulan
                            $count = Announcement::where('is_featured', true)->count();
                            if ($count >= 2) {
                                Notification::make()
                                    ->title('Maksimal 2 pengumuman unggulan.')
                                    ->danger()
                                    ->send();
                                return;
                            }
                        }

                        $record->update([
                            'is_featured' => !$record->is_featured,
                        ]);

                        Notification::make()
                            ->title($record->is_featured ? 'Pengumuman dijadikan unggulan' : 'Pengumuman dihapus dari unggulan')
                            ->success()
                            ->id($record->id)
                            ->send();
                    })
                    ->color(fn (Announcement $record) => $record->is_featured ? 'success' : 'gray')
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
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }
}
