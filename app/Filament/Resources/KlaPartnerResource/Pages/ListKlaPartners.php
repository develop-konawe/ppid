<?php

namespace App\Filament\Resources\KlaPartnerResource\Pages;

use App\Filament\Resources\KlaPartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaPartners extends ListRecords
{
    protected static string $resource = KlaPartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
