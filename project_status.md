# 📋 PROJECT STATUS — PPID Konawe (ppid-konawe)

> **UNTUK AI MODEL / AGENT:**
> Baca seluruh dokumen ini **sebelum** melakukan perubahan apa pun. Dokumen ini adalah sumber kebenaran tunggal (*single source of truth*) tentang konteks, status, arsitektur, dan aturan pengembangan proyek ini.
> **Tanggal terakhir diperbarui:** 2026-06-06 (rev 6 — Bug fix PPID, UI/UX, & Aksesibilitas)

---

## 1. 🗺️ Gambaran Umum Proyek

| Atribut | Detail |
|---|---|
| **Nama Proyek** | PPID Kabupaten Konawe — Website Layanan Informasi Publik |
| **Tujuan** | Portal informasi publik (PPID) + sub-sistem KLA (Kabupaten Layak Anak) |
| **Instansi** | Dinas Komunikasi dan Informatika Kabupaten Konawe |
| **Tech Stack** | Laravel 12, Filament v3, Spatie Laravel Permission v6, Vite, MySQL |
| **PHP Version** | ^8.2 |
| **Path Proyek** | `d:\dev\source\kominfo\ppid-konawe` |
| **Admin Panel URL** | `/admin` |
| **Frontend KLA URL** | `/kla` |

---

## 2. 🏗️ Arsitektur Proyek

### 2.1 Struktur Direktori Utama

```
ppid-konawe/
├── app/
│   ├── Filament/
│   │   ├── Pages/          # Custom Filament pages (Dashboard, ChangePassword)
│   │   ├── Resources/      # 40 Filament Resources (20 PPID core + 20 KLA)
│   │   └── Widgets/        # Dashboard widgets
│   ├── Http/Controllers/   # Frontend controllers
│   ├── Models/             # 42 Eloquent models
│   ├── Providers/
│   │   └── Filament/AdminPanelProvider.php  # ⚠️ Konfigurasi panel utama
│   └── Traits/             # KlaAuditable trait
├── database/
│   ├── migrations/         # 47 file migrasi
│   └── seeders/            # 23 seeder (termasuk KLA)
├── resources/views/pages/kla/index.blade.php  # ⚠️ Frontend KLA (71KB, kompleks)
├── routes/web.php          # Semua route frontend
├── KLA_TRACKER.md          # Riwayat development KLA (baca juga ini)
└── implementation_plan_kla.md  # Rencana fitur KLA (baca juga ini)
```

### 2.2 Navigation Groups di Admin Panel

Urutan grup navigasi di Filament (diatur di `AdminPanelProvider.php`) — **urutan ini TIDAK BOLEH diubah sembarangan**:

| Urutan | Nama Grup | Keterangan |
|---|---|---|
| 1 | `Master Data` | Data referensi inti PPID |
| 2 | `Publikasi` | Berita, pengumuman, galeri |
| 3 | `Layanan Publik` | Permohonan informasi publik |
| 4 | `Pengaturan Tampilan` | Carousel, menu, pengaturan |
| 5 | `Sistem` | User, role, permission |
| 6 | `KLA - Profil & Pengaturan` | ⬇️ KLA di bawah inti |
| 7 | `KLA - Evaluasi & Indikator` | |
| 8 | `KLA - Layanan & Pengaduan` | |
| 9 | `KLA - Informasi & Publikasi` | |
| 10 | `KLA - Kemitraan` | |
| 11 | `KLA - Sistem` | |

---

## 3. 🏛️ Sistem PPID Inti (Sebelum KLA)

> Bagian ini mendeskripsikan sistem inti PPID yang sudah ada **sebelum** modul KLA dikembangkan. Jangan mengubah arsitektur ini.

### 3.1 Role & Permission PPID (Seeder: `UserRoleSeeder`)

Ada **dua role inti** PPID yang dibuat pertama kali:

| Role | Nama di DB | Akses |
|---|---|---|
| Admin Utama | `admin_utama` | Superuser — semua permission, bisa publish, approve, manage user |
| PPID Pelaksana | `ppid_pelaksana` | Operator OPD — hanya bisa input draft, kirim review, lihat laporan |

> **PENTING untuk AI:** Nama role yang benar adalah `admin_utama` dan `ppid_pelaksana`. BUKAN `admin_ppid`.

