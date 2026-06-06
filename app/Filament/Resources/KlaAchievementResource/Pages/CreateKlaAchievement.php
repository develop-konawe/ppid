<?php

namespace App\Filament\Resources\KlaAchievementResource\Pages;

use App\Filament\Resources\KlaAchievementResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKlaAchievement extends CreateRecord
{
    protected static string $resource = KlaAchievementResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
