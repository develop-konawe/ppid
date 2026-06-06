<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = 'Pengguna';
    protected static ?string $pluralModelLabel = 'Pengguna';
    protected static ?string $navigationLabel = 'Pengguna';
    protected static ?string $navigationGroup = 'Sistem';

    public static function canAccess(): bool
    {
        return auth()->user()->isSuperAdmin();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isSuperAdmin();
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn ($record) => $record === null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                    ->label('Password'),

                Forms\Components\Select::make('role')
                    ->label('Role')
                    ->options(\Spatie\Permission\Models\Role::orderBy('name')->pluck('name', 'name'))
                    ->searchable()
                    ->live()
                    ->dehydrated(false) // disimpan manual via afterCreate/afterSave di Page
                    ->afterStateHydrated(function ($component, $record) {
                        // Pre-populate saat edit: ambil role pertama user
                        if ($record) {
                            $component->state($record->roles->first()?->name);
                        }
                    })
                    ->disabled(fn (Forms\Get $get): bool => (bool) $get('is_super_admin'))
                    ->helperText('Pilih satu role. Role PPID Pelaksana membutuhkan OPD; role Operator PPID & KLA tidak.'),

                Forms\Components\Select::make('opd_id')
                    ->relationship('opd', 'nama_opd')
                    ->label('OPD')
                    ->searchable()
                    ->preload()
                    ->placeholder('Pilih OPD (hanya untuk user PPID)')
                    ->helperText('Wajib diisi hanya untuk role PPID Pelaksana. Kosongkan untuk user KLA.')
                    ->hidden(fn (Forms\Get $get): bool =>
                        $get('is_super_admin') ||
                        (!empty($get('role')) && $get('role') !== 'ppid_pelaksana')
                    )
                    ->required(fn (Forms\Get $get): bool =>
                        !$get('is_super_admin') &&
                        $get('role') === 'ppid_pelaksana'
                    ),

                Forms\Components\Toggle::make('is_super_admin')
                    ->label('Super Admin Kominfo')
                    ->live()
                    ->afterStateUpdated(function (Forms\Set $set, $state) {
                        if ($state) {
                            $set('role', null);
                            $set('opd_id', null);
                        }
                    })
                    ->hidden(fn () => !auth()->user()->isSuperAdmin()),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('roles.name')->label('Role'),
                Tables\Columns\TextColumn::make('opd.nama_opd')->label('OPD'),
                Tables\Columns\IconColumn::make('is_super_admin')
                    ->boolean()
                    ->label('Super Admin'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn (User $record) => ! $record->is_super_admin),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(false),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
