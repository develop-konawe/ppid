<?php

namespace App\Filament\Resources\KlaStatisticResource\Pages;

use App\Filament\Resources\KlaStatisticResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKlaStatistic extends CreateRecord
{
    protected static string $resource = KlaStatisticResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
