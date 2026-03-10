<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicInformationResource\Pages;
use App\Models\PublicInformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
                        ->label('Judul Informasi')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Forms\Components\Select::make('information_type')
                        ->label('Jenis Informasi')
                        ->options([
                            'berkala' => 'Informasi Berkala',
                            'setiap_saat' => 'Informasi Setiap Saat',
                            'serta_merta' => 'Informasi Serta Merta',
                            'dikecualikan' => 'Informasi Dikecualikan',
                        ])
                        ->required()
                        ->live(),

                    Forms\Components\Select::make('report_level')
                        ->label('Level Laporan')
                        ->options([
                            'opd' => 'OPD',
                            'konsolidasi' => 'Konsolidasi',
                        ])
                        ->visible(fn (Forms\Get $get) => $get('information_type') === 'berkala'),

                    Forms\Components\Select::make('category_id')
                        ->label('Kategori')
                        ->relationship('category', 'name')
                        ->required(),

                    Forms\Components\Select::make('opd_id')
                        ->label('OPD Penanggung Jawab')
                        ->relationship('opd', 'nama_opd')
                        ->required()
                        ->default(fn () => auth()->user()->opd_id)
                        ->disabled(fn () => auth()->user()->role === 'ppid_pelaksana')
                        ->dehydrated(),

                    Forms\Components\TextInput::make('year')
                        ->label('Tahun / Periode')
                        ->placeholder('Contoh: 2025 atau 2025-2030')
                        ->maxLength(20),

                    Forms\Components\RichEditor::make('description')
                        ->label('Ringkasan / Deskripsi')
                        ->columnSpanFull(),
                ])->columns(2),

                // 🔄 BAGIAN LAMPIRAN YANG SUDAH DIPERBAIKI
                Forms\Components\Section::make('Lampiran Dokumen')->schema([

                    // Membuat pilihan (radio) yang tidak disimpan ke database (dehydrated: false)
                    Forms\Components\Radio::make('attachment_type')
                        ->label('Pilih Tipe Lampiran')
                        ->options([
                            'upload' => 'Upload File Lokal',
                            'url'    => 'Link Tautan Eksternal (G-Drive, dll)',
                        ])
                        ->default('upload')
                        ->inline()
                        ->live() // Memicu perubahan form secara instan
                        ->dehydrated(false) // Field ini tidak akan di-save ke kolom database
                        ->afterStateHydrated(function (Forms\Components\Radio $component, $record) {
                            // Saat mode Edit: otomatis pilih opsi 'url' jika record punya file_url
                            if ($record && $record->file_url) {
                                $component->state('url');
                            } else {
                                $component->state('upload');
                            }
                        })
                        ->afterStateUpdated(function ($state, callable $set) {
                            // Kosongkan field yang tidak dipilih agar data lamanya tidak nyangkut saat disimpan
                            if ($state === 'upload') {
                                $set('file_url', null);
                            } else {
                                $set('file_path', null);
                            }
                        }),

                    // Field Upload (Hanya muncul jika Radio 'upload' dipilih)
                    Forms\Components\FileUpload::make('file_path')
                        ->label('Upload File Lokal')
                        ->directory('informasi_publik')
                        ->acceptedFileTypes(['application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'image/jpeg', 'image/png'])
                        ->maxSize(20480)
                        ->required()
                        ->visible(fn (Forms\Get $get) => $get('attachment_type') === 'upload')
                        ->helperText('Upload langsung ke server. Prioritaskan format PDF.'),

                    // Field URL (Hanya muncul jika Radio 'url' dipilih)
                    Forms\Components\TextInput::make('file_url')
                        ->label('Link Eksternal (G-Drive / OneDrive)')
                        ->url()
                        ->required()
                        ->visible(fn (Forms\Get $get) => $get('attachment_type') === 'url')
                        ->helperText('Gunakan tautan ini jika ukuran file terlalu besar untuk diupload.'),

                ])->columns(1), // Dibuat 1 kolom agar inputannya berada pas di bawah radio button
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(50),

                Tables\Columns\TextColumn::make('information_type')
                    ->label('Jenis')
                    ->badge(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable(),

                Tables\Columns\TextColumn::make('opd.singkatan')
                    ->label('OPD')
                    ->sortable(),

                Tables\Columns\TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable(),

                // Mengubah icon agar dinamis menyesuaikan tipe lampiran
                Tables\Columns\IconColumn::make('file_path')
                    ->label('Tipe Lampiran')
                    ->icon(fn ($record) => $record->file_path ? 'heroicon-o-document-arrow-up' : 'heroicon-o-link')
                    ->color(fn ($record) => $record->file_path ? 'primary' : 'warning')
                    ->tooltip(fn ($record) => $record->file_path ? 'File Lokal' : 'Link Eksternal'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'secondary' => 'draft',
                        'warning' => 'review',
                        'success' => 'published',
                        'danger' => 'rejected',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('information_type')
                    ->label('Filter Jenis')
                    ->options([
                        'berkala' => 'Berkala',
                        'setiap_saat' => 'Setiap Saat',
                        'serta_merta' => 'Serta Merta',
                        'dikecualikan' => 'Dikecualikan',
                    ]),
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Filter Kategori')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('opd_id')
                    ->label('Filter OPD')
                    ->relationship('opd', 'nama_opd'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
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
