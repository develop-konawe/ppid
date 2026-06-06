<?php

namespace App\Filament\Resources\KlaIndicatorCategoryResource\Pages;

use App\Filament\Resources\KlaIndicatorCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaIndicatorCategories extends ListRecords
{
    protected static string $resource = KlaIndicatorCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
