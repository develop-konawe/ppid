<?php

namespace App\Filament\Resources\KlaRegulationResource\Pages;

use App\Filament\Resources\KlaRegulationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaRegulations extends ListRecords
{
    protected static string $resource = KlaRegulationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Regulasi KLA'),
        ];
    }
}
