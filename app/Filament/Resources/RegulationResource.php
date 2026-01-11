<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegulationResource\Pages;
use App\Filament\Resources\RegulationResource\RelationManagers;
use App\Models\Regulation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegulationResource extends Resource
{
    protected static ?string $model = Regulation::class;

    protected static ?string $pluralLabel = "Regulasi";

    // atur urutan ke-4 di sidebar
    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-scale';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                'title',
//                'summary',
//                'doc_url',
//                'issue_date',
                Forms\Components\Select::make('opd_id')
                    ->label('OPD')
                    ->relationship('opd', 'nama_opd')
                    ->searchable()
                    ->preload()
                    ->visible(fn () => auth()->user()->isSuperAdmin()),

                Forms\Components\TextInput::make('title')
                    ->label('Judul Peraturan')
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('issue_date')
                    ->label('Tanggal Penerbitan')
                    ->required(),

                // Ringkasan menggunakan textarea
                Forms\Components\Textarea::make('summary')
                    ->label('Ringkasan')
                    ->rows(3)
                    ->required()
                    ->maxLength(65535),

                Forms\Components\FileUpload::make('doc_url')
                    ->label("Dokumen Peraturan")
                    ->disk('public')
                    ->directory('peraturan')
                    ->visibility('public'),

            ])->columns([
                'sm' => 1,
                'md' => 1,
                'lg' => 2,
                'xl' => 2,
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
                Tables\Columns\TextColumn::make('title')->label('Judul Peraturan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('summary')->label('Ringkasan')->limit(50),
                // buatkan preview pdf dengan window pop up seperti window.open ketika diklik
                Tables\Columns\TextColumn::make('doc_url')->label('Dokumen Peraturan')
                    ->url(fn ($record) => asset('storage/' . $record->doc_url)
                    )->openUrlInNewTab()->icon('heroicon-o-document-text')
                    ->tooltip('Buka Dokumen'),
                Tables\Columns\TextColumn::make('issue_date')->label('Tanggal Penerbitan')->date()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat pada')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Diubah pada')->dateTime()->sortable(),
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
            'index' => Pages\ListRegulations::route('/'),
            'create' => Pages\CreateRegulation::route('/create'),
            'edit' => Pages\EditRegulation::route('/{record}/edit'),
        ];
    }
}
