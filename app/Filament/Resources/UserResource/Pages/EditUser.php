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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['is_super_admin']) && $data['is_super_admin']) {
            $data['opd_id'] = null;
        }
        return $data;
    }

    protected function afterSave(): void
    {
        // Update role tunggal dari field 'role' (tidak di-dehydrate otomatis)
        $roleName = $this->data['role'] ?? null;
        
        // Pastikan super admin tidak memiliki role tambahan
        if (isset($this->data['is_super_admin']) && $this->data['is_super_admin']) {
            $roleName = null;
        }
        
        $this->record->syncRoles($roleName ? [$roleName] : []);
    }
}
