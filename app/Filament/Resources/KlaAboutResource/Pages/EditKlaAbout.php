<?php

namespace App\Filament\Resources\KlaAboutResource\Pages;

use App\Filament\Resources\KlaAboutResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaAbout extends EditRecord
{
    protected static string $resource = KlaAboutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
