<?php

namespace App\Filament\Resources\KlaProgramResource\Pages;

use App\Filament\Resources\KlaProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaPrograms extends ListRecords
{
    protected static string $resource = KlaProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Program/Kegiatan'),
        ];
    }
}
