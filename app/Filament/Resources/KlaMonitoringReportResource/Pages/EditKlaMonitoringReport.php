<?php

namespace App\Filament\Resources\KlaMonitoringReportResource\Pages;

use App\Filament\Resources\KlaMonitoringReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaMonitoringReport extends EditRecord
{
    protected static string $resource = KlaMonitoringReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
