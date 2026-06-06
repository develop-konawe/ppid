<?php

namespace App\Filament\Resources;

use App\Filament\Traits\HasKlaAccess;

use App\Filament\Resources\KlaDocumentResource\Pages;
use App\Models\KlaDocument;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KlaDocumentResource extends Resource
{
    use HasKlaAccess;
    protected static ?string $model = KlaDocument::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $modelLabel = 'Dokumen KLA';
    protected static ?string $pluralModelLabel = 'Dokumen KLA';
    protected static ?string $navigationGroup = 'KLA - Informasi & Publikasi';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Dokumen')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('category')
                    ->label('Kategori Dokumen')
                    ->placeholder('contoh: Rencana Aksi, Laporan, SK, dsb')
                    ->maxLength(100),

                Forms\Components\DatePicker::make('issue_date')
                    ->label('Tanggal Terbit'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif/Tampilkan')
                    ->default(true)
                    ->inline(false),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('doc_url')
                    ->label('Upload Dokumen (PDF)')
                    ->disk('public')
                    ->directory('kla/dokumen')
                    ->visibility('public')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(20480)
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul Dokumen')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->label('Kategori')->sortable(),
                Tables\Columns\TextColumn::make('doc_url')
                    ->label('File')
                    ->url(fn ($record) => $record->doc_url ? asset('storage/' . $record->doc_url) : null)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-document-text')
                    ->tooltip('Buka Dokumen'),
                Tables\Columns\TextColumn::make('issue_date')->label('Tanggal Terbit')->date('d M Y')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean()->sortable(),
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
            'index'  => Pages\ListKlaDocuments::route('/'),
            'create' => Pages\CreateKlaDocument::route('/create'),
            'edit'   => Pages\EditKlaDocument::route('/{record}/edit'),
        ];
    }
}
