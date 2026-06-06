<?php

namespace App\Filament\Resources\KlaGalleryResource\Pages;

use App\Filament\Resources\KlaGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaGallery extends EditRecord
{
    protected static string $resource = KlaGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
