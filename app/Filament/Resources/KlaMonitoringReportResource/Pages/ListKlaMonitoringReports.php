<?php

namespace App\Filament\Resources\KlaMonitoringReportResource\Pages;

use App\Filament\Resources\KlaMonitoringReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlaMonitoringReports extends ListRecords
{
    protected static string $resource = KlaMonitoringReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
