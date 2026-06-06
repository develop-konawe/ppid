<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformationExceptionResource\Pages;
use App\Filament\Resources\InformationExceptionResource\RelationManagers;
use App\Filament\Traits\HasPublicInfoAccess;
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
    use HasPublicInfoAccess;
    protected static ?string $model = InformationException::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';
    protected static ?string $modelLabel = 'Pengecualian Informasi';
    protected static ?string $pluralModelLabel = 'Pengecualian Informasi';
    protected static ?string $navigationGroup = 'Layanan Publik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('public_information_id')
                    ->label('Judul Informasi (Dikecualikan)')
                    ->relationship('publicInformation', 'title', fn ($query) => $query->where('information_type', 'dikecualikan'))
                    ->required()
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('exception_reason')
                    ->label('Alasan Pengecualian')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('legal_basis')
                    ->label('Dasar Hukum')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('valid_until')
                    ->label('Batas Waktu Pengecualian (Berlaku Sampai)')
                    ->nullable(),
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
