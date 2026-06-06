<?php

namespace App\Filament\Resources\KlaAboutResource\Pages;

use App\Filament\Resources\KlaAboutResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKlaAbout extends CreateRecord
{
    protected static string $resource = KlaAboutResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
