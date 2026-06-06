<?php

namespace App\Filament\Resources\KlaPartnerCategoryResource\Pages;

use App\Filament\Resources\KlaPartnerCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaPartnerCategory extends EditRecord
{
    protected static string $resource = KlaPartnerCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
