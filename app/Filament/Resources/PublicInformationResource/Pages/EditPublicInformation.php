<?php

namespace App\Filament\Resources\PublicInformationResource\Pages;

use App\Filament\Resources\PublicInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPublicInformation extends EditRecord
{
    protected static string $resource = PublicInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // FITUR BARU: Tangkap data sebelum form disimpan (Jika user ubah dropdown manual dan klik Save)
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Cek jika user mengubah status menjadi 'published' dan status sebelumnya BUKAN 'published'
        if ($data['status'] === 'published' && $this->record->status !== 'published') {
            $data['published_at'] = now();
            $data['approved_by'] = auth()->id();
        }

        return $data;
    }
}