**Permission PPID Granular** (dikelola Spatie):

| Permission | Keterangan |
|---|---|
| `info.create` | Membuat informasi publik baru |
| `info.edit` | Mengedit informasi publik |
| `info.delete` | Menghapus informasi publik |
| `info.publish` | Menerbitkan/mempublikasikan informasi |
| `info.verify` | Memverifikasi konten |
| `permohonan.view` | Melihat permohonan informasi |
| `permohonan.verify` | Memverifikasi permohonan |
| `permohonan.respond` | Merespons permohonan |
| `permohonan.delete` | Menghapus permohonan |
| `opd.create/edit/delete` | Mengelola data OPD |
| `opd.manage_user` | Mengelola user dalam OPD |
| `user.create/edit/delete/assign_role/reset_password` | Manajemen user |
| `report.view/export` | Lihat & ekspor laporan |

### 3.2 Model User — Field Penting

File: `app/Models/User.php` — implements `FilamentUser`, menggunakan `HasRoles` (Spatie)

| Field | Tipe | Keterangan |
|---|---|---|
| `name` | string | Nama user |
| `email` | string | Email login |
| `password` | hashed | Password |
| `is_super_admin` | boolean | Jika `true` = `admin_utama`, bisa publish & manage semua OPD |
| `opd_id` | FK → `opds` | OPD tempat user bertugas (null untuk super admin) |

> **Logika otorisasi di PublicInformationResource menggunakan `is_super_admin`**, bukan role Spatie secara langsung. Super admin bisa publish dan lihat semua OPD; non-super-admin hanya bisa lihat data `opd_id` miliknya sendiri.

### 3.3 Tabel Database PPID Inti

Semua tabel ini ada **sebelum KLA** dan TIDAK BOLEH diubah:

| Tabel | Model | Keterangan |
|---|---|---|
| `users` | `User` | Pengguna admin panel |
| `opds` | `Opd` | Organisasi Perangkat Daerah (sumber data multi-OPD) |
| `profiles` | `Profile` | Profil instansi (konten halaman Profil PPID) |
| `categories` | `Category` | Kategori berita/pengumuman |
| `news` | `News` | Berita PPID (multi-OPD, ada `source_type`, `views`, `is_featured`) |
| `announcements` | `Announcement` | Pengumuman (ada `is_featured`, `published_at`, `views`) |
| `documents` | `Document` | Dokumen unduhan umum |
| `pages` | `Page` | Halaman statis (Profil PPID, dll.) |
| `carousels` | `Carousel` | Banner/slider homepage |
| `contacts` | `Contact` | Pesan masuk dari form kontak |
| `faqs` | `Faq` | FAQ umum (bukan KLA) |
| `galleries` | `Gallery` | Galeri foto/video umum |
| `regulations` | `Regulation` | Regulasi/peraturan umum (bukan KLA) |
| `menus` | `Menu` | Navigasi website (hierarki, ada `parent_id`) |
| `social_media` | `SocialMedia` | Akun media sosial instansi |
| `pengaturan` | `Pengaturan` | Pengaturan global website |
| `information_categories` | `InformationCategory` | Kategori informasi publik |
| `public_informations` | `PublicInformation` | **Tabel utama PPID** — dokumen informasi publik |
| `information_exceptions` | `InformationException` | Detail pengecualian informasi dikecualikan |
| `information_requests` | `InformationRequest` | Permohonan informasi dari masyarakat |

### 3.4 Alur Kerja Informasi Publik (PublicInformation)

`PublicInformation` adalah tabel paling krusial di PPID. Berikut alurnya:

**Jenis Informasi** (kolom `information_type`):
- `berkala` — Informasi Berkala (laporan rutin, ada `report_level`: `opd` atau `konsolidasi`)
- `setiap_saat` — Informasi Setiap Saat
- `serta_merta` — Informasi Serta Merta
- `dikecualikan` — Informasi Dikecualikan (punya relasi ke `information_exceptions`)

**Status Publikasi** (kolom `status`):
```
draft → review → published
                 rejected ←┘ (bisa di-reject oleh admin_utama)
```
- `ppid_pelaksana` hanya bisa set status ke `draft` atau `review`
- Hanya `admin_utama` (is_super_admin=true) yang bisa `published` atau `rejected`
- Tombol **Terbitkan** dan **Tarik ke Draft** di admin panel hanya muncul untuk `is_super_admin`

