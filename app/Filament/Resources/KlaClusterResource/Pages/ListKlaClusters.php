<?php

namespace App\Filament\Resources\KlaClusterResource\Pages;

use App\Filament\Resources\KlaClusterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaClusters extends ListRecords
{
    protected static string $resource = KlaClusterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Klaster KLA'),
        ];
    }
}
