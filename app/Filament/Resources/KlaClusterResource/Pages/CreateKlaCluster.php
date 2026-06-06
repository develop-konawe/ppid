<?php

namespace App\Filament\Resources\KlaClusterResource\Pages;

use App\Filament\Resources\KlaClusterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKlaCluster extends CreateRecord
{
    protected static string $resource = KlaClusterResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
