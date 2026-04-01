@extends('layouts.app')

@section('title', 'Informasi Publik Serta Merta')

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
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
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
        /* Alert Banner */
        .alert-banner {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            position: relative;
            overflow: hidden;
        }

        .alert-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        /* Table styles */
        .table-header {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }

        .table-row-hover:hover {
            background-color: #fef2f2;
        }
    </style>
@endpush

@section('content')
    <!-- Alert Banner -->
    <div class="alert-banner text-white py-3 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 relative z-10">
            <div class="flex items-center justify-center md:justify-between flex-wrap gap-3">
                <div class="flex items-center gap-3">
            <span class="flex h-6 w-6 relative">
              <span
                  class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"
              ></span>
              <span
                  class="relative inline-flex rounded-full h-6 w-6 bg-white/30 backdrop-blur-sm items-center justify-center"
              >
                <i class="fa-solid fa-bolt text-xs"></i>
              </span>
            </span>
                    <p class="text-sm font-medium">
                        <span class="font-black">INFORMASI SERTA MERTA:</span> Informasi darurat yang harus
                        segera diketahui masyarakat
                    </p>
                </div>
                <div class="flex gap-2">
            <span class="text-xs bg-white/20 px-3 py-1 rounded-full backdrop-blur-sm">
              <i class="fa-regular fa-bell mr-1"></i> 3 Informasi Baru
            </span>
                </div>
            </div>
        </div>
    </div>

    <main class="py-8 md:py-12">
        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-6">
            <div class="flex items-center text-sm text-slate-500">
                <a href="/" class="hover:text-primary transition-soft">
                    <i class="fa-solid fa-home mr-1"></i> Beranda
                </a>
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-secondary font-medium">Informasi Serta Merta</span>
            </div>
        </div>

        <!-- Header Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="animate-slide-up">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-secondary/10 rounded-2xl flex items-center justify-center">
                            <i class="fa-solid fa-bolt text-2xl text-secondary"></i>
                        </div>
                        <div>
                <span
                    class="text-sm font-semibold text-secondary bg-secondary/10 px-4 py-1.5 rounded-full"
                >INFORMASI DARURAT & STRATEGIS</span
                >
                        </div>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-black text-dark mb-4">
                        INFORMASI <span class="text-secondary">SERTA MERTA</span>
                    </h1>
                    <p class="text-slate-600 max-w-2xl text-lg leading-relaxed">
                        Informasi yang dapat mengancam hajat hidup orang banyak dan ketertiban umum, serta
                        wajib segera diumumkan kepada masyarakat tanpa penundaan.
                    </p>
                </div>

                <!-- Stat Card -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100 min-w-[250px]">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-secondary/10 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-chart-line text-2xl text-secondary"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-secondary">28</p>
                            <p class="text-slate-600 text-sm">Total Informasi</p>
                            <p class="text-xs text-slate-500 mt-1">Tahun 2026</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-600">Tahun ini:</span>
                            <span class="font-semibold text-secondary">7 informasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Emergency Alert Cards -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Alert Card 1 -->
                <div
                    class="bg-gradient-to-br from-red-50 to-orange-50 p-5 rounded-xl border-l-4 border-secondary"
                >
                    <div class="flex items-start justify-between">
                        <div>
                <span
                    class="inline-flex items-center gap-1 bg-secondary/20 text-secondary px-3 py-1 rounded-full text-xs font-semibold mb-3"
                >
                  <i class="fa-solid fa-circle-exclamation text-xs"></i>
                  SIAGA BENCANA
                </span>
                            <h3 class="font-bold text-dark mb-1">Peringatan Dini Cuaca Ekstrem</h3>
                            <p class="text-xs text-slate-600 mb-2">BMKG - 21 Februari 2026</p>
                        </div>
                        <i class="fa-solid fa-cloud-rain text-3xl text-secondary/30"></i>
                    </div>
                    <p class="text-sm text-slate-700 mb-3">
                        Potensi hujan lebat disertai angin kencang di wilayah Konawe. Waspada banjir dan tanah
                        longsor.
                    </p>
                    <a
                        href="#"
                        class="text-secondary text-sm font-semibold inline-flex items-center hover:underline"
                    >
                        Lihat Detail <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                <!-- Alert Card 2 -->
                <div
                    class="bg-gradient-to-br from-yellow-50 to-amber-50 p-5 rounded-xl border-l-4 border-amber-500"
                >
                    <div class="flex items-start justify-between">
                        <div>
                <span
                    class="inline-flex items-center gap-1 bg-amber-500/20 text-amber-700 px-3 py-1 rounded-full text-xs font-semibold mb-3"
                >
                  <i class="fa-solid fa-virus text-xs"></i>
                  KESEHATAN
                </span>
                            <h3 class="font-bold text-dark mb-1">Kejadian Luar Biasa (KLB) DBD</h3>
                            <p class="text-xs text-slate-600 mb-2">Dinas Kesehatan - 19 Februari 2026</p>
                        </div>
                        <i class="fa-solid fa-biohazard text-3xl text-amber-500/30"></i>
                    </div>
                    <p class="text-sm text-slate-700 mb-3">
                        Peningkatan kasus DBD di 5 kecamatan. Masyarakat diminta melakukan PSN 3M Plus.
                    </p>
                    <a
                        href="#"
                        class="text-amber-600 text-sm font-semibold inline-flex items-center hover:underline"
                    >
                        Lihat Detail <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                <!-- Alert Card 3 -->
                <div
                    class="bg-gradient-to-br from-blue-50 to-indigo-50 p-5 rounded-xl border-l-4 border-blue-500"
                >
                    <div class="flex items-start justify-between">
                        <div>
                <span
                    class="inline-flex items-center gap-1 bg-blue-500/20 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold mb-3"
                >
                  <i class="fa-solid fa-road text-xs"></i>
                  TRANSPORTASI
                </span>
                            <h3 class="font-bold text-dark mb-1">Penutupan Jalan Nasional</h3>
                            <p class="text-xs text-slate-600 mb-2">Dinas PUPR - 20 Februari 2026</p>
                        </div>
                        <i class="fa-solid fa-road-bridge text-3xl text-blue-500/30"></i>
                    </div>
                    <p class="text-sm text-slate-700 mb-3">
                        Longsor menutup akses jalan poros Konawe-Kendari. Dialihkan via jalur alternatif.
                    </p>
                    <a
                        href="#"
                        class="text-blue-600 text-sm font-semibold inline-flex items-center hover:underline"
                    >
                        Lihat Detail <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Filter Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <div class="bg-white p-5 rounded-2xl shadow-lg border border-slate-100">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Search -->
                    <div class="flex-grow relative">
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"
                        ></i>
                        <input
                            type="text"
                            placeholder="Cari informasi serta merta..."
                            class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition-soft"
                        />
                    </div>

                    <!-- Kategori Filter -->
                    <select
                        class="md:w-48 px-4 py-3 border border-slate-200 rounded-xl text-slate-600 focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary"
                    >
                        <option>Semua Kategori</option>
                        <option>Bencana Alam</option>
                        <option>Kesehatan</option>
                        <option>Keamanan</option>
                        <option>Transportasi</option>
                        <option>Kebijakan Darurat</option>
                    </select>

                    <!-- Status Filter -->
                    <select
                        class="md:w-40 px-4 py-3 border border-slate-200 rounded-xl text-slate-600 focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary"
                    >
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Selesai</option>
                        <option>Dalam Penanganan</option>
                    </select>

                    <button
                        class="md:w-40 bg-secondary hover:bg-red-700 text-white px-6 py-3 rounded-xl font-semibold transition-soft flex items-center justify-center gap-2"
                    >
                        <i class="fa-solid fa-filter"></i>
                        FILTER
                    </button>
                </div>
            </div>
        </section>

        <!-- Table Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-16">
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-secondary to-red-700 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-white font-bold text-lg flex items-center gap-2">
                            <i class="fa-solid fa-bolt"></i>
                            DAFTAR INFORMASI SERTA MERTA
                        </h2>
                        <div class="flex items-center gap-3">
                <span class="text-white/80 text-sm flex items-center gap-1">
                  <i class="fa-regular fa-clock"></i> Update Real-time
                </span>
                            <span class="bg-white/20 text-white px-3 py-1 rounded-full text-xs">
                  <i class="fa-regular fa-bell mr-1"></i> 3 Baru
                </span>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-red-50 border-b border-red-100">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-secondary uppercase tracking-wider"
                            >
                                No
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-secondary uppercase tracking-wider"
                            >
                                Informasi
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-secondary uppercase tracking-wider"
                            >
                                Kategori
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-secondary uppercase tracking-wider"
                            >
                                Tanggal
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-secondary uppercase tracking-wider"
                            >
                                Status
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-secondary uppercase tracking-wider"
                            >
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                        <!-- Row 1 - Active Emergency -->
                        <tr class="table-row-hover transition-soft bg-red-50/30">
                            <td class="px-6 py-4 text-sm text-slate-600">
                    <span class="flex items-center">
                      <span class="relative flex h-3 w-3 mr-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"
                        ></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-secondary"></span>
                      </span>
                      1
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-dark">Peringatan Dini Banjir Bandang</p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Wilayah Kecamatan Unaaha, Wawotobi, dan sekitarnya
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                    <span
                        class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium"
                    >Bencana Alam</span
                    >
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                21 Feb 2026<br /><span class="text-xs text-slate-400">10:30 WITA</span>
                            </td>
                            <td class="px-6 py-4">
                    <span
                        class="status-badge inline-flex items-center px-3 py-1 bg-red-100 text-secondary rounded-full text-xs font-semibold"
                    >
                      <i
                          class="fa-solid fa-circle text-[6px] mr-1 text-secondary animate-pulse"
                      ></i>
                      AKTIF
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                        title="Detail"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                        title="Download"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                        title="Share"
                                    >
                                        <i class="fa-solid fa-share-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-6 py-4 text-sm text-slate-600">2</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-dark">KLB Demam Berdarah Dengue</p>
                                    <p class="text-xs text-slate-500 mt-1">5 kecamatan dengan kasus >100</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                    <span
                        class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-medium"
                    >Kesehatan</span
                    >
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                19 Feb 2026<br /><span class="text-xs text-slate-400">14:15 WITA</span>
                            </td>
                            <td class="px-6 py-4">
                    <span
                        class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold"
                    >
                      <i class="fa-solid fa-circle text-[6px] mr-1 text-yellow-600"></i>
                      DALAM PENANGANAN
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-6 py-4 text-sm text-slate-600">3</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-dark">Longsor Jalur Poros Konawe-Kendari</p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        KM 15-17, akses tertutup material longsor
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                    <span
                        class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-xs font-medium"
                    >Transportasi</span
                    >
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                20 Feb 2026<br /><span class="text-xs text-slate-400">06:45 WITA</span>
                            </td>
                            <td class="px-6 py-4">
                    <span
                        class="inline-flex items-center px-3 py-1 bg-red-100 text-secondary rounded-full text-xs font-semibold"
                    >
                      <i
                          class="fa-solid fa-circle text-[6px] mr-1 text-secondary animate-pulse"
                      ></i>
                      AKTIF
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-6 py-4 text-sm text-slate-600">4</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-dark">Kenaikan Harga Bahan Pokok</p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Imbas cuaca ekstrem dan gangguan distribusi
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                    <span
                        class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-xs font-medium"
                    >Ekonomi</span
                    >
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                18 Feb 2026<br /><span class="text-xs text-slate-400">09:00 WITA</span>
                            </td>
                            <td class="px-6 py-4">
                    <span
                        class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold"
                    >
                      DALAM PENANGANAN
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 5 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-6 py-4 text-sm text-slate-600">5</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-dark">Kebakaran Hutan dan Lahan</p>
                                    <p class="text-xs text-slate-500 mt-1">Kecamatan Amonggedo, 50 Ha terbakar</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                    <span
                        class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium"
                    >Bencana Alam</span
                    >
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                15 Feb 2026<br /><span class="text-xs text-slate-400">13:20 WITA</span>
                            </td>
                            <td class="px-6 py-4">
                    <span
                        class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold"
                    >
                      SELESAI
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 6 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-6 py-4 text-sm text-slate-600">6</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-dark">Gangguan Keamanan - Konflik Sosial</p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Kecamatan Besulutu, situasi kondusif
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                    <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-medium"
                    >Keamanan</span
                    >
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                14 Feb 2026<br /><span class="text-xs text-slate-400">20:30 WITA</span>
                            </td>
                            <td class="px-6 py-4">
                    <span
                        class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold"
                    >
                      SELESAI
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-8 h-8 bg-red-50 text-secondary rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-slate-50 px-6 py-4 border-t border-slate-200">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-sm text-slate-600">
                            Menampilkan <span class="font-semibold">1-6</span> dari
                            <span class="font-semibold">28</span> informasi
                        </p>
                        <div class="flex items-center gap-2">
                            <button
                                class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:bg-secondary hover:text-white hover:border-secondary transition-soft disabled:opacity-50"
                                disabled
                            >
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button
                                class="w-10 h-10 bg-secondary text-white rounded-lg font-semibold hover:bg-red-700 transition-soft"
                            >
                                1
                            </button>
                            <button
                                class="w-10 h-10 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-secondary hover:text-white hover:border-secondary transition-soft"
                            >
                                2
                            </button>
                            <button
                                class="w-10 h-10 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-secondary hover:text-white hover:border-secondary transition-soft"
                            >
                                3
                            </button>
                            <span class="text-slate-400">...</span>
                            <button
                                class="w-10 h-10 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-secondary hover:text-white hover:border-secondary transition-soft"
                            >
                                5
                            </button>
                            <button
                                class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 hover:bg-secondary hover:text-white hover:border-secondary transition-soft"
                            >
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Informasi & Statistik -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Statistik -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100 h-full">
                        <h3 class="font-bold text-lg text-dark mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-chart-pie text-secondary"></i>
                            STATISTIK INFORMASI SERTA MERTA
                        </h3>
                        <div class="space-y-4">
                            <!-- By Category -->
                            <div>
                                <p class="text-sm font-semibold text-slate-700 mb-2">Berdasarkan Kategori</p>
                                <div class="space-y-2">
                                    <div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="text-slate-600">Bencana Alam</span>
                                            <span class="font-semibold text-secondary">12</span>
                                        </div>
                                        <div class="w-full bg-slate-200 rounded-full h-1.5">
                                            <div class="bg-secondary h-1.5 rounded-full" style="width: 43%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="text-slate-600">Kesehatan</span>
                                            <span class="font-semibold text-secondary">8</span>
                                        </div>
                                        <div class="w-full bg-slate-200 rounded-full h-1.5">
                                            <div class="bg-secondary h-1.5 rounded-full" style="width: 28%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="text-slate-600">Keamanan</span>
                                            <span class="font-semibold text-secondary">4</span>
                                        </div>
                                        <div class="w-full bg-slate-200 rounded-full h-1.5">
                                            <div class="bg-secondary h-1.5 rounded-full" style="width: 14%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="text-slate-600">Transportasi</span>
                                            <span class="font-semibold text-secondary">3</span>
                                        </div>
                                        <div class="w-full bg-slate-200 rounded-full h-1.5">
                                            <div class="bg-secondary h-1.5 rounded-full" style="width: 11%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="text-slate-600">Ekonomi</span>
                                            <span class="font-semibold text-secondary">1</span>
                                        </div>
                                        <div class="w-full bg-slate-200 rounded-full h-1.5">
                                            <div class="bg-secondary h-1.5 rounded-full" style="width: 4%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-slate-100">
                                <p class="text-sm font-semibold text-slate-700 mb-2">Berdasarkan Status</p>
                                <div class="grid grid-cols-3 gap-2 text-center">
                                    <div class="bg-red-50 p-2 rounded-lg">
                                        <p class="text-lg font-bold text-secondary">5</p>
                                        <p class="text-xs text-slate-600">Aktif</p>
                                    </div>
                                    <div class="bg-yellow-50 p-2 rounded-lg">
                                        <p class="text-lg font-bold text-yellow-700">8</p>
                                        <p class="text-xs text-slate-600">Penanganan</p>
                                    </div>
                                    <div class="bg-gray-50 p-2 rounded-lg">
                                        <p class="text-lg font-bold text-gray-600">15</p>
                                        <p class="text-xs text-slate-600">Selesai</p>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2">
                                <div class="bg-secondary/5 p-3 rounded-lg">
                                    <p class="text-xs text-slate-600 flex items-center gap-2">
                                        <i class="fa-solid fa-clock-rotate-left text-secondary"></i>
                                        Rata-rata respon: <span class="font-semibold text-secondary">2.5 jam</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dasar Hukum & Prosedur -->
                <div class="lg:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 h-full">
                        <!-- Dasar Hukum -->
                        <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-10 h-10 bg-secondary/10 rounded-xl flex items-center justify-center"
                                >
                                    <i class="fa-solid fa-scale-balanced text-secondary"></i>
                                </div>
                                <h3 class="font-bold text-lg text-dark">Dasar Hukum</h3>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-sm">
                                    <span class="w-1.5 h-1.5 bg-secondary rounded-full mt-2"></span>
                                    <span class="text-slate-600"
                                    >UU No. 14/2008 tentang Keterbukaan Informasi Publik</span
                                    >
                                </li>
                                <li class="flex items-start gap-3 text-sm">
                                    <span class="w-1.5 h-1.5 bg-secondary rounded-full mt-2"></span>
                                    <span class="text-slate-600">PP No. 61/2010 tentang Pelaksanaan UU KIP</span>
                                </li>
                                <li class="flex items-start gap-3 text-sm">
                                    <span class="w-1.5 h-1.5 bg-secondary rounded-full mt-2"></span>
                                    <span class="text-slate-600"
                                    >Perki No. 1/2010 tentang Standar Layanan Informasi</span
                                    >
                                </li>
                                <li class="flex items-start gap-3 text-sm">
                                    <span class="w-1.5 h-1.5 bg-secondary rounded-full mt-2"></span>
                                    <span class="text-slate-600">Perbup Konawe No. 15/2020 tentang PPID</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Prosedur -->
                        <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-10 h-10 bg-secondary/10 rounded-xl flex items-center justify-center"
                                >
                                    <i class="fa-solid fa-clock text-secondary"></i>
                                </div>
                                <h3 class="font-bold text-lg text-dark">Mekanisme</h3>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-sm">
                                    <span class="w-1.5 h-1.5 bg-secondary rounded-full mt-2"></span>
                                    <span class="text-slate-600">Diumumkan segera saat kejadian (real-time)</span>
                                </li>
                                <li class="flex items-start gap-3 text-sm">
                                    <span class="w-1.5 h-1.5 bg-secondary rounded-full mt-2"></span>
                                    <span class="text-slate-600">Update informasi setiap perkembangan</span>
                                </li>
                                <li class="flex items-start gap-3 text-sm">
                                    <span class="w-1.5 h-1.5 bg-secondary rounded-full mt-2"></span>
                                    <span class="text-slate-600"
                                    >Dapat diakses melalui website, SMS, dan media sosial</span
                                    >
                                </li>
                            </ul>
                            <div class="mt-4 pt-4 border-t border-slate-100">
                                <div class="flex items-center gap-3 text-sm">
                                    <i class="fa-solid fa-headset text-secondary"></i>
                                    <span class="text-slate-600"
                                    >Call Center Darurat:
                      <strong class="text-secondary">(0408) 123456</strong></span
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Saluran Informasi -->
                        <div
                            class="md:col-span-2 bg-gradient-to-r from-secondary to-red-700 p-6 rounded-2xl shadow-lg text-white"
                        >
                            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm"
                                    >
                                        <i class="fa-solid fa-bell text-2xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-lg">Butuh Informasi Cepat?</h4>
                                        <p class="text-white/80 text-sm">
                                            Dapatkan informasi serta merta melalui kanal resmi PPID
                                        </p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <a
                                        href="#"
                                        class="bg-white text-secondary px-4 py-2 rounded-lg font-semibold text-sm hover:bg-slate-100 transition-soft flex items-center gap-2"
                                    >
                                        <i class="fa-brands fa-whatsapp"></i>
                                        WhatsApp
                                    </a>
                                    <a
                                        href="#"
                                        class="bg-white/20 text-white px-4 py-2 rounded-lg font-semibold text-sm hover:bg-white/30 transition-soft backdrop-blur-sm flex items-center gap-2"
                                    >
                                        <i class="fa-regular fa-bell"></i>
                                        Langganan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
