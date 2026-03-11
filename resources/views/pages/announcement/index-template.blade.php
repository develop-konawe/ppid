@extends('layouts.app')

@section('title', 'Pengumuman')

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
                        info: '#0284C7',
                        exclusive: '#6B21A8',
                        announcement: '#B45309', // Warna khas untuk pengumuman
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
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
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
        /* Custom Styles - Diambil dari halaman utama untuk konsistensi */
        .glass-nav {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(31, 58, 138, 0.1);
        }

        .transition-soft {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover {
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -10px rgba(180, 83, 9, 0.2);
        }

        /* Logo Styles */
        .logo-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-konawe {
            filter: drop-shadow(0 4px 8px rgba(31, 58, 138, 0.3));
            transition: all 0.3s ease;
        }

        .logo-container:hover .logo-konawe {
            filter: drop-shadow(0 8px 16px rgba(31, 58, 138, 0.5));
            transform: scale(1.05);
        }

        .gov-badge-modern {
            background: linear-gradient(135deg, #ffffff 0%, #2563eb 100%);
            border: 2px solid rgba(220, 38, 38, 0.3);
            box-shadow: 0 10px 25px -5px rgba(174, 183, 208, 0.4);
            position: relative;
            overflow: hidden;
        }

        .gov-badge-modern::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .badge-indicator {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 14px;
            height: 14px;
            background: #dc2626;
            border: 2px solid white;
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.8;
            }
        }

        /* Mobile menu */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .mobile-menu.active {
            max-height: 500px;
        }

        /* Kustomisasi untuk halaman pengumuman */
        .announcement-hero {
            background: linear-gradient(135deg, #b45309 0%, #92400e 100%);
            position: relative;
            overflow: hidden;
        }

        .announcement-hero::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMzAgMTBhMjAgMjAgMCAwIDEgMjAgMjAgMjAgMjAgMCAwIDEtMjAgMjAgMjAgMjAgMCAwIDEtMjAtMjAgMjAgMjAgMCAwIDEgMjAtMjB6IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMDIiIGZpbGwtcnVsZT0iZXZlbm9kZCIvPjwvc3ZnPg==');
            opacity: 0.1;
            animation: slide 20s linear infinite;
        }

        @keyframes slide {
            from {
                background-position: 0 0;
            }
            to {
                background-position: 60px 60px;
            }
        }

        .table-row-hover:hover {
            background-color: #fffbeb;
        }

        .status-badge {
            @apply px-2 py-1 rounded-full text-xs font-medium inline-flex items-center gap-1;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #b45309;
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')
    <!-- ========== MAIN CONTENT - HALAMAN PENGUMUMAN ========== -->
    <main>
        <!-- Hero Section Khusus Pengumuman (Modern) -->
        <section class="announcement-hero py-16 md:py-24 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative max-w-7xl mx-auto px-4 md:px-8 lg:px-12 text-center text-white z-10">
                <div
                    class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6"
                >
                    <i class="fa-solid fa-bullhorn text-sm"></i>
                    <span class="text-sm font-medium">PENGUMUMAN RESMI PPID</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 animate-slide-up">
                    INFORMASI & PENGUMUMAN
                </h1>
                <p class="text-lg md:text-xl text-amber-100 max-w-3xl mx-auto">
                    Tetap terinformasi dengan pengumuman terbaru seputar layanan, kegiatan, dan kebijakan
                    PPID Kabupaten Konawe.
                </p>
            </div>

            <!-- Wave Decoration -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" fill="#F8FAFC">
                    <path
                        d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,100L1360,100C1280,100,1120,100,960,100C800,100,640,100,480,100C320,100,160,100,80,100L0,100Z"
                    ></path>
                </svg>
            </div>
        </section>

        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-6">
            <div class="flex items-center text-sm text-slate-500">
                <a href="index.html" class="hover:text-primary transition-soft"
                ><i class="fa-solid fa-home mr-1"></i> Beranda</a
                >
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-amber-600 font-medium">Pengumuman</span>
            </div>
        </div>

        <!-- Highlight Pengumuman Penting -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <div
                class="bg-gradient-to-r from-red-500 to-red-600 text-white p-6 rounded-2xl shadow-2xl relative overflow-hidden group"
            >
                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-soft"></div>
                <div class="relative flex flex-col md:flex-row items-center gap-6 z-10">
                    <div
                        class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm"
                    >
                        <i class="fa-solid fa-circle-exclamation text-3xl animate-pulse"></i>
                    </div>
                    <div class="flex-grow text-center md:text-left">
              <span
                  class="text-sm font-semibold bg-white/30 px-3 py-1 rounded-full inline-block mb-2"
              >PENGUMUMAN PENTING</span
              >
                        <h2 class="text-xl md:text-2xl font-bold mb-1">
                            Perubahan Jam Layanan PPID Selama Bulan Ramadhan 1447 H
                        </h2>
                        <p class="text-white/90 text-sm">
                            Layanan PPID akan buka pukul 08.00 - 15.00 WITA selama bulan Ramadhan. Berlaku mulai
                            1 Maret 2026.
                        </p>
                    </div>
                    <a
                        href="#"
                        class="bg-white text-red-600 px-6 py-3 rounded-xl font-bold hover:bg-amber-50 transition-soft shadow-lg whitespace-nowrap"
                    >
                        Selengkapnya
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Filter & Pencarian -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <div class="bg-white p-4 rounded-xl shadow-md border border-slate-100">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow relative">
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"
                        ></i>
                        <input
                            type="text"
                            placeholder="Cari judul atau nomor pengumuman..."
                            class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50"
                        />
                    </div>
                    <div class="flex gap-2">
                        <select
                            class="px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 bg-white"
                        >
                            <option>Semua Kategori</option>
                            <option>Layanan</option>
                            <option>Kepegawaian</option>
                            <option>Pengadaan</option>
                            <option>Kegiatan</option>
                            <option>Libur</option>
                        </select>
                        <select
                            class="px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 bg-white"
                        >
                            <option>2026</option>
                            <option>2025</option>
                            <option>2024</option>
                        </select>
                        <button
                            class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-xl font-semibold transition-soft shadow-md hover:shadow-lg"
                        >
                            <i class="fa-solid fa-search mr-2"></i>
                            <span class="hidden md:inline">Cari</span>
                        </button>
                    </div>
                </div>

                <!-- Quick Filter Chips -->
                <div class="flex flex-wrap gap-2 mt-4">
                    <span class="text-sm text-slate-500 mr-2">Filter Cepat:</span>
                    <button
                        class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-medium hover:bg-amber-200 transition-soft"
                    >
                        Semua
                    </button>
                    <button
                        class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-medium hover:bg-amber-100 hover:text-amber-700 transition-soft"
                    >
                        Layanan
                    </button>
                    <button
                        class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-medium hover:bg-amber-100 hover:text-amber-700 transition-soft"
                    >
                        Kepegawaian
                    </button>
                    <button
                        class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-medium hover:bg-amber-100 hover:text-amber-700 transition-soft"
                    >
                        Pengadaan
                    </button>
                    <button
                        class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-medium hover:bg-amber-100 hover:text-amber-700 transition-soft"
                    >
                        Kegiatan
                    </button>
                </div>
            </div>
        </section>

        <!-- Statistik Cepat -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 text-center">
                    <div class="text-2xl font-black text-amber-600">45</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider">Total Pengumuman</div>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 text-center">
                    <div class="text-2xl font-black text-amber-600">12</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider">Tahun 2026</div>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 text-center">
                    <div class="text-2xl font-black text-amber-600">5</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider">Aktif</div>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 text-center">
                    <div class="text-2xl font-black text-amber-600">8</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider">Akan Datang</div>
                </div>
            </div>
        </section>

        <!-- Daftar Pengumuman (Desktop: Tabel / Mobile: Card) -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-12">
            <!-- Judul Section -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black text-dark flex items-center gap-2">
                    <i class="fa-solid fa-list text-amber-600"></i>
                    DAFTAR PENGUMUMAN
                </h2>
                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-sm font-medium"
                >1-10 dari 45</span
                >
            </div>

            <!-- Tabel untuk Desktop -->
            <div
                class="hidden md:block bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden"
            >
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-amber-600 to-amber-700 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">No</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Judul Pengumuman</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Kategori</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                        <!-- Row 1 - Penting -->
                        <tr class="hover:bg-amber-50/50 transition-soft">
                            <td class="px-6 py-4 text-sm text-slate-600">
                    <span class="flex items-center">
                      <span class="relative flex h-2 w-2 mr-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"
                        ></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-600"></span>
                      </span>
                      1
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-dark">
                                    Perubahan Jam Layanan PPID Selama Ramadhan 1447 H
                                </div>
                                <div class="text-xs text-slate-500">Berlaku mulai 1 Maret 2026</div>
                            </td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-amber-100 text-amber-700 rounded-full px-2 py-1">
                      <i class="fa-solid fa-clock text-xs"></i> Layanan
                    </span>
                            </td>
                            <td class="px-6 py-4 text-sm">22 Feb 2026</td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-red-100 text-red-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-circle text-[6px] mr-1"></i> AKTIF
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#"
                                    class="text-amber-600 hover:text-amber-800 font-medium text-sm inline-flex items-center gap-1"
                                >
                                    Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="hover:bg-amber-50/50 transition-soft">
                            <td class="px-6 py-4 text-sm">2</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-dark">
                                    Pengumuman Hasil Seleksi PPPK Formasi 2025
                                </div>
                                <div class="text-xs text-slate-500">Nomor: 800/123/PPID/2026</div>
                            </td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-blue-100 text-blue-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-users text-xs"></i> Kepegawaian
                    </span>
                            </td>
                            <td class="px-6 py-4 text-sm">15 Feb 2026</td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-green-100 text-green-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-check-circle text-xs"></i> SELESAI
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#"
                                    class="text-amber-600 hover:text-amber-800 font-medium text-sm inline-flex items-center gap-1"
                                >
                                    Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="hover:bg-amber-50/50 transition-soft">
                            <td class="px-6 py-4 text-sm">3</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-dark">
                                    Libur Nasional dan Cuti Bersama Tahun 2026
                                </div>
                                <div class="text-xs text-slate-500">Surat Edaran Sekretaris Daerah</div>
                            </td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-purple-100 text-purple-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-calendar-alt text-xs"></i> Libur
                    </span>
                            </td>
                            <td class="px-6 py-4 text-sm">10 Feb 2026</td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-yellow-100 text-yellow-700 rounded-full px-2 py-1">
                      <i class="fa-solid fa-clock text-xs"></i> AKAN DATANG
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#"
                                    class="text-amber-600 hover:text-amber-800 font-medium text-sm inline-flex items-center gap-1"
                                >
                                    Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Tambahkan baris lainnya sesuai kebutuhan (hingga 10 baris) -->
                        <!-- Row 4 -->
                        <tr class="hover:bg-amber-50/50 transition-soft">
                            <td class="px-6 py-4 text-sm">4</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-dark">
                                    Pengadaan Langsung Jasa Kebersihan Kantor
                                </div>
                                <div class="text-xs text-slate-500">Nomor: 027/45/PAN/2026</div>
                            </td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-green-100 text-green-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-truck text-xs"></i> Pengadaan
                    </span>
                            </td>
                            <td class="px-6 py-4 text-sm">5 Feb 2026</td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-red-100 text-red-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-circle text-[6px] mr-1"></i> AKTIF
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#"
                                    class="text-amber-600 hover:text-amber-800 font-medium text-sm inline-flex items-center gap-1"
                                >
                                    Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Row 5 -->
                        <tr class="hover:bg-amber-50/50 transition-soft">
                            <td class="px-6 py-4 text-sm">5</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-dark">
                                    Sosialisasi Keterbukaan Informasi Publik 2026
                                </div>
                                <div class="text-xs text-slate-500">Akan dilaksanakan pada 15 Maret 2026</div>
                            </td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-orange-100 text-orange-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-chalkboard-user text-xs"></i> Kegiatan
                    </span>
                            </td>
                            <td class="px-6 py-4 text-sm">1 Feb 2026</td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-yellow-100 text-yellow-700 rounded-full px-2 py-1">
                      <i class="fa-solid fa-clock text-xs"></i> AKAN DATANG
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#"
                                    class="text-amber-600 hover:text-amber-800 font-medium text-sm inline-flex items-center gap-1"
                                >
                                    Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Row 6 -->
                        <tr class="hover:bg-amber-50/50 transition-soft">
                            <td class="px-6 py-4 text-sm">6</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-dark">
                                    Pengumuman Pemenang Tender Pengadaan Komputer
                                </div>
                                <div class="text-xs text-slate-500">Nomor: 027/89/PAN/2026</div>
                            </td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-green-100 text-green-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-computer text-xs"></i> Pengadaan
                    </span>
                            </td>
                            <td class="px-6 py-4 text-sm">28 Jan 2026</td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-green-100 text-green-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-check-circle text-xs"></i> SELESAI
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#"
                                    class="text-amber-600 hover:text-amber-800 font-medium text-sm inline-flex items-center gap-1"
                                >
                                    Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Row 7 -->
                        <tr class="hover:bg-amber-50/50 transition-soft">
                            <td class="px-6 py-4 text-sm">7</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-dark">Jadwal Pelayanan PPID Bulan Maret 2026</div>
                                <div class="text-xs text-slate-500">Update jadwal layanan</div>
                            </td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-amber-100 text-amber-700 rounded-full px-2 py-1">
                      <i class="fa-solid fa-clock text-xs"></i> Layanan
                    </span>
                            </td>
                            <td class="px-6 py-4 text-sm">25 Jan 2026</td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-green-100 text-green-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-check-circle text-xs"></i> SELESAI
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#"
                                    class="text-amber-600 hover:text-amber-800 font-medium text-sm inline-flex items-center gap-1"
                                >
                                    Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Row 8 -->
                        <tr class="hover:bg-amber-50/50 transition-soft">
                            <td class="px-6 py-4 text-sm">8</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-dark">
                                    Mutasi dan Promosi Jabatan Eselon III dan IV
                                </div>
                                <div class="text-xs text-slate-500">Keputusan Bupati Konawe</div>
                            </td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-blue-100 text-blue-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-users text-xs"></i> Kepegawaian
                    </span>
                            </td>
                            <td class="px-6 py-4 text-sm">20 Jan 2026</td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-gray-100 text-gray-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-archive text-xs"></i> ARSIP
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#"
                                    class="text-amber-600 hover:text-amber-800 font-medium text-sm inline-flex items-center gap-1"
                                >
                                    Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Row 9 -->
                        <tr class="hover:bg-amber-50/50 transition-soft">
                            <td class="px-6 py-4 text-sm">9</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-dark">
                                    Peringatan Hari Keterbukaan Informasi Nasional
                                </div>
                                <div class="text-xs text-slate-500">Acara puncak 28 April 2026</div>
                            </td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-orange-100 text-orange-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-chalkboard-user text-xs"></i> Kegiatan
                    </span>
                            </td>
                            <td class="px-6 py-4 text-sm">15 Jan 2026</td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-yellow-100 text-yellow-700 rounded-full px-2 py-1">
                      <i class="fa-solid fa-clock text-xs"></i> AKAN DATANG
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#"
                                    class="text-amber-600 hover:text-amber-800 font-medium text-sm inline-flex items-center gap-1"
                                >
                                    Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Row 10 -->
                        <tr class="hover:bg-amber-50/50 transition-soft">
                            <td class="px-6 py-4 text-sm">10</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-dark">Pengumuman Libur Isra Mi'raj 1447 H</div>
                                <div class="text-xs text-slate-500">Tanggal merah 28 Februari 2026</div>
                            </td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-purple-100 text-purple-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-calendar-alt text-xs"></i> Libur
                    </span>
                            </td>
                            <td class="px-6 py-4 text-sm">10 Jan 2026</td>
                            <td class="px-6 py-4">
                    <span class="status-badge bg-green-100 text-green-600 rounded-full px-2 py-1">
                      <i class="fa-solid fa-check-circle text-xs"></i> SELESAI
                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#"
                                    class="text-amber-600 hover:text-amber-800 font-medium text-sm inline-flex items-center gap-1"
                                >
                                    Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-slate-50 px-6 py-4 border-t border-slate-200">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-3">
                        <p class="text-sm text-slate-600">
                            Menampilkan <span class="font-medium">1-10</span> dari
                            <span class="font-medium">45</span> pengumuman
                        </p>
                        <div class="flex gap-2">
                            <button
                                class="w-9 h-9 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:bg-amber-600 hover:text-white disabled:opacity-50 transition-soft"
                                disabled
                            >
                                <i class="fa-solid fa-chevron-left text-xs"></i>
                            </button>
                            <button
                                class="w-9 h-9 bg-amber-600 text-white rounded-lg text-sm font-semibold hover:bg-amber-700 transition-soft"
                            >
                                1
                            </button>
                            <button
                                class="w-9 h-9 bg-white border border-slate-200 rounded-lg text-sm hover:bg-amber-600 hover:text-white transition-soft"
                            >
                                2
                            </button>
                            <button
                                class="w-9 h-9 bg-white border border-slate-200 rounded-lg text-sm hover:bg-amber-600 hover:text-white transition-soft"
                            >
                                3
                            </button>
                            <span class="text-slate-400 self-center">...</span>
                            <button
                                class="w-9 h-9 bg-white border border-slate-200 rounded-lg text-sm hover:bg-amber-600 hover:text-white transition-soft"
                            >
                                8
                            </button>
                            <button
                                class="w-9 h-9 bg-white border border-slate-200 rounded-lg flex items-center justify-center hover:bg-amber-600 hover:text-white transition-soft"
                            >
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card View untuk Mobile -->
            <div class="md:hidden space-y-4">
                <!-- Card 1 (Penting) -->
                <div class="bg-white p-5 rounded-xl shadow-md border-l-4 border-red-500 card-hover">
                    <div class="flex justify-between items-start mb-2">
              <span class="status-badge bg-amber-100 text-amber-700">
                <i class="fa-solid fa-clock text-xs"></i> Layanan
              </span>
                        <span class="status-badge bg-red-100 text-red-600">
                <i class="fa-solid fa-circle text-[6px] mr-1"></i> AKTIF
              </span>
                    </div>
                    <h3 class="font-bold text-dark mb-1">
                        Perubahan Jam Layanan PPID Selama Ramadhan 1447 H
                    </h3>
                    <p class="text-xs text-slate-500 mb-2">Berlaku mulai 1 Maret 2026</p>
                    <div class="flex justify-between items-center text-sm">
              <span class="text-slate-400"
              ><i class="fa-regular fa-calendar mr-1"></i>22 Feb 2026</span
              >
                        <a href="#" class="text-amber-600 font-medium inline-flex items-center gap-1">
                            Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-5 rounded-xl shadow-md border border-slate-100 card-hover">
                    <div class="flex justify-between items-start mb-2">
              <span class="status-badge bg-blue-100 text-blue-600">
                <i class="fa-solid fa-users text-xs"></i> Kepegawaian
              </span>
                        <span class="status-badge bg-green-100 text-green-600">SELESAI</span>
                    </div>
                    <h3 class="font-bold text-dark mb-1">Hasil Seleksi PPPK Formasi 2025</h3>
                    <p class="text-xs text-slate-500 mb-2">Nomor: 800/123/PPID/2026</p>
                    <div class="flex justify-between items-center text-sm">
              <span class="text-slate-400"
              ><i class="fa-regular fa-calendar mr-1"></i>15 Feb 2026</span
              >
                        <a href="#" class="text-amber-600 font-medium inline-flex items-center gap-1">
                            Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-5 rounded-xl shadow-md border border-slate-100 card-hover">
                    <div class="flex justify-between items-start mb-2">
              <span class="status-badge bg-purple-100 text-purple-600">
                <i class="fa-solid fa-calendar-alt text-xs"></i> Libur
              </span>
                        <span class="status-badge bg-yellow-100 text-yellow-700">AKAN DATANG</span>
                    </div>
                    <h3 class="font-bold text-dark mb-1">Libur Nasional dan Cuti Bersama 2026</h3>
                    <p class="text-xs text-slate-500 mb-2">Surat Edaran Sekretaris Daerah</p>
                    <div class="flex justify-between items-center text-sm">
              <span class="text-slate-400"
              ><i class="fa-regular fa-calendar mr-1"></i>10 Feb 2026</span
              >
                        <a href="#" class="text-amber-600 font-medium inline-flex items-center gap-1">
                            Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Lihat Semua untuk Mobile -->
                <a
                    href="#"
                    class="block text-center bg-amber-50 text-amber-700 py-3 rounded-xl font-semibold hover:bg-amber-100 transition-soft"
                >
                    Lihat Semua Pengumuman
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
        </section>

        <!-- Kategori Pengumuman -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-16">
            <h2 class="text-2xl font-black text-dark mb-6 flex items-center gap-2">
                <i class="fa-solid fa-tags text-amber-600"></i>
                JELAJAHI BERDASARKAN KATEGORI
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <a
                    href="#"
                    class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 text-center hover:bg-amber-50 hover:border-amber-200 transition-soft group"
                >
                    <div
                        class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-amber-600 group-hover:text-white transition-soft"
                    >
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <p class="font-semibold text-dark">Layanan</p>
                    <p class="text-xs text-slate-500">15 Pengumuman</p>
                </a>
                <a
                    href="#"
                    class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 text-center hover:bg-blue-50 hover:border-blue-200 transition-soft group"
                >
                    <div
                        class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-blue-600 group-hover:text-white transition-soft"
                    >
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <p class="font-semibold text-dark">Kepegawaian</p>
                    <p class="text-xs text-slate-500">12 Pengumuman</p>
                </a>
                <a
                    href="#"
                    class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 text-center hover:bg-green-50 hover:border-green-200 transition-soft group"
                >
                    <div
                        class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-green-600 group-hover:text-white transition-soft"
                    >
                        <i class="fa-solid fa-truck"></i>
                    </div>
                    <p class="font-semibold text-dark">Pengadaan</p>
                    <p class="text-xs text-slate-500">8 Pengumuman</p>
                </a>
                <a
                    href="#"
                    class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 text-center hover:bg-orange-50 hover:border-orange-200 transition-soft group"
                >
                    <div
                        class="w-12 h-12 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-orange-600 group-hover:text-white transition-soft"
                    >
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <p class="font-semibold text-dark">Kegiatan</p>
                    <p class="text-xs text-slate-500">6 Pengumuman</p>
                </a>
                <a
                    href="#"
                    class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 text-center hover:bg-purple-50 hover:border-purple-200 transition-soft group"
                >
                    <div
                        class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-purple-600 group-hover:text-white transition-soft"
                    >
                        <i class="fa-solid fa-calendar-alt"></i>
                    </div>
                    <p class="font-semibold text-dark">Libur</p>
                    <p class="text-xs text-slate-500">4 Pengumuman</p>
                </a>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
@endpush
