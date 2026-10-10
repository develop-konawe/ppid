<?php

namespace App\Filament\Traits;

/**
 * Trait HasPublicInfoAccess
 *
 * Gunakan trait ini HANYA pada resource yang berkaitan dengan
 * Informasi Publik dan Permohonan Informasi, yaitu:
 *   - PublicInformationResource  (informasi berkala, setiap saat, serta merta, dikecualikan)
 *   - InformationRequestResource (permohonan informasi dari masyarakat)
 *
 * Resource dengan trait ini dapat diakses oleh:
 *   - is_super_admin = true  (Super Admin Kominfo)
 *   - role: operator_ppid
 *   - role: ppid_pelaksana   (operator OPD — hanya kelola data informasi publik milik OPD-nya)
 *
 * Catatan: filter data per-OPD untuk ppid_pelaksana dilakukan di
 * masing-masing resource via getEloquentQuery(), bukan di sini.
 */
trait HasPublicInfoAccess
{
    /**
     * Cek apakah user boleh mengakses resource ini.
     * Digunakan oleh Filament untuk:
     * - Menyembunyikan dari navigasi sidebar
     * - Memblokir akses langsung via URL
     */
    public static function canAccess(): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }

        // Super Admin Kominfo selalu punya akses penuh
        if ($user->is_super_admin) {
            return true;
        }

        // operator_ppid dan ppid_pelaksana boleh akses resource Informasi Publik
        return $user->hasAnyRole(['operator_ppid', 'ppid_pelaksana']);
    }
}
