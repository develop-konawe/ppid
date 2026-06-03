<?php

namespace App\Filament\Traits;

/**
 * Trait HasPpidAccess
 *
 * Gunakan trait ini pada resource PPID yang HANYA boleh diakses oleh Admin Utama
 * (admin_utama / is_super_admin). Resource ini TIDAK boleh diakses oleh:
 * - ppid_pelaksana (mereka hanya mengelola Informasi Publik & Permohonan)
 * - Semua role KLA (admin_kla, operator_kla, verifikator_kla)
 *
 * Resource yang cocok: Berita, Pengumuman, Galeri, Dokumen, Kategori,
 * Carousel, Menu, OPD, FAQ, Pengaturan, Regulasi, Media Sosial, dll.
 *
 * Untuk resource Informasi Publik & Permohonan Informasi,
 * gunakan trait HasPublicInfoAccess (yang juga mengizinkan ppid_pelaksana).
 */
trait HasPpidAccess
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

        // Hanya Admin Utama yang boleh akses resource publikasi & pengaturan
        return $user->hasRole('admin_utama');
    }
}
