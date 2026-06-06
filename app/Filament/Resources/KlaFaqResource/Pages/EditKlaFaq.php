<?php

namespace App\Filament\Resources\KlaFaqResource\Pages;

use App\Filament\Resources\KlaFaqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaFaq extends EditRecord
{
    protected static string $resource = KlaFaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
