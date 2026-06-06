<?php

namespace App\Filament\Resources;

use App\Filament\Traits\HasKlaAccess;

use App\Filament\Resources\KlaProgramResource\Pages;
use App\Models\KlaProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class KlaProgramResource extends Resource
{
    use HasKlaAccess;
    protected static ?string $model = KlaProgram::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $modelLabel = 'Program & Kegiatan KLA';
    protected static ?string $pluralModelLabel = 'Program & Kegiatan KLA';
    protected static ?string $navigationGroup = 'KLA - Informasi & Publikasi';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Program/Kegiatan')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('event_date')
                    ->label('Tanggal Kegiatan'),

                Forms\Components\TextInput::make('location')
                    ->label('Lokasi')
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif/Tampilkan')
                    ->default(true)
                    ->inline(false),

                Forms\Components\FileUpload::make('image')
                    ->label('Foto Kegiatan')
                    ->image()
                    ->disk('public')
                    ->directory('kla/program')
                    ->visibility('public')
                    ->maxWidth('500px'),

                Forms\Components\RichEditor::make('description')
                    ->label('Deskripsi Program/Kegiatan')
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
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->rounded(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('event_date')
                    ->label('Tgl Kegiatan')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi')
                    ->limit(40),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
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
            'index'  => Pages\ListKlaPrograms::route('/'),
            'create' => Pages\CreateKlaProgram::route('/create'),
            'edit'   => Pages\EditKlaProgram::route('/{record}/edit'),
        ];
    }
}
