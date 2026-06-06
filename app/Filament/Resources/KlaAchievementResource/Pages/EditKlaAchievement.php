<?php

namespace App\Filament\Resources\KlaAchievementResource\Pages;

use App\Filament\Resources\KlaAchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaAchievement extends EditRecord
{
    protected static string $resource = KlaAchievementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
