<?php

namespace App\Filament\Resources;

use App\Filament\Traits\HasKlaAccess;

use App\Filament\Resources\KlaComplaintResource\Pages;
use App\Models\KlaComplaint;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KlaComplaintResource extends Resource
{
    use HasKlaAccess;
    protected static ?string $model = KlaComplaint::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $modelLabel = 'Pengaduan KLA';
    protected static ?string $pluralModelLabel = 'Pengaduan KLA';
    protected static ?string $navigationGroup = 'KLA - Layanan & Pengaduan';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Pelapor')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->label('Nomor HP')
                    ->tel()
                    ->maxLength(20),

                Forms\Components\Select::make('status')
                    ->label('Status Pengaduan')
                    ->options([
                        'pending'  => 'Pending',
                        'diproses' => 'Sedang Diproses',
                        'selesai'  => 'Selesai',
                    ])
                    ->default('pending')
                    ->required(),

                Forms\Components\TextInput::make('subject')
                    ->label('Subjek Pengaduan')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('message')
                    ->label('Isi Pengaduan')
                    ->required()
                    ->rows(4)
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('response')
                    ->label('Balasan Admin')
                    ->rows(4)
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Pelapor')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('subject')->label('Subjek')->limit(50)->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'diproses',
                        'success' => 'selesai',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Masuk')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending'  => 'Pending',
                        'diproses' => 'Sedang Diproses',
                        'selesai'  => 'Selesai',
                    ]),
            ])
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
            'index'  => Pages\ListKlaComplaints::route('/'),
            'create' => Pages\CreateKlaComplaint::route('/create'),
            'edit'   => Pages\EditKlaComplaint::route('/{record}/edit'),
        ];
    }
}
