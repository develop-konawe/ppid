<?php

namespace App\Filament\Resources\KlaPartnerCategoryResource\Pages;

use App\Filament\Resources\KlaPartnerCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaPartnerCategories extends ListRecords
{
    protected static string $resource = KlaPartnerCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
