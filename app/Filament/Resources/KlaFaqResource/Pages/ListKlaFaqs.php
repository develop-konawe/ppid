<?php

namespace App\Filament\Resources\KlaFaqResource\Pages;

use App\Filament\Resources\KlaFaqResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaFaqs extends ListRecords
{
    protected static string $resource = KlaFaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah FAQ KLA'),
        ];
    }
}
