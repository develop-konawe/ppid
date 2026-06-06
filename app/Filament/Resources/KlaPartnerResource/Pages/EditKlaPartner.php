<?php

namespace App\Filament\Resources\KlaPartnerResource\Pages;

use App\Filament\Resources\KlaPartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaPartner extends EditRecord
{
    protected static string $resource = KlaPartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
