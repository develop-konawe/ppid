<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Update role tunggal dari field 'role' (tidak di-dehydrate otomatis)
        $roleName = $this->data['role'] ?? null;
        $this->record->syncRoles($roleName ? [$roleName] : []);
    }
}
