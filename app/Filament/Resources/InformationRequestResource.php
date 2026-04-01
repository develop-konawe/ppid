<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformationRequestResource\Pages;
use App\Models\InformationRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InformationRequestResource extends Resource
{
    protected static ?string $model = InformationRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';
    
    protected static ?string $modelLabel = 'Permohonan Informasi';
    protected static ?string $navigationLabel = 'Permohonan Masuk';
    protected static ?string $pluralModelLabel = 'Permohonan Informasi';
    protected static ?string $navigationGroup = 'Layanan Publik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Identitas Pemohon')->schema([
                        Forms\Components\TextInput::make('kategori_pemohon')
                            ->disabled(),
                        Forms\Components\TextInput::make('nik_no_identitas')
                            ->label('NIK / No Identitas')
                            ->disabled(),
                        Forms\Components\TextInput::make('nama_lengkap')
                            ->disabled(),
                        Forms\Components\TextInput::make('pekerjaan')
                            ->disabled(),
                        Forms\Components\Textarea::make('alamat')
                            ->disabled()
                            ->columnSpanFull(),
                    ])->columns(2),

                    Forms\Components\Section::make('Kontak')->schema([
                        Forms\Components\TextInput::make('email')
                            ->disabled(),
                        Forms\Components\TextInput::make('no_telp')
                            ->label('No. Telepon/WA')
                            ->disabled(),
                    ])->columns(2),

                    Forms\Components\Section::make('Rincian Permohonan')->schema([
                        Forms\Components\Textarea::make('rincian_informasi')
                            ->disabled()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('tujuan_penggunaan')
                            ->disabled()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('cara_memperoleh')
                            ->disabled(),
                        Forms\Components\TextInput::make('cara_mendapatkan')
                            ->disabled(),
                    ])->columns(2),
                    
                    Forms\Components\Section::make('Dokumen Pendukung')->schema([
                        Forms\Components\FileUpload::make('foto_ktp')
                            ->label('Foto KTP / Identitas')
                            ->image()
                            ->disabled()
                            ->columnSpanFull(),
                    ])->collapsed(),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Tanggapan PPID')->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Menunggu Proses (Pending)',
                                'diproses' => 'Sedang Diproses',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                            ])
                            ->required()
                            ->native(false)
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (in_array($state, ['approved', 'rejected'])) {
                                    $set('responded_at', now());
                                    $set('responded_by', auth()->id());
                                } else {
                                    $set('responded_at', null);
                                    $set('responded_by', null);
                                }
                            }),

                        Forms\Components\Textarea::make('response_message')
                            ->label('Pesan Balasan')
                            ->rows(4)
                            ->required(fn (Forms\Get $get) => in_array($get('status'), ['approved', 'rejected'])),
                            
                        Forms\Components\FileUpload::make('response_file')
                            ->label('File Balasan (Opsional)')
                            ->directory('permohonan/balasan')
                            ->acceptedFileTypes(['application/pdf'])
                            ->visible(fn (Forms\Get $get) => $get('status') === 'approved'),
                            
                        Forms\Components\DateTimePicker::make('responded_at')
                            ->label('Waktu Ditanggapi')
                            ->disabled()
                            ->dehydrated(),
                    ]),
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Pemohon')
                    ->searchable()
                    ->sortable()
                    ->description(fn (InformationRequest $record): string => $record->kategori_pemohon),
                Tables\Columns\TextColumn::make('rincian_informasi')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'diproses',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'diproses' => 'Diproses',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default => $state,
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'diproses' => 'Diproses',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Proses / Detail'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListInformationRequests::route('/'),
            'create' => Pages\CreateInformationRequest::route('/create'),
            'edit' => Pages\EditInformationRequest::route('/{record}/edit'),
        ];
    }
}
