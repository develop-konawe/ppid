<?php

namespace App\Filament\Resources\InformationExceptionResource\Pages;

use App\Filament\Resources\InformationExceptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInformationExceptions extends ListRecords
{
    protected static string $resource = InformationExceptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