**Lampiran Dokumen** (dua pilihan):
- Upload file lokal → disimpan di `file_path` (direktori `informasi_publik/`)
- Link eksternal (G-Drive/OneDrive) → disimpan di `file_url`

**Filter Data per OPD:**
- Non-super-admin hanya melihat data dari `opd_id`-nya sendiri (di `getEloquentQuery()`)
- Super admin melihat semua data dari semua OPD

### 3.5 Alur Kerja Permohonan Informasi (InformationRequest)

Masyarakat mengajukan permohonan via frontend `/permohonan-informasi`. Status permohonan:

| Status | Keterangan |
|---|---|
| `pending` | Baru masuk, belum diproses |
| `diproses` | Sedang ditindaklanjuti |
| `approved` | Disetujui, sudah direspons |
| `rejected` | Ditolak dengan alasan |

Masyarakat bisa cek status lewat `/cek-status`.

### 3.6 User Demo yang Ada

| Email | Nama | `is_super_admin` | `opd_id` | Role |
|---|---|---|---|---|
| `ppid_admin@gmail.com` | admin | `true` | null | `admin_utama` |
| `rsud_admin@gmail.com` | RSUD Konawe | `false` | 2 (RSUD) | `ppid_pelaksana` |
| `diskominfo@mail.com` | Admin Diskominfo | `false` | 1 (Diskominfo) | — |

---

## 4. 🗄️ Database Schema — Tabel KLA (prefix: `kla_`)

Semua tabel KLA sudah ter-migrasi. **JANGAN membuat migration baru.**

### Tabel KLA Fase 1 (Eksisting sejak 2026-05-21):

| Tabel | Model | Keterangan |
|---|---|---|
| `kla_abouts` | `KlaAbout` | Profil/tentang KLA |
| `kla_regulations` | `KlaRegulation` | Regulasi & landasan hukum KLA |
| `kla_clusters` | `KlaCluster` | 5 klaster KLA (punya banyak indikator) |
| `kla_statistics` | `KlaStatistic` | Statistik data anak |
| `kla_programs` | `KlaProgram` | Program & kegiatan KLA |
| `kla_achievements` | `KlaAchievement` | Penghargaan/prestasi KLA |
| `kla_documents` | `KlaDocument` | Dokumen unduhan KLA |
| `kla_galleries` | `KlaGallery` | Foto & video galeri KLA |
| `kla_faqs` | `KlaFaq` | FAQ KLA |
| `kla_complaints` | `KlaComplaint` | Pengaduan anak |

### Tabel KLA Fase 2 (Ditambahkan 2026-05-30):

| Tabel | Model | Keterangan |
|---|---|---|
| `kla_indicator_categories` | `KlaIndicatorCategory` | Kategori indikator |
| `kla_indicators` | `KlaIndicator` | Indikator spesifik KLA |
| `kla_indicator_progress` | `KlaIndicatorProgress` | Log capaian indikator |
| `kla_monitoring_reports` | `KlaMonitoringReport` | Laporan monitoring |
| `kla_dashboard_metrics` | `KlaDashboardMetric` | Metrik hero dashboard |
| `kla_chart_data` | `KlaChartData` | Data grafik/chart KLA |
| `kla_partner_categories` | `KlaPartnerCategory` | Kategori mitra |
| `kla_partners` | `KlaPartner` | Data mitra KLA |
| `kla_service_categories` | `KlaServiceCategory` | Kategori layanan ILA |
| `kla_services` | `KlaService` | Daftar institusi/layanan anak |
| `kla_publication_categories` | `KlaPublicationCategory` | Kategori publikasi |
| `kla_audit_logs` | `KlaAuditLog` | Log audit perubahan data |

---

## 4. 🔐 Role & Permission (Spatie)

### Role yang Ada:

| Role | Akses |
|---|---|
| `admin_utama` | Full access ke semua modul (PPID + KLA) |
| `ppid_pelaksana` | Akses operasional PPID |
| `admin_kla` | Full access **hanya lingkup KLA** (tidak bisa manage user global) |
| `operator_kla` | Input data KLA, publikasi, program, galeri |
| `verifikator_kla` | Verifikasi indikator dan pengaduan anak |

### Permission KLA Granular:

