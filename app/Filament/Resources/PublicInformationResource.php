<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicInformationResource\Pages;
use App\Filament\Traits\HasPublicInfoAccess;
use App\Models\PublicInformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PublicInformationResource extends Resource
{
    use HasPublicInfoAccess;
    protected static ?string $model = PublicInformation::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $modelLabel = 'Informasi Publik';
    protected static ?string $pluralModelLabel = 'Informasi Publik';
    protected static ?string $navigationGroup = 'Layanan Publik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([

                    // KOLOM KIRI
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Section::make('Informasi Utama')->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Judul Informasi')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),

                            Forms\Components\Select::make('information_type')
                                ->label('Jenis Informasi')
                                ->options([
                                    'berkala'      => 'Informasi Berkala',
                                    'setiap_saat'  => 'Informasi Setiap Saat',
                                    'serta_merta'  => 'Informasi Serta Merta',
                                    'dikecualikan' => 'Informasi Dikecualikan',
                                ])
                                ->required()
                                ->live(),

                            Forms\Components\Select::make('report_level')
                                ->label('Level Laporan')
                                ->options([
                                    'opd'         => 'Laporan OPD',
                                    'konsolidasi' => 'Laporan Konsolidasi',
                                ])
                                ->visible(fn (Forms\Get $get) => $get('information_type') === 'berkala'),

                            Forms\Components\RichEditor::make('description')
                                ->label('Ringkasan / Deskripsi')
                                ->columnSpanFull(),
                        ])->columns(2),

                        Forms\Components\Section::make('Lampiran Dokumen')->schema([
                            Forms\Components\Radio::make('attachment_type')
                                ->label('Pilih Tipe Lampiran')
                                ->options([
                                    'upload' => 'Upload File Lokal (Server)',
                                    'url'    => 'Link Tautan Eksternal (G-Drive, dll)',
                                ])
                                ->default('upload')
                                ->inline()
                                ->live()
                                ->dehydrated(false)
                                ->afterStateHydrated(function (Forms\Components\Radio $component, ?PublicInformation $record) {
                                    if ($record && !empty($record->file_url)) {
                                        $component->state('url');
                                    } else {
                                        $component->state('upload');
                                    }
                                })
                                ->afterStateUpdated(function ($state, callable $set) {
                                    if ($state === 'upload') {
                                        $set('file_url', null);
                                    } else {
                                        $set('file_path', null);
                                    }
                                }),

                            Forms\Components\FileUpload::make('file_path')
                                ->label('Upload File Lokal')
                                ->directory('informasi_publik')
                                ->acceptedFileTypes(['application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'image/jpeg', 'image/png'])
                                ->maxSize(20480)
                                ->required(fn (Forms\Get $get) => $get('attachment_type') === 'upload')
                                ->visible(fn (Forms\Get $get) => $get('attachment_type') === 'upload')
                                ->helperText('Maksimal 20MB. Prioritaskan format PDF.'),

                            Forms\Components\TextInput::make('file_url')
                                ->label('Link Eksternal (G-Drive / OneDrive)')
                                ->url()
                                ->required(fn (Forms\Get $get) => $get('attachment_type') === 'url')
                                ->visible(fn (Forms\Get $get) => $get('attachment_type') === 'url')
                                ->helperText('Gunakan tautan ini jika ukuran file terlalu besar untuk diupload.'),
                        ]),
                    ])->columnSpan(['lg' => 2]),

                    // KOLOM KANAN
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Section::make('Pengaturan Publikasi')->schema([

                            Forms\Components\Select::make('status')
                                ->label('Status Publikasi')
                                ->options(function () {
                                    if (!auth()->user()->isSuperAdmin() && !auth()->user()->hasRole('operator_ppid')) {
                                        return [
                                            'draft'  => 'Draft (Simpan Saja)',
                                            'review' => 'Kirim untuk Review',
                                        ];
                                    }
                                    return [
                                        'draft'     => 'Draft',
                                        'review'    => 'Sedang Direview',
                                        'published' => 'Terbitkan (Publish)',
                                        'rejected'  => 'Tolak Publikasi',
                                    ];
                                })
                                ->default('draft')
                                ->required()
                                ->native(false)
                                ->helperText(fn () => (!auth()->user()->isSuperAdmin() && !auth()->user()->hasRole('operator_ppid')) ? 'Pilih "Kirim untuk Review" agar Admin Utama dapat menerbitkannya.' : ''),

                            Forms\Components\Select::make('category_id')
                                ->label('Kategori')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),

                            Forms\Components\Select::make('opd_id')
                                ->label('OPD Penanggung Jawab')
                                ->relationship('opd', 'nama_opd')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->default(fn () => auth()->user()->opd_id)
                                // LOGIKA BARU: Disable jika bukan super admin atau admin utama PPID
                                ->disabled(fn () => (!auth()->user()->isSuperAdmin() && !auth()->user()->hasRole('operator_ppid')))
                                ->dehydrated(),

                            Forms\Components\TextInput::make('year')
                                ->label('Tahun / Periode')
                                ->placeholder('Contoh: 2026 atau 2025-2026')
                                ->maxLength(20)
                                ->numeric(false),
                        ]),
                    ])->columnSpan(['lg' => 1]),

                ])
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
                    ->limit(40)
                    ->description(fn ($record) => $record->category->name ?? '-'),

                Tables\Columns\TextColumn::make('information_type')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'berkala' => 'Berkala',
                        'setiap_saat' => 'Setiap Saat',
                        'serta_merta' => 'Serta Merta',
                        'dikecualikan' => 'Dikecualikan',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'berkala' => 'success',
                        'serta_merta' => 'danger',
                        'setiap_saat' => 'info',
                        'dikecualikan' => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('opd.singkatan')
                    ->label('OPD')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\IconColumn::make('file_path')
                    ->label('Lampiran')
                    ->icon(fn ($record) => $record->file_url ? 'heroicon-o-link' : 'heroicon-o-document-arrow-up')
                    ->color(fn ($record) => $record->file_url ? 'warning' : 'primary')
                    ->tooltip(fn ($record) => $record->file_url ? 'Link Eksternal' : 'File Lokal Server'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'gray'    => 'draft',
                        'warning' => 'review',
                        'success' => 'published',
                        'danger'  => 'rejected',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft'     => 'Draft',
                        'review'    => 'Review',
                        'published' => 'Publish',
                        'rejected'  => 'Ditolak',
                        default     => $state,
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Publikasi')
                    ->options([
                        'draft'     => 'Draft',
                        'review'    => 'Menunggu Review',
                        'published' => 'Dipublikasikan',
                        'rejected'  => 'Ditolak',
                    ]),
                Tables\Filters\SelectFilter::make('information_type')
                    ->label('Jenis Informasi')
                    ->options([
                        'berkala'      => 'Berkala',
                        'setiap_saat'  => 'Setiap Saat',
                        'serta_merta'  => 'Serta Merta',
                        'dikecualikan' => 'Dikecualikan',
                    ]),
                Tables\Filters\SelectFilter::make('opd_id')
                    ->label('Filter OPD')
                    ->relationship('opd', 'nama_opd')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                // LOGIKA BARU: Aksi Cepat Terbitkan
                Tables\Actions\Action::make('publish')
                    ->label('Terbitkan')
                    ->icon('heroicon-m-check-circle')
                    ->button()
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Terbitkan Dokumen Ini?')
                    ->visible(fn ($record) =>
                        (auth()->user()->isSuperAdmin() || auth()->user()->hasRole('operator_ppid')) &&
                        in_array($record->status, ['review', 'draft', 'rejected'])
                    )
                    ->action(function ($record) {
                        $record->update([
                            'status'       => 'published',
                            'approved_by'  => auth()->id(),
                            'published_at' => $record->published_at ?? now(),
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Dokumen Berhasil Diterbitkan')
                            ->success()
                            ->send();
                    }),

                // LOGIKA BARU: Aksi Cepat Batalkan Publikasi
                Tables\Actions\Action::make('unpublish')
                    ->label('Tarik ke Draft')
                    ->icon('heroicon-m-x-circle')
                    ->button()
                    ->color('warning')
                    ->requiresConfirmation()
                    ->visible(fn ($record) =>
                        (auth()->user()->isSuperAdmin() || auth()->user()->hasRole('operator_ppid')) &&
                        $record->status === 'published'
                    )
                    ->action(function ($record) {
                        $record->update(['status' => 'draft']);

                        \Filament\Notifications\Notification::make()
                            ->title('Publikasi Dibatalkan')
                            ->warning()
                            ->send();
                    }),

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->tooltip('Aksi Lainnya'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // LOGIKA BARU: Filter data OPD jika bukan super admin atau operator PPID utama
        if (!auth()->user()->isSuperAdmin() && !auth()->user()->hasRole('operator_ppid')) {
            $query->where('opd_id', auth()->user()->opd_id);
        }

        return $query;
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
