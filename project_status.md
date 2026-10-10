# 📋 PROJECT STATUS — PPID Konawe (ppid-konawe)

> **UNTUK AI MODEL / AGENT:**
> Baca seluruh dokumen ini **sebelum** melakukan perubahan apa pun. Dokumen ini adalah sumber kebenaran tunggal (*single source of truth*) tentang konteks, status, arsitektur, dan aturan pengembangan proyek ini.
> **Tanggal terakhir diperbarui:** 2026-10-10 (Penghapusan Modul Pengembangan KLA — Proyek dikembalikan ke PPID Murni)

---

## 1. 🗺️ Gambaran Umum Proyek

| Atribut | Detail |
|---|---|
| **Nama Proyek** | PPID Kabupaten Konawe — Website Layanan Informasi Publik |
| **Tujuan** | Portal informasi publik (PPID) Pemerintah Kabupaten Konawe |
| **Instansi** | Dinas Komunikasi dan Informatika Kabupaten Konawe |
| **Tech Stack** | Laravel 12, Filament v3, Spatie Laravel Permission v6, Vite, MySQL |
| **PHP Version** | ^8.2 |
| **Path Proyek** | `/media/are-one/DATA/DEV/source/kominfo/ppid-konawe` |
| **Admin Panel URL** | `/admin` |

---

## 2. 🏗️ Arsitektur Proyek

### 2.1 Struktur Direktori Utama

```
ppid-konawe/
├── app/
│   ├── Filament/
│   │   ├── Pages/          # Custom Filament pages (Dashboard, ChangePassword, ApiDocumentation)
│   │   ├── Resources/      # Filament Resources PPID Core
│   │   ├── Traits/         # HasPpidAccess, HasPublicInfoAccess
│   │   └── Widgets/        # Dashboard widgets (Statistik)
│   ├── Http/Controllers/   # Frontend controllers
│   ├── Models/             # Eloquent models PPID Core
│   └── Providers/
│       └── Filament/AdminPanelProvider.php  # Konfigurasi panel utama
├── database/
│   ├── migrations/         # Migrasi database PPID
│   └── seeders/            # Seeder PPID
├── resources/views/        # Frontend blade views
└── routes/web.php          # Semua route frontend
```

### 2.2 Navigation Groups di Admin Panel

Urutan grup navigasi di Filament (diatur di `AdminPanelProvider.php`):

| Urutan | Nama Grup | Keterangan |
|---|---|---|
| 1 | `Master Data` | Data referensi inti PPID (OPD, Kategori Berita, Kategori Info Publik) |
| 2 | `Publikasi` | Berita, pengumuman, galeri, dokumen, regulasi, halaman statis |
| 3 | `Layanan Publik` | Permohonan informasi publik, info dikecualikan, kontak, FAQ |
| 4 | `Pengaturan Tampilan` | Carousel, menu, pengaturan umum, media sosial |
| 5 | `Sistem` | User management |

---

## 3. 🏛️ Sistem PPID Inti

### 3.1 Role & Permission PPID

| Role | Nama di DB | Akses |
|---|---|---|
| Admin Utama / Super Admin | `is_super_admin = true` | Superuser — semua wewenang, kelola OPD, manage user |
| Operator PPID | `operator_ppid` | Pengelola konten portal PPID global (Diskominfo) |
| PPID Pelaksana | `ppid_pelaksana` | Operator OPD — input draft informasi publik & kelola permohonan OPD terkait |

**Permission PPID Granular** (dikelola Spatie):
- `info.create`, `info.edit`, `info.delete`, `info.publish`, `info.verify`
- `permohonan.view`, `permohonan.verify`, `permohonan.respond`, `permohonan.delete`
- `opd.create`, `opd.edit`, `opd.delete`, `opd.manage_user`
- `user.create`, `user.edit`, `user.delete`, `user.assign_role`, `user.reset_password`
- `report.view`, `report.export`

