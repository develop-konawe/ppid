<?php

namespace App\Filament\Resources\KlaPublicationCategoryResource\Pages;

use App\Filament\Resources\KlaPublicationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaPublicationCategory extends EditRecord
{
    protected static string $resource = KlaPublicationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
