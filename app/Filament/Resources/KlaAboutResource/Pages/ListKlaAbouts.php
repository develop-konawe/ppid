<?php

namespace App\Filament\Resources\KlaAboutResource\Pages;

use App\Filament\Resources\KlaAboutResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaAbouts extends ListRecords
{
    protected static string $resource = KlaAboutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Tentang KLA'),
        ];
    }
}
