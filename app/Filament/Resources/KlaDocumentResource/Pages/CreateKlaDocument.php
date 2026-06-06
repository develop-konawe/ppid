<?php

namespace App\Filament\Resources\KlaDocumentResource\Pages;

use App\Filament\Resources\KlaDocumentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKlaDocument extends CreateRecord
{
    protected static string $resource = KlaDocumentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
