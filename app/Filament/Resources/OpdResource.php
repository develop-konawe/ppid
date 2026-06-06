<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OpdResource\Pages;
use App\Filament\Resources\OpdResource\RelationManagers;
use App\Models\Opd;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OpdResource extends Resource
{
    use \App\Filament\Traits\HasPpidAccess;
    protected static ?string $model = Opd::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $modelLabel = 'Daftar OPD';
    protected static ?string $pluralModelLabel = 'Daftar OPD';
    protected static ?string $navigationLabel = 'Data OPD';
    protected static ?string $navigationGroup = 'Master Data';

    // Hanya Admin Utama yang bisa lihat menu OPD
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('admin_utama');
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama_opd')
                ->required()
                ->label('Nama OPD'),

            Forms\Components\TextInput::make('singkatan')
                ->label('Singkatan'),

            Forms\Components\TextInput::make('website')
                ->url()
                ->label('Website'),

            Forms\Components\TextInput::make('email')
                ->email()
                ->label('Email'),

            Forms\Components\TextInput::make('telepon')
                ->label('Telepon'),

            Forms\Components\Textarea::make('alamat')
                ->rows(3)
                ->label('Alamat'),

            Forms\Components\TextInput::make('kepala_opd')
                ->label('Kepala OPD'),

            Forms\Components\FileUpload::make('logo')
                ->image()
                ->directory('opd-logo')
                ->label('Logo OPD')
                ->maxSize(2048),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular(),

                Tables\Columns\TextColumn::make('nama_opd')
                    ->searchable()
                    ->sortable()
                    ->label('Nama OPD'),

                Tables\Columns\TextColumn::make('singkatan')
                    ->label('Singkatan'),

                Tables\Columns\TextColumn::make('website')
                    ->label('Website')
                    ->url(fn ($record) => $record->website, true),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),

                Tables\Columns\TextColumn::make('telepon')
                    ->label('Telepon'),

                Tables\Columns\TextColumn::make('kepala_opd')
                    ->label('Kepala OPD'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // nanti bisa tambahkan relation manager: users, news, dll
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOpds::route('/'),
            'create' => Pages\CreateOpd::route('/create'),
            'edit'   => Pages\EditOpd::route('/{record}/edit'),
        ];
    }
}
