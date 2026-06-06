<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        // Simpan role tunggal dari field 'role' (tidak di-dehydrate otomatis)
        $roleName = $this->data['role'] ?? null;
        $this->record->syncRoles($roleName ? [$roleName] : []);
    }
}
