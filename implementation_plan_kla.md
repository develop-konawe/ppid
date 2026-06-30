# Implementasi Fitur KLA (Kabupaten/Kota Layak Anak) - Edisi Dynamic CMS & KLA Admin

## Deskripsi

Melanjutkan pengembangan modul **KLA (Kabupaten/Kota Layak Anak)** pada website PPID Kabupaten Konawe. Fase pertama (UI/UX KLA Landing Page) telah selesai dan visual sudah berjalan sangat baik. Fase kedua ini akan fokus pada **Dynamic CMS Integration, Backend Architecture, Role Management, dan Monitoring System** tanpa merusak struktur dan arsitektur eksisting.

---

## 1. Role & Permission System (Spatie)

Role eksisting: `admin_utama`, `ppid_pelaksana`.
Semua `admin_utama` tetap memiliki **Full Access** ke seluruh modul KLA.

**[NEW] Role KLA Spesifik:**
- `admin_kla`: Akses penuh hanya pada lingkup KLA (tidak bisa mengelola user global atau sistem PPID utama).
- `operator_kla`: Input data KLA, publikasi, program, galeri.
- `verifikator_kla`: Melakukan verifikasi data indikator dan aduan (complaints).

**[NEW] Permission Granular:**
- `kla.view`, `kla.create`, `kla.update`, `kla.delete`, `kla.publish`
- `kla.monitoring.manage`
- `kla.complaint.manage`
- `kla.statistics.manage`
- `kla.regulation.manage`
- `kla.gallery.manage`

---

## 2. Database & Module Architecture

Semua module menggunakan prefix `kla_` agar modular dan terisolasi dari core PPID.
Tabel lama pada fase 1 tetap dipertahankan dengan beberapa penambahan struktur relasi.

### Tabel Eksisting (Perlu direview & disesuaikan):
- `kla_abouts`
- `kla_regulations`
- `kla_clusters`
- `kla_statistics`
- `kla_programs`
- `kla_achievements`
- `kla_documents`
- `kla_galleries`
- `kla_faqs`

### [NEW] Modul & Tabel Tambahan:
1. **Indikator & Monitoring**
   - `kla_indicator_categories` (Kategori indikator/klaster capaian)
   - `kla_indicators` (Data indikator spesifik)
   - `kla_indicator_progress` (Log capaian/progress dari waktu ke waktu)
   - `kla_monitoring_reports` (Laporan evaluasi monitoring)
2. **Dashboard & Metrics**
   - `kla_dashboard_metrics` (Data statis/cache metrik untuk hero dan dashboard)
   - `kla_chart_data` (Data agregat untuk visualisasi grafik KLA)
3. **Kemitraan & Layanan**
   - `kla_partner_categories` (Kategori mitra, misal: LSM, Swasta, Media)
   - `kla_partners` (Data mitra KLA)
   - `kla_service_categories` (Layanan ILA dll.)
   - `kla_services` (Daftar institusi/layanan anak)
4. **Klasifikasi Konten (Taxonomy)**
   - `kla_publication_categories` (Kategori artikel/publikasi KLA)
5. **Governance**
   - `kla_audit_logs` (Pencatatan riwayat perubahan data krusial, siapa/kapan/data sblm-ssdh)

---

## 3. Workflow Pengaduan Anak (Complaints)

Status lama: `pending`, `diproses`, `selesai`.
Status baru (Enum):
- `pending` (Baru masuk)
- `diverifikasi` (Dicek keabsahannya oleh verifikator_kla)
- `diproses` (Sedang ditangani instansi)
- `ditindaklanjuti` (Tahap resolusi lanjut)
- `selesai` (Kasus ditutup)
- `ditolak` (Spam / tidak valid)

**Penambahan Fitur Aduan:**
- Histori penanganan (timeline log per aduan).
- Catatan internal admin (private note).
- Lampiran (upload dokumen / bukti).
- Notifikasi internal dashboard.

---

## 4. Filament Admin Panel KLA

Semua Filament Resource KLA akan di-upgrade ke level production-grade CMS:
- **KLA Dashboard**: Custom page di Filament khusus menayangkan widget (Statistik, Pengaduan terbaru, Publikasi terbaru, Progress indikator).
- **List Records**: Menambahkan Filter (kategori, status publish, tanggal), Search, dan Sort.
- **Workflow Publish**: Toggle `is_active` / `status` (Draft, Published, Archived).
- **Relation Managers**: Mengelola data berjenjang (misal: `KlaCluster` memiliki banyak `KlaIndicators`).
- **Bulk Actions**: Hapus/Publish massal.
- **Chart Widgets**: Grafik monitoring dan aduan pada admin panel.

---

## 5. Frontend Dynamic Integration

Tampilan eksisting di `resources/views/pages/kla/index.blade.php` **tidak diubah secara destruktif**. Hanya mengubah data yang di-render (*hardcoded dummy*) menjadi data relasional dari CMS.

Section yang akan dihubungkan ke CMS:
1. **Hero Statistics**: Mengambil metrik utama (Kategori KLA, Jumlah Anak, dll.) dari tabel `kla_dashboard_metrics` atau `kla_statistics`.
2. **Dashboard Monitoring / Chart**: Data grafik capaian dan monitoring ditarik dari `kla_chart_data` & `kla_indicators`.
3. **Klaster & Progress**: Menampilkan klaster aktif dan presentase capaian.
4. **Publikasi, Berita, & Program**: Looping data dinamis `KlaProgram` / `KlaPublication`.
5. **Regulasi & Dokumen**: Table/List regulasi riil.
6. **Galeri & Prestasi**: Media grid riil.
7. **Layanan ILA & Partner**: Looping logo/informasi mitra dari `kla_partners`.
8. **Pengaduan Anak**: Submit form di frontend langsung masuk ke `kla_complaints` dengan status `pending`.

---

## 6. Audit Log & Keamanan Data

- **Audit Log**: Menggunakan pattern Laravel Model Observers atau Spatie ActivityLog untuk semua tabel `kla_*`. Menyimpan log perubahan (User ID, event: created/updated/deleted, old_values, new_values).
- **Keamanan Pengaduan**: Data pelapor (nama, kontak) hanya bisa dilihat oleh role yang berwenang (`admin_utama`, `verifikator_kla`). Perlindungan data sensitif anak sangat diutamakan.

---

## Verification Plan

### Langkah Kerja (Incremental):
1. Membuat migrasi untuk Role dan Permission baru, lalu Seed ke database.
2. Membuat/mengupdate tabel database `kla_*` dan Model beserta relasi dan status Enum.
3. Menyematkan Audit Log Observers pada Model.
4. Membangun Filament Resources yang kompleks (Filters, Relation Managers, KLA Dashboard).
5. Mengikat (binding) variabel pada `KlaController` untuk melempar data dinamis ke Blade `index.blade.php`.
6. Testing:
   - Login sebagai `admin_kla` vs `admin_ppid`.
   - Membuat pengaduan dummy di frontend dan mengecek proses verifikasi di admin.
   - Memastikan desain frontend tidak goyah saat data dinamis dimasukkan.