```
kla.view, kla.create, kla.update, kla.delete, kla.publish
kla.monitoring.manage
kla.complaint.manage
kla.statistics.manage
kla.regulation.manage
kla.gallery.manage
```

> Seeder: `database/seeders/KlaRolesAndPermissionsSeeder.php`

---

## 5. 📁 Filament Resources — Peta Lengkap

### Resources PPID Inti (20 resource):

| Resource | Navigation Group | Keterangan |
|---|---|---|
| `AnnouncementResource` | Publikasi | Pengumuman |
| `CarouselResource` | Pengaturan Tampilan | Slider homepage |
| `CategoryResource` | Master Data | Kategori berita |
| `ContactResource` | Layanan Publik | Pesan masuk |
| `DocumentResource` | Publikasi | Dokumen unduhan |
| `FaqResource` | Layanan Publik | FAQ umum |
| `GalleryResource` | Publikasi | Galeri foto/video |
| `InformationCategoryResource` | Master Data | Kategori informasi publik |
| `InformationExceptionResource` | Layanan Publik | Informasi dikecualikan |
| `InformationRequestResource` | Layanan Publik | Permohonan informasi |
| `MenuResource` | Pengaturan Tampilan | Navigasi website |
| `NewsResource` | Publikasi | Berita |
| `OpdResource` | Master Data | Data OPD |
| `PageResource` | Publikasi | Halaman statis |
| `PengaturanResource` | Pengaturan Tampilan | Pengaturan umum |
| `RegulationResource` | Publikasi | Regulasi umum |
| `SocialMediaResource` | Pengaturan Tampilan | Media sosial |
| `UserResource` | Sistem | Manajemen pengguna |

### Resources KLA (21 resource):

| Resource | Navigation Group | Keterangan |
|---|---|---|
| `KlaAboutResource` | KLA - Profil & Pengaturan | Profil KLA |
| `KlaStatisticResource` | KLA - Profil & Pengaturan | Statistik anak |
| `KlaClusterResource` | KLA - Evaluasi & Indikator | Klaster KLA |
| `KlaIndicatorCategoryResource` | KLA - Evaluasi & Indikator | Kategori indikator |
| `KlaIndicatorResource` | KLA - Evaluasi & Indikator | Indikator spesifik |
| `KlaMonitoringReportResource` | KLA - Evaluasi & Indikator | Laporan monitoring |
| `KlaChartDataResource` | KLA - Evaluasi & Indikator | Data grafik |
| `KlaComplaintResource` | KLA - Layanan & Pengaduan | Pengaduan anak |
| `KlaServiceCategoryResource` | KLA - Layanan & Pengaduan | Kategori layanan |
| `KlaServiceResource` | KLA - Layanan & Pengaduan | Layanan ILA |
| `KlaProgramResource` | KLA - Informasi & Publikasi | Program & kegiatan |
| `KlaRegulationResource` | KLA - Informasi & Publikasi | Regulasi KLA |
| `KlaDocumentResource` | KLA - Informasi & Publikasi | Dokumen KLA |
| `KlaGalleryResource` | KLA - Informasi & Publikasi | Galeri KLA |
| `KlaFaqResource` | KLA - Informasi & Publikasi | FAQ KLA |
| `KlaAchievementResource` | KLA - Informasi & Publikasi | Prestasi KLA |
| `KlaPublicationCategoryResource` | KLA - Informasi & Publikasi | Kategori publikasi |
| `KlaPartnerCategoryResource` | KLA - Kemitraan | Kategori mitra |
| `KlaPartnerResource` | KLA - Kemitraan | Data mitra |
| `KlaDashboardMetricResource` | KLA - Sistem | Metrik dashboard |
| `KlaAuditLogResource` | KLA - Sistem | Log audit (read-only) |

---

## 6. 🌐 Frontend Routes

| Method | URL | Controller | Route Name |
|---|---|---|---|
| GET | `/` | `HomeController@index` | `home` |
| GET | `/kla` | `KlaController@index` | `kla` |
| POST | `/kla/pengaduan` | `KlaController@submitComplaint` | `kla.complaint.store` |
| GET | `/kontak` | `ContactController@index` | `contact` |
| GET | `/gallery` | `GalleryController@index` | `gallery` |
| GET | `/news` | `NewsController@index` | `news` |
| GET | `/regulation` | `RegulationController@index` | `regulation` |
| GET | `/informasi-berkala` | `InformasiPublicController@berkala` | `ppid.berkala` |
| GET | `/informasi-setiap-saat` | `InformasiPublicController@setiapSaat` | `ppid.setiap-saat` |
| GET | `/informasi-serta-merta` | `InformasiPublicController@sertaMerta` | `ppid.serta-merta` |
| GET | `/permohonan-informasi` | `InformationRequestController@index` | `permohonan.index` |
| GET | `/cek-status` | `InformationRequestController@checkStatus` | `permohonan.status` |

