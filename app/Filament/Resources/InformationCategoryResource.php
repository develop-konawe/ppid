<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformationCategoryResource\Pages;
use App\Filament\Resources\InformationCategoryResource\RelationManagers;
use App\Models\InformationCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InformationCategoryResource extends Resource
{
    protected static ?string $model = InformationCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $modelLabel = 'Kategori Informasi';
    protected static ?string $pluralModelLabel = 'Kategori Informasi';
    protected static ?string $navigationGroup = 'Layanan Publik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(InformationCategory::class, 'slug', ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Kategori')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->label('Slug')->searchable()->sortable(),
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
            'index' => Pages\ListInformationCategories::route('/'),
            'create' => Pages\CreateInformationCategory::route('/create'),
            'edit' => Pages\EditInformationCategory::route('/{record}/edit'),
        ];
    }
}
