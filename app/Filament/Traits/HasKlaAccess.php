<?php

namespace App\Filament\Traits;

/**
 * Trait HasKlaAccess
 *
 * Gunakan trait ini pada semua Filament Resource yang merupakan bagian dari
 * sistem KLA (Kabupaten Layak Anak). Trait ini memastikan resource hanya bisa
 * diakses oleh:
 * - Super Admin Kominfo (is_super_admin = true)
 * - Pengguna dengan role 'operator_kla'
 */
trait HasKlaAccess
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

        // Sesuai instruksi: hanya super admin dan operator kla yang boleh mengelola KLA
        return $user->hasRole('operator_kla');
    }
}