---

## 7. 🎛️ KlaController — Data yang Di-pass ke View

File: `app/Http/Controllers/KlaController.php`

`KlaController@index` mem-passing variabel berikut ke `resources/views/pages/kla/index.blade.php`:

| Variabel | Model | Query |
|---|---|---|
| `$about` | `KlaAbout` | `where('is_active', true)->latest()->first()` |
| `$statistics` | `KlaStatistic` | `where('is_active', true)->orderBy('order')->get()` |
| `$clusters` | `KlaCluster` | `where('is_active', true)->orderBy('order')->get()` |
| `$programs` | `KlaProgram` | `where('is_active', true)->orderBy('event_date', 'desc')->take(3)->get()` |
| `$regulations` | `KlaRegulation` | `where('is_active', true)->orderBy('issue_date', 'desc')->take(5)->get()` |
| `$achievements` | `KlaAchievement` | `where('is_active', true)->orderBy('year', 'desc')->take(4)->get()` |
| `$documents` | `KlaDocument` | `where('is_active', true)->orderBy('issue_date', 'desc')->take(6)->get()` |
| `$galleries` | `KlaGallery` | `where('is_active', true)->orderBy('created_at', 'desc')->take(9)->get()` |
| `$faqs` | `KlaFaq` | `where('is_active', true)->orderBy('sort_order')->get()` |
| `$metrics` | `KlaDashboardMetric` | `where('is_active', true)->orderBy('order')->get()` |
| `$chartData` | `KlaChartData` | `orderBy('order')->get()` |
| `$partners` | `KlaPartner` | `where('is_active', true)->orderBy('order')->get()` |
| `$services` | `KlaService` | `where('is_active', true)->get()` |

---

## 8. 📈 STATUS PENGEMBANGAN SAAT INI

### ✅ SELESAI (DONE)

