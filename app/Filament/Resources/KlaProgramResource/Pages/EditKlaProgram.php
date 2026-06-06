<?php

namespace App\Filament\Resources\KlaProgramResource\Pages;

use App\Filament\Resources\KlaProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaProgram extends EditRecord
{
    protected static string $resource = KlaProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
