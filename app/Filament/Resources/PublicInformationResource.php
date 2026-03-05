<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicInformationResource\Pages;
use App\Filament\Resources\PublicInformationResource\RelationManagers;
use App\Models\PublicInformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PublicInformationResource extends Resource
{
    protected static ?string $model = PublicInformation::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Informasi Publik';
    protected static ?string $pluralLabel = 'Informasi Publik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('information_type')
                        ->label('Jenis Informasi')
                        ->options([
                            'berkala' => 'Informasi Berkala',
                            'setiap_saat' => 'Informasi Setiap Saat',
                            'serta_merta' => 'Informasi Serta Merta',
                            'dikecualikan' => 'Informasi Dikecualikan',
                        ])
                        ->required(),

                    Forms\Components\Select::make('category_id')
                        ->relationship('category', 'name')
                        ->required(),

                    Forms\Components\Select::make('report_level')
                        ->label('Level Laporan')
                        ->options([
                            'opd' => 'OPD',
                            'konsolidasi' => 'Konsolidasi',
                        ])
                        ->visible(fn ($get) => $get('information_type') === 'berkala'),

                    Forms\Components\Select::make('opd_id')
                        ->relationship('opd', 'nama_opd')
                        ->required()
                        ->disabled(fn () => auth()->user()->role === 'ppid_pelaksana')
                        ->default(fn () => auth()->user()->opd_id),

                    Forms\Components\Textarea::make('description')->columnSpanFull(),

                    Forms\Components\TextInput::make('year')
                        ->numeric()
                        ->minValue(2000)
                        ->maxValue(now()->year),

                    Forms\Components\FileUpload::make('file_path')
                        ->directory('ppid')
                        ->acceptedFileTypes(['application/pdf'])
                        ->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('information_type')->badge(),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori'),
                Tables\Columns\TextColumn::make('opd.nama_opd')->label('OPD'),
                Tables\Columns\TextColumn::make('year')->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'secondary' => 'draft',
                        'warning' => 'review',
                        'success' => 'published',
                        'danger' => 'rejected',
                    ]),
                Tables\Columns\TextColumn::make('creator.name')->label('Dibuat Oleh'),
                Tables\Columns\TextColumn::make('approver.name')->label('Disetujui Oleh'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('information_type')
                    ->options([
                        'berkala' => 'Berkala',
                        'setiap_saat' => 'Setiap Saat',
                        'serta_merta' => 'Serta Merta',
                        'dikecualikan' => 'Dikecualikan',
                    ]),
                Tables\Filters\SelectFilter::make('opd_id')
                    ->relationship('opd', 'nama_opd'),
                Tables\Filters\Filter::make('year'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record) =>
                        auth()->user()->role === 'ppid_utama'
                        && $record->status === 'review'
                    )
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'published',
                            'approved_by' => auth()->id(),
                            'published_at' => now(),
                        ]);
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // 🔒 PPID Pelaksana hanya lihat OPD-nya
        if (auth()->user()->role === 'ppid_pelaksana') {
            $query->where('opd_id', auth()->user()->opd_id);
        }

        return $query;
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
            'index' => Pages\ListPublicInformation::route('/'),
            'create' => Pages\CreatePublicInformation::route('/create'),
            'edit' => Pages\EditPublicInformation::route('/{record}/edit'),
        ];
    }
}
