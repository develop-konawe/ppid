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

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Kelembagaan (ORPEG)')
                ->description('Data identitas resmi perangkat daerah sesuai struktur organisasi Pemkab Konawe.')
                ->schema([
                    Forms\Components\TextInput::make('id_unit')
                        ->label('ID Unit (ORPEG)')
                        ->disabled()
                        ->dehydrated()
                        ->placeholder('Otomatis dari API ORPEG (contoh: D0001)'),

                    Forms\Components\TextInput::make('tipe_unit')
                        ->label('Tipe Unit')
                        ->placeholder('Contoh: A, B'),

                    Forms\Components\TextInput::make('nama_opd')
                        ->required()
                        ->label('Nama OPD')
                        ->columnSpan(2),

                    Forms\Components\TextInput::make('singkatan')
                        ->label('Singkatan / Akronim'),

                    Forms\Components\TextInput::make('keterangan')
                        ->label('Dasar Hukum / Keterangan')
                        ->placeholder('Contoh: Perbub 12 Tahun 2024'),

                    Forms\Components\TextInput::make('file_dasar_hukum')
                        ->label('File Dasar Hukum')
                        ->url()
                        ->columnSpan(2)
                        ->placeholder('URL berkas dasar hukum jika tersedia'),
                ])->columns(2),

            Forms\Components\Section::make('Lokasi & Titik Koordinat')
                ->description('Lokasi kantor untuk navigasi dan peta interaktif masyarakat.')
                ->schema([
                    Forms\Components\Textarea::make('alamat')
                        ->rows(2)
                        ->label('Alamat Kantor')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('latitude')
                        ->numeric()
                        ->label('Latitude')
                        ->placeholder('-3.854067'),

                    Forms\Components\TextInput::make('longitude')
                        ->numeric()
                        ->label('Longitude')
                        ->placeholder('122.042205'),
                ])->columns(2),

            Forms\Components\Section::make('Kontak & Layanan PPID')
                ->description('Kontak operasional PPID Pelaksana untuk pelayanan informasi publik.')
                ->schema([
                    Forms\Components\TextInput::make('kepala_opd')
                        ->label('Kepala OPD / Pembina PPID'),

                    Forms\Components\TextInput::make('website')
                        ->url()
                        ->label('Website'),

                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->label('Email'),

                    Forms\Components\TextInput::make('telepon')
                        ->label('Telepon / Helpdesk'),

                    Forms\Components\FileUpload::make('logo')
                        ->image()
                        ->directory('opd-logo')
                        ->label('Logo OPD')
                        ->maxSize(2048)
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular(),

                Tables\Columns\TextColumn::make('id_unit')
                    ->label('ID Unit')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nama_opd')
                    ->searchable()
                    ->sortable()
                    ->label('Nama OPD'),

                Tables\Columns\TextColumn::make('singkatan')
                    ->label('Singkatan')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tipe_unit')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'A' => 'success',
                        'B' => 'info',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('telepon')
                    ->label('Telepon'),

                Tables\Columns\TextColumn::make('kepala_opd')
                    ->label('Kepala OPD')
                    ->toggleable(isToggledHiddenByDefault: true),
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
