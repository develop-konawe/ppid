<?php

namespace App\Filament\Resources\KlaIndicatorResource\Pages;

use App\Filament\Resources\KlaIndicatorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaIndicator extends EditRecord
{
    protected static string $resource = KlaIndicatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
