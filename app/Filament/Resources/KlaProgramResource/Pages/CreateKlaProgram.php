<?php

namespace App\Filament\Resources\KlaProgramResource\Pages;

use App\Filament\Resources\KlaProgramResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKlaProgram extends CreateRecord
{
    protected static string $resource = KlaProgramResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
