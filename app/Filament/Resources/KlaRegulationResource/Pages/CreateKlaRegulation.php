<?php

namespace App\Filament\Resources\KlaRegulationResource\Pages;

use App\Filament\Resources\KlaRegulationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKlaRegulation extends CreateRecord
{
    protected static string $resource = KlaRegulationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
