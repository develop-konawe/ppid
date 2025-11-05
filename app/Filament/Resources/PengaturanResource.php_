<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanResource\Pages;
use App\Filament\Resources\PengaturanResource\RelationManagers;
use App\Models\Pengaturan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanResource extends Resource
{
    protected static ?string $model = Pengaturan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Sistem';

    protected static ?string $pluralLabel = 'Pengaturan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('key')->required()->unique(ignoreRecord: true),
                Forms\Components\Select::make('type')
                    ->options([
                        'string' => 'String',
                        'integer' => 'Integer',
                        'boolean' => 'Boolean',
                        'color' => 'Color',
                        'json' => 'JSON',
                        'image' => 'Image',
                    ])->required(),

                Forms\Components\TextInput::make('group')->label('Group'),

                // STRING / INTEGER
                Forms\Components\TextInput::make('value')
                    ->label('Value')
                    ->visible(fn ($get) => in_array($get('type'), ['string', 'integer'])),

                // BOOLEAN
                Forms\Components\Toggle::make('value')
                    ->label('Value (Boolean)')
                    ->visible(fn ($get) => $get('type') === 'boolean'),

                // COLOR
                Forms\Components\ColorPicker::make('value')
                    ->label('Value (Color)')
                    ->visible(fn ($get) => $get('type') === 'color'),

                // IMAGE
                Forms\Components\FileUpload::make('value')
                    ->label('Value (Image)')
                    ->image()
                    ->directory('pengaturan')
                    ->disk('public')
                    ->maxSize(1024) // 1MB
                    ->imagePreviewHeight('150')
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                    ->visible(fn ($get) => $get('type') === 'image'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('key')->searchable(),
                Tables\Columns\TextColumn::make('value')->limit(30),
                Tables\Columns\BadgeColumn::make('type'),
                Tables\Columns\TextColumn::make('group')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
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
            ])->defaultSort('group');
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
            'index' => Pages\ListPengaturans::route('/'),
            'create' => Pages\CreatePengaturan::route('/create'),
            'edit' => Pages\EditPengaturan::route('/{record}/edit'),
        ];
    }
}