- [x] **Fase 1 — Frontend KLA Landing Page**: Desain UI/UX `index.blade.php` sudah jadi dan visual berjalan sangat baik.
- [x] **Fase 2 — CMS Backend**: Integrasi 21 tabel KLA ke admin panel Filament (semua resource ada).
- [x] **Audit Logging**: Trait `KlaAuditable` ter-implementasi di setiap model KLA, terintegrasi dengan `KlaAuditLogResource`.
- [x] **RBAC (Roles & Permissions)**: Menambahkan 3 role KLA baru (`admin_kla`, `operator_kla`, `verifikator_kla`) via `KlaRolesAndPermissionsSeeder`. Role PPID yang sudah ada sebelumnya (`admin_utama`, `ppid_pelaksana`) tetap tidak diubah. `admin_utama` juga mendapatkan semua permission KLA secara otomatis.
- [x] **Demo Seeder**: `KlaDemoSeeder` mengisi data awal tanpa bentrok validasi, termasuk `KlaAbout`.
- [x] **Navigasi Admin Panel**: 21 menu KLA ter-group ke 6 grup logis, ditempatkan di urutan paling bawah di `AdminPanelProvider.php`.
- [x] **KlaController**: Semua variabel yang dibutuhkan frontend sudah di-pass ke view (dari model dinamis, bukan dummy).
- [x] **Bug Fix — Auto-assign `ppid_pelaksana`** *(2026-06-02)*: `CreateUser.php` sebelumnya memiliki `afterCreate()` yang memaksa role `ppid_pelaksana` ke setiap user baru, menyebabkan user `operator_kla` juga ikut mendapat role `ppid_pelaksana`. Fix: hapus `afterCreate()` tersebut. Role kini sepenuhnya dari pilihan form.
- [x] **Bug Fix — OPD wajib untuk user KLA** *(2026-06-02)*: Form tambah user memaksa pilihan OPD untuk semua user non-super-admin. Fix di `UserResource.php`: field OPD sekarang hanya `required` jika role `ppid_pelaksana` dipilih, dan field OPD akan tersembunyi otomatis jika hanya role KLA yang dipilih.
- [x] **Bug Fix — Role multi-select pada form tambah user** *(2026-06-02)*: Diubah dari multi-select ke single-select. Role disimpan manual via `syncRoles()` di `afterCreate()`/`afterSave()` karena field `role` bersifat virtual (tidak terhubung langsung ke kolom tabel).
- [x] **Bug Fix — Akses menu PPID oleh user KLA** *(2026-06-02)*: User dengan role KLA (`admin_kla`, `operator_kla`, `verifikator_kla`) bisa mengakses menu Publikasi, Layanan Publik, Master Data, dll. Fix: dibuat trait `app/Filament/Traits/HasPpidAccess.php` dan `HasPublicInfoAccess.php` yang membagi wewenang spesifik untuk `admin_utama` dan `ppid_pelaksana`.
- [x] **Bug Fix — Akses menu KLA khusus operator** *(2026-06-02)*: Menu KLA hanya boleh dikelola oleh Super Admin Kominfo dan `operator_kla`. Fix: dibuat trait `app/Filament/Traits/HasKlaAccess.php` dan di-apply ke seluruh 21 resource KLA.
- [x] **Enhancement PPID Utama & UI/UX** *(2026-06-06)*:
  - Perbaikan bug *Policy* hak akses edit OPD untuk Super Admin & PPID Pelaksana.
  - Perbaikan sinkronisasi input form (jika toggle Super Admin ON, maka field role & OPD dikosongkan dan diabaikan).
  - Integrasi fitur **Aksesibilitas (Ramah Disabilitas)** berupa *floating widget* berbasis `localStorage` untuk mengatur ukuran teks, grayscale, kontras tinggi, garis bawah tautan, dan *readable font*.
  - Pembaruan UI form permohonan menggunakan **TomSelect** untuk fitur pencarian pada *dropdown* pilihan OPD.
  - Perbaikan pembacaan URL *symlink* gambar logo OPD di Windows Server menggunakan `Storage::disk('public')->exists()`.
- [x] **Refactoring & Simplifikasi Role User** *(2026-06-08)*:
  - Eksekusi migration `modify_user_roles_for_ppid_and_kla` untuk menyesuaikan role yang digunakan di form resource (mengubah `admin_utama` menjadi `operator_ppid`, serta menghapus `admin_kla` & `verifikator_kla`).
  - Pembuatan `PpidPelaksanaSeeder` untuk meng-generate user dengan role `ppid_pelaksana` per OPD secara otomatis.
  - Penambahan fitur **Reset Password** pada tabel `UserResource` yang memungkinkan *Super Admin* untuk mereset kata sandi pengguna langsung dari modal tanpa perlu mengubah data lainnya.

### ⚠️ SEDANG BERJALAN / PENDING

- [ ] **Frontend Dynamic Binding** (`resources/views/pages/kla/index.blade.php`):
  - View masih mengandung sebagian data **hardcoded/dummy** yang belum diganti dengan variabel dinamis dari controller.
  - **Bug aktif**: Error `Undefined variable $defaultStats`, `Undefined array key 'bg'` saat rendering view ketika controller mengirim data kosong.
  - Perlu: implementasi *empty state* UI yang profesional di setiap section jika data dari CMS kosong.
  - Perlu: audit menyeluruh seluruh section di `index.blade.php` untuk memastikan semua data terambil dari variabel controller.

### 🔴 BELUM DIMULAI (TODO)

- [ ] **Filament Advanced Features**:
  - KLA Dashboard custom page dengan widgets (chart, statistik, aduan terbaru).
  - Filters & Search pada semua KLA Resource yang masih kosong (`->filters([])`).
  - Relation Managers (misal: `KlaCluster` → `KlaIndicators`).
  - Bulk publish/unpublish action.
- [ ] **Workflow Pengaduan**: Status enum lengkap (`pending → diverifikasi → diproses → ditindaklanjuti → selesai/ditolak`) dengan timeline log per aduan, catatan internal, dan lampiran.
- [ ] **Testing**: Login `admin_kla` vs `admin_ppid`, submit pengaduan frontend → verifikasi di admin.

---

## 9. 🛑 ATURAN MUTLAK (WAJIB DIPATUHI AI/DEVELOPER)

