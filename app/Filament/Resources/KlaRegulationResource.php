<?php

namespace App\Filament\Resources;

use App\Filament\Traits\HasKlaAccess;

use App\Filament\Resources\KlaRegulationResource\Pages;
use App\Models\KlaRegulation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class KlaRegulationResource extends Resource
{
    use HasKlaAccess;
    protected static ?string $model = KlaRegulation::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';
    protected static ?string $modelLabel = 'Regulasi KLA';
    protected static ?string $pluralModelLabel = 'Regulasi KLA';
    protected static ?string $navigationGroup = 'KLA - Informasi & Publikasi';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Regulasi')
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('issue_date')
                    ->label('Tanggal Penerbitan')
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif/Tampilkan')
                    ->default(true)
                    ->inline(false),

                Forms\Components\Textarea::make('summary')
                    ->label('Ringkasan')
                    ->rows(3)
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('doc_url')
                    ->label('Dokumen Regulasi (PDF)')
                    ->disk('public')
                    ->directory('kla/regulasi')
                    ->visibility('public')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(10240)
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Regulasi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('summary')
                    ->label('Ringkasan')
                    ->limit(60),
                Tables\Columns\TextColumn::make('doc_url')
                    ->label('Dokumen')
                    ->url(fn ($record) => $record->doc_url ? asset('storage/' . $record->doc_url) : null)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-document-text')
                    ->tooltip('Buka Dokumen'),
                Tables\Columns\TextColumn::make('issue_date')
                    ->label('Tanggal Terbit')
                    ->date('d M Y')
                    ->sortable(),
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
            'index'  => Pages\ListKlaRegulations::route('/'),
            'create' => Pages\CreateKlaRegulation::route('/create'),
            'edit'   => Pages\EditKlaRegulation::route('/{record}/edit'),
        ];
    }
}
