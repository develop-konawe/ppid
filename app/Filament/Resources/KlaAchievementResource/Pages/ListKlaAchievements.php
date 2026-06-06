<?php

namespace App\Filament\Resources\KlaAchievementResource\Pages;

use App\Filament\Resources\KlaAchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaAchievements extends ListRecords
{
    protected static string $resource = KlaAchievementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Prestasi/Penghargaan'),
        ];
    }
}
