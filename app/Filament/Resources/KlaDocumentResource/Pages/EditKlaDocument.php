<?php

namespace App\Filament\Resources\KlaDocumentResource\Pages;

use App\Filament\Resources\KlaDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaDocument extends EditRecord
{
    protected static string $resource = KlaDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
