-- =============================================================================
-- MIGRATION SCRIPT: Menambahkan tabel baru ke backup production
-- Dibuat: 2026-04-08
-- Tujuan: Menambahkan tabel yang belum ada di backup production ke schema terbaru
--
-- CARA PENGGUNAAN:
--   1. Import dulu: ppidkonawekabgo_data.sql ke database lokal (misal: ppid_local)
--   2. Kemudian jalankan file ini di database yang sama
--   3. Setelah selesai, export dan upload ke server production via cPanel
-- =============================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS = 0;
SET NAMES utf8mb4;

-- =============================================================================
-- TABEL 1: information_categories
-- Migration: 2026_01_29_123828_create_information_categories_table
-- =============================================================================

CREATE TABLE IF NOT EXISTS `information_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `information_categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- TABEL 2: public_informations
-- Migration: 2026_01_29_123910_create_public_information_table
-- =============================================================================

CREATE TABLE IF NOT EXISTS `public_informations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `information_type` enum('berkala','setiap_saat','serta_merta','dikecualikan') NOT NULL,
  `report_level` enum('opd','konsolidasi') DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `opd_id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(20) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL COMMENT 'Menyimpan path file jika diupload ke server lokal',
  `file_url` varchar(255) DEFAULT NULL COMMENT 'Menyimpan link eksternal seperti Google Drive',
  `file_type` varchar(255) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `status` enum('draft','review','published','rejected') NOT NULL DEFAULT 'draft',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `public_informations_category_id_foreign` (`category_id`),
  KEY `public_informations_opd_id_foreign` (`opd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- TABEL 3: information_exceptions
-- Migration: 2026_01_29_124059_create_information_exceptions_table
-- =============================================================================

CREATE TABLE IF NOT EXISTS `information_exceptions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `public_information_id` bigint(20) UNSIGNED NOT NULL,
  `exception_reason` text NOT NULL,
  `legal_basis` varchar(255) NOT NULL,
  `valid_until` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `information_exceptions_public_information_id_foreign` (`public_information_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- TABEL 4: information_requests
-- Migration: 2026_01_29_124159_create_information_requests_table
-- =============================================================================

CREATE TABLE IF NOT EXISTS `information_requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kategori_pemohon` varchar(255) NOT NULL DEFAULT 'Perorangan',
  `nik_no_identitas` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `dokumen_pendukung` varchar(255) DEFAULT NULL,
  `rincian_informasi` text NOT NULL,
  `tujuan_penggunaan` text NOT NULL,
  `cara_memperoleh` enum('Melihat/Membaca/Mendengarkan/Mencatat','Mendapatkan Salinan Hardcopy','Mendapatkan Salinan Softcopy') NOT NULL DEFAULT 'Mendapatkan Salinan Softcopy',
  `cara_mendapatkan` enum('Mengambil Langsung','Kurir/Pos','Faksimili','Email') NOT NULL DEFAULT 'Email',
  `information_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','diproses','approved','rejected') NOT NULL DEFAULT 'pending',
  `response_message` text DEFAULT NULL,
  `response_file` varchar(255) DEFAULT NULL,
  `responded_at` timestamp NULL DEFAULT NULL,
  `responded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `information_requests_user_id_foreign` (`user_id`),
  KEY `information_requests_information_id_foreign` (`information_id`),
  KEY `information_requests_responded_by_foreign` (`responded_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- FOREIGN KEYS untuk tabel-tabel baru
-- =============================================================================

-- FK untuk public_informations
ALTER TABLE `public_informations`
  ADD CONSTRAINT `public_informations_category_id_foreign`
    FOREIGN KEY (`category_id`) REFERENCES `information_categories` (`id`),
  ADD CONSTRAINT `public_informations_opd_id_foreign`
    FOREIGN KEY (`opd_id`) REFERENCES `opds` (`id`);

-- FK untuk information_exceptions (cascadeOnDelete sesuai migration fix)
ALTER TABLE `information_exceptions`
  ADD CONSTRAINT `information_exceptions_public_information_id_foreign`
    FOREIGN KEY (`public_information_id`) REFERENCES `public_informations` (`id`) ON DELETE CASCADE;

-- FK untuk information_requests
ALTER TABLE `information_requests`
  ADD CONSTRAINT `information_requests_user_id_foreign`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `information_requests_information_id_foreign`
    FOREIGN KEY (`information_id`) REFERENCES `public_informations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `information_requests_responded_by_foreign`
    FOREIGN KEY (`responded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

-- =============================================================================
-- UPDATE TABEL migrations
-- Menambahkan record migration yang belum ada agar Laravel tidak mencoba
-- menjalankan ulang migration yang sudah di-handle manual ini
-- =============================================================================

INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
  ('2026_01_29_123828_create_information_categories_table', 2),
  ('2026_01_29_123910_create_public_information_table', 2),
  ('2026_01_29_124059_create_information_exceptions_table', 2),
  ('2026_01_29_124159_create_information_requests_table', 2),
  ('2026_02_17_051258_fix_fk_information_exceptions', 2);

SET FOREIGN_KEY_CHECKS = 1;

COMMIT;
-- =============================================================================
-- SELESAI
-- Database sekarang sudah sesuai dengan schema terbaru.
-- Silakan export seluruh database ini dan upload ke production via cPanel.
-- =============================================================================
