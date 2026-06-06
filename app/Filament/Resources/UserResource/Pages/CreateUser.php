<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['is_super_admin']) && $data['is_super_admin']) {
            $data['opd_id'] = null;
        }
        return $data;
    }

    protected function afterCreate(): void
    {
        // Simpan role tunggal dari field 'role' (tidak di-dehydrate otomatis)
        $roleName = $this->data['role'] ?? null;
        
        // Pastikan super admin tidak memiliki role tambahan
        if (isset($this->data['is_super_admin']) && $this->data['is_super_admin']) {
            $roleName = null;
        }
        
        $this->record->syncRoles($roleName ? [$roleName] : []);
    }
}
