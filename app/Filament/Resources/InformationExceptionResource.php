<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformationExceptionResource\Pages;
use App\Filament\Resources\InformationExceptionResource\RelationManagers;
use App\Models\InformationException;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InformationExceptionResource extends Resource
{
    protected static ?string $model = InformationException::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('publicInformation.title')->label('Judul Informasi'),
                Tables\Columns\TextColumn::make('exception_reason')->label('Alasan Pengecualian'),
                Tables\Columns\TextColumn::make('legal_basis')->label('Dasar Hukum'),
                Tables\Columns\TextColumn::make('valid_until')->date()->label('Berlaku Sampai'),
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
            'index' => Pages\ListInformationExceptions::route('/'),
            'create' => Pages\CreateInformationException::route('/create'),
            'edit' => Pages\EditInformationException::route('/{record}/edit'),
        ];
    }
}
