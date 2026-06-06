<?php

namespace App\Filament\Resources\KlaIndicatorResource\Pages;

use App\Filament\Resources\KlaIndicatorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaIndicators extends ListRecords
{
    protected static string $resource = KlaIndicatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
