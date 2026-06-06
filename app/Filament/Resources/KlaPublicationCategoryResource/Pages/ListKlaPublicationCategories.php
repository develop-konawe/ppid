<?php

namespace App\Filament\Resources\KlaPublicationCategoryResource\Pages;

use App\Filament\Resources\KlaPublicationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaPublicationCategories extends ListRecords
{
    protected static string $resource = KlaPublicationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