### 3.2 Model User — Field Penting

File: `app/Models/User.php` — implements `FilamentUser`, menggunakan `HasRoles` (Spatie)

| Field | Tipe | Keterangan |
|---|---|---|
| `name` | string | Nama user |
| `email` | string | Email login |
| `password` | hashed | Password |
| `is_super_admin` | boolean | Jika `true` = Super Admin Kominfo |
| `opd_id` | FK → `opds` | OPD tempat user bertugas (null untuk super admin / operator ppid) |

### 3.3 Tabel Database PPID Inti

| Tabel | Model | Keterangan |
|---|---|---|
| `users` | `User` | Pengguna admin panel |
| `opds` | `Opd` | Organisasi Perangkat Daerah |
| `profiles` | `Profile` | Profil instansi |
| `categories` | `Category` | Kategori berita |
| `news` | `News` | Berita PPID |
| `announcements` | `Announcement` | Pengumuman |
| `documents` | `Document` | Dokumen unduhan |
| `pages` | `Page` | Halaman statis |
| `carousels` | `Carousel` | Banner/slider homepage |
| `contacts` | `Contact` | Pesan masuk dari form kontak |
| `faqs` | `Faq` | FAQ umum |
| `galleries` | `Gallery` | Galeri foto/video |
| `regulations` | `Regulation` | Regulasi/peraturan umum |
| `menus` | `Menu` | Navigasi website |
| `social_media` | `SocialMedia` | Akun media sosial instansi |
| `pengaturan` | `Pengaturan` | Pengaturan global website |
| `information_categories` | `InformationCategory` | Kategori informasi publik |
| `public_informations` | `PublicInformation` | Tabel utama dokumen informasi publik |
| `information_exceptions` | `InformationException` | Detail pengecualian informasi dikecualikan |
| `information_requests` | `InformationRequest` | Permohonan informasi dari masyarakat |

---

## 4. 📁 Filament Resources PPID Core

| Resource | Navigation Group | Keterangan |
|---|---|---|
| `OpdResource` | Master Data | Data OPD |
| `CategoryResource` | Master Data | Kategori berita |
| `InformationCategoryResource` | Master Data | Kategori informasi publik |
| `NewsResource` | Publikasi | Berita |
| `AnnouncementResource` | Publikasi | Pengumuman |
| `GalleryResource` | Publikasi | Galeri foto/video |
| `DocumentResource` | Publikasi | Dokumen unduhan |
| `RegulationResource` | Publikasi | Regulasi umum |
| `PageResource` | Publikasi | Halaman statis |
| `InformationRequestResource` | Layanan Publik | Permohonan informasi publik |
| `InformationExceptionResource` | Layanan Publik | Informasi dikecualikan |
| `ContactResource` | Layanan Publik | Pesan masuk kontak |
| `FaqResource` | Layanan Publik | FAQ |
| `CarouselResource` | Pengaturan Tampilan | Banner homepage |
| `MenuResource` | Pengaturan Tampilan | Menu navigasi |
| `SocialMediaResource` | Pengaturan Tampilan | Media sosial |
| `PengaturanResource` | Pengaturan Tampilan | Pengaturan umum website |
| `PublicInformationResource` | - (Khusus) | Dokumen informasi publik |
| `UserResource` | Sistem | Manajemen pengguna |

---

## 5. 🌐 Frontend Routes

