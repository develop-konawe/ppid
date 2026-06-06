<?php

namespace App\Filament\Resources\KlaGalleryResource\Pages;

use App\Filament\Resources\KlaGalleryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKlaGallery extends CreateRecord
{
    protected static string $resource = KlaGalleryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
