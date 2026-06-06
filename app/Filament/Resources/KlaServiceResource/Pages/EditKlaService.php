<?php

namespace App\Filament\Resources\KlaServiceResource\Pages;

use App\Filament\Resources\KlaServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaService extends EditRecord
{
    protected static string $resource = KlaServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
