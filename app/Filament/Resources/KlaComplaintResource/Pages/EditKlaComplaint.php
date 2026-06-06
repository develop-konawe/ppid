<?php

namespace App\Filament\Resources\KlaComplaintResource\Pages;

use App\Filament\Resources\KlaComplaintResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaComplaint extends EditRecord
{
    protected static string $resource = KlaComplaintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
