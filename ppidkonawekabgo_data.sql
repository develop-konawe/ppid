-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 08 Apr 2026 pada 13.37
-- Versi server: 10.11.16-MariaDB
-- Versi PHP: 8.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppidkonawekabgo_data`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `source_type` enum('ppid_utama','ppid_pelaksana') NOT NULL DEFAULT 'ppid_utama',
  `opd_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1768168531),
('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1768168531;', 1768168531),
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:20:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"info.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:9:\"info.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"info.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"info.publish\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"info.verify\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"permohonan.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:17:\"permohonan.verify\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:18:\"permohonan.respond\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:17:\"permohonan.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:10:\"opd.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:8:\"opd.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:10:\"opd.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:15:\"opd.manage_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:11:\"user.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:9:\"user.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:11:\"user.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:16:\"user.assign_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:19:\"user.reset_password\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:11:\"report.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:13:\"report.export\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"admin_utama\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:14:\"ppid_pelaksana\";s:1:\"c\";s:3:\"web\";}}}', 1768254872),
('ppid-konawe-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1775615449),
('ppid-konawe-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1775615449;', 1775615449),
('ppid-konawe-cache-livewire-rate-limiter:2177c734aa7a048404428016f1be8516329d3981', 'i:1;', 1770619476),
('ppid-konawe-cache-livewire-rate-limiter:2177c734aa7a048404428016f1be8516329d3981:timer', 'i:1770619476;', 1770619476),
('ppid-konawe-cache-livewire-rate-limiter:31d23ae77b57f2551a382ae69b9789e76d8e28d8', 'i:1;', 1772167766),
('ppid-konawe-cache-livewire-rate-limiter:31d23ae77b57f2551a382ae69b9789e76d8e28d8:timer', 'i:1772167766;', 1772167766),
('ppid-konawe-cache-livewire-rate-limiter:3dd8af4c8b18599f9ffa22ea9ccd3f8a93042b19', 'i:1;', 1770163613),
('ppid-konawe-cache-livewire-rate-limiter:3dd8af4c8b18599f9ffa22ea9ccd3f8a93042b19:timer', 'i:1770163613;', 1770163613),
('ppid-konawe-cache-livewire-rate-limiter:67d89423bde98dce893339cd57724b3d311a404c', 'i:1;', 1769410032),
('ppid-konawe-cache-livewire-rate-limiter:67d89423bde98dce893339cd57724b3d311a404c:timer', 'i:1769410032;', 1769410032),
('ppid-konawe-cache-livewire-rate-limiter:742a22374d7d6347d709fadcbba698e29b341133', 'i:1;', 1773279400),
('ppid-konawe-cache-livewire-rate-limiter:742a22374d7d6347d709fadcbba698e29b341133:timer', 'i:1773279400;', 1773279400),
('ppid-konawe-cache-livewire-rate-limiter:9709a915ffbe840b8ff732ba20267ee09880e08c', 'i:1;', 1768786440),
('ppid-konawe-cache-livewire-rate-limiter:9709a915ffbe840b8ff732ba20267ee09880e08c:timer', 'i:1768786440;', 1768786440),
('ppid-konawe-cache-livewire-rate-limiter:d1a0e7c9cbbdbb84ffa99995a0ef11f1a679563e', 'i:1;', 1768784864),
('ppid-konawe-cache-livewire-rate-limiter:d1a0e7c9cbbdbb84ffa99995a0ef11f1a679563e:timer', 'i:1768784864;', 1768784864),
('ppid-konawe-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:20:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"info.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:9:\"info.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"info.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"info.publish\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"info.verify\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"permohonan.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:17:\"permohonan.verify\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:18:\"permohonan.respond\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:17:\"permohonan.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:10:\"opd.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:8:\"opd.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:10:\"opd.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:15:\"opd.manage_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:11:\"user.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:9:\"user.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:11:\"user.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:16:\"user.assign_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:19:\"user.reset_password\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:11:\"report.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:13:\"report.export\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"admin_utama\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:14:\"ppid_pelaksana\";s:1:\"c\";s:3:\"web\";}}}', 1775697292);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `carousels`
--

CREATE TABLE `carousels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `carousels`
--

INSERT INTO `carousels` (`id`, `title`, `caption`, `image`, `link_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Judul 1', 'Caption judul 1', 'banners/01KFW5M2Y7KFD0MTY6HPK28ZTD.png', NULL, 1, 1, '2026-01-11 13:54:03', '2026-01-25 20:30:09'),
(2, 'Kantor Bupati Kabupaten Konawe', NULL, 'banners/01KGNR3WZ6B9BT47VTTZRSGBBA.jpg', NULL, 2, 1, '2026-01-11 13:54:03', '2026-02-04 18:54:22'),
(3, 'Bendungan Ameroro Kab Konawe', NULL, 'banners/01KGNRCM0SYD59DGMTHRGVSKK3.jpg', NULL, 3, 1, '2026-01-11 13:54:03', '2026-02-04 18:59:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `agree` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('photo','video') NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `media_url` varchar(255) DEFAULT NULL,
  `media_path` varchar(255) DEFAULT NULL,
  `source_type` enum('ppid_utama','ppid_pelaksana') NOT NULL DEFAULT 'ppid_utama',
  `opd_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `galleries`
--

INSERT INTO `galleries` (`id`, `type`, `caption`, `description`, `media_url`, `media_path`, `source_type`, `opd_id`, `created_by`, `created_at`, `updated_at`) VALUES
(7, 'photo', NULL, 'Komitmen pemerintah daerah dalam memperluas perlindungan kesehatan masyarakat Kabupaten Konawe mendapat pengakuan  nasional. Penghargaan ini diberikan kepada daerah yang dinilai konsisten dan berkomitmen kuat dalam menjamin akses layanan kesehatan melalui Program Jaminan Kesehatan Nasional (JKN). Capaian ini sekaligus menunjukkan kesungguhan Pemerintah Daerah Kabupaten Konawe dalam memastikan bahwa seluruh warga memperoleh layanan kesehatan yang adil ,merata, dan terjangkau.', NULL, 'gallery/01KGK4YG3MNR925R94B4G5B6Q0.jfif', 'ppid_pelaksana', 1, 1, '2026-02-03 18:40:54', '2026-02-03 18:40:54'),
(8, 'photo', NULL, NULL, NULL, 'gallery/01KJ3VPHY4TART2KHENVTGG5KF.jpg', 'ppid_pelaksana', 1, 1, '2026-02-22 16:42:03', '2026-02-22 16:42:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'custom',
  `url` varchar(255) DEFAULT NULL,
  `page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `news_id` bigint(20) UNSIGNED DEFAULT NULL,
  `announcement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `name`, `type`, `url`, `page_id`, `news_id`, `announcement_id`, `parent_id`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Profil', 'custom', '#', NULL, NULL, NULL, NULL, 1, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(2, 'Informasi Publik', 'custom', '#', NULL, NULL, NULL, NULL, 2, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(3, 'Berita', 'news', NULL, NULL, NULL, NULL, NULL, 3, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(4, 'Pengumuman', 'announcement', NULL, NULL, NULL, NULL, NULL, 4, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(5, 'Regulasi', 'custom', 'https://ppid.konawekab.go.id/regulation', NULL, NULL, NULL, NULL, 5, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(6, 'Galeri', 'custom', 'https://ppid.konawekab.go.id/gallery', NULL, NULL, NULL, NULL, 6, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(7, 'Kontak', 'custom', 'https://ppid.konawekab.go.id/kontak', NULL, NULL, NULL, NULL, 7, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(8, 'Profil Singkat PPID', 'page', '#', 1, NULL, NULL, 1, 1, '2026-01-11 13:54:03', '2026-01-25 20:36:31'),
(9, 'Visi dan Misi PPID', 'page', '#', 2, NULL, NULL, 1, 2, '2026-01-11 13:54:03', '2026-01-27 20:41:57'),
(10, 'Struktur PPID', 'custom', '#', NULL, NULL, NULL, 1, 3, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(11, 'Maklumat PPID', 'custom', '#', NULL, NULL, NULL, 1, 4, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(12, 'SOP', 'page', '#', 3, NULL, NULL, 1, 5, '2026-01-11 13:54:03', '2026-01-28 17:04:43'),
(13, 'Standar Pelayanan', 'page', '#', 7, NULL, NULL, 1, 6, '2026-01-11 13:54:03', '2026-02-04 16:55:40'),
(14, 'Sarpras PPID', 'custom', '#', NULL, NULL, NULL, 1, 7, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(15, 'Anggaran PPID', 'custom', '#', NULL, NULL, NULL, 1, 8, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(16, 'Dokumen PPID', 'custom', '#', NULL, NULL, NULL, 1, 9, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(17, 'Informasi Berkala', 'page', '#', 5, NULL, NULL, 2, 1, '2026-01-11 13:54:03', '2026-02-03 18:07:40'),
(18, 'Informasi Setiap Saat', 'custom', '#', NULL, NULL, NULL, 2, 2, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(19, 'Informasi Serta Merta', 'custom', '#', NULL, NULL, NULL, 2, 3, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(20, 'Informasi Dikecualikan', 'custom', '#', NULL, NULL, NULL, 2, 4, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(21, 'Daftar Informasi Publik', 'custom', '#', NULL, NULL, NULL, 2, 5, '2026-01-11 13:54:03', '2026-01-11 13:54:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_opds_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(3, '0001_01_01_000001_create_cache_table', 1),
(4, '0001_01_01_000002_create_jobs_table', 1),
(5, '2025_08_01_020435_create_profiles_table', 1),
(6, '2025_08_01_020717_create_categories_table', 1),
(7, '2025_08_01_020718_create_news_table', 1),
(8, '2025_08_01_020939_create_announcements_table', 1),
(9, '2025_08_01_021123_create_documents_table', 1),
(10, '2025_08_01_061005_create_pages_table', 1),
(11, '2025_08_04_015335_create_carousels_table', 1),
(12, '2025_08_04_015755_create_contacts_table', 1),
(13, '2025_08_04_020015_create_faqs_table', 1),
(14, '2025_08_04_020231_create_galleries_table', 1),
(15, '2025_08_04_020243_create_regulations_table', 1),
(16, '2025_08_04_020634_create_menus_table', 1),
(17, '2025_09_17_053339_create_social_media_table', 1),
(18, '2025_11_02_093309_create_pengaturan_table', 1),
(19, '2026_01_11_025214_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `source_type` enum('ppid_utama','ppid_pelaksana') NOT NULL DEFAULT 'ppid_utama',
  `opd_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id`, `category_id`, `title`, `slug`, `content`, `image`, `is_featured`, `views`, `source_type`, `opd_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Bupati Konawe Resmikan Sejumlah Puskesmas, Tegaskan Komitmen Peningkatan Layanan Kesehatan.', 'bupati-konawe-resmikan-sejumlah-puskesmas-tegaskan-komitmen-peningkatan-layanan-kesehatan', '<p>&nbsp;</p><p>Konawe – Pemerintah Kabupaten Konawe terus memperkuat komitmennya dalam meningkatkan kualitas pelayanan kesehatan bagi masyarakat. Bupati Konawe, Yusran Akbar, S.T., meresmikan sejumlah gedung Puskesmas yang dipusatkan di Kecamatan Lambuya sebagai bagian dari upaya peningkatan sarana dan prasarana kesehatan di daerah.</p><p>Dalam sambutannya, Bupati Konawe menegaskan bahwa Puskesmas merupakan ujung tombak pelayanan kesehatan masyarakat. Oleh karena itu, keberadaan fasilitas kesehatan yang representatif, mudah diakses, serta didukung oleh tenaga kesehatan yang profesional menjadi prioritas utama Pemerintah Kabupaten Konawe.</p><p>“Pembangunan dan peningkatan fasilitas Puskesmas merupakan bentuk komitmen pemerintah daerah dalam menghadirkan pelayanan kesehatan yang optimal, cepat, dan berkualitas bagi masyarakat,” ujar Bupati.Bupati Konawe menyampaikan bahwa peningkatan kualitas pelayanan kesehatan difokuskan pada tiga aspek utama, yaitu aksesibilitas fasilitas kesehatan, peningkatan kualitas sumber daya manusia kesehatan, serta efisiensi pelayanan dan pengelolaan anggaran. Ketiga aspek tersebut diharapkan mampu mendorong pelayanan kesehatan yang merata dan berkeadilan di seluruh wilayah Kabupaten Konawe.</p><p>Lebih lanjut, Bupati menekankan pentingnya kolaborasi dan sinergi antara pemerintah daerah, kepala puskesmas, tenaga kesehatan, aparatur sipil negara (ASN), serta masyarakat dalam mewujudkan layanan kesehatan yang prima. Pemerintah daerah juga berkomitmen melakukan pemerataan tenaga medis, peningkatan insentif, serta pengembangan kompetensi tenaga kesehatan guna mendukung peningkatan mutu pelayanan.</p><p>Selain aspek pelayanan kesehatan, Bupati Konawe juga mengajak seluruh pihak untuk menggunakan media sosial secara bijak dan bertanggung jawab dalam mendukung pembangunan daerah, khususnya di sektor kesehatan.</p><p></p><p><br></p><p>Peresmian gedung Puskesmas tersebut turut dihadiri oleh jajaran Forum Koordinasi Pimpinan Daerah (Forkopimda), Kepala Dinas Kesehatan Kabupaten Konawe, para camat, kepala puskesmas, serta tokoh masyarakat. Kegiatan diawali dengan doa bersama dan dilanjutkan dengan peninjauan langsung fasilitas Puskesmas Lambuya yang kini dilengkapi ruang pelayanan gawat darurat, ruang persalinan, dan laboratorium sederhana.</p><p>Melalui peresmian Puskesmas Wawotobi, Alosika, Anggaberi, dan Lambuya, Pemerintah Kabupaten Konawe berharap akses layanan kesehatan semakin merata, terutama bagi masyarakat di wilayah pedesaan, serta mampu mendukung terwujudnya masyarakat Konawe yang sehat, mandiri, dan produktif.[arm,<a href=\"https://www.facebook.com/hashtag/ikp?__eep__=6&amp;__cft__[0]=AZbkiyot6iSkzKdD5bGg3xfcmh4SLXP4-h4-InjUj3uc4ugV9LjtMDehdjXKUfJjv93KaEQhRMlo7CVhBnTNbp4VDNUfmyeJuAXn74lBoPKFqf2N4xg4_bTMnplMAchyKXkaq4hM6ayvczkpY-NDQ38sCV-DZmsQy24KqvV7wJG6Y2mNZlaqv-NUZ2eW3lE7fhslAgBX46Tlo4Reu7uexBmu&amp;__tn__=*NK-R\"><strong>#ikp</strong></a>]&nbsp;</p>', 'berita/01KFWH3NPRPXPNCG1WS5RKF9MQ.jpg', 0, 98, 'ppid_utama', NULL, 1, '2026-01-25 20:51:07', '2026-04-07 06:27:24'),
(2, NULL, 'Lepas Bantuan Pangan Beras, Bupati Konawe Diwakili Sekda Minta Penyaluran Dikawal dan Tepat Sasaran', 'lepas-bantuan-pangan-beras-bupati-konawe-diwakili-sekda-minta-penyaluran-dikawal-dan-tepat-sasaran', '<p>Konawe, Sulawesi Tenggara – Pemerintah Kabupaten Konawe kembali menunjukkan komitmennya sebagai salah satu lumbung pangan nasional dengan melepas bantuan pangan berupa beras ke Provinsi Sulawesi Utara.</p><p>Pelepasan bantuan tersebut dilaksanakan pada Senin (2/2/2026) di halaman Kantor Bupati Konawe. Kegiatan ini diwakili oleh Sekretaris Daerah (Sekda) Konawe, Dr. Ferdinand, SP, MH, yang mewakili Bupati Konawe. Sebanyak 2.000 ton beras dikirim melalui Perum Bulog untuk disalurkan kepada masyarakat di Sulawesi Utara.</p><p>Pelepasan bantuan pangan beras ini menegaskan peran strategis Kabupaten Konawe sebagai lumbung pangan nasional sekaligus menjadi wujud nyata kontribusi daerah dalam menjaga ketahanan pangan. Bantuan tersebut juga melanjutkan tradisi penyaluran beras ke berbagai wilayah lain, seperti Papua, Sulawesi Tengah, dan Ambon.</p><p>Sekda Konawe, mewakili Bupati Konawe Yusran Akbar, ST, menegaskan bahwa capaian tersebut tidak terlepas dari kerja sama berbagai pihak, mulai dari pemerintah daerah, Perum Bulog, lembaga penelitian, hingga dukungan pemerintah pusat. Menurutnya, sinergi tersebut memastikan tata niaga beras berjalan dengan baik.</p><p>Ia juga menekankan pentingnya pengawalan distribusi bantuan agar penyaluran beras benar-benar tepat sasaran dan diterima oleh masyarakat yang berhak.</p><p>“Penyaluran bantuan ini harus dikawal dengan baik agar manfaatnya dapat dirasakan langsung oleh masyarakat penerima,” tegasnya.</p><p>Penghargaan yang diberikan Menteri Pertanian kepada Bulog Kabupaten Konawe, lanjutnya, menjadi bukti keberhasilan tata kelola pangan yang telah dilakukan selama ini. Pelepasan beras ini tidak hanya menjadi simbol solidaritas antar daerah, tetapi juga mencerminkan tanggung jawab bersama dalam memperkuat ketahanan pangan nasional.</p><p>Dengan doa dan semangat kebersamaan, bantuan beras ke Sulawesi Utara diharapkan dapat memberikan manfaat besar bagi masyarakat penerima, sekaligus semakin memperkokoh posisi Kabupaten Konawe sebagai penopang utama pangan di Sulawesi Tenggara dan Indonesia.</p><p>Turut hadir dalam kegiatan tersebut Kepala Bulog Konawe, Abdan Djarmin, serta sejumlah kepala Organisasi Perangkat Daerah (OPD) lingkup Pemerintah Kabupaten Konawe.</p><p>Kabupaten Konawe dikenal sebagai salah satu daerah penghasil beras terbesar di Sulawesi Tenggara. Surplus produksi beras yang dimiliki memungkinkan daerah ini berkontribusi aktif dalam menjaga ketahanan pangan nasional melalui penyaluran bantuan ke daerah lain.</p><p>Pelepasan bantuan pangan beras ini menjadi bukti nyata solidaritas antar daerah sekaligus memperkuat peran Konawe sebagai penopang ketahanan pangan nasional. Dengan pengawalan yang ketat, bantuan tersebut diharapkan benar-benar bermanfaat bagi masyarakat Sulawesi Utara yang membutuhkan.</p>', 'berita/01KGK1ZG0VZYM2NTEZRV0P9THJ.jpg', 0, 63, 'ppid_utama', NULL, 1, '2026-02-03 17:49:00', '2026-04-07 06:29:47'),
(3, NULL, 'BPS Konawe Rilis Indeks Harga Konsumen (IHK) Kabupaten Konawe Bulan Januari 2026', 'bps-konawe-rilis-indeks-harga-konsumen-ihk-kabupaten-konawe-bulan-januari-2026', '<p>Konawe –&nbsp; Badan Pusat Statistik (BPS) Kabupaten Konawe merilis data terbaru Indeks Harga Konsumen (IHK) untuk bulan Januari 2026 di Ruang Rapat Badan Pusat Statistik Kabupaten Konawe, Senin (2/2/2026).</p><p>Rilis IHK tersebut dihadiri oleh Asisten III Setda Konawe, Kabag Ekonomi, serta sejumlah OPD lingkup Pemda Kabupaten Konawe.</p><p>Dalam rilis resmi yang disampaikan, Plt. Kepala BPS Kabupaten Konawe, Fatchur Rochman, <a href=\"https://l.facebook.com/l.php?u=http%3A%2F%2FS.ST%2F%3Ffbclid%3DIwZXh0bgNhZW0CMTAAYnJpZBExTVVZUmNybFk5Z29wVllMWXNydGMGYXBwX2lkEDIyMjAzOTE3ODgyMDA4OTIAAR69spYm8fGorFDgeJHqLmdl9M00Xwl8NVWW65b_0pmBE0m-ZywLfQbeRqUkug_aem_CQLa1PXjKMV-pMfclia7Jw&amp;h=AT0LGSD-HtGNnPpTuQ7p6klc4hj6dwFheB3i3XEnYw6l2O3R2Dwy1c76Dj-K4wFH8eqprhiDVpv3h6MzPXrUTQSKdmqTbhj48N7dE4c_axO84jtNPlWqIYiyDCgbSv0YFW4yEq-RmZpVp9Y8Nw&amp;__tn__=-UK-R&amp;c[0]=AT3Fk2-cMdjpMFqAwXkPOCKex4yzspL2RdsbiqgSdcVDwuCvHoBDaOxo5oAKBmvQRIu9AHF6fLl5T8DjXfsdjjupYpI20AAIaKbX7c08KbLcrlabgpYSHbmOxQaf4b1SgzjUdS7wfVRqBYJkGLsSOS6_Mt_qSPrdEBTuwCZOs2Q6HmqUHYnEl1dELnobFQS9rJjDnPoyMp2vPT-i6gm3XA7k5xgvdw\"><strong>S.ST.</strong></a>, M.E., menyampaikan bahwa inflasi year-on-year terjadi karena adanya kenaikan harga yang ditunjukkan oleh naiknya beberapa indeks kelompok pengeluaran, yaitu: Kelompok makanan, minuman, dan tembakau sebesar 3,32 persen,Kelompok pakaian dan alas kaki sebesar 0,14 persen, Kelompok perumahan, air, listrik, dan bahan bakar rumah tangga sebesar 16,66 persen, Kelompok perlengkapan, peralatan, dan pemeliharaan rutin rumah tangga sebesar 0,67 persen,Kelompok kesehatan sebesar 16,58 persen,Kelompok transportasi sebesar 0,61 persen,Kelompok pendidikan sebesar 1,42 persen, Kelompok penyediaan makanan dan minuman/restoran sebesar 1,29 persen, Kelompok perawatan pribadi dan jasa lainnya sebesar 4,5 persen.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;627483425_122206254644507032_357008677300022737_n.jpg&quot;,&quot;filesize&quot;:73369,&quot;height&quot;:525,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/ID8k4L5rYjU50DOVzV0ejn2N13XgAtAXTdkjpgTZ.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/ID8k4L5rYjU50DOVzV0ejn2N13XgAtAXTdkjpgTZ.jpg&quot;,&quot;width&quot;:383}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;caption&quot;:&quot;Sumber: BPS Kab. Konawe&quot;,&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/ID8k4L5rYjU50DOVzV0ejn2N13XgAtAXTdkjpgTZ.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/ID8k4L5rYjU50DOVzV0ejn2N13XgAtAXTdkjpgTZ.jpg\" width=\"383\" height=\"525\"><figcaption class=\"attachment__caption attachment__caption--edited\">Sumber: BPS Kab. Konawe</figcaption></a></figure>Adapun indeks kelompok pengeluaran yang mengalami penurunan adalah kelompok informasi, komunikasi, dan jasa keuangan sebesar 0,14 persen. Sementara itu, kelompok rekreasi, olahraga, dan budaya tidak mengalami perubahan indeks.</p><p>Kepala BPS Kabupaten Konawe berharap agar rilis rutin Indeks Harga Konsumen (IHK) setiap bulan tidak hanya menjadi laporan angka statistik semata, tetapi juga dijadikan rujukan penting oleh Pemerintah Daerah Konawe dalam menyusun kebijakan. Data IHK yang menggambarkan inflasi maupun deflasi di daerah diharapkan dapat dimanfaatkan secara tepat oleh pemangku kepentingan, khususnya Tim Pengendalian Inflasi Daerah (TPID), guna menjaga stabilitas harga dan daya beli masyarakat.</p>', 'berita/01KGNGQGZSVJX2ANBT8NFNX0DQ.jpg', 0, 31, 'ppid_pelaksana', 1, 1, '2026-02-04 16:45:17', '2026-04-07 03:05:48'),
(4, NULL, 'Bupati Konawe Pimpin Apel Gabungan ASN di Halaman Kantor Bupati', 'bupati-konawe-pimpin-apel-gabungan-asn-di-halaman-kantor-bupati', '<p>Konawe&nbsp; – Bupati Konawe, Yusran Akbar, ST, memimpin apel gabungan Aparatur Sipil Negara (ASN) dan Pegawai Pemerintah dengan Perjanjian Kerja (P3K) di lingkungan Pemerintah Kabupaten Konawe. Kegiatan tersebut dilaksanakan di halaman Kantor Bupati Konawe, Senin (9 /2/26 )</p><p>Apel gabungan ini diikuti oleh seluruh kepala perangkat daerah, pejabat struktural dan fungsional, serta staf ASN lingkup Pemerintah Kabupaten Konawe.</p><p>Dalam arahannya, Bupati Yusran Akbar menekankan pentingnya disiplin, tanggung jawab, dan profesionalisme dalam menjalankan tugas pemerintahan serta pelayanan publik. Ia mengingatkan seluruh ASN dan Pegawai Pemerintah dengan Perjanjian Kerja (P3K), agar senantiasa menjaga etika, meningkatkan kinerja, dan memberikan pelayanan terbaik kepada masyarakat.</p><p>“Saya berharap seluruh ASN dan Pegawai Pemerintah dengan Perjanjian Kerja (P3K) dapat bekerja dengan disiplin, menjaga etika, dan memberikan pelayanan yang maksimal kepada masyarakat Konawe,” tegasnya.</p><p>Lebih lanjut, Bupati menyampaikan bahwa apel gabungan ini juga menjadi momentum untuk meningkatkan kesiapan jajaran pemerintah daerah dalam menyambut bulan suci Ramadan. Menurutnya, Ramadan harus dimaknai sebagai sarana memperkuat keimanan, kebersamaan, serta kepedulian terhadap kebersihan dan ketertiban lingkungan.</p><p>“Ramadan adalah momentum kebersamaan dan introspeksi diri. Mari kita jaga kebersihan lingkungan serta menciptakan suasana yang aman dan nyaman, baik di lingkungan kerja maupun di tengah masyarakat,” ujarnya.</p><p>Di akhir arahannya, Bupati Yusran Akbar mengajak seluruh ASN dan Pegawai Pemerintah dengan Perjanjian Kerja (P3K) untuk terus bersinergi dalam mendukung program pembangunan daerah serta menjaga kondusivitas wilayah Kabupaten Konawe.</p><p>“Dengan kerja sama, kekompakan, dan komitmen bersama, saya yakin kita dapat mewujudkan Konawe yang tertib, bersih, dan sejahtera,” tutupnya.&nbsp;</p>', 'berita/01KH51ERYKZFHAS8K2T2D5RZ7R.jpg', 0, 37, 'ppid_pelaksana', 1, 1, '2026-02-10 17:26:12', '2026-04-07 06:29:12'),
(5, NULL, 'Bupati Konawe Tegaskan Arah Pembangunan di Forum OPD RKPD 2027', 'bupati-konawe-tegaskan-arah-pembangunan-di-forum-opd-rkpd-2027', '<p>Konawe – Bupati Konawe Yusran Akbar, ST memimpin langsung pelaksanaan Forum Organisasi Perangkat Daerah (OPD) dalam rangka penyusunan Rencana Kerja Pemerintah Daerah (RKPD) Kabupaten Konawe Tahun 2027.&nbsp;</p><p>Kegiatan ini menjadi momentum strategis untuk menyelaraskan arah kebijakan pembangunan daerah dengan kebutuhan masyarakat serta prioritas pembangunan nasional dan provinsi. Kegiatan ini merupakan tahapan penting dalam proses perencanaan pembangunan daerah yang partisipatif dan terintegrasi.</p><p>Dalam sambutannya, Bupati Konawe Yusran Akbar, ST&nbsp; menekankan bahwa Forum OPD memiliki peran strategis dalam menyelaraskan program dan kegiatan setiap perangkat daerah agar sejalan dengan visi dan misi pembangunan Kabupaten Konawe. Ia meminta seluruh OPD menyusun perencanaan yang berbasis kebutuhan masyarakat serta berorientasi pada hasil dan dampak nyata.“Perencanaan yang baik adalah kunci keberhasilan pembangunan. Oleh karena itu, seluruh OPD harus mampu merumuskan program yang tepat sasaran, terukur, dan saling mendukung,” tegas Bupati.</p><p>Bupati juga menyoroti pentingnya sinergi dan kolaborasi antarperangkat daerah guna menghindari tumpang tindih program serta memastikan efisiensi penggunaan anggaran. Ia berharap program prioritas yang dirumuskan melalui Forum OPD ini dapat mendorong percepatan pembangunan dan peningkatan kesejahteraan masyarakat.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;bupati 2.jpg&quot;,&quot;filesize&quot;:522526,&quot;height&quot;:1365,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/HljTkcTSY9XfXA5j3Ab7wqms1FaW2GZB24tZ5GQp.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/HljTkcTSY9XfXA5j3Ab7wqms1FaW2GZB24tZ5GQp.jpg&quot;,&quot;width&quot;:2048}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/HljTkcTSY9XfXA5j3Ab7wqms1FaW2GZB24tZ5GQp.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/HljTkcTSY9XfXA5j3Ab7wqms1FaW2GZB24tZ5GQp.jpg\" width=\"2048\" height=\"1365\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">bupati 2.jpg</span> <span class=\"attachment__size\">510.28 KB</span></figcaption></a></figure>Selain itu, Bupati menegaskan pentingnya pelaksanaan pembangunan yang taat aturan, transparan, dan bertanggung jawab. Setiap penggunaan anggaran harus benar-benar memberikan manfaat nyata bagi masyarakat, mengingat dana yang dibelanjakan pada dasarnya merupakan milik rakyat dan wajib diawasi bersama.</p><p>Bupati Konawe juga menyampaikan komitmennya untuk terus memantau pelaksanaan program pembangunan agar tidak terjadi penyimpangan serta menghindari belanja yang tidak bermanfaat. Dengan sinergi, pengawasan, dan pemahaman bersama, pembangunan daerah diharapkan dapat berjalan efektif, tepat sasaran, dan berkelanjutan.</p><p>Forum OPD RKPD Tahun 2027 ini diikuti oleh seluruh kepala OPD, jajaran Badan Perencanaan Pembangunan Daerah (Bappeda), serta para pemangku kepentingan terkait. Dalam forum tersebut, masing-masing OPD memaparkan rencana program dan kegiatan yang selanjutnya dibahas serta diselaraskan dengan prioritas pembangunan daerah.</p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;foto bersama.jpg&quot;,&quot;filesize&quot;:561932,&quot;height&quot;:1365,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/aPw3o73Z2HPQOuMXhVujAsoxNNOSuI6e5d8GU5ch.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/aPw3o73Z2HPQOuMXhVujAsoxNNOSuI6e5d8GU5ch.jpg&quot;,&quot;width&quot;:2048}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/aPw3o73Z2HPQOuMXhVujAsoxNNOSuI6e5d8GU5ch.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/aPw3o73Z2HPQOuMXhVujAsoxNNOSuI6e5d8GU5ch.jpg\" width=\"2048\" height=\"1365\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">foto bersama.jpg</span> <span class=\"attachment__size\">548.76 KB</span></figcaption></a></figure>Usai memimpin rapat Forum Organisasi Perangkat Daerah (OPD) Rencana Kerja Pemerintah Daerah (RKPD) Tahun 2027, Bupati Konawe melaksanakan penandatanganan Nota Kesepahaman (MoU) bersama Dinas Komunikasi, Informatika, dan Persandian serta Kepala Badan Pusat Statistik (BPS) Kabupaten Konawe. Penandatanganan Nota Kesepahaman tersebut dilakukan sebagai bentuk sinergi dalam mendukung implementasi Satu Data Indonesia di Kabupaten Konawe.</p><p>Melalui kerja sama ini, diharapkan terwujud peningkatan koordinasi antara Pemerintah Kabupaten Konawe dan BPS Konawe, khususnya dalam standardisasi data, sinkronisasi informasi, serta pemanfaatan data statistik sebagai dasar perencanaan dan pelaksanaan pembangunan yang lebih terarah dan berkelanjutan.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;ttd.jpg&quot;,&quot;filesize&quot;:571832,&quot;height&quot;:1365,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/RFtGftBFxL3EYRLNuRfn56ljXEgT6is86U4BNN1W.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/RFtGftBFxL3EYRLNuRfn56ljXEgT6is86U4BNN1W.jpg&quot;,&quot;width&quot;:2048}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/RFtGftBFxL3EYRLNuRfn56ljXEgT6is86U4BNN1W.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/RFtGftBFxL3EYRLNuRfn56ljXEgT6is86U4BNN1W.jpg\" width=\"2048\" height=\"1365\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">ttd.jpg</span> <span class=\"attachment__size\">558.43 KB</span></figcaption></a></figure>Melalui pelaksanaan Forum OPD ini, Pemerintah Kabupaten Konawe berharap dapat menghasilkan dokumen RKPD Tahun 2027 yang berkualitas, komprehensif, serta menjadi pedoman dalam pelaksanaan pembangunan daerah yang berkelanjutan</p>', 'berita/01KH5233ESXKDH4K4TT48Z37PV.jpg', 0, 54, 'ppid_pelaksana', 1, 1, '2026-02-10 17:37:18', '2026-04-07 08:12:16'),
(6, NULL, 'Dinas Kominfo dan Persandian Serahkan Piala “Indonesia Innovation Excellence Award 2026” kepada Bupati Konawe.', 'dinas-kominfo-dan-persandian-serahkan-piala-indonesia-innovation-excellence-award-2026-kepada-bupati-konawe', '<p>Konawe – Dinas Komunikasi, Informatika, dan Persandian (Kominfo dan Persandian) Kabupaten Konawe secara resmi menyerahkan piala penghargaan nasional “Indonesia Innovation Excellence Award 2026” yang diberikan oleh One Magazine kepada Bupati Konawe, Yusran Akbar, S.T. Penyerahan dilaksanakan dalam seremoni di Ruang Rapat Bupati Konawe, Kamis(19/2/2026).</p><p>Penghargaan tersebut merupakan bentuk apresiasi atas pengabdian, capaian kinerja, serta dedikasi Bupati Konawe dalam mendukung program nasional Presiden Republik Indonesia, “Wujudkan Asta Cita Menuju Indonesia Emas 2045”. Penilaian dilakukan tidak hanya pada aspek administratif, tetapi juga pada inovasi dan kerja nyata yang memberikan dampak langsung bagi masyarakat.</p><p>Pengakuan dari One Magazine ini diberikan setelah melalui proses evaluasi yang objektif dan komprehensif. Aspek yang dinilai meliputi tata kelola pemerintahan, efektivitas pelaksanaan program, serta keberlanjutan pembangunan yang berdampak luas bagi masyarakat.</p><p>Berbagai terobosan di bidang pelayanan publik, penguatan ekonomi lokal, serta pemanfaatan teknologi dalam tata kelola pemerintahan menjadi indikator penting dalam proses penilaian. Hal ini mencerminkan komitmen Pemerintah Kabupaten Konawe dalam menghadirkan inovasi yang berorientasi pada peningkatan kesejahteraan masyarakat.</p><p>Kepala Dinas Komunikasi, Informatika, dan Persandian Kabupaten Konawe, Drs. M. Akib Ras, <a href=\"https://l.facebook.com/l.php?u=http%3A%2F%2FM.Si%2F%3Ffbclid%3DIwZXh0bgNhZW0CMTAAYnJpZBExVUt1aW1OVWRJRXlRbkd6cHNydGMGYXBwX2lkEDIyMjAzOTE3ODgyMDA4OTIAAR4OkEaFh86HKXhV5R4e2zOYsKwZZeu2MryKOTpD6ytGZGtmaecCPVU4Iehhjw_aem_EQctdCWRyT2qde7ZYhZtVw&amp;h=AT6VAaSA1gf5sXWDWzSZ8ubmFdoUYENsF1AdEmkppVayR7TuBZxBU8eMOx6UQLOMznGZiMNXspjtVrQv_bVN8fbT1-YZDzgQZpmv3OzGBpF_YtNObdWfjtxXrasElw6UUiHFUdtRn0-5f7xvFw&amp;__tn__=-UK-R&amp;c[0]=AT675r6hxQoWpEbADcxwpdgljjc_1TwNZ__1xNf_vmPp8HA6L_ZSarJ5f7G6a1S4mpBgNpxRDrp1mPV5JxUe71gflpWIfoP9KYo1Ej7NaN-Z5oiOxS1NgI0URM_ZDKvPvMiRGOLkPkjv_ik9PKPf8wIrN7tgPiDz5NHXluKzSthx96SrrFitFfAbPzzz1VpHi5YpLQnMjsOdppotuVqusOR4-BEY2w\"><strong>M.Si.</strong></a>, menyampaikan bahwa penghargaan tersebut menjadi bukti nyata atas keseriusan pemerintah daerah dalam menyelaraskan kebijakan dengan agenda pembangunan nasional. Menurutnya, capaian ini merupakan hasil kerja kolektif seluruh perangkat daerah di bawah kepemimpinan Bupati Konawe.</p><p>Senada dengan itu, Kepala Bidang Pengelolaan Informasi dan Komunikasi Publik (IKP) Dinas Kominfo dan Persandian Kabupaten Konawe, Nurlina, S.Sos., M.M., menambahkan bahwa penghargaan ini memperkuat semangat inovasi dan kolaborasi dalam mewujudkan pembangunan daerah yang berkelanjutan.</p><p>Dengan diterimanya penghargaan tersebut, Pemerintah Kabupaten Konawe diharapkan semakin termotivasi untuk terus melahirkan program inovatif yang mendukung kemajuan daerah dan kesejahteraan masyarakat.</p>', 'berita/01KJ3VMYPB5A85XB8QTSM1DS2D.jpg', 0, 54, 'ppid_pelaksana', 1, 1, '2026-02-22 16:41:11', '2026-04-07 22:41:58'),
(7, NULL, 'Pelantikan Pejabat Konawe Digelar di TPA, Sarat Makna', 'pelantikan-pejabat-konawe-digelar-di-tpa-sarat-makna', '<p>Konawe – Yusran Akbar, S.T., melantik sejumlah pejabat struktural dan fungsional di lingkungan Pemerintah Kabupaten Konawe pada Jumat, [20 /2/ 26].</p><p>Prosesi pelantikan dilaksanakan di Tempat Pembuangan Akhir (TPA) Kabupaten Konawe dan berlangsung secara sederhana serta khidmat. Kegiatan tersebut dihadiri oleh Sekretaris Daerah, para kepala organisasi perangkat daerah, serta jajaran aparatur sipil negara.</p><p>Pelantikan ini menjadi bagian dari langkah strategis pemerintah daerah dalam memperkuat tata kelola pemerintahan dan meningkatkan kualitas pelayanan publik, terutama pada sektor kebersihan dan pengelolaan lingkungan. Penyelenggaraan kegiatan di area TPA mengandung pesan kuat mengenai keseriusan pemerintah dalam menangani persoalan persampahan secara berkelanjutan dan terintegrasi.</p><p>Dalam prosesi tersebut, Bupati Konawe memimpin langsung pengambilan sumpah dan janji jabatan. Para pejabat yang dilantik mengikuti pembacaan sumpah dengan penuh kesungguhan sebagai bentuk komitmen terhadap amanah yang diberikan. Pengucapan sumpah jabatan menjadi penegasan integritas, loyalitas, serta kesiapan untuk melaksanakan tugas sesuai dengan ketentuan peraturan perundang-undangan.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;pelantikan 2.jpg&quot;,&quot;filesize&quot;:766250,&quot;height&quot;:1365,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/F72yXVlhzrpul57dvXdokTmO22vHR97re9iZXAI9.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/F72yXVlhzrpul57dvXdokTmO22vHR97re9iZXAI9.jpg&quot;,&quot;width&quot;:2048}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/F72yXVlhzrpul57dvXdokTmO22vHR97re9iZXAI9.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/F72yXVlhzrpul57dvXdokTmO22vHR97re9iZXAI9.jpg\" width=\"2048\" height=\"1365\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">pelantikan 2.jpg</span> <span class=\"attachment__size\">748.29 KB</span></figcaption></a></figure>TPA sebagai lokasi pelantikan memiliki makna simbolis yang mendalam. Tempat tersebut merupakan titik akhir dari rangkaian aktivitas masyarakat, di mana seluruh sisa kegiatan dikumpulkan dan dikelola agar tidak menimbulkan dampak negatif bagi lingkungan. Makna ini mencerminkan bahwa pelayanan publik harus menyentuh seluruh aspek kehidupan, termasuk persoalan mendasar yang sering kali kurang mendapat perhatian.</p><p>Selain melambangkan tanggung jawab, TPA juga merepresentasikan proses transformasi. Sampah yang awalnya tidak bernilai dapat dikelola menjadi sesuatu yang bermanfaat melalui sistem dan manajemen yang tepat. Sejalan dengan itu, pejabat yang dilantik diharapkan mampu membawa perubahan positif, memperkuat organisasi perangkat daerah, serta meningkatkan efektivitas pelayanan kepada masyarakat.&nbsp;</p><p>Rotasi dan pengangkatan dilakukan berdasarkan evaluasi kinerja dan kebutuhan organisasi guna mendukung percepatan pembangunan daerah, khususnya dalam peningkatan kualitas kebersihan dan lingkungan hidup di Kabupaten Konawe.</p>', 'berita/01KJ3W2ZVJYB7PCWEN7EXGF41G.jpg', 0, 34, 'ppid_pelaksana', 1, 1, '2026-02-22 16:48:51', '2026-04-07 06:29:47'),
(8, NULL, 'Momentum HUT ke-66, Gubernur Sultra Pimpin Upacara di Konawe', 'momentum-hut-ke-66-gubernur-sultra-pimpin-upacara-di-konawe', '<p>KONAWE – Momentum Hari Ulang Tahun (HUT) ke-66 Kabupaten Konawe berlangsung khidmat dengan kehadiran Gubernur Sulawesi Tenggara (Sultra) yang didampingi Bupati dan Wakil Bupati Konawe serta bertindak sebagai inspektur upacara, Senin (3/3/2026).</p><p>Upacara yang digelar di Lapangan Kantor Bupati Konawe tersebut dihadiri jajaran Forkopimda Sultra, forkopimda konawe para kepala daerah dan perwakilan kabupaten se-Sultra, pimpinan OPD, tokoh masyarakat, serta peserta dari unsur ASN, TNI/Polri, dan organisasi kemasyarakatan.&nbsp;</p><p>Kehadiran para kepala daerah menjadi simbol solidaritas dan sinergi antardaerah dalam mendukung pembangunan di Sulawesi Tenggara.</p><p>Dalam amanatnya, Gubernur Mayjen TNI (Purn) Andi Sumangerukka, S.E., M.M.&nbsp; menyampaikan rasa syukur atas terselenggaranya peringatan HUT ke-66 Konawe. Ia menegaskan bahwa peringatan hari jadi tidak boleh sekadar menjadi agenda seremonial tahunan, melainkan harus dimaknai sebagai momentum refleksi dan evaluasi terhadap perjalanan pemerintahan, pembangunan, serta kehidupan bermasyarakat, berbangsa, dan bernegara.</p><p>Gubernur mengapresiasi berbagai capaian dan kemajuan yang telah diraih Konawe selama 66 tahun, termasuk sejumlah prestasi pada setiap periode kepemimpinan. Namun, ia mengingatkan bahwa masih terdapat tantangan yang harus diselesaikan, seperti persoalan sosial dan ekonomi, kemiskinan, pengangguran, inflasi, ancaman krisis pangan dan energi, kerusakan lingkungan, serta peningkatan profesionalisme dan integritas aparatur.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;HUT.jpg&quot;,&quot;filesize&quot;:559743,&quot;height&quot;:1274,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/r2bRAl5IskF1fCzGS3jtpICk0F66pYrW31S5WMdH.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/r2bRAl5IskF1fCzGS3jtpICk0F66pYrW31S5WMdH.jpg&quot;,&quot;width&quot;:1600}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/r2bRAl5IskF1fCzGS3jtpICk0F66pYrW31S5WMdH.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/r2bRAl5IskF1fCzGS3jtpICk0F66pYrW31S5WMdH.jpg\" width=\"1600\" height=\"1274\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">HUT.jpg</span> <span class=\"attachment__size\">546.62 KB</span></figcaption></a></figure>“Di usia ke-66 ini, Konawe harus semakin maju, mandiri, dan berdaya saing. Sinergi antara pemerintah daerah, provinsi, dan masyarakat menjadi kunci dalam mewujudkan kesejahteraan bersama,” ujarnya.</p><p>Ia juga menekankan pentingnya menjaga persatuan, membangun harmoni dalam keberagaman, serta mengedepankan nilai-nilai kearifan lokal. Selain itu, penguatan sektor pertanian, peningkatan kualitas pelayanan publik, pembangunan infrastruktur, dan pengembangan sumber daya manusia harus menjadi prioritas pembangunan ke depan.</p><p>Menurutnya, kolaborasi yang efektif, efisien, dan produktif antara pemerintah dan seluruh lapisan masyarakat akan menjadi kunci utama dalam mewujudkan pembangunan Konawe yang berkelanjutan.</p><p>Peringatan HUT ke-66 Kabupaten Konawe berlangsung penuh semangat kebersamaan dan optimisme untuk masa depan daerah yang lebih maju dan sejahtera.</p>', 'berita/01KJXT53VNSARXWRFBQZ7R3EAT.jpg', 0, 18, 'ppid_pelaksana', 1, 1, '2026-03-04 18:35:18', '2026-04-03 12:38:00'),
(9, NULL, 'Bupati Konawe Bersama KADIN dan IMI Berbagi Kebaikan di Bulan Suci Ramadan', 'bupati-konawe-bersama-kadin-dan-imi-berbagi-kebaikan-di-bulan-suci-ramadan', '<p>Bupati Konawe bersama Wakil Ketua Umum KADIN Indonesia Bidang Organisasi, KADIN Sulawesi Tenggara, Sekretaris Jenderal IMI Sultra, Pelaksana Harian (Plh) Ketua KADIN Konawe, serta Ketua IMI Konawe melaksanakan kegiatan berbagi kebaikan di bulan suci Ramadan yang berlangsung di Pesantren Darull Sholah, Desa Analahumbuti, Kecamatan Wawotobi, Sabtu (07/03/2026).<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;touring ramadhan 5.jpg&quot;,&quot;filesize&quot;:789551,&quot;height&quot;:2048,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/K0dWnYYPHuNUhxdXBjBdNoa4FrNe9lE0gkRhtMd6.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/K0dWnYYPHuNUhxdXBjBdNoa4FrNe9lE0gkRhtMd6.jpg&quot;,&quot;width&quot;:1536}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/K0dWnYYPHuNUhxdXBjBdNoa4FrNe9lE0gkRhtMd6.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/K0dWnYYPHuNUhxdXBjBdNoa4FrNe9lE0gkRhtMd6.jpg\" width=\"1536\" height=\"2048\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">touring ramadhan 5.jpg</span> <span class=\"attachment__size\">771.05 KB</span></figcaption></a></figure>Kegiatan ini merupakan wujud kepedulian sosial sekaligus momentum untuk mempererat tali silaturahmi antara pemerintah daerah, organisasi dunia usaha, dan masyarakat. Melalui kegiatan berbagi di bulan Ramadan yang penuh berkah ini, diharapkan dapat menumbuhkan semangat kebersamaan, kepedulian, serta memperkuat nilai-nilai keagamaan di tengah masyarakat.</p><p>Pemerintah Kabupaten Konawe terus mendorong berbagai kegiatan sosial dan keagamaan sebagai bagian dari upaya membangun masyarakat yang religius, harmonis, dan sejahtera.</p>', 'berita/01KNNB47F2RDD5VJCT7GG0RTKN.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 18:25:51', '2026-04-07 18:25:51'),
(10, NULL, 'Badan Pangan Nasional Lakukan Sidak Harga Pangan Jelang Idul Fitri di Pasar Tutuwi Motaha', 'badan-pangan-nasional-lakukan-sidak-harga-pangan-jelang-idul-fitri-di-pasar-tutuwi-motaha', '<p>KONAWE – Otoritas Kompeten Keamanan Pangan dari Badan Pangan Nasional melakukan inspeksi mendadak (sidak) harga dan ketersediaan bahan pangan di Pasar Sentral Tutuwi Motaha, Kelurahan Asinua, Kabupaten Konawe, menjelang Hari Raya Idul Fitri 1447 Hijriah. [9/3/2026]</p><p>Kegiatan tersebut dilakukan untuk memastikan stabilitas harga, ketersediaan bahan pangan, serta keamanan pangan yang beredar di masyarakat menjelang meningkatnya kebutuhan konsumsi pada hari besar keagamaan.</p><p>Dalam pelaksanaannya, tim dari <a href=\"https://www.facebook.com/hashtag/badanpangannasional?__eep__=6&amp;__cft__[0]=AZa84T6yy5n2qtf0jZ711iMjzHae3wU94P0kMqLCRSNar8Q7ALzBvbJYDThnVW9XoqCDpYdx48bVAG4n2EOiD560ZMhQFvZSbkFzWyCgbnkB8pAlml9P7tcx3GcoAVbJzuxsFA5a4p1hhWvQBM5jshPY&amp;__tn__=*NK-R\"><strong>#BadanPanganNasional</strong></a> didampingi oleh Kepala Dinas Ketahanan Pangan Kabupaten Konawe yang mewakili Bupati Konawe, Kepala Dinas Komunikasi dan Informatika Kabupaten Konawe, perwakilan Perum Bulog Cabang Unaaha, serta jajaran Kepolisian Negara Republik Indonesia melalui Polres Unaaha.</p><p>Tim meninjau langsung sejumlah komoditas pangan strategis yang dijual oleh para pedagang di pasar, seperti beras, gula pasir, minyak goreng, telur, daging ayam, cabai, dan bawang merah. Berdasarkan hasil pemantauan sementara, sebagian besar harga komoditas pangan masih berada pada kisaran yang relatif stabil, meskipun terdapat sedikit kenaikan pada beberapa komoditas akibat meningkatnya permintaan masyarakat menjelang Idul Fitri.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;badan pangan 2.jpg&quot;,&quot;filesize&quot;:744043,&quot;height&quot;:1365,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/sy4aM5bQDMvFI0hkKQ2YeFw7f2tHEZR8QmFR2t98.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/sy4aM5bQDMvFI0hkKQ2YeFw7f2tHEZR8QmFR2t98.jpg&quot;,&quot;width&quot;:2048}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/sy4aM5bQDMvFI0hkKQ2YeFw7f2tHEZR8QmFR2t98.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/sy4aM5bQDMvFI0hkKQ2YeFw7f2tHEZR8QmFR2t98.jpg\" width=\"2048\" height=\"1365\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">badan pangan 2.jpg</span> <span class=\"attachment__size\">726.6 KB</span></figcaption></a></figure>Perwakilan tim dari Badan Pangan Nasional, Anto, menyampaikan bahwa pemerintah hadir untuk memastikan ketersediaan dan keterjangkauan harga pangan bagi masyarakat, khususnya menjelang bulan Ramadan dan Hari Raya Idul Fitri. Pemerintah telah menetapkan instrumen pengendalian harga melalui kebijakan harga acuan agar harga pangan strategis tidak mengalami lonjakan ketika permintaan meningkat.</p><p>Melalui penetapan harga acuan tersebut, pemerintah berharap masyarakat tetap dapat membeli bahan pangan pokok dengan harga yang wajar. Di sisi lain, para pedagang juga masih dapat memperoleh keuntungan yang layak sehingga aktivitas perdagangan tetap berjalan dengan baik.</p><p>Selain itu, pemerintah juga terus menjaga ketersediaan pasokan pangan agar tetap stabil, sehingga kebutuhan masyarakat selama hari besar keagamaan dapat terpenuhi tanpa terjadi kelangkaan.</p><p>Berdasarkan hasil pemantauan di pasar, secara umum harga sejumlah komoditas pangan pokok seperti beras, bawang merah, bawang putih, dan minyak goreng masih berada dalam kisaran harga yang telah ditetapkan pemerintah. Oleh karena itu, diharapkan kondisi stabilitas harga tersebut dapat terus terjaga hingga perayaan Idul Fitri dan setelahnya, sehingga masyarakat tetap dapat memenuhi kebutuhan pangannya dengan baik.</p><p>Selain memantau harga, tim juga memberikan imbauan kepada para pedagang agar tetap menjaga kualitas dan keamanan pangan yang dijual kepada masyarakat. Hal tersebut penting untuk memastikan pangan yang dikonsumsi masyarakat tetap aman, sehat, dan layak selama bulan Ramadan hingga perayaan Idul Fitri.</p><p>Melalui kegiatan sidak ini, diharapkan distribusi pangan tetap berjalan lancar, harga kebutuhan pokok tetap terkendali, serta masyarakat dapat memenuhi kebutuhan pangan dengan aman dan terjangkau menjelang Hari Raya Idul Fitri 1447 Hijriah.</p>', 'berita/01KNNBGQY3SSFSA0CNEF9CS31W.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 18:32:41', '2026-04-07 18:32:41'),
(11, NULL, 'Bupati Konawe Hadiri Kegiatan Operasi Pangan Murah Menjelang Hari Raya Idul Fitri 1447 H', 'bupati-konawe-hadiri-kegiatan-operasi-pangan-murah-menjelang-hari-raya-idul-fitri-1447-h', '<p>KONAWE – Bupati Konawe, Yusran Akbar, S.T., menghadiri kegiatan Operasi Pangan Murah dalam rangka menyambut Hari Raya Idul Fitri 1447 Hijriah yang diselenggarakan oleh Bank Bahteramas. [11/3/26].</p><p>Kegiatan ini digelar sebagai upaya membantu masyarakat memperoleh kebutuhan pokok dengan harga yang lebih terjangkau menjelang hari raya.</p><p>Operasi Pangan Murah tersebut menyediakan berbagai komoditas kebutuhan pokok, di antaranya beras, minyak goreng, gula pasir, tepung terigu, telur, serta sejumlah bahan pangan lainnya yang dijual dengan harga lebih rendah dibandingkan harga pasar.</p><p>Dalam kesempatan tersebut, Bupati Konawe menyampaikan bahwa kondisi perekonomian daerah saat ini menunjukkan tren yang positif. Hal ini terlihat dari tingginya perputaran dan pembayaran kredit di Konawe yang mencapai sekitar 30 persen dari total kredit yang disalurkan di Sulawesi Tenggara, yang menandakan aktivitas usaha masyarakat berjalan dengan baik.</p><p>Pemerintah Kabupaten Konawe juga terus berupaya menjaga daya beli masyarakat melalui berbagai program, salah satunya melalui pelaksanaan pasar pangan murah. Upaya tersebut dilakukan untuk memastikan ketersediaan bahan pangan tetap terjaga sekaligus membantu mengendalikan laju inflasi. Berdasarkan data Februari 2026, tingkat inflasi di Kabupaten Konawe tercatat terkendali sehingga menunjukkan kondisi ekonomi daerah yang relatif stabil.</p><p>“Melalui kegiatan Operasi Pangan Murah ini, pemerintah daerah berharap masyarakat dapat terbantu dalam memenuhi kebutuhan pokok menjelang Hari Raya Idul Fitri, sekaligus menjaga stabilitas harga bahan pangan di pasaran,” ujar Bupati Konawe.</p><p>Pada kesempatan yang sama, Bupati Konawe juga menyampaikan apresiasi kepada Bank Bahteramas atas inisiatif dan dukungannya dalam penyelenggaraan kegiatan yang memberikan manfaat langsung bagi masyarakat. Pemerintah daerah berharap sinergi antara pemerintah, dunia usaha, dan sektor perbankan dapat terus diperkuat guna mendukung peningkatan kesejahteraan masyarakat serta menjaga stabilitas perekonomian daerah.</p>', 'berita/01KNNBNFC1RBXYH5Q1F10FK5S3.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 18:35:16', '2026-04-07 18:35:16'),
(12, NULL, 'Bupati Konawe Kunjungan Kerja ke Ditjen Bina Pemdes Kemendagri', 'bupati-konawe-kunjungan-kerja-ke-ditjen-bina-pemdes-kemendagri', '<p>KONAWE – Bupati Konawe, Yusran Akbar, melakukan kunjungan kerja ke Direktorat Jenderal Bina Pemerintahan Desa pada Kementerian Dalam Negeri guna membahas penguatan tata kelola pemerintahan desa serta sinkronisasi program pembangunan desa di Kabupaten Konawe.[13/3/26].</p><p>Dalam kunjungan tersebut, Bupati Konawe bersama jajaran Pemerintah Kabupaten Konawe melakukan konsultasi dan koordinasi terkait berbagai program strategis, terutama yang menyangkut pengelolaan dana desa, peningkatan kapasitas aparatur desa, serta upaya percepatan pembangunan di wilayah pedesaan.</p><p>Pertemuan tersebut dihadiri oleh jajaran pimpinan Ditjen Bina Pemerintahan Desa Kemendagri, di antaranya Direktur Jenderal Bina Pemerintahan Desa, Dr. Drs. La Ode Ahmad Pidana Bolombo, A.P., Sekretaris Ditjen Bina Pemdes Murtono, S.STP., serta Dra. Lusje Anneke Tabalujan, M.Pd.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;kunker kemendagri 2.jpg&quot;,&quot;filesize&quot;:82799,&quot;height&quot;:560,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/ayU0Wn5l367nOh7m8fGdNyj3uSpxPRerwHzwM4og.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/ayU0Wn5l367nOh7m8fGdNyj3uSpxPRerwHzwM4og.jpg&quot;,&quot;width&quot;:1080}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/ayU0Wn5l367nOh7m8fGdNyj3uSpxPRerwHzwM4og.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/ayU0Wn5l367nOh7m8fGdNyj3uSpxPRerwHzwM4og.jpg\" width=\"1080\" height=\"560\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">kunker kemendagri 2.jpg</span> <span class=\"attachment__size\">80.86 KB</span></figcaption></a></figure>Bupati Konawe menyampaikan bahwa kunjungan kerja ini bertujuan untuk memperkuat sinergi antara pemerintah daerah dan pemerintah pusat, khususnya dalam memastikan program pembangunan desa berjalan efektif dan tepat sasaran.</p><p>“Kami ingin memastikan seluruh kebijakan dan program pembangunan desa di Kabupaten Konawe selaras dengan regulasi serta arah kebijakan pemerintah pusat,” ujarnya.</p><p>Selain itu, dalam pertemuan tersebut juga dibahas sejumlah isu terkait pembinaan pemerintah desa, termasuk peningkatan kualitas pelayanan publik di desa serta penguatan peran pemerintah desa dalam mendorong pembangunan dan kesejahteraan masyarakat.</p><p>Pihak Direktorat Jenderal Bina Pemerintahan Desa menyambut baik kunjungan kerja Pemerintah Kabupaten Konawe dan berharap koordinasi seperti ini dapat terus dilakukan guna memperkuat tata kelola pemerintahan desa yang transparan, akuntabel, dan berorientasi pada pelayanan masyarakat.</p><p>Melalui kunjungan kerja ini, Pemerintah Kabupaten Konawe berharap berbagai program pembangunan desa dapat berjalan lebih optimal sehingga mampu mendorong peningkatan kesejahteraan masyarakat, khususnya di wilayah pedesaan Kabupaten Konawe.</p>', 'berita/01KNNBTHR6CAKK0A4YK631Q5PP.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 18:38:02', '2026-04-07 18:38:02'),
(13, NULL, 'DP3A Kabupaten Konawe Perkuat Pembinaan Remaja melalui Kegiatan Forum Anak', 'dp3a-kabupaten-konawe-perkuat-pembinaan-remaja-melalui-kegiatan-forum-anak', '<p>Konawe, 16 Maret 2026 — DP3A Kabupaten Konawe terus memperkuat pembinaan karakter generasi muda melalui berbagai kegiatan positif yang melibatkan Forum Anak Kabupaten Konawe sebagai wadah partisipasi anak dalam pembangunan daerah. Salah satu kegiatan yang dilaksanakan adalah pengajian, buka puasa bersama, dan edukasi remaja yang berkolaborasi dengan Ikatan Pelajar Muhammadiyah.</p><p>Kegiatan yang dilaksanakan di Mesjid At-Taqwa tersebut diikuti sekitar 30 peserta remaja berusia 15 hingga 18 tahun. Program ini menjadi bagian dari inovasi Forum Anak Kabupaten Konawe dalam menghadirkan ruang pembinaan yang edukatif, religius, dan sosial bagi generasi muda.</p><p>Kepala Dinas P3A Kabupaten Konawe, Noor Jannah, ST., <a href=\"https://l.facebook.com/l.php?u=http%3A%2F%2FM.Si%2F%3Ffbclid%3DIwZXh0bgNhZW0CMTAAYnJpZBExdDZKWXBiaVA0aHQ4VGJHS3NydGMGYXBwX2lkEDIyMjAzOTE3ODgyMDA4OTIAAR59Zten-_hYfeYTtIiaovczq_l4rh3jDMjOSb6rI_iM8-WGF5y2Iku7tvG1FA_aem_TO3dt0z14G4R4D4eQ1dYNg&amp;h=AT7zPWqw-ot5XCM1HsrPSDyp8_LMJdJagK1gI_OSSwBHpAZqiJJooft06HSTVLjIabviibPgp6hZB0B24aKKSdxxHSrQmiLL5_zc-WweBE__ZNyc4FjNpqiXwAVhBEiBjlkqOXnW2D7MwsPeYbdwDLWO0vaj1iq4ew&amp;__tn__=-UK-R&amp;c[0]=AT4okPdx33HdLTjWgUVaMuBKdlzV_r_RGQvLxM9HRrWARIhNs9fyJ2IjgJkJdjrA-SqZCx--FZA3E2NCf0QRxadpVSmoCcNsj_f_bQo3DENKmihzbWTgQuv1yrd5sUhEu-ud28H6LohyNQcDbYbkSIjrmBsN4n7AG8NUZjX53C4\"><strong>M.Si</strong></a>, melalui Kepala Bidang Pemenuhan Hak Anak, Wiwin, <a href=\"https://l.facebook.com/l.php?u=http%3A%2F%2FS.ST%2F%3Ffbclid%3DIwZXh0bgNhZW0CMTAAYnJpZBExdDZKWXBiaVA0aHQ4VGJHS3NydGMGYXBwX2lkEDIyMjAzOTE3ODgyMDA4OTIAAR6_AkXP8jxdJ7-dRaB61OTQAIMeYZzZqwp1Pc28pMCXYyPAMPovfhjZEzlRTQ_aem_b9t6DIQTTSxITMCYEtoFeA&amp;h=AT7-EcLkxN2OA8IT9Zc1Mjc0bPkNZOQt-lFcLkRVcu86RhHK2OvwX1DF12VHAxVYxX99CojpHvfI6ah3mPvJprGcDoeS7Xf7pfpDC3vgxYSj-7HvCKvgq-AEFvjokNH5DXecXpsYrEs62ttkyM2m9l8vyGjoxainhg&amp;__tn__=-UK-R&amp;c[0]=AT4okPdx33HdLTjWgUVaMuBKdlzV_r_RGQvLxM9HRrWARIhNs9fyJ2IjgJkJdjrA-SqZCx--FZA3E2NCf0QRxadpVSmoCcNsj_f_bQo3DENKmihzbWTgQuv1yrd5sUhEu-ud28H6LohyNQcDbYbkSIjrmBsN4n7AG8NUZjX53C4\"><strong>S.ST.</strong></a>, M.Kes, menyampaikan apresiasi atas terselenggaranya kegiatan yang dinilai sejalan dengan program perlindungan anak dan penguatan karakter remaja.</p><p>“Ibu Kepala Dinas sangat mendukung kegiatan Forum Anak yang berkolaborasi dengan Ikatan Pelajar Muhammadiyah, karena kegiatan seperti pengajian, buka puasa bersama, dan edukasi remaja merupakan bagian dari pembinaan generasi muda agar memiliki karakter yang baik, peduli terhadap sesama, serta memahami pentingnya perlindungan anak,” ujar Wiwin.</p><p>Menurutnya, kegiatan tersebut tidak hanya memperkuat nilai keagamaan, tetapi juga menjadi sarana pembelajaran sosial bagi remaja agar aktif berkontribusi di lingkungan masing-masing.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;dp3a 2.jpg&quot;,&quot;filesize&quot;:381919,&quot;height&quot;:900,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/J7ZKY5kRJaQtkzwciS3ovG3NDOw6jNJIlq3zCWvw.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/J7ZKY5kRJaQtkzwciS3ovG3NDOw6jNJIlq3zCWvw.jpg&quot;,&quot;width&quot;:1600}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/J7ZKY5kRJaQtkzwciS3ovG3NDOw6jNJIlq3zCWvw.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/J7ZKY5kRJaQtkzwciS3ovG3NDOw6jNJIlq3zCWvw.jpg\" width=\"1600\" height=\"900\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">dp3a 2.jpg</span> <span class=\"attachment__size\">372.97 KB</span></figcaption></a></figure>“Melalui Forum Anak, diharapkan remaja dapat terus menghadirkan inovasi kegiatan yang positif, menjadi pelopor di lingkungan masing-masing, serta berani menyampaikan apabila terdapat persoalan yang berkaitan dengan perlindungan anak,” tambahnya.</p><p>Selain pengajian dan buka puasa bersama, peserta juga&nbsp;</p><p>mendapatkan materi edukasi mengenai pencegahan kekerasan terhadap anak, larangan pekerja anak, bahaya merokok dan NAPZA, serta penguatan peran Forum Anak Daerah sebagai pelapor apabila terjadi kasus yang berkaitan dengan perlindungan anak.</p><p>Ketua Forum Anak Kabupaten Konawe menyampaikan bahwa kegiatan ini merupakan bentuk komitmen forum anak dalam menghadirkan aktivitas yang bermanfaat bagi remaja.</p><p>“Melalui kegiatan ini kami ingin menghadirkan aktivitas positif bagi remaja agar tidak hanya aktif dalam kegiatan keagamaan, tetapi juga memiliki pemahaman tentang pentingnya perlindungan anak dan kepedulian terhadap lingkungan sekitar,” ujarnya.</p><p>DP3A Kabupaten Konawe berharap kegiatan serupa dapat terus dikembangkan melalui kolaborasi lintas organisasi kepemudaan sehingga lahir generasi muda Konawe yang berkarakter, sehat, peduli, dan aktif dalam mendukung terciptanya lingkungan yang ramah anak.</p>', 'berita/01KNNC3SDXYKWWJ2NVJ02S8GHJ.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 18:43:05', '2026-04-07 18:43:05');
INSERT INTO `news` (`id`, `category_id`, `title`, `slug`, `content`, `image`, `is_featured`, `views`, `source_type`, `opd_id`, `created_by`, `created_at`, `updated_at`) VALUES
(14, NULL, 'Festival Mobil Hias Gema Takbir Konawe Bersahaja Pererat Silaturahmi Antarumat', 'festival-mobil-hias-gema-takbir-konawe-bersahaja-pererat-silaturahmi-antarumat', '<p>Konawe — Pemerintah Daerah Kabupaten Konawe menggelar Festival Mobil Hias Gema Takbir Konawe dalam rangka menyambut Hari Raya Idulfitri 1447 Hijriah. Kegiatan ini berlangsung meriah dengan mengusung semangat Konawe Bersahaja melalui gema takbir sebagai sarana mempererat silaturahmi antarumat. [20/2/26].</p><p>Sebanyak 62 peserta yang terdiri atas Organisasi Perangkat Daerah (OPD) dan seluruh kecamatan se-Kabupaten Konawe ambil bagian dalam festival tersebut. Setiap peserta menampilkan mobil hias dengan ornamen Islami yang kreatif dan sarat makna, diiringi lantunan takbir sepanjang rute yang telah ditetapkan.</p><p>Pawai mobil hias dimulai dari Kecamatan Wawotobi dan berakhir di depan Kantor Bupati Konawe, tepatnya di kawasan ICP. Iring-iringan kendaraan hias dipimpin langsung oleh wakil Bupati&nbsp; Konawe Syamsul Ibrahim, sehingga menambah semarak suasana malam takbiran.</p><p>Acara ini dihadiri oleh bupati konawe&nbsp; Yusran Akbar, ST bersama jajaran Forum Koordinasi Pimpinan Daerah (Forkopimda), pimpinan OPD, camat, lurah, kepala desa, Ketua Dekranasda Kab.Konawe tokoh agama, tokoh masyarakat, serta warga yang antusias menyaksikan jalannya festival.</p><p>Dalam sambutannya, Bupati Konawe menyampaikan apresiasi kepada panitia, peserta, perangkat daerah, organisasi kemasyarakatan, dan seluruh masyarakat yang telah berpartisipasi menyukseskan kegiatan tersebut. Menurutnya, festival ini tidak hanya menjadi bagian dari perayaan malam takbiran, tetapi juga sarana syiar Islam, ruang kreativitas masyarakat, dan penguat kebersamaan antarwarga.</p><p>Ia menilai tingginya antusiasme peserta terlihat dari kreativitas mobil hias yang ditampilkan oleh setiap kecamatan dan OPD. Festival ini, menurutnya, lahir dari semangat menghadirkan malam takbiran yang tertib, religius, dan memberi hiburan positif bagi masyarakat.</p><p>Bupati juga berharap semangat kebersamaan yang terbangun melalui kegiatan ini dapat terus berlanjut dalam berbagai agenda daerah. Salah satunya pada pelaksanaan Seleksi Tilawatil Quran Tingkat Provinsi Sulawesi Tenggara 2026 yang akan digelar di Konawe pada Juni mendatang.</p><p>Selain itu, ia mengingatkan seluruh peserta agar menjunjung sportivitas dalam menerima hasil perlombaan. Menurutnya, esensi festival terletak pada partisipasi, kreativitas, dan semangat persaudaraan, bukan semata-mata pada kemenangan.</p><p>Bupati juga mengajak masyarakat menjadikan momentum Idulfitri sebagai sarana memperkuat persaudaraan, menjaga ketertiban umum, serta membangun budaya saling menghargai dalam kehidupan bermasyarakat. Di akhir sambutannya, ia menyampaikan terima kasih kepada unsur pengamanan, Forkopimda, dan anggota Pramuka yang telah mendukung kelancaran kegiatan.</p><p>Sementara itu, Wakil Bupati Konawe H.Syamsul Ibrahim,SE.,<a href=\"https://l.facebook.com/l.php?u=http%3A%2F%2FM.Si%2F%3Ffbclid%3DIwZXh0bgNhZW0CMTAAYnJpZBExdDZKWXBiaVA0aHQ4VGJHS3NydGMGYXBwX2lkEDIyMjAzOTE3ODgyMDA4OTIAAR59Zten-_hYfeYTtIiaovczq_l4rh3jDMjOSb6rI_iM8-WGF5y2Iku7tvG1FA_aem_TO3dt0z14G4R4D4eQ1dYNg&amp;h=AT73t-_aMYhX6i0TakNEZKwgQuQLXBFhaDK0bCXlyKNkzVU8bkk5NygsPQB3gFkZoz5wUbkMac3dx5mxmOdEsOJotky5v4N_Oh8DiwAFDolKB2qc7dOc_XdvanV7Di8mpbMJqH9c8uKgb4ejPdmY-I5YJiO4qtawlg&amp;__tn__=-UK-R&amp;c[0]=AT43Dizu1Yd2MRtZVkrzmqb_PPSWHe6hhBcarBbTuzH_za7ECuKO-lyDCN7WID7ft0Nu5_H1pUWzfVDcT89SqOH2Yb7DNA-7Q5KrlvjPzs5zdSXdlxm7KQPgLIDwKYWoL5-Rzk8PyeuIAO5pRR0m4j99PsJ7TC7eHfFelg5966UOLc4uIBPfMrSdM7np3981WKAjg-XnhdcQtkw3erWmCaSe-xGHpw\"><strong>M.Si</strong></a> menyampaikan bahwa festival ini menjadi bukti kuatnya sinergi antara pemerintah daerah, aparat keamanan, dan masyarakat dalam menghadirkan kegiatan keagamaan yang tertib dan bernilai positif.</p><p>Ia mengapresiasi partisipasi seluruh peserta, panitia, pimpinan OPD, camat, lurah, kepala desa, organisasi kemasyarakatan, hingga kelompok majelis taklim yang turut memeriahkan kegiatan. Menurutnya, pelaksanaan festival mobil hias malam takbiran ini menjadi kebanggaan tersendiri karena menghadirkan inovasi dalam perayaan Idulfitri di Sulawesi Tenggara.</p><p>Wakil Bupati juga menekankan bahwa keberhasilan festival menjadi modal penting bagi Konawe sebagai tuan rumah Seleksi Tilawatil Quran tingkat provinsi. Ia berharap seluruh elemen daerah kembali bersinergi menyiapkan pelayanan terbaik bagi tamu dari berbagai kabupaten dan kota, termasuk dukungan terhadap UMKM lokal.</p><p>Selain itu, ia mengingatkan pentingnya menjaga kebersihan kawasan publik, terutama di sekitar kompleks perkantoran pemerintah yang kini menjadi pusat aktivitas masyarakat. Menurutnya, kebersihan merupakan tanggung jawab bersama dan bagian dari citra daerah.</p><p>Festival ini mendapat sambutan hangat dari masyarakat karena selain menjadi hiburan, juga menjadi ajang kreativitas OPD dan kecamatan dalam menyampaikan pesan-pesan keagamaan.</p><p>Setelah festival ditutup, kegiatan dilanjutkan dengan penyerahan hadiah kepada peserta terbaik. Penghargaan diberikan berdasarkan penilaian dewan juri terhadap aspek keindahan, kreativitas dekorasi, kekompakan tim, dan kesesuaian tema Islami yang ditampilkan.</p><p>Rangkaian kegiatan ditutup dengan harapan agar semangat Bersahaja terus terjaga dan mampu memperkuat keharmonisan, persaudaraan, serta persatuan di tengah keberagaman masyarakat Konawe</p>', 'berita/01KNNCEQW18SSMM534BBJJ0CKH.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 18:49:04', '2026-04-07 18:49:04'),
(15, NULL, 'Bupati Konawe Luncurkan Bantuan Pangan Alokasi Februari–Maret Tahun 2026', 'bupati-konawe-luncurkan-bantuan-pangan-alokasi-februari-maret-tahun-2026', '<p>Konawe – Yusran Akbar, ST&nbsp; secara resmi meluncurkan penyaluran bantuan pangan untuk alokasi bulan Februari dan Maret 2026 sebagai bagian dari komitmen pemerintah daerah dalam menjaga ketahanan pangan dan membantu masyarakat memenuhi kebutuhan pokok. [26/3/26]</p><p>Kegiatan peluncuran dilaksanakan di Perum Bulog Unit Unaaha dan dihadiri oleh Asisten III Sekretariat Daerah Konawe, Ketua DPRD Konawe, Kepala Bulog Konawe, Kepala BPS Konawe, unsur Forum Koordinasi Pimpinan Daerah (Forkopimda), kepala organisasi perangkat daerah (OPD), serta masyarakat penerima manfaat dari Kelurahan Tobeu dan Kelurahan Tuoy.</p><p>Dalam sambutannya, Bupati Konawe Yusran Akbar, ST menyampaikan apresiasi atas pelaksanaan bantuan pangan yang dinilai sangat membantu masyarakat, terutama dengan adanya peningkatan jumlah penerima manfaat dari 18.757 orang menjadi 30.847 orang. Menurutnya, peningkatan tersebut menunjukkan perhatian pemerintah dalam memperluas jangkauan perlindungan sosial bagi masyarakat yang membutuhkan.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;bantuan pangan.jpg&quot;,&quot;filesize&quot;:571500,&quot;height&quot;:1365,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/41GFOOQWs1LffsE9j8hojRdgeHsd8S7gA26nO4sl.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/41GFOOQWs1LffsE9j8hojRdgeHsd8S7gA26nO4sl.jpg&quot;,&quot;width&quot;:2048}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/41GFOOQWs1LffsE9j8hojRdgeHsd8S7gA26nO4sl.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/41GFOOQWs1LffsE9j8hojRdgeHsd8S7gA26nO4sl.jpg\" width=\"2048\" height=\"1365\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">bantuan pangan.jpg</span> <span class=\"attachment__size\">558.11 KB</span></figcaption></a></figure>Bupati Konawe juga mengimbau masyarakat agar tetap tenang dalam menghadapi isu kenaikan harga bahan pokok dan tidak melakukan pembelian secara berlebihan. Ia menegaskan bahwa pemerintah terus berupaya menjaga ketersediaan pasokan agar kebutuhan masyarakat tetap terpenuhi dengan harga yang terjangkau.</p><p>Selain itu, Bupati Konawe mengapresiasi sinergi antara pemerintah daerah, Bulog, dan seluruh pemangku kepentingan dalam menjaga stabilitas harga dan pengendalian inflasi di daerah. Berdasarkan data tahun 2025, Kabupaten Konawe masuk dalam nominasi kabupaten terbaik dalam penanggulangan inflasi, bahkan pada Februari 2026 tercatat sebagai daerah dengan kondisi inflasi paling stabil di Sulawesi Tenggara.</p><p>Peluncuran penyaluran bantuan pangan ditandai secara simbolis dengan pelepasan armada distribusi bantuan pangan yang akan menyalurkan beras kepada masyarakat penerima manfaat di berbagai wilayah Kabupaten Konawe. Pelepasan armada ini mencerminkan komitmen pemerintah daerah dalam memperkuat sistem distribusi pangan yang terencana, tepat sasaran, dan berkelanjutan.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;bantuan pangan 2.jpg&quot;,&quot;filesize&quot;:716303,&quot;height&quot;:1212,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/OoO1bS7uOjzbvwnuXEzwGz2XOSkCwm7p1tgiWzHO.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/OoO1bS7uOjzbvwnuXEzwGz2XOSkCwm7p1tgiWzHO.jpg&quot;,&quot;width&quot;:2048}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/OoO1bS7uOjzbvwnuXEzwGz2XOSkCwm7p1tgiWzHO.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/OoO1bS7uOjzbvwnuXEzwGz2XOSkCwm7p1tgiWzHO.jpg\" width=\"2048\" height=\"1212\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">bantuan pangan 2.jpg</span> <span class=\"attachment__size\">699.51 KB</span></figcaption></a></figure>Pemerintah Kabupaten Konawe memastikan seluruh proses distribusi bantuan pangan berjalan lancar, transparan, dan akuntabel dengan melibatkan seluruh pihak terkait. Program ini diharapkan dapat menjaga daya beli masyarakat, mendukung pengendalian inflasi pangan, serta meningkatkan kesejahteraan masyarakat secara berkelanjutan.&nbsp;</p><p>Melalui program ini, pemerintah berharap kesejahteraan masyarakat dapat terus meningkat serta daya beli masyarakat tetap terjaga di tengah berbagai tantangan ekonomi.</p>', 'berita/01KNNCRRPCCYB736RW1QMY9PK3.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 18:54:32', '2026-04-07 18:54:32'),
(16, NULL, 'Wakili Bupati, Sekda Konawe Matangkan Persiapan Kegiatan HUT ke-66', 'wakili-bupati-sekda-konawe-matangkan-persiapan-kegiatan-hut-ke-66', '<p>KONAWE – Sekretaris Daerah (Sekda) Kabupaten Konawe Dr. Ferdinand, SP.,MH mewakili Bupati Konawe memimpin rapat pemantapan pelaksanaan kegiatan Hari Ulang Tahun (HUT) Kabupaten Konawe ke-66. Aula Inowa [27/3/26]&nbsp;</p><p>Rapat tersebut diikuti oleh Kepala Organisasi Perangkat Daerah (OPD), Asisten III Setda Konawe, camat se-Kabupaten Konawe, Ketua TP-PKK Kabupaten Konawe, serta panitia pelaksana. Kegiatan ini bertujuan untuk memastikan seluruh rangkaian peringatan HUT berjalan lancar, tertib, dan sesuai rencana.</p><p>Dalam arahannya, Sekda menekankan pentingnya koordinasi dan kerja sama antarsemua pihak yang terlibat. Ia meminta setiap seksi kepanitiaan menjalankan tugasnya secara maksimal serta memperhatikan aspek teknis pelaksanaan kegiatan.</p><p>Sekda Konawe menjelaskan bahwa pelaksanaan HUT ke-66 memiliki tiga fokus utama, yaitu kesiapan penginapan, penyediaan kuliner, serta kelancaran transportasi dan rangkaian kegiatan secara keseluruhan. Hal ini penting guna memberikan pelayanan optimal bagi tamu dan masyarakat.</p><p>Ia juga menegaskan perlunya sinergi seluruh elemen, mulai dari panitia, OPD, hingga TP-PKK. Menurutnya, kolaborasi yang solid menjadi kunci keberhasilan penyelenggaraan kegiatan berskala besar.</p><p>Selain itu, Sekda memastikan kesiapan seluruh pihak, termasuk dukungan dari berbagai asosiasi dan pengamanan. Ia mengingatkan agar semua pihak menjaga komitmen dan koordinasi demi kelancaran kegiatan.</p><p>“Persiapan harus dilakukan secara matang. Setiap panitia harus memahami tugas dan tanggung jawabnya agar seluruh rangkaian kegiatan dapat berjalan sukses,” ujarnya.</p><p>Rapat juga membahas susunan agenda serta kesiapan sarana dan prasarana pendukung, termasuk lokasi kegiatan, pengamanan, dan partisipasi masyarakat. Panitia diminta mengantisipasi berbagai potensi kendala, seperti faktor cuaca dan teknis pelaksanaan.</p><p>Dengan dilaksanakannya rapat pemantapan ini, diharapkan seluruh rangkaian kegiatan HUT Konawe ke-66 dapat berlangsung dengan baik serta menjadi momentum mempererat kebersamaan dan meningkatkan semangat pembangunan di Kabupaten Konawe.</p>', 'berita/01KNNCWXVTFFG2Y0PWGY425G4T.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 18:56:49', '2026-04-07 18:56:49'),
(17, NULL, 'Ground Check PBI Tahap II Dimulai, Sekda Konawe Tekankan Pentingnya Data Akurat', 'ground-check-pbi-tahap-ii-dimulai-sekda-konawe-tekankan-pentingnya-data-akurat', '<p>Sekretaris Daerah Kabupaten Konawe,Dr. Ferdinand , SP.,MH secara resmi membuka kegiatan pelatihan lapangan Ground Check Penerima Bantuan Iuran (PBI) Tahap II sebagai bagian dari upaya peningkatan kualitas data sosial masyarakat dan validasi penerima bantuan jaminan kesehatan, Selasa Aula Inowa&nbsp; (31/3/2026).</p><p>Kegiatan tersebut dihadiri oleh Kepala Dinas Sosial,Kepala&nbsp; Badan Pusat Statistik Kabupaten Konawe, perangkat Dinas&nbsp; terkait, serta petugas lapangan yang akan melakukan verifikasi langsung terhadap data masyarakat penerima bantuan.&nbsp;</p><p>Dalam sambutannya, Sekda menegaskan bahwa akurasi data merupakan fondasi utama dalam penyusunan kebijakan pemerintah daerah, khususnya pada sektor pelayanan sosial dan kesehatan.&nbsp;</p><p>Sekda Konawe menyampaikan apresiasi kepada Badan Pusat Statistik, jajaran dinas terkait, serta tim lapangan yang akan melaksanakan kegiatan ground check peningkatan kualitas Data Tunggal Sosial Ekonomi Nasional (DTSEN), khususnya untuk verifikasi data penerima bantuan iuran (PBI) nonaktif.</p><p>Menurutnya, data yang akurat sangat penting karena menjadi dasar utama pemerintah daerah dalam menjalankan pembangunan dan penyelenggaraan pemerintahan. Hal tersebut sejalan dengan tujuan utama pembangunan daerah, yaitu meningkatkan kesejahteraan masyarakat, memperbaiki kualitas pelayanan publik, dan memperkuat daya saing daerah.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;pbi 2.jpg&quot;,&quot;filesize&quot;:605727,&quot;height&quot;:1365,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/mFz3ZgR6qQAaIHonKhUXqkIeelMT6NeTyh8OYyLF.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/mFz3ZgR6qQAaIHonKhUXqkIeelMT6NeTyh8OYyLF.jpg&quot;,&quot;width&quot;:2048}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/mFz3ZgR6qQAaIHonKhUXqkIeelMT6NeTyh8OYyLF.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/mFz3ZgR6qQAaIHonKhUXqkIeelMT6NeTyh8OYyLF.jpg\" width=\"2048\" height=\"1365\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">pbi 2.jpg</span> <span class=\"attachment__size\">591.53 KB</span></figcaption></a></figure>Sekda juga menekankan pentingnya koordinasi yang semakin intens antara pemerintah daerah dan Badan Pusat Statistik agar kualitas data sosial ekonomi semakin baik ke depan. Data yang valid, lanjutnya, akan memastikan program jaminan sosial, terutama layanan kesehatan melalui BPJS Kesehatan, dapat tepat sasaran dan berjalan sesuai kebutuhan masyarakat.&nbsp;</p><p>Selain itu, ia menjelaskan bahwa perbaikan data ini merupakan tindak lanjut dari kesepakatan pemerintah bersama DPR dalam menjaga keberlanjutan layanan kesehatan masyarakat, melakukan pengecekan desil berdasarkan data terbaru, serta membangun tata kelola jaminan kesehatan yang terintegrasi menuju satu data tunggal nasional.</p><p>Di akhir sambutannya, Sekda mengingatkan bahwa iuran BPJS merupakan bentuk tanggung jawab bersama dan solidaritas sosial, karena prinsip jaminan kesehatan adalah saling membantu antarwarga sesuai kebutuhan pelayanan kesehatan.</p><p>Melalui pelatihan ini, para petugas lapangan diharapkan mampu menjalankan proses verifikasi secara objektif, teliti, dan sesuai kondisi riil masyarakat, sehingga hasil pendataan benar-benar dapat menjadi dasar kebijakan yang tepat sasaran.&nbsp;</p><p>Jika data yang diperoleh akurat, maka program perlindungan sosial yang dijalankan pemerintah akan semakin efektif dalam meningkatkan kesejahteraan masyarakat Kabupaten Konawe.</p>', 'berita/01KNND1KQY6553M7PJVHKAVEVT.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 18:59:22', '2026-04-07 18:59:22'),
(18, NULL, 'BPS Konawe Rilis Indeks Harga Konsumen (IHK) Kabupaten Konawe Bulan Maret 2026', 'bps-konawe-rilis-indeks-harga-konsumen-ihk-kabupaten-konawe-bulan-maret-2026', '<p>Konawe – Badan Pusat Statistik (BPS) Kabupaten Konawe merilis data terbaru Indeks Harga Konsumen (IHK) untuk bulan Maret&nbsp; 2026 di Ruang Rapat Badan Pusat Statistik Kabupaten Konawe, Rabu&nbsp; (1/4/2026).</p><p>Rilis IHK tersebut dihadiri oleh Setda Konawe Dr Ferdinand,SP.,MH&nbsp; Kepala BAPPEDA, Kabag Ekonomi, serta sejumlah OPD lingkup Pemda Kabupaten Konawe.</p><p>Dalam rilis resmi yang disampaikan, Kepala BPS Kabupaten konawe&nbsp; Ade Ida Mane, <a href=\"https://l.facebook.com/l.php?u=http%3A%2F%2FS.St%2F%3Ffbclid%3DIwZXh0bgNhZW0CMTAAYnJpZBExdDZKWXBiaVA0aHQ4VGJHS3NydGMGYXBwX2lkEDIyMjAzOTE3ODgyMDA4OTIAAR6_AkXP8jxdJ7-dRaB61OTQAIMeYZzZqwp1Pc28pMCXYyPAMPovfhjZEzlRTQ_aem_b9t6DIQTTSxITMCYEtoFeA&amp;h=AT6N8ronemy4zIfKFkbaXpuBbBsv3JLXiwF5H4sKIT4Zyz4jQOTOJYhPT5btDAT0F8yesw45Dg54gHiN-5m9ZLz3QNsUvDtkXbRQYY8skuupWTPlNb6n9q4D5aWJdfaEsoQUdUVxBpAqhGXJv8SXg90vM78ftkK4Sw&amp;__tn__=-UK-R&amp;c[0]=AT6Xk0uRowes6auBwXFyG6CdMsey0p0bmStgVIGZRxoTiszFv6jr6OW72YbmAXcLn_B7CxwCywkc_G-GiaVOXPNM7OPwAdMA3Ahv4iwJjg7rGJ1kf31bn4rODdgcmBxQJZVO-gGABUAbaSsXPWCXJlGplFWmd22O5NhxLRsYg6M\"><strong>S.St</strong></a>, <a href=\"https://l.facebook.com/l.php?u=http%3A%2F%2FM.Si%2F%3Ffbclid%3DIwZXh0bgNhZW0CMTAAYnJpZBExdDZKWXBiaVA0aHQ4VGJHS3NydGMGYXBwX2lkEDIyMjAzOTE3ODgyMDA4OTIAAR5h3y8eH-YHKrjedQemXoPSoJEHXlzmL4Uot9h87UzHou0edKkLcKa53176JQ_aem_qhkNRFO7dZ8cF9j4HJ0PAg&amp;h=AT7poCvDRvgXHlJigp4sTyl_Bx4kJbmRZJ2vwOolpKf6r3hds-jcua__99XEZqr8Eng2WCck49YlPSMkUUnA105dfxuLHZiIVbNe-7v-dTFXvcbcvtzi925n5KuXuktA0ERV-jjAgqFuRhFQs3PSywzAPy1kBfpJOQ&amp;__tn__=-UK-R&amp;c[0]=AT6Xk0uRowes6auBwXFyG6CdMsey0p0bmStgVIGZRxoTiszFv6jr6OW72YbmAXcLn_B7CxwCywkc_G-GiaVOXPNM7OPwAdMA3Ahv4iwJjg7rGJ1kf31bn4rODdgcmBxQJZVO-gGABUAbaSsXPWCXJlGplFWmd22O5NhxLRsYg6M\"><strong>M.Si</strong></a>, di wakili Hasriati, S.Pi.&nbsp; Kordinator Statistik Distribusi Bps. Konawe, Pada Maret 2026 terjadi inflasi year on year (y-on-y) Kabupaten Konawe sebesar 1,81 persen dengan Indeks Harga Konsumen (IHK) sebesar 111,14.</p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;bps 2.jpg&quot;,&quot;filesize&quot;:299170,&quot;height&quot;:1066,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/I8rGt23MwaAg3eM5HZkOySZj3RKNldWqS5oyVj2D.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/I8rGt23MwaAg3eM5HZkOySZj3RKNldWqS5oyVj2D.jpg&quot;,&quot;width&quot;:1600}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/I8rGt23MwaAg3eM5HZkOySZj3RKNldWqS5oyVj2D.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/I8rGt23MwaAg3eM5HZkOySZj3RKNldWqS5oyVj2D.jpg\" width=\"1600\" height=\"1066\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">bps 2.jpg</span> <span class=\"attachment__size\">292.16 KB</span></figcaption></a></figure></p><p>Inflasi y-on-y terjadi karena adanya kenaikan harga yang ditunjukkan oleh naiknya beberapa indeks kelompok pengeluaran, yaitu: kelompok makanan, minuman dan tembakau sebesar 1,04 persen; kelompok pakaian dan alas kaki sebesar 0,28 persen; kelompok perumahan, air, listrik, dan bahan bakar rumah tangga sebesar 8,70 persen; kelompok perlengkapan, peralatan dan pemeliharaan rutin rumah tangga sebesar 0,90 persen; kelompok transportasi sebesar 0,44 persen; kelompok informasi, komunikasi, dan jasa keuangan sebesar 0,46 persen; kelompok pendidikan sebesar 1,42 persen; kelompok penyediaan makanan dan minuman/restoran sebesar 1,34 persen; kelompok perawatan pribadi dan jasa lainnya sebesar 4,37 persen.&nbsp;</p><p>Adapun kelompok kesehatan; kelompok rekreasi, olahraga, dan budaya; tidak mengalami perubahan indeks. Tingkat inflasi month to month (m-to-m) Kabupaten Konawe bulan Maret 2026 sebesar 1,14 persen dan tingkat inflasi year to date (y-to-d) Kabupaten Konawe bulan Maret 2026 sebesar 1,36 persen.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;bps 3.jpg&quot;,&quot;filesize&quot;:118377,&quot;height&quot;:762,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/0XpUOKUWcgyT0Mtil6o9G8R1pxbQAq5DuIplzGjG.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/0XpUOKUWcgyT0Mtil6o9G8R1pxbQAq5DuIplzGjG.jpg&quot;,&quot;width&quot;:559}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/0XpUOKUWcgyT0Mtil6o9G8R1pxbQAq5DuIplzGjG.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/0XpUOKUWcgyT0Mtil6o9G8R1pxbQAq5DuIplzGjG.jpg\" width=\"559\" height=\"762\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">bps 3.jpg</span> <span class=\"attachment__size\">115.6 KB</span></figcaption></a></figure>Kepala BPS Kabupaten Konawe berharap agar rilis rutin Indeks Harga Konsumen (IHK) setiap bulan tidak hanya menjadi laporan angka statistik semata, tetapi juga dijadikan rujukan penting oleh Pemerintah Daerah Konawe dalam menyusun kebijakan.</p><p>Data IHK yang menggambarkan inflasi maupun deflasi di daerah diharapkan dapat dimanfaatkan secara tepat oleh pemangku kepentingan, khususnya Tim Pengendalian Inflasi Daerah (TPID), guna menjaga stabilitas harga dan daya beli masyarakat.</p>', 'berita/01KNND6EHEFPTCXD734YMNMC45.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 19:02:01', '2026-04-07 19:02:01'),
(19, NULL, 'Bupati Konawe Buka Forum Perencanaan Pembangunan 2027, Tekankan Arah Kebijakan Berbasis Potensi Daerah', 'bupati-konawe-buka-forum-perencanaan-pembangunan-2027-tekankan-arah-kebijakan-berbasis-potensi-daerah', '<p>Bupati Konawe Buka Forum Perencanaan Pembangunan 2027, Tekankan Arah Kebijakan Berbasis Potensi Daerah.</p><p>Konawe Pemerintah Kabupaten Konawe mulai menyusun arah pembangunan tahun 2027 melalui pelaksanaan Musyawarah Perencanaan Pembangunan Daerah tingkat kabupaten Konawe. Agra Wisata pondidaha [2/4/26].</p><p>Kegiatan tersebut dihadiri unsur Forum Koordinasi Pimpinan Daerah, pimpinan dan anggota Dewan Perwakilan Rakyat Daerah Kabupaten Konawe, Sekretaris Daerah Kabupaten Konawe, perwakilan Badan Perencanaan Pembangunan Daerah Provinsi Sulawesi Tenggara, Kepala Badan Pusat Statistik Kabupaten Konawe, tenaga ahli Pemerintah Kabupaten Konawe, Kepala Kantor Pelayanan, Penyuluhan, dan Konsultasi Perpajakan Unaaha, pimpinan organisasi perangkat daerah, para camat, lurah, kepala desa, akademisi, tokoh masyarakat, pelaku usaha, hingga perwakilan sektor perbankan.</p><p>Forum tahunan ini menjadi bagian penting dalam penyusunan Rencana Kerja Pemerintah Daerah tahun 2027 dengan fokus pada penguatan daya saing ekonomi melalui pemanfaatan potensi lokal, peningkatan kualitas sumber daya manusia, dan penguatan tata kelola pemerintahan.</p><p>Dalam sambutannya, Bupati Yusran Akbar menegaskan bahwa perencanaan pembangunan harus dilakukan secara terarah dan melibatkan seluruh unsur pemerintahan agar kebijakan yang dihasilkan memiliki keterkaitan antarsektor.&nbsp; Pembangunan daerah membutuhkan kesamaan langkah sejak tahap perencanaan sehingga pelaksanaan program di lapangan dapat berjalan efektif. “Kita harus memastikan seluruh perangkat daerah bergerak dalam visi yang sama, karena setiap kebijakan yang disusun hari ini akan menentukan kualitas pelayanan dan pembangunan daerah pada tahun mendatang,” ujarnya.</p><p>Ia menjelaskan, dinamika ekonomi global saat ini memberi pengaruh langsung terhadap daerah, mulai dari tekanan inflasi, perubahan pola distribusi logistik, hingga percepatan transformasi digital. Kondisi tersebut, kata dia, menuntut pemerintah daerah lebih cermat dalam menyusun prioritas program, terutama yang berkaitan dengan penguatan ekonomi masyarakat dan efisiensi penggunaan anggaran. Pemerintah daerah juga diminta menjaga stabilitas daerah melalui kebijakan yang responsif terhadap perkembangan kebutuhan masyarakat.</p><p>Selain sektor ekonomi, peningkatan kualitas sumber daya manusia menjadi perhatian utama dalam arah pembangunan daerah ke depan. Pemerintah Kabupaten Konawe menilai bahwa keberhasilan pembangunan tidak hanya ditentukan oleh besarnya anggaran, tetapi juga oleh kemampuan aparatur dalam menjalankan tata kelola pemerintahan yang transparan, efektif, dan akuntabel. Seluruh perangkat daerah diminta memahami peran masing-masing agar setiap program yang dirancang benar-benar tepat sasaran dan memberi dampak nyata.</p><p>Melalui forum ini, pemerintah daerah berharap seluruh usulan pembangunan dari berbagai tingkatan pemerintahan dapat terintegrasi menjadi kebijakan yang terukur dan berkelanjutan. Sinergi antara pemerintah, masyarakat, dunia usaha, dan kalangan akademisi dinilai menjadi fondasi penting dalam mewujudkan Konawe yang bersahaja, berdaya saing, sejahtera, adil, dan berkelanjutan.</p>', 'berita/01KNNDAVK3WZ69T5NR4KHCEQ8Y.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 19:04:25', '2026-04-07 19:04:25'),
(20, NULL, 'Ustadz Abdul Somad Ceramah di Tabligh Akbar Pemkab Konawe, Warga Antusias Hadir', 'ustadz-abdul-somad-ceramah-di-tabligh-akbar-pemkab-konawe-warga-antusias-hadir', '<p>Pemerintah Kabupaten Konawe menggelar tabligh akbar dan halal bihalal dengan menghadirkan Ustadz Abdul Somad sebagai penceramah utama di Masjid Babusalam Konawe, Ahad &nbsp; (5/4/2026).&nbsp;</p><p>Kegiatan keagamaan tersebut berlangsung khidmat dan dihadiri&nbsp;</p><p>ribuan warga dari berbagai wilayah di Kabupaten Konawe.</p><p>Sejak pagi hari, masyarakat telah memadati area masjid untuk mengikuti tausiyah yang disampaikan dai nasional tersebut. Kehadiran Ustadz Abdul Somad menarik perhatian jamaah yang ingin mendengarkan langsung pesan-pesan keagamaan dalam suasana pasca-Idulfitri.</p><p>Acara tersebut dihadiri oleh Bupati Konawe, Wakil Bupati Konawe, Sekretaris Daerah Kabupaten Konawe, Ketua DPRD Konawe, jajaran Pemerintah Kabupaten Konawe, unsur Forkopimda, Ketua TP-PKK Kabupaten Konawe, tokoh agama, majelis taklim se-Kabupaten Konawe, serta tokoh masyarakat.&nbsp;</p><p>Kehadiran berbagai unsur tersebut mencerminkan kuatnya sinergi antara pemerintah daerah dan masyarakat dalam mendukung kegiatan keagamaan sebagai ruang mempererat silaturahmi, memperkuat kebersamaan, serta menumbuhkan nilai-nilai sosial yang harmonis dalam kehidupan bermasyarakat.</p><p>Dalam sambutannya, Bupati Konawe Yusran Akbar,ST&nbsp; menyampaikan&nbsp; secara singkat , terima kasih atas antusiasme masyarakat yang hadir. Ia menilai kegiatan keagamaan seperti ini menjadi sarana memperkuat kebersamaan sekaligus menumbuhkan semangat persaudaraan di tengah kehidupan bermasyarakat.</p><p>Menurut Yusran, kehadiran Ustadz Abdul Somad memberikan energi positif bagi masyarakat Konawe karena ceramah yang disampaikan sarat pesan moral dan keagamaan. Ia juga mengapresiasi panitia serta seluruh pihak yang telah mendukung pelaksanaan kegiatan hingga berjalan tertib dan lancar.</p><p>Dalam tausiyahnya, Ustadz Abdul Somad menegaskan bahwa ibadah Ramadan, seperti puasa, membaca Al-Qur’an, dan zakat fitrah, belum sepenuhnya sempurna apabila hubungan antarsesama masih diwarnai sakit hati dan perselisihan. Ia mengajak jamaah menjadikan halal bihalal sebagai kesempatan untuk saling memaafkan dan memperbaiki hubungan sosial.</p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;ust smdd.jpg&quot;,&quot;filesize&quot;:909598,&quot;height&quot;:1365,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/uV6JzVTl3hw4NkwCb6F5OJ27GZKGfjGr5bWuXdgM.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/uV6JzVTl3hw4NkwCb6F5OJ27GZKGfjGr5bWuXdgM.jpg&quot;,&quot;width&quot;:2048}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/uV6JzVTl3hw4NkwCb6F5OJ27GZKGfjGr5bWuXdgM.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/uV6JzVTl3hw4NkwCb6F5OJ27GZKGfjGr5bWuXdgM.jpg\" width=\"2048\" height=\"1365\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">ust smdd.jpg</span> <span class=\"attachment__size\">888.28 KB</span></figcaption></a></figure></p><p>“Puasa, membaca Al-Qur’an, dan zakat fitrah sudah kita jalankan, tetapi hubungan dengan sesama manusia juga harus diperbaiki. Kalau masih ada sakit hati, maka hari ini saatnya saling memaafkan dan berdamai,” ujarnya di hadapan jamaah.</p><p>Ia menjelaskan, kesalahan kepada sesama manusia tidak cukup diselesaikan dengan istighfar, melainkan harus diiringi permintaan maaf secara langsung. Menurutnya, hati yang bersih akan melahirkan kehidupan yang damai dan penuh keberkahan.</p><p>Selain itu, Ustadz Abdul Somad mengingatkan pentingnya menjaga ketenangan hati, menghindari dendam, dan menyerahkan setiap persoalan kepada Allah agar kehidupan sosial tetap harmonis.</p><p>“Momentum halal bihalal harus menjadi jalan memperkuat ukhuwah dan memperbaiki diri agar kehidupan masyarakat semakin damai dan penuh keberkahan,” pesannya.</p><p>Antusiasme masyarakat terlihat hingga akhir acara. Banyak warga datang bersama keluarga untuk mengikuti seluruh rangkaian kegiatan dengan tertib.&nbsp;</p><p>Pemerintah Kabupaten Konawe berharap tabligh akbar ini dapat memperkuat nilai keagamaan dan semangat kebersamaan sebagai bagian dari pembangunan daerah yang berkarakter.</p>', 'berita/01KNNDG38VQ5TQ6S313SAY35GC.jpg', 0, 0, 'ppid_utama', NULL, 1, '2026-04-07 19:07:17', '2026-04-07 19:07:17'),
(21, NULL, 'Forum Kemitraan Kesehatan Keluarga: Langkah Strategis Konawe Bersama Noora Health', 'forum-kemitraan-kesehatan-keluarga-langkah-strategis-konawe-bersama-noora-health', '<p>Unaaha – Pemerintah Kabupaten Konawe melalui Dinas Kesehatan resmi menjalin kerja sama dengan Yayasan Noora Health Indonesia dalam kegiatan Forum Kemitraan Edukasi Kesehatan Keluarga. Aula BKPSDM [6/4/26].</p><p>Acara yang dibuka langsung oleh Bupati Konawe Yusran Akbar,ST ini menjadi momentum penting untuk memperkuat peran keluarga sebagai garda terdepan dalam menjaga kesehatan masyarakat.&nbsp;</p><p>Acara Forum Kemitraan Edukasi Kesehatan Keluarga yang dirangkaikan dengan penandatanganan PKS antara Dinas Kesehatan Kabupaten Konawe dan Yayasan Noora Health Indonesia dihadiri oleh berbagai unsur penting daerah. Hadir Ketua dan Anggota TP PKK Kabupaten, Bappeda Kabupaten Konawe, Dinas Kesehatan, dan RSUD Kabupaten Konawe, Dinas Pemberdayaan Perempuan dan Perlindungan Anak, BKB Kabupaten Konawe, Kepala Puskesmas se-Kabupaten Konawe dan&nbsp; Dinas Komunikasi dan Informasi Kabupaten Konawe hadir untuk mendukung publikasi dan penyebaran informasi. Dengan keterlibatan seluruh unsur tersebut, forum ini menjadi wadah kolaborasi lintas sektor yang diharapkan mampu memperkuat peran keluarga sebagai garda terdepan dalam menjaga kesehatan masyarakat Konawe.</p><p>Dalam sambutannya, Bupati Konawe Yusran Akbar,ST menekankan bahwa pendampingan keluarga merupakan strategi utama dalam mencegah dan mengelola penyakit tidak menular. Edukasi yang diberikan melalui program ini diharapkan mampu meningkatkan kesadaran masyarakat akan pentingnya pola hidup sehat. Beliau juga menegaskan bahwa kolaborasi lintas sektor, termasuk dengan Yayasan Noora Health Indonesia, menjadi langkah strategis untuk memperkuat kapasitas pengasuh keluarga sehingga masyarakat lebih mandiri dalam menjaga kesehatan anggota keluarganya.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;noora 2.jpg&quot;,&quot;filesize&quot;:979400,&quot;height&quot;:1306,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/HYJhI9RdJgoU2m9PbzyWQ5pAUIEEexnD7lnTCjME.jpg&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/news/content/HYJhI9RdJgoU2m9PbzyWQ5pAUIEEexnD7lnTCjME.jpg&quot;,&quot;width&quot;:3208}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"https://ppid.konawekab.go.id//storage/news/content/HYJhI9RdJgoU2m9PbzyWQ5pAUIEEexnD7lnTCjME.jpg\"><img src=\"https://ppid.konawekab.go.id//storage/news/content/HYJhI9RdJgoU2m9PbzyWQ5pAUIEEexnD7lnTCjME.jpg\" width=\"3208\" height=\"1306\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">noora 2.jpg</span> <span class=\"attachment__size\">956.45 KB</span></figcaption></a></figure>Selain itu, Bupati menyampaikan pesan inspiratif dengan menyinggung kisah perjuangan keluarga dalam film Lorenzo’s Oil. Kisah tersebut dijadikan analogi bahwa ketekunan, cinta keluarga, dan kerja sama dengan para ahli dapat melahirkan solusi nyata bagi kesehatan. Pesan ini memperkuat makna forum bahwa pendampingan kesehatan keluarga bukan sekadar formalitas, melainkan sebuah perjuangan bersama demi kesejahteraan masyarakat.</p><p>Penandatanganan Perjanjian Kerja Sama (PKS) antara Dinas Kesehatan Konawe dan Yayasan Noora Health Indonesia menjadi simbol sinergi dalam membangun sistem kesehatan berbasis keluarga. Dengan dukungan semua pihak, program ini diharapkan menghadirkan edukasi yang terstruktur, memperkuat peran keluarga sebagai garda terdepan kesehatan, serta menjadi contoh nyata bagaimana kerja sama pemerintah, mitra, dan masyarakat dapat menghasilkan perubahan positif bagi kesejahteraan masyarakat Konawe.</p>', 'berita/01KNNDW6MK09GE0GQ27ZMFTC83.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 19:13:53', '2026-04-07 19:13:53'),
(22, NULL, 'Sinergi Ketahanan Pangan, Asisten III Konawe Hadiri Advokasi Lintas Sektor', 'sinergi-ketahanan-pangan-asisten-iii-konawe-hadiri-advokasi-lintas-sektor', '<p>Asisten III Sekretariat Daerah Kabupaten Konawe, Mudarman Pagala, mewakili Bupati Konawe dalam kegiatan advokasi lintas sektor Program Aksi Nasional Ketahanan Pangan Terpadu Tahun 2026. Aula Inowa [7/4/26].</p><p>Kegiatan tersebut menjadi forum strategis untuk memperkuat koordinasi antarinstansi dalam mendukung kebijakan ketahanan pangan nasional yang aman, sehat, dan berkelanjutan.</p><p>Pelaksanaan advokasi melibatkan berbagai unsur pemerintah dan lembaga terkait, di antaranya, BPOM Kendari,&nbsp; Dinas Ketahanan Pangan Kabupaten Konawe, Dinas Kesehatan, instansi teknis lainnya, serta Kementerian Agama. Keterlibatan lintas sektor ini dinilai penting untuk memastikan pengawasan pangan tidak hanya menyentuh aspek distribusi dan kualitas, tetapi juga keamanan konsumsi serta kepastian kehalalan produk yang beredar di masyarakat.</p><p>Dalam forum tersebut, Mudarman Pagala menegaskan komitmen Pemerintah Kabupaten Konawe dalam mendukung pelaksanaan program nasional di bidang ketahanan pangan. Menurutnya, pengawasan harus dilakukan secara menyeluruh sejak tahap produksi, distribusi, hingga pangan sampai ke tangan konsumen agar standar kesehatan masyarakat tetap terjaga.</p><p>Sebagai tindak lanjut dari penguatan koordinasi, kegiatan tersebut dirangkaikan dengan penandatanganan komitmen bersama oleh seluruh unsur yang terlibat. Kesepakatan ini menjadi dasar kerja sama dalam memperkuat pengawasan pangan segar maupun pangan olahan agar tetap higienis, aman, dan layak konsumsi.</p><p>Pada sesi pemaparan materi, Abdul Hasim menjelaskan bahwa pemerintah daerah secara rutin melaksanakan pengawasan keamanan pangan dan pengawalan pasar sebagai bagian dari perlindungan terhadap masyarakat. Menurutnya, pengawasan tersebut dilakukan berkelanjutan melalui keterlibatan berbagai perangkat teknis agar pengendalian pangan berjalan efektif di seluruh rantai distribusi.</p><p>Ia menambahkan, pelaksanaan pengawasan mengacu pada Undang-Undang Nomor 18 Tahun 2012 tentang pangan serta regulasi pemerintah terkait keamanan pangan segar dan pangan olahan. Aturan tersebut menegaskan bahwa pangan merupakan kebutuhan dasar yang harus tersedia dalam kondisi aman, bermutu, higienis, dan sesuai dengan nilai agama serta budaya masyarakat.</p><p>Dalam praktiknya, pengawasan dilakukan melalui petugas keamanan pangan, pengambilan sampel, serta pengujian laboratorium untuk mendeteksi kemungkinan cemaran biologis maupun bahan kimia berbahaya. Langkah ini dipandang penting untuk mencegah risiko gangguan kesehatan akibat pangan yang tidak memenuhi standar keamanan.</p><p>Melalui kegiatan advokasi ini, pemerintah daerah berharap terbangun kesamaan langkah antarinstansi dalam mendukung kebijakan keamanan pangan nasional. Kolaborasi sektor kesehatan, pertanian, perdagangan, dan lembaga pendukung lainnya diharapkan semakin kuat guna mewujudkan sistem ketahanan pangan terpadu di wilayah Sulawesi Tenggara.&nbsp;</p>', 'berita/01KNNESHSR3HYZHNPJ1TFDATY9.jpg', 0, 0, 'ppid_pelaksana', 1, 1, '2026-04-07 19:29:55', '2026-04-07 19:29:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `opds`
--

CREATE TABLE `opds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_opd` varchar(255) NOT NULL,
  `singkatan` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `kepala_opd` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `opds`
--

INSERT INTO `opds` (`id`, `nama_opd`, `singkatan`, `website`, `email`, `telepon`, `alamat`, `logo`, `kepala_opd`, `created_at`, `updated_at`) VALUES
(1, 'Dinas Komunikasi dan Informatika', NULL, 'https://diskominfo.konawekab.go.id', 'diskominfo@konawekab.go.id', '(0408) - 2422006', 'Kantor Bupati Konawe\nJl. Inolobunggadue I\nLantai III', 'opd-logo/01KGK4ERJYB50YZ5B8C7JR7VTQ.png', 'Drs. H. Muh. Akib Ras, M.Si', '2026-02-03 18:32:18', '2026-02-03 18:32:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `is_active`, `views`, `created_at`, `updated_at`) VALUES
(1, 'Profil Singkat PPID', 'profil-singkat-ppid', '<p>Keterbukaan informasi adalah salah satu pilar penting yang akan mendorong terciptanya iklim transparansi. Terlebih lagi, di era yang serba terbuka ini, keinginan masyarakat untuk memperoleh informasi semakin tinggi. Memperoleh informasi sendiri termasuk hak asasi manusia, seperti yang disebutkan dalam Undang-Undang Dasar Negara Republik Indonesia Tahun 1945 Pasal 28 F bahwa setiap orang berhak untuk berkomunikasi dan memperoleh informasi untuk mengembangkan pribadi dan lingkungan sosialnya, serta berhak untuk mencari, memperoleh, memiliki, dan menyimpan informasi dengan menggunakan segala jenis saluran yang tersedia.&nbsp;</p><p>Undang-Undang Republik Indonesia Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik sangat penting sebagai landasan hukum yang berkaitan dengan (1) hak setiap orang untuk memperoleh informasi; (2) kewajiban badan publik menyediakan dan melayani permintaan informasi secara cepat, tepat waktu, biaya ringan/proporsional, dan cara sederhana; (3) pengecualian bersifat ketat dan terbatas; (4) kewajiban badan publik untuk membenahi sistem dokumentasi dan pelayanan informasi.</p><p>Diberlakukannya UU KIP merupakan perubahan yang mendasar dalam kehidupan bermasyarakat, berbangsa dan bernegara, oleh sebab itu perlu adanya kesadaran dari seluruh elemen bangsa agar setiap lembaga dan badan pemerintah dalam pengelolaan informasi harus dengan prinsip good governance, tata kelola yang baik dan akuntabilitas. UU KIP sebagai instrumen hukum yang mengikat merupakan tonggak atau dasar bagi seluruh rakyat Indonesia untuk bersama-sama mengawasi secara langsung pelayanan publik yang diselenggarakan oleh Badan Publik.</p><p>Adapun lingkup Badan Publik dalam Undang-undang Nomor 14 Tahun 2008 meliputi lembaga eksekutif, yudikatif, legislatif, serta penyelenggara negara lainnya yang mendapatkan dana dari Anggaran Pendapatan dan Belanja Negara (APBN)/Anggaran Pendapatan dan Belanja Daerah (APBD) dan mencakup pula organisasi nonpemerintah, baik yang berbadan hukum maupun yang tidak berbadan hukum, seperti lembaga swadaya masyarakat, perkumpulan, serta organisasi lainnya yang mengelola atau menggunakan dana yang sebagian atau seluruhnya bersumber dari APBN/APBD, sumbangan masyarakat, dan/atau luar negeri.</p><p>Pejabat Pengelola Informasi dan Dokumentasi atau yang selanjutnya disebut PPID adalah pejabat yang bertanggung jawab di bidang penyimpanan, pendokumentasian, penyediaan, dan/atau pelayanan Informasi di Badan Publik. Sejalan dengan amanah Undang-Undang Nomor 14 tahun 2008 tentang Keterbukaan Informasi Publik, Pemerintah Kabupaten Konawe telah melakukan beberapa upaya menyelaraskan aspek legal dengan menetapkan Peraturan Bupati Konawe Nomor 72 Tahun 2022 Tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Pemerintah Kabupaten Konawe.</p>', 1, 127, '2026-01-25 20:35:01', '2026-04-07 06:42:42'),
(2, 'Visi dan Misi PPID', 'visi-dan-misi-ppid', '<p><strong>VISI</strong></p><p>Mewujudkan tata kelola informasi publik Kabupaten Konawe yang transparan, akuntabel, dan patuh terhadap regulasi keterbukaan informasi</p><p><strong>MISI</strong></p><p>1. Memenuhi kebutuhan informasi masyarakat secara proaktif dan sistematis</p><p>2. Meningkatkan standar kualitas pelayanan informasi agar lebih akurat dan terpercaya</p><p>3. Menciptakan ekosistem keterbukaan informasi yang cepat, praktis, dan mudah diakses oleh seluruh lapisan masyarakat Kabupaten Konawe</p>', 1, 96, '2026-01-27 20:40:09', '2026-04-07 07:36:41'),
(3, 'SOP PPID', 'sop-ppid', '<p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;application/pdf&quot;,&quot;filename&quot;:&quot;SOP PPID KAB KONAWE.pdf&quot;,&quot;filesize&quot;:1920019,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/pages/content/M010Rz6gXNIewgSpwztDmtll2vSkwYhaKiUAalhP.pdf&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/pages/content/M010Rz6gXNIewgSpwztDmtll2vSkwYhaKiUAalhP.pdf&quot;}\" data-trix-content-type=\"application/pdf\" class=\"attachment attachment--file attachment--pdf\"><a href=\"https://ppid.konawekab.go.id//storage/pages/content/M010Rz6gXNIewgSpwztDmtll2vSkwYhaKiUAalhP.pdf\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">SOP PPID KAB KONAWE.pdf</span> <span class=\"attachment__size\">1.83 MB</span></figcaption></a></figure></p>', 1, 108, '2026-01-28 16:49:57', '2026-04-07 04:45:44'),
(5, 'Laporan Tahunan Pengelolaan Pengaduan Pelayanan Publik', 'laporan-tahunan-pengelolaan-pengaduan-pelayanan-publik', '<p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;application/pdf&quot;,&quot;filename&quot;:&quot;LAPORAN TAHUNAN PENGELOLAAN PENGADUAN PELAYANAN PUBLIK (EDIT).pdf&quot;,&quot;filesize&quot;:1870883,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/pages/content/MYbOUDCnGM6epVeuDQHPKC9PC7WdAV6WsgbTSnHe.pdf&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/pages/content/MYbOUDCnGM6epVeuDQHPKC9PC7WdAV6WsgbTSnHe.pdf&quot;}\" data-trix-content-type=\"application/pdf\" class=\"attachment attachment--file attachment--pdf\"><a href=\"https://ppid.konawekab.go.id//storage/pages/content/MYbOUDCnGM6epVeuDQHPKC9PC7WdAV6WsgbTSnHe.pdf\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">LAPORAN TAHUNAN PENGELOLAAN PENGADUAN PELAYANAN PUBLIK (EDIT).pdf</span> <span class=\"attachment__size\">1.78 MB</span></figcaption></a></figure></p>', 1, 89, '2026-02-03 17:54:07', '2026-04-07 06:45:29'),
(6, 'Kecamatan', 'kecamatan', '<p><a href=\"https://konawekab.go.id/kecamatan\">https://konawekab.go.id/kecamatan</a></p>', 1, 5, '2026-02-03 17:59:38', '2026-02-03 18:11:16'),
(7, 'Standar Layanan Informasi Publik ', 'standar-layanan-informasi-publik', '<p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;application/pdf&quot;,&quot;filename&quot;:&quot;STANDAR LAYANAN INFORMASI PUBLIK KIP.pdf&quot;,&quot;filesize&quot;:1134489,&quot;href&quot;:&quot;https://ppid.konawekab.go.id//storage/pages/content/kQlSt5VonUxGOhZBKm8VuWerNleM7rSj6az4sAcw.pdf&quot;,&quot;url&quot;:&quot;https://ppid.konawekab.go.id//storage/pages/content/kQlSt5VonUxGOhZBKm8VuWerNleM7rSj6az4sAcw.pdf&quot;}\" data-trix-content-type=\"application/pdf\" class=\"attachment attachment--file attachment--pdf\"><a href=\"https://ppid.konawekab.go.id//storage/pages/content/kQlSt5VonUxGOhZBKm8VuWerNleM7rSj6az4sAcw.pdf\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">STANDAR LAYANAN INFORMASI PUBLIK KIP.pdf</span> <span class=\"attachment__size\">1.08 MB</span></figcaption></a></figure></p>', 1, 66, '2026-02-04 16:55:06', '2026-04-07 00:10:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturans`
--

CREATE TABLE `pengaturans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'string',
  `group` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengaturans`
--

INSERT INTO `pengaturans` (`id`, `name`, `key`, `value`, `type`, `group`, `created_at`, `updated_at`) VALUES
(1, 'email', 'email', '', 'string', 'general', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(2, 'Kontak', 'contact', '', 'string', 'general', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(3, 'Gambar Kontak', 'contac_image', NULL, 'image', 'general', '2026-01-11 13:54:03', '2026-01-11 13:54:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'info.create', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(2, 'info.edit', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(3, 'info.delete', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(4, 'info.publish', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(5, 'info.verify', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(6, 'permohonan.view', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(7, 'permohonan.verify', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(8, 'permohonan.respond', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(9, 'permohonan.delete', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(10, 'opd.create', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(11, 'opd.edit', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(12, 'opd.delete', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(13, 'opd.manage_user', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(14, 'user.create', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(15, 'user.edit', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(16, 'user.delete', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(17, 'user.assign_role', 'web', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(18, 'user.reset_password', 'web', '2026-01-11 13:54:04', '2026-01-11 13:54:04'),
(19, 'report.view', 'web', '2026-01-11 13:54:04', '2026-01-11 13:54:04'),
(20, 'report.export', 'web', '2026-01-11 13:54:04', '2026-01-11 13:54:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `regulations`
--

CREATE TABLE `regulations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text DEFAULT NULL,
  `doc_url` varchar(255) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `source_type` enum('ppid_utama','ppid_pelaksana') NOT NULL DEFAULT 'ppid_utama',
  `opd_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin_utama', 'web', '2026-01-11 13:54:04', '2026-01-11 13:54:04'),
(2, 'ppid_pelaksana', 'web', '2026-01-11 13:54:04', '2026-01-11 13:54:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(6, 2),
(7, 1),
(8, 1),
(8, 2),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(19, 2),
(20, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AOtmvolbo3sOg8iYTTUiO6ngmFZZHhANBsiAX9ks', NULL, '216.106.185.13', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnhYd3htRU1CVUpaU2lDSXBzSEZPOVlJSGJUdW40dG15dktEZHlMaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vcHBpZC5rb25hd2VrYWIuZ28uaWQiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1775623584),
('chNxFOTaS0uvddF3sPbOys0XvHgbpBL4fa1DDKpV', NULL, '216.106.185.13', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6.1 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGF3eXVKSmJIVUo2MUVZNFBRZmlXQkFJNGVHUjRUbE1IdmtER0RiWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vcHBpZC5rb25hd2VrYWIuZ28uaWQiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1775630054),
('HTGvEZ8oPHDDn8ftYuI2I7aMjArDwaC8MjCfvnDb', NULL, '52.167.144.173', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFdubkhDTURubURFclM1UXJ5bE1lZFo4VjFyd3hxUE94VEI5RWZCOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vcHBpZC5rb25hd2VrYWIuZ28uaWQiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1775615274),
('JBbAvlR8I94jTtdrGXh6vXmuutLUT4J1gSCWhg9c', 1, '125.162.219.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRTZRTWpNcU9NS3hjMWVma0RKWXZBNjdnT01qS1k3WHZQdE8yRkwwbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vcHBpZC5rb25hd2VrYWIuZ28uaWQvbmV3cz9wYWdlPTMiO3M6NToicm91dGUiO3M6NDoibmV3cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRvODdMQ3Y1azM0b2V2bktLY0J4WGMuQnhkME9FZG9PY01oMnBEakE3eXhLZXJTWTBPM0hjUyI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1775620127),
('kEtqf05RiyxdsinnBuL32VveRfJwSWpdM7BbHnsn', NULL, '51.89.129.216', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYXkzR2N2YkxWWjZjYUJUUzd3NVZFTU0zY3J1WG1acVM0S0hySU05MiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTQxOiJodHRwczovL3BwaWQua29uYXdla2FiLmdvLmlkL25ld3MvZGluYXMta29taW5mby1kYW4tcGVyc2FuZGlhbi1zZXJhaGthbi1waWFsYS1pbmRvbmVzaWEtaW5ub3ZhdGlvbi1leGNlbGxlbmNlLWF3YXJkLTIwMjYta2VwYWRhLWJ1cGF0aS1rb25hd2UiO3M6NToicm91dGUiO3M6MTE6Im5ld3MuZGV0YWlsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775626918),
('O7sL3gIrLlYcWD7uOr8YezuvepfjAQmEndxv5PaF', NULL, '216.106.185.13', 'Mozilla/5.0 (Knoppix; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUxsVnlnRUpHeXI2TGtNRWxBaWJBcURSRmROY0pCaU5ySDNsakdSMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vcHBpZC5rb25hd2VrYWIuZ28uaWQiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1775612947),
('qX4a5VXKnJRTtmONuH7fP3qz9r9L4SVogdUImbXl', NULL, '36.83.70.213', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibHpzTDVaNk1SYThjQm5rWWcyZE93eHNMY0VpSUpjakhpVmJsYW44eCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vcHBpZC5rb25hd2VrYWIuZ28uaWQiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1775625864),
('rqjmMWMN8zp7y9OP3tpqTBYUlsK0y7PS8Bc3eAQ9', NULL, '4.196.118.112', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0o2ZUMyM3N3TFBOdEFBZHZCME9IeThXOFlkNFp5V0NMWGlPdW5rWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vcHBpZC5rb25hd2VrYWIuZ28uaWQiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1775618415),
('Ykk9DnMfBrNHq9ygPlD6eWGW8CxnFf9FWg0jZ2v2', NULL, '216.106.185.13', 'Mozilla/5.0 (Windows NT 6.1; rv:109.0) Gecko/20100101 Firefox/115.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2RCSER6MnNxU01uajduY1dWZUZlaGc3QzAzTkY1NUt0WkFMNHZ2SyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTIxOiJodHRwczovL3BwaWQua29uYXdla2FiLmdvLmlkLz9waG9uZXBlX2FjdGlvbj1jdXJsdGVzdFBob25lUGUmdXJsPWh0dHAlM0ElMkYlMkZkNzV1bG9ibmVqdmdmbDBhbGtwMGRiY3Q1dHVhbzU5a3Mub2FzdC5saXZlIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1775630054);

-- --------------------------------------------------------

--
-- Struktur dari tabel `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `platform` enum('facebook','x','instagram','tiktok','youtube','threads') NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `social_media`
--

INSERT INTO `social_media` (`id`, `platform`, `url`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'facebook', 'https://web.facebook.com/ppid.diskominfokonawe', 'fa-facebook', 1, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(2, 'tiktok', 'https://www.tiktok.com/@kominfokab.konawe', 'fa-tiktok', 1, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(3, 'instagram', 'https://www.instagram.com/ppid.konawe/', 'fa-instagram', 1, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(4, 'youtube', 'http://www.youtube.com/@diskominfokonawe8546', 'fa-youtube', 1, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(5, 'x', 'https://x.com', 'fa-x-twitter', 1, '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(6, 'threads', 'https://www.threads.com', 'fa-threads', 1, '2026-01-11 13:54:03', '2026-01-11 13:54:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `opd_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_super_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `opd_id`, `is_super_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ppid_admin@gmail.com', NULL, '$2y$12$o87LCv5k34oevnKKcBxXc.Bxd0OEdoOcMh2pDjA7yxKerSY0O3HcS', NULL, 1, 'gu9YgeKTJpiGQI9Z4mHniTd2mUvSyfUnmgAYjXeJI7yYBmKzZODSsdbQlB8k', '2026-01-11 13:54:03', '2026-01-11 13:54:03'),
(2, 'RSUD Konawe', 'rsud_admin@gmail.com', NULL, '$2y$12$MKbfhsiDDtLzuvQJiDzvHuBM7WFAlcqcf0JLACyLV7p33POlFuZE.', NULL, 0, NULL, '2026-01-11 13:54:03', '2026-01-11 13:54:03');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `announcements_slug_unique` (`slug`),
  ADD KEY `announcements_category_id_foreign` (`category_id`),
  ADD KEY `announcements_opd_id_foreign` (`opd_id`),
  ADD KEY `announcements_created_by_foreign` (`created_by`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_opd_id_foreign` (`opd_id`),
  ADD KEY `galleries_created_by_foreign` (`created_by`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_page_id_foreign` (`page_id`),
  ADD KEY `menus_news_id_foreign` (`news_id`),
  ADD KEY `menus_announcement_id_foreign` (`announcement_id`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_category_id_foreign` (`category_id`),
  ADD KEY `news_opd_id_foreign` (`opd_id`),
  ADD KEY `news_created_by_foreign` (`created_by`);

--
-- Indeks untuk tabel `opds`
--
ALTER TABLE `opds`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pengaturans`
--
ALTER TABLE `pengaturans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengaturans_name_unique` (`name`),
  ADD UNIQUE KEY `pengaturans_key_unique` (`key`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `regulations`
--
ALTER TABLE `regulations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regulations_opd_id_foreign` (`opd_id`),
  ADD KEY `regulations_created_by_foreign` (`created_by`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_opd_id_foreign` (`opd_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `opds`
--
ALTER TABLE `opds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pengaturans`
--
ALTER TABLE `pengaturans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `regulations`
--
ALTER TABLE `regulations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `announcements_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `announcements_opd_id_foreign` FOREIGN KEY (`opd_id`) REFERENCES `opds` (`id`);

--
-- Ketidakleluasaan untuk tabel `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `galleries_opd_id_foreign` FOREIGN KEY (`opd_id`) REFERENCES `opds` (`id`);

--
-- Ketidakleluasaan untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_announcement_id_foreign` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `menus_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `menus_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `news_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `news_opd_id_foreign` FOREIGN KEY (`opd_id`) REFERENCES `opds` (`id`);

--
-- Ketidakleluasaan untuk tabel `regulations`
--
ALTER TABLE `regulations`
  ADD CONSTRAINT `regulations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `regulations_opd_id_foreign` FOREIGN KEY (`opd_id`) REFERENCES `opds` (`id`);

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_opd_id_foreign` FOREIGN KEY (`opd_id`) REFERENCES `opds` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
