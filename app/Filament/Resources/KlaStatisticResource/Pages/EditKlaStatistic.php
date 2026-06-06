<?php

namespace App\Filament\Resources\KlaStatisticResource\Pages;

use App\Filament\Resources\KlaStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaStatistic extends EditRecord
{
    protected static string $resource = KlaStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
