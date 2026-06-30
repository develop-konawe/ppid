# KLA Module Development Tracker

> **PENTING UNTUK AI MODEL (LLM):**
> Baca dokumen ini sebelum melakukan perubahan apa pun pada modul KLA (Kabupaten Layak Anak) di dalam repositori PPID Konawe. Dokumen ini menyimpan riwayat pengembangan, *rules* mutlak, serta status *task* yang sedang berjalan atau sudah selesai.

---

## 🛑 ABSOLUTE RULES (PANTANGAN)
Saat memodifikasi atau memperbaiki modul KLA, Anda **WAJIB** mematuhi aturan berikut:
1. **JANGAN mengubah struktur database yang sudah ada.**
2. **JANGAN membuat migration baru.**
3. **JANGAN mengubah arsitektur CMS (Filament) secara fundamental.**
4. Modul KLA adalah "sub-sistem" (tambahan), sehingga grup menunya di Filament harus ditempatkan **di posisi terbawah** setelah menu-menu sistem inti.
5. Untuk masalah *fallback frontend* jika data kosong, gunakan UI *empty state* yang profesional. **Jangan gunakan data *dummy* statis di view**.

---

## 🏗️ Arsitektur & Teknologi
- **Framework:** Laravel 12
- **CMS/Admin Panel:** Filament v3
- **Struktur Resource KLA:** Terdapat 21 Resource KLA di dalam `app/Filament/Resources/` yang terbagi menjadi beberapa *Navigation Group*:
  - `KLA - Profil & Pengaturan`
  - `KLA - Evaluasi & Indikator`
  - `KLA - Layanan & Pengaduan`
  - `KLA - Informasi & Publikasi`
  - `KLA - Kemitraan`
  - `KLA - Sistem`

---

## 📈 Status Saat Ini (Current Status)

### ✅ SELESAI (DONE)
- **CMS Backend:** Integrasi 21 tabel database KLA ke dalam Panel Admin (Filament).
- **Audit Logging:** Implementasi *trait* `KlaAuditable` di setiap model, terintegrasi otomatis dengan `KlaAuditLogResource`.
- **RBAC (Roles & Permissions):** Pembuatan role `admin_kla` dan `operator_kla` (beserta Spatie Permissions) via `KlaRolesAndPermissionsSeeder`.
- **Dummy Data (Seeder):** Menyesuaikan `KlaDemoSeeder` agar mengisi data awal tanpa bentrok dengan validasi, termasuk menambahkan entri untuk `KlaAbout` (Profil KLA).
- **Navigasi Admin Panel:** Memperbaiki visibilitas dan merapikan 21 menu Filament menjadi 6 grup logis. Menempatkan grup KLA secara global di urutan paling bawah pada `AdminPanelProvider.php`.

### 🔄 SEDANG BERJALAN / TERTUNDA (IN PROGRESS / PENDING)
- **Frontend KLA (`KlaController` & `index.blade.php`):**
  - Mengganti seluruh data hardcoded/dummy di frontend KLA menjadi data dinamis dari CMS.
  - Jika tabel kosong, render komponen *empty state* yang terlihat profesional alih-alih menampilkan angka/statistik *dummy*.
  - (Error yang belum terselesaikan): Perbaikan error *"Undefined variable $defaultStats"*, *"Undefined array key 'bg'"*, dll saat proses *passing* data dari Controller ke View.

---

## 📝 Riwayat Perubahan (Changelog)

### [2026-05-31] Fase 2 - Perbaikan Filament UI & Menu Grouping
- **Fixed:** Memperbaiki visibilitas seluruh `Kla*Resource` yang sebelumnya hilang karena kurangnya *permission* di Admin.
- **Fixed:** Error `Field 'created_by' doesn't have a default value` saat seeder, ditangani dengan menambahkan kolom default atau penyesuaian seeder agar mendukung sistem auditable.
- **Added:** Menyuntikkan `protected static ?string $navigationGroup` ke puluhan modul KLA menggunakan *script* otomatis.
- **Changed:** Penempatan *navigation menu* KLA di `AdminPanelProvider` digeser ke paling bawah di bawah menu inti.

### [2026-05-30] Fase 1 - Integrasi Model & Filament
- Pembuatan model dan Filament Resources untuk ekosistem KLA (Klaster, Indikator, FAQ, Chart, Statistik, dll).
- Pembuatan Traits audit log.

---
*Dokumen ini harus selalu diperbarui setiap ada perbaikan signifikan pada modul KLA, agar konteks AI selalu terjaga.*
