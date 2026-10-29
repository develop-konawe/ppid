<?php

namespace App\Filament\Resources\OpdResource\Pages;

use App\Filament\Resources\OpdResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Artisan;
use Throwable;

class ListOpds extends ListRecords
{
    protected static string $resource = OpdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('syncOrpeg')
                ->label('Sinkronisasi ORPEG')
                ->icon('heroicon-o-arrow-path')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Sinkronisasi Master Data OPD dari ORPEG')
                ->modalDescription('Sistem akan menghubungi API ORPEG Pemda Konawe untuk memperbarui nama, koordinat, dan data kelembagaan resmi. Data kontak dan logo lokal akan tetap dipertahankan.')
                ->modalSubmitActionLabel('Mulai Sinkronisasi')
                ->action(function () {
                    try {
                        $exitCode = Artisan::call('opd:sync', ['--force' => true]);

                        if ($exitCode === 0) {
                            Notification::make()
                                ->title('Sinkronisasi Berhasil')
                                ->body('Data master OPD berhasil diperbarui dari API ORPEG.')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Sinkronisasi Gagal')
                                ->body('Terjadi kendala saat menghubungi API ORPEG. Periksa koneksi atau log sistem.')
                                ->danger()
                                ->send();
                        }
                    } catch (Throwable $e) {
                        Notification::make()
                            ->title('Error Sinkronisasi')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
