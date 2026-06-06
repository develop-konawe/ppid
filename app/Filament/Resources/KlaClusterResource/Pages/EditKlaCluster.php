<?php

namespace App\Filament\Resources\KlaClusterResource\Pages;

use App\Filament\Resources\KlaClusterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaCluster extends EditRecord
{
    protected static string $resource = KlaClusterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
