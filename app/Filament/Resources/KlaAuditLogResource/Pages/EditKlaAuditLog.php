<?php

namespace App\Filament\Resources\KlaAuditLogResource\Pages;

use App\Filament\Resources\KlaAuditLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaAuditLog extends EditRecord
{
    protected static string $resource = KlaAuditLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