> [!CAUTION]
> Melanggar aturan ini dapat merusak sistem yang sudah berjalan.

1. **JANGAN mengubah struktur database yang sudah ada** (tabel, kolom, tipe data).
2. **JANGAN membuat migration baru** — semua tabel sudah ada (47 migration).
3. **JANGAN mengubah arsitektur CMS Filament secara fundamental.**
4. **Grup menu KLA HARUS selalu berada di urutan terbawah** di `AdminPanelProvider.php`, setelah semua grup inti.
5. **JANGAN menggunakan data dummy/hardcoded di View** — jika data kosong, gunakan *empty state* komponen yang profesional.
6. **Jangan mengubah nama route** yang sudah ada — banyak bagian view dan controller bergantung pada nama route ini.
7. **Jangan mengubah namespace/class name** model/resource yang sudah ada tanpa memperbarui semua referensi.

---

## 10. 📝 Panduan Pengembangan untuk AI Agent

### Cara Mengerjakan Task Frontend KLA:

1. **Baca `resources/views/pages/kla/index.blade.php`** — ini file besar (71KB), baca per-section.
2. Identifikasi section yang masih menggunakan data hardcoded (angka statis, teks dummy).
3. Ganti dengan variabel yang sudah di-pass dari `KlaController@index` (lihat tabel di Bagian 7).
4. Untuk setiap section, tambahkan kondisi `@if($collection->isEmpty())` → tampilkan *empty state* profesional.
5. Pastikan tidak ada breaking change pada desain visual (CSS class tidak boleh dihapus).

### Cara Mengerjakan Task CMS (Filament):

1. Setiap Resource KLA ada di `app/Filament/Resources/Kla*Resource.php`.
2. Untuk menambahkan filter: gunakan `Tables\Filters\SelectFilter` atau `Tables\Filters\TernaryFilter`.
3. Untuk Relation Manager: buat file baru di `app/Filament/Resources/KlaClusterResource/RelationManagers/`.
4. Pastikan `$navigationGroup` selalu set ke salah satu dari 6 grup KLA yang ada.

### Cara Menjalankan Seeder:

```bash
# Jalankan seeder KLA spesifik
php artisan db:seed --class=KlaDemoSeeder
php artisan db:seed --class=KlaRolesAndPermissionsSeeder

# Jalankan semua seeder (hati-hati, bisa reset data)
php artisan db:seed
```

### Cara Menjalankan Dev Server:

```bash
# Jalankan semua sekaligus (server + queue + log + vite)
composer run dev

# Atau manual
php artisan serve
npm run dev
```

---

## 11. 🔗 File Referensi Penting

| File | Keterangan |
|---|---|
| [`KLA_TRACKER.md`](KLA_TRACKER.md) | Riwayat pengembangan & aturan KLA |
| [`implementation_plan_kla.md`](implementation_plan_kla.md) | Rencana fitur KLA lengkap |
| [`app/Http/Controllers/KlaController.php`](app/Http/Controllers/KlaController.php) | Controller frontend KLA |
| [`app/Providers/Filament/AdminPanelProvider.php`](app/Providers/Filament/AdminPanelProvider.php) | Konfigurasi panel admin |
| [`resources/views/pages/kla/index.blade.php`](resources/views/pages/kla/index.blade.php) | View frontend KLA (71KB) |
| [`database/seeders/KlaRolesAndPermissionsSeeder.php`](database/seeders/KlaRolesAndPermissionsSeeder.php) | Seeder role & permission |
| [`database/seeders/KlaDemoSeeder.php`](database/seeders/KlaDemoSeeder.php) | Seeder data demo KLA |
| [`routes/web.php`](routes/web.php) | Semua route frontend |
| [`composer.json`](composer.json) | Dependensi PHP |

---

## 12. 🧩 Dependensi Utama

| Package | Versi | Kegunaan |
|---|---|---|
| `laravel/framework` | ^12.0 | Framework utama |
| `filament/filament` | ^3.3 | Admin panel CMS |
| `spatie/laravel-permission` | ^6.24 | RBAC (Role & Permission) |
| PHP | ^8.2 | Runtime |

---

*Dokumen ini harus selalu diperbarui setiap ada perubahan signifikan pada proyek.*
*Terakhir diperbarui: 2026-06-08 oleh AI Agent (Antigravity).*
