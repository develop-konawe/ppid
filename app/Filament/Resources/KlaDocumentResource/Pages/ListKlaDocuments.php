<?php

namespace App\Filament\Resources\KlaDocumentResource\Pages;

use App\Filament\Resources\KlaDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaDocuments extends ListRecords
{
    protected static string $resource = KlaDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Dokumen KLA'),
        ];
    }
}
