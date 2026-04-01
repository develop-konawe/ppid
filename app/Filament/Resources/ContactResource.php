<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $pluralLabel = "Kontak";
    // Set the navigation sort order 7
    protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $modelLabel = 'Pesan Kotak Masuk';
    protected static ?string $pluralModelLabel = 'Pesan Kotak Masuk';
    protected static ?string $navigationGroup = 'Layanan Publik';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('admin_utama');
    }

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
                Tables\Columns\TextColumn::make('first_name')->label('Nama Depan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('last_name')->label('Nama Belakang')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('subject')->label('Subjek')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('message')->label('Pesan')->limit(50)->wrap(),
                Tables\Columns\BooleanColumn::make('agree')->label('Setuju')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat Pada')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui Pada')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListContacts::route('/'),
//            'create' => Pages\CreateContact::route('/create'),
//            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
