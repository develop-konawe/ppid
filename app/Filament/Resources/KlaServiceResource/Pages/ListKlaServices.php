<?php

namespace App\Filament\Resources\KlaServiceResource\Pages;

use App\Filament\Resources\KlaServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaServices extends ListRecords
{
    protected static string $resource = KlaServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
