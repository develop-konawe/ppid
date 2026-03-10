@extends('layouts.app')

@section('title', 'Informasi Publik Berkala')

@push('scripts-head')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#1F3A8A',
                            dark: '#172554',
                            light: '#3B82F6',
                            subtle: '#EFF6FF',
                        },
                        secondary: '#DC2626',
                        accent: '#059669',
                        light: '#F8FAFC',
                        dark: '#0F172A',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['Poppins', 'Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                    },
                },
            },
        };
    </script>
@endpush

@push('styles')
    <style>
        /* Table styles */
        .table-header {
            background: linear-gradient(135deg, #1f3a8a 0%, #2d4ba0 100%);
        }

        .table-row-hover:hover {
            background-color: #eff6ff;
        }
    </style>
@endpush

@section('content')
    <main class="py-8 md:py-12">
        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-6">
            <div class="flex items-center text-sm text-slate-500">
                <a href="/" class="hover:text-primary transition-soft">
                    <i class="fa-solid fa-home mr-1"></i> Beranda
                </a>
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-primary font-medium">Informasi Berkala</span>
            </div>
        </div>

        <!-- Header Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="animate-slide-up">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center">
                            <i class="fa-solid fa-clock-rotate-left text-2xl text-primary"></i>
                        </div>
                        <div>
                    <span
                        class="text-sm font-semibold text-primary bg-primary-subtle px-4 py-1.5 rounded-full"
                    >PPID KABUPATEN KONAWE</span
                    >
                        </div>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-black text-dark mb-4">
                        INFORMASI <span class="text-primary">BERKALA</span>
                    </h1>
                    <p class="text-slate-600 max-w-2xl text-lg leading-relaxed">
                        Informasi yang wajib disediakan dan diumumkan secara berkala oleh Pejabat Pengelola
                        Informasi dan Dokumentasi (PPID) Kabupaten Konawe sesuai dengan ketentuan
                        perundang-undangan.
                    </p>
                </div>

                <!-- Info Card -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100 min-w-[250px]">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-file-circle-check text-2xl text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-primary">124</p>
                            <p class="text-slate-600 text-sm">Total Dokumen</p>
                            <p class="text-xs text-slate-500 mt-1">Terakhir diperbarui: Feb 2026</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Filter & Search Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="bg-white p-5 rounded-2xl shadow-lg border border-slate-100">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Search -->
                    <div class="flex-grow relative">
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"
                        ></i>
                        <input
                            type="text"
                            placeholder="Cari dokumen informasi berkala..."
                            class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-soft"
                        />
                    </div>

                    <!-- Tahun Filter -->
                    <select
                        class="md:w-48 px-4 py-3 border border-slate-200 rounded-xl text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                    >
                        <option>Semua Tahun</option>
                        <option>2026</option>
                        <option>2025</option>
                        <option>2024</option>
                        <option>2023</option>
                    </select>

                    <!-- Kategori Filter -->
                    <select
                        class="md:w-48 px-4 py-3 border border-slate-200 rounded-xl text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                    >
                        <option>Semua Kategori</option>
                        <option>Profil & Kelembagaan</option>
                        <option>Keuangan & Anggaran</option>
                        <option>Program & Kegiatan</option>
                        <option>Regulasi & Kebijakan</option>
                        <option>Layanan Publik</option>
                    </select>

                    <button
                        class="md:w-48 bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-semibold transition-soft flex items-center justify-center gap-2"
                    >
                        <i class="fa-solid fa-filter"></i>
                        FILTER
                    </button>
                </div>

                <!-- Active Filters -->
                <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-slate-100">
                    <span class="text-sm text-slate-500 mr-2">Filter aktif:</span>
                    <span
                        class="inline-flex items-center gap-1 px-3 py-1 bg-primary-subtle text-primary rounded-full text-sm"
                    >
                  Tahun 2026
                  <i class="fa-solid fa-xmark cursor-pointer hover:text-primary-dark ml-1"></i>
                </span>
                    <span
                        class="inline-flex items-center gap-1 px-3 py-1 bg-primary-subtle text-primary rounded-full text-sm"
                    >
                  Keuangan & Anggaran
                  <i class="fa-solid fa-xmark cursor-pointer hover:text-primary-dark ml-1"></i>
                </span>
                </div>
            </div>
        </section>

        <!-- Table Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-16">
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                <!-- Table Header with Info -->
                <div class="bg-gradient-to-r from-primary to-primary-dark px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-white font-bold text-lg">DAFTAR INFORMASI BERKALA</h2>
                        <span class="text-white/80 text-sm">Diperbarui: 07 Februari 2026</span>
                    </div>
                </div>

                <!-- Table Wrapper for Responsive -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <!-- Table Head -->
                        <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider"
                            >
                                No
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider"
                            >
                                Judul Informasi
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider"
                            >
                                Kategori
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider"
                            >
                                Tahun
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider"
                            >
                                Tanggal Publikasi
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider"
                            >
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <!-- Table Body -->
                        <tbody class="divide-y divide-slate-200">
                        <!-- Row 1 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-6 py-4 text-sm text-slate-600">1</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-dark">
                                        Laporan Keuangan Pemerintah Daerah (LKPD) TA 2025
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">Ringkasan laporan keuangan audited</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                        <span
                            class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium"
                        >Keuangan</span
                        >
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">2025</td>
                            <td class="px-6 py-4 text-sm text-slate-600">15 Jan 2026</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-primary-subtle text-primary rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                        title="Download"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                        title="Lihat Detail"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-6 py-4 text-sm text-slate-600">2</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-dark">
                                        Rencana Pembangunan Jangka Menengah Daerah (RPJMD) 2025-2030
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Dokumen perencanaan pembangunan daerah
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                        <span
                            class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-medium"
                        >Perencanaan</span
                        >
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">2025-2030</td>
                            <td class="px-6 py-4 text-sm text-slate-600">10 Des 2025</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-primary-subtle text-primary rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                        title="Download"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                        title="Lihat Detail"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-6 py-4 text-sm text-slate-600">3</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-dark">
                                        Profil Penyelenggara Pemerintahan Daerah Tahun 2025
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">Data umum dan informasi kelembagaan</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                        <span
                            class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-xs font-medium"
                        >Profil</span
                        >
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">2025</td>
                            <td class="px-6 py-4 text-sm text-slate-600">5 Des 2025</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-primary-subtle text-primary rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                        title="Download"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                        title="Lihat Detail"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-6 py-4 text-sm text-slate-600">4</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-dark">
                                        Laporan Kinerja Instansi Pemerintah (LKj) Tahun 2025
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">Laporan akuntabilitas kinerja</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                        <span
                            class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-xs font-medium"
                        >Kinerja</span
                        >
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">2025</td>
                            <td class="px-6 py-4 text-sm text-slate-600">28 Feb 2026</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-primary-subtle text-primary rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                        title="Download"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                        title="Lihat Detail"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 5 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-6 py-4 text-sm text-slate-600">5</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-dark">
                                        Rencana Strategis (Renstra) Perangkat Daerah 2025-2030
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">Dokumen renstra seluruh OPD</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                        <span
                            class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-medium"
                        >Perencanaan</span
                        >
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">2025-2030</td>
                            <td class="px-6 py-4 text-sm text-slate-600">20 Des 2025</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-primary-subtle text-primary rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                        title="Download"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                        title="Lihat Detail"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 6 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-6 py-4 text-sm text-slate-600">6</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-dark">
                                        Informasi Kinerja Pelayanan Publik Semester II 2025
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">Laporan pelayanan publik</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                        <span
                            class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium"
                        >Pelayanan</span
                        >
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">2025</td>
                            <td class="px-6 py-4 text-sm text-slate-600">10 Jan 2026</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-primary-subtle text-primary rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                        title="Download"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                        title="Lihat Detail"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer with Pagination -->
                <div class="bg-slate-50 px-6 py-4 border-t border-slate-200">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-sm text-slate-600">
                            Menampilkan <span class="font-semibold">1-6</span> dari
                            <span class="font-semibold">124</span> dokumen
                        </p>
                        <div class="flex items-center gap-2">
                            <button
                                class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white hover:border-primary transition-soft disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled
                            >
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button
                                class="w-10 h-10 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition-soft"
                            >
                                1
                            </button>
                            <button
                                class="w-10 h-10 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition-soft"
                            >
                                2
                            </button>
                            <button
                                class="w-10 h-10 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition-soft"
                            >
                                3
                            </button>
                            <span class="text-slate-400">...</span>
                            <button
                                class="w-10 h-10 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition-soft"
                            >
                                21
                            </button>
                            <button
                                class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition-soft"
                            >
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Informasi Tambahan -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Dasar Hukum -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-scale-balanced text-primary"></i>
                        </div>
                        <h3 class="font-bold text-lg text-dark">Dasar Hukum</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-sm">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full mt-2"></span>
                            <span class="text-slate-600"
                            >Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</span
                            >
                        </li>
                        <li class="flex items-start gap-3 text-sm">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full mt-2"></span>
                            <span class="text-slate-600"
                            >Peraturan Komisi Informasi Nomor 1 Tahun 2010 tentang Standar Layanan Informasi
                      Publik</span
                            >
                        </li>
                        <li class="flex items-start gap-3 text-sm">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full mt-2"></span>
                            <span class="text-slate-600"
                            >Peraturan Bupati Konawe Nomor 15 Tahun 2020 tentang Pedoman Pengelolaan Informasi
                      dan Dokumentasi</span
                            >
                        </li>
                    </ul>
                </div>

                <!-- Mekanisme -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-circle-info text-primary"></i>
                        </div>
                        <h3 class="font-bold text-lg text-dark">Mekanisme Pengajuan</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-sm">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full mt-2"></span>
                            <span class="text-slate-600"
                            >Informasi Berkala diperbarui setiap 6 bulan atau 1 tahun sekali</span
                            >
                        </li>
                        <li class="flex items-start gap-3 text-sm">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full mt-2"></span>
                            <span class="text-slate-600"
                            >Dapat diakses langsung melalui website atau mengajukan permohonan</span
                            >
                        </li>
                        <li class="flex items-start gap-3 text-sm">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full mt-2"></span>
                            <span class="text-slate-600"
                            >Respon maksimal 10 hari kerja untuk permohonan informasi</span
                            >
                        </li>
                    </ul>
                    <a
                        href="#"
                        class="inline-flex items-center gap-2 mt-4 text-primary font-semibold text-sm hover:underline"
                    >
                        <i class="fa-solid fa-file-import"></i>
                        Ajukan Permohonan Informasi
                    </a>
                </div>
            </div>
        </section>

        <!-- FAQ Mini -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-16">
            <div class="bg-primary-subtle p-8 rounded-3xl">
                <div class="text-center mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-dark mb-3">
                        Pertanyaan Seputar Informasi Berkala
                    </h2>
                    <p class="text-slate-600">Temukan jawaban atas pertanyaan yang sering diajukan</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-4xl mx-auto">
                    <div class="bg-white p-4 rounded-xl shadow-sm">
                        <h3 class="font-semibold text-dark mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-circle-question text-primary text-sm"></i>
                            Apa itu Informasi Berkala?
                        </h3>
                        <p class="text-sm text-slate-600">
                            Informasi yang wajib diumumkan secara rutin dan diperbarui secara berkala, minimal
                            setiap 6 bulan atau 1 tahun sekali.
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm">
                        <h3 class="font-semibold text-dark mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-circle-question text-primary text-sm"></i>
                            Bagaimana cara mengaksesnya?
                        </h3>
                        <p class="text-sm text-slate-600">
                            Dapat diunduh langsung dari website atau mengajukan permohonan ke PPID jika dokumen
                            tidak tersedia.
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm">
                        <h3 class="font-semibold text-dark mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-circle-question text-primary text-sm"></i>
                            Apakah ada biaya?
                        </h3>
                        <p class="text-sm text-slate-600">
                            Tidak dipungut biaya, hanya membayar biaya penggandaan jika diperlukan dokumen
                            fisik.
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm">
                        <h3 class="font-semibold text-dark mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-circle-question text-primary text-sm"></i>
                            Kapan diperbarui?
                        </h3>
                        <p class="text-sm text-slate-600">
                            Informasi diperbarui sesuai periode yang ditentukan, umumnya setiap awal semester
                            atau tahun.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
