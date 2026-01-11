<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use App\Filament\Resources\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateGallery extends CreateRecord
{
    protected static string $resource = GalleryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();
        $data['created_by'] = $user->id;

        // PPID Pelaksana → paksa pakai OPD user
        if ($user->hasRole('ppid_pelaksana')) {
            $data['opd_id'] = $user->opd_id;
            $data['source_type'] = 'ppid_pelaksana';
        }

        // Admin PPID
        if ($user->hasRole('admin_utama')) {
            $data['source_type'] = $data['opd_id']
                ? 'ppid_pelaksana'   // atas nama OPD
                : 'ppid_utama';      // berita pusat
        }

        return $data;
    }
}