| Method | URL | Controller | Route Name |
|---|---|---|---|
| GET | `/` | `HomeController@index` | `home` |
| GET | `/kontak` | `ContactController@index` | `contact` |
| POST | `/kontak` | `ContactController@submit` | `contact.submit` |
| GET | `/gallery` | `GalleryController@index` | `gallery` |
| GET | `/news` | `NewsController@index` | `news` |
| GET | `/announcement` | `AnnouncementController@index` | `announcement` |
| GET | `/regulation` | `RegulationController@index` | `regulation` |
| GET | `/page/{slug}` | `PageController@show` | `page.detail` |
| GET | `/ppid-pelaksana` | `PpidPelaksanaController@index` | `ppid.pelaksana` |
| GET | `/search` | `SearchController@index` | `search.global` |
| GET | `/faq` | `FaqController@index` | `faq` |
| GET | `/informasi-berkala` | `InformasiPublicController@berkala` | `ppid.berkala` |
| GET | `/informasi-berkala/{id}` | `InformasiPublicController@berkalaDetail` | `berkala.detail` |
| GET | `/informasi-setiap-saat` | `InformasiPublicController@setiapSaat` | `ppid.setiap-saat` |
| GET | `/informasi-setiap-saat/{id}` | `InformasiPublicController@setiapSaatDetail` | `setiap-saat.detail` |
| GET | `/informasi-serta-merta` | `InformasiPublicController@sertaMerta` | `ppid.serta-merta` |
| GET | `/informasi-serta-merta/{id}` | `InformasiPublicController@sertaMertaDetail` | `serta-merta.detail` |
| GET | `/informasi-dikecualikan` | `InformasiPublicController@dikecualikan` | `ppid.dikecualikan` |
| GET | `/informasi-dikecualikan/{id}` | `InformasiPublicController@dikecualikanDetail` | `dikecualikan.detail` |
| GET | `/permohonan-informasi` | `InformationRequestController@index` | `permohonan.index` |
| POST | `/permohonan-informasi` | `InformationRequestController@store` | `permohonan.store` |
| GET | `/permohonan/{id}/cetak` | `InformationRequestController@printPdf` | `permohonan.print` |
| GET | `/cek-status` | `InformationRequestController@checkStatus` | `permohonan.status` |
| POST | `/cek-status` | `InformationRequestController@processCheckStatus` | `permohonan.status.check` |
| GET | `/kebijakan-privasi` | `PrivacyController@kebijakanPrivasi` | `kebijakan-privasi` |
| GET | `/syarat-ketentuan` | `PrivacyController@syaratKetentuan` | `syarat-ketentuan` |
| GET | `/aksesibilitas` | `PrivacyController@aksesibilitas` | `aksesibilitas` |
| GET | `/sitemap.xml` | `SitemapController@index` | `sitemap` |

---

## 6. 📈 STATUS PENGEMBANGAN SAAT INI

### ✅ SELESAI (DONE)

- [x] **Penghapusan Fitur KLA (Kabupaten Layak Anak)** *(2026-10-10)*:
  - Seluruh modul, Filament Resources, model, controller, views, routes, migrations, dan seeders terkait KLA telah dihapus bersih dari codebase.
  - Sidebar admin Filament dikembalikan ke 5 navigation group inti PPID (`Master Data`, `Publikasi`, `Layanan Publik`, `Pengaturan Tampilan`, `Sistem`).
  - Route `/kla`, `/kla/publikasi/{slug}`, `/kla/pengaduan` dan sitemap generation untuk KLA telah dihilangkan.
  - Form user management dibersihkan dari opsi/keterangan KLA.
- [x] **Enhancement PPID Utama & UI/UX**:
  - Perbaikan policy hak akses edit OPD untuk Super Admin & PPID Pelaksana.
  - Floating widget aksesibilitas (ramah disabilitas).
  - Searchable OPD dropdown menggunakan TomSelect pada permohonan informasi.
  - Perbaikan preview dan cetak PDF permohonan PPID.
  - Reset password langsung dari Filament UserResource modal.

---

## 7. 🛑 ATURAN PENGEMBANGAN

1. Fokus penuh pada sistem inti PPID (Keterbukaan Informasi Publik).
2. Mempertahankan struktur database dan relasi multi-OPD pada `public_informations` dan `information_requests`.
3. Menjaga otorisasi role Spatie (`operator_ppid`, `ppid_pelaksana`) serta hak akses `is_super_admin`.
