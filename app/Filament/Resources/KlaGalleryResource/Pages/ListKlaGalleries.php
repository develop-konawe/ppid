<?php

namespace App\Filament\Resources\KlaGalleryResource\Pages;

use App\Filament\Resources\KlaGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaGalleries extends ListRecords
{
    protected static string $resource = KlaGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Galeri KLA'),
        ];
    }
}
