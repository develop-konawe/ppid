<?php

namespace App\Filament\Resources\KlaComplaintResource\Pages;

use App\Filament\Resources\KlaComplaintResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaComplaints extends ListRecords
{
    protected static string $resource = KlaComplaintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pengaduan'),
        ];
    }
}
