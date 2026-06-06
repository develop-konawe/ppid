<?php

namespace App\Filament\Resources\KlaStatisticResource\Pages;

use App\Filament\Resources\KlaStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaStatistics extends ListRecords
{
    protected static string $resource = KlaStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Statistik'),
        ];
    }
}
