<?php

namespace App\Filament\Resources\PublicInformationResource\Pages;

use App\Filament\Resources\PublicInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePublicInformation extends CreateRecord
{
    protected static string $resource = PublicInformationResource::class;

    // FITUR BARU: Tangkap data sebelum divalidasi dan masuk ke database
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Otomatis catat siapa yang membuat dokumen ini
        $data['created_by'] = auth()->id();

        // Cek jika saat bikin baru, statusnya langsung di-set ke 'published'
        if (isset($data['status']) && $data['status'] === 'published') {
            $data['published_at'] = now();
            $data['approved_by'] = auth()->id();
        }

        return $data;
    }
}
