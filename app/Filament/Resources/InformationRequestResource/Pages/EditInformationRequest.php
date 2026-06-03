<?php

namespace App\Filament\Resources\InformationRequestResource\Pages;

use App\Filament\Resources\InformationRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInformationRequest extends EditRecord
{
    protected static string $resource = InformationRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('cetak')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->color('gray')
                ->url(fn () => route('permohonan.print', $this->record))
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }
}
