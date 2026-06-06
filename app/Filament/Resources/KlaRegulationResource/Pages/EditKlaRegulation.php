<?php

namespace App\Filament\Resources\KlaRegulationResource\Pages;

use App\Filament\Resources\KlaRegulationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaRegulation extends EditRecord
{
    protected static string $resource = KlaRegulationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
