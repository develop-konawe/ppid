<?php

namespace App\Filament\Resources\KlaFaqResource\Pages;

use App\Filament\Resources\KlaFaqResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKlaFaq extends CreateRecord
{
    protected static string $resource = KlaFaqResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
