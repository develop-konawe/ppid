<?php

namespace App\Filament\Resources\InformationExceptionResource\Pages;

use App\Filament\Resources\InformationExceptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInformationException extends EditRecord
{
    protected static string $resource = InformationExceptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
