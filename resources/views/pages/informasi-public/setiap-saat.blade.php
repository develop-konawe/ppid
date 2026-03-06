@extends('layouts.app')

@section('title', 'Informasi Publik Setiap Saat')

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
                        light: '#F8FAFC',
                        dark: '#0F172A',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['Poppins', 'Inter', 'sans-serif'],
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
        .transition-soft {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .table-row-hover:hover {
            background-color: #f0f9ff;
        }

        .table-header {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        }
    </style>
@endpush

@section('content')
    <!-- Main Content -->
    <main class="py-8 md:py-12">
        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-6">
            <div class="flex items-center text-sm text-slate-500">
                <a href="/" class="hover:text-primary transition-soft"
                ><i class="fa-solid fa-home mr-1"></i> Beranda</a
                >
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-info font-medium">Informasi Setiap Saat</span>
            </div>
        </div>

        <!-- Header -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-info/10 rounded-2xl flex items-center justify-center">
                    <i class="fa-solid fa-infinity text-2xl text-info"></i>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-dark">
                        INFORMASI <span class="text-info">SETIAP SAAT</span>
                    </h1>
                    <p class="text-slate-600">
                        Informasi yang tersedia dan dapat diakses publik kapan saja
                    </p>
                </div>
                <div class="ml-auto bg-white px-4 py-2 rounded-xl shadow-sm border border-slate-100">
                    <span class="text-2xl font-bold text-info">456</span>
                    <span class="text-sm text-slate-500 ml-1">Dokumen</span>
                </div>
            </div>
        </section>

        <!-- Filter Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-6">
            <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                <div class="flex flex-col md:flex-row gap-3">
                    <div class="flex-grow relative">
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"
                        ></i>
                        <input
                            type="text"
                            placeholder="Cari dokumen..."
                            class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-info"
                        />
                    </div>
                    <select
                        class="md:w-40 px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-info"
                    >
                        <option>Semua Kategori</option>
                        <option>Peraturan</option>
                        <option>Statistik</option>
                        <option>Profil Wilayah</option>
                        <option>Kelembagaan</option>
                    </select>
                    <select
                        class="md:w-32 px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-info"
                    >
                        <option>PDF</option>
                        <option>DOC</option>
                        <option>XLS</option>
                        <option>Semua</option>
                    </select>
                    <button
                        class="bg-info hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition-soft"
                    >
                        <i class="fa-solid fa-search mr-2"></i> CARI
                    </button>
                </div>
            </div>
        </section>

        <!-- Table Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-16">
            <div class="bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden">
                <!-- Table Header -->
                <div class="table-header px-6 py-3">
                    <h2 class="text-white font-semibold">DAFTAR INFORMASI SETIAP SAAT</h2>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">
                                No
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">
                                Judul Informasi
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">
                                Kategori
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">
                                Tahun
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">
                                Format
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">
                                Ukuran
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">
                                Diunduh
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                        <!-- Row 1 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm text-slate-600">1</td>
                            <td class="px-4 py-3">
                    <span class="font-medium text-dark"
                    >Peraturan Bupati Konawe No. 15 Tahun 2026</span
                    >
                                <p class="text-xs text-slate-500">Tentang Standar Pelayanan Publik</p>
                            </td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded-full text-xs"
                    >Peraturan</span
                    >
                            </td>
                            <td class="px-4 py-3 text-sm">2026</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-red-100 text-red-600 rounded text-xs font-medium"
                    >PDF</span
                    >
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600">2.1 MB</td>
                            <td class="px-4 py-3 text-sm text-slate-600">1,284x</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-info/10 text-info rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                        title="Download"
                                    >
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-slate-100 text-slate-600 rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                        title="Lihat"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">2</td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-dark">Profil Kabupaten Konawe Tahun 2026</span>
                                <p class="text-xs text-slate-500">
                                    Data geografis, demografis, dan potensi daerah
                                </p>
                            </td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-green-100 text-green-600 rounded-full text-xs"
                    >Profil</span
                    >
                            </td>
                            <td class="px-4 py-3 text-sm">2026</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-red-100 text-red-600 rounded text-xs">PDF</span>
                            </td>
                            <td class="px-4 py-3 text-sm">2.4 MB</td>
                            <td class="px-4 py-3 text-sm">956x</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-info/10 text-info rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-slate-100 text-slate-600 rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">3</td>
                            <td class="px-4 py-3">
                    <span class="font-medium text-dark"
                    >Rencana Pembangunan Jangka Menengah Daerah 2025-2030</span
                    >
                                <p class="text-xs text-slate-500">Dokumen perencanaan pembangunan daerah</p>
                            </td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-purple-100 text-purple-600 rounded-full text-xs"
                    >Perencanaan</span
                    >
                            </td>
                            <td class="px-4 py-3 text-sm">2025</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-red-100 text-red-600 rounded text-xs">PDF</span>
                            </td>
                            <td class="px-4 py-3 text-sm">3.2 MB</td>
                            <td class="px-4 py-3 text-sm">843x</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-info/10 text-info rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-slate-100 text-slate-600 rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">4</td>
                            <td class="px-4 py-3">
                    <span class="font-medium text-dark"
                    >Data Statistik Daerah Kabupaten Konawe 2025</span
                    >
                                <p class="text-xs text-slate-500">Indikator makro ekonomi dan kesejahteraan</p>
                            </td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-orange-100 text-orange-600 rounded-full text-xs"
                    >Statistik</span
                    >
                            </td>
                            <td class="px-4 py-3 text-sm">2025</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-green-100 text-green-600 rounded text-xs">XLSX</span>
                            </td>
                            <td class="px-4 py-3 text-sm">1.8 MB</td>
                            <td class="px-4 py-3 text-sm">712x</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-info/10 text-info rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-slate-100 text-slate-600 rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 5 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">5</td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-dark">Struktur Organisasi Perangkat Daerah</span>
                                <p class="text-xs text-slate-500">Data kelembagaan dan pejabat struktural</p>
                            </td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-indigo-100 text-indigo-600 rounded-full text-xs"
                    >Kelembagaan</span
                    >
                            </td>
                            <td class="px-4 py-3 text-sm">2026</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-red-100 text-red-600 rounded text-xs">PDF</span>
                            </td>
                            <td class="px-4 py-3 text-sm">1.2 MB</td>
                            <td class="px-4 py-3 text-sm">654x</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-info/10 text-info rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-slate-100 text-slate-600 rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 6 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">6</td>
                            <td class="px-4 py-3">
                    <span class="font-medium text-dark"
                    >Standar Operasional Prosedur Pelayanan Publik</span
                    >
                                <p class="text-xs text-slate-500">SOP pelayanan di lingkungan Pemkab Konawe</p>
                            </td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-teal-100 text-teal-600 rounded-full text-xs"
                    >Layanan</span
                    >
                            </td>
                            <td class="px-4 py-3 text-sm">2026</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-red-100 text-red-600 rounded text-xs">PDF</span>
                            </td>
                            <td class="px-4 py-3 text-sm">4.5 MB</td>
                            <td class="px-4 py-3 text-sm">543x</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-info/10 text-info rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-slate-100 text-slate-600 rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 7 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">7</td>
                            <td class="px-4 py-3">
                    <span class="font-medium text-dark"
                    >Peta Administrasi Wilayah Kabupaten Konawe</span
                    >
                                <p class="text-xs text-slate-500">Peta batas kecamatan dan desa/kelurahan</p>
                            </td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-amber-100 text-amber-600 rounded-full text-xs"
                    >Peta</span
                    >
                            </td>
                            <td class="px-4 py-3 text-sm">2026</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded text-xs">JPG</span>
                            </td>
                            <td class="px-4 py-3 text-sm">5.1 MB</td>
                            <td class="px-4 py-3 text-sm">432x</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-info/10 text-info rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-slate-100 text-slate-600 rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 8 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">8</td>
                            <td class="px-4 py-3">
                    <span class="font-medium text-dark"
                    >Laporan Kinerja Instansi Pemerintah 2025</span
                    >
                                <p class="text-xs text-slate-500">Laporan akuntabilitas kinerja</p>
                            </td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-cyan-100 text-cyan-600 rounded-full text-xs"
                    >Kinerja</span
                    >
                            </td>
                            <td class="px-4 py-3 text-sm">2025</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-red-100 text-red-600 rounded text-xs">PDF</span>
                            </td>
                            <td class="px-4 py-3 text-sm">2.8 MB</td>
                            <td class="px-4 py-3 text-sm">387x</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-info/10 text-info rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-slate-100 text-slate-600 rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 9 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">9</td>
                            <td class="px-4 py-3">
                    <span class="font-medium text-dark"
                    >Rencana Strategis Perangkat Daerah 2025-2030</span
                    >
                                <p class="text-xs text-slate-500">Renstra seluruh OPD</p>
                            </td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-purple-100 text-purple-600 rounded-full text-xs"
                    >Perencanaan</span
                    >
                            </td>
                            <td class="px-4 py-3 text-sm">2025</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded text-xs">DOCX</span>
                            </td>
                            <td class="px-4 py-3 text-sm">3.5 MB</td>
                            <td class="px-4 py-3 text-sm">321x</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-info/10 text-info rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-slate-100 text-slate-600 rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 10 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">10</td>
                            <td class="px-4 py-3">
                    <span class="font-medium text-dark"
                    >Indeks Kepuasan Masyarakat Semester II 2025</span
                    >
                                <p class="text-xs text-slate-500">Hasil survei kepuasan masyarakat</p>
                            </td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-orange-100 text-orange-600 rounded-full text-xs"
                    >Statistik</span
                    >
                            </td>
                            <td class="px-4 py-3 text-sm">2025</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-green-100 text-green-600 rounded text-xs">XLSX</span>
                            </td>
                            <td class="px-4 py-3 text-sm">0.8 MB</td>
                            <td class="px-4 py-3 text-sm">298x</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-info/10 text-info rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="w-7 h-7 bg-slate-100 text-slate-600 rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-slate-50 px-4 py-3 border-t border-slate-200">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-3">
                        <p class="text-sm text-slate-600">Menampilkan 1-10 dari 456 dokumen</p>
                        <div class="flex gap-2">
                            <button
                                class="w-8 h-8 bg-white border border-slate-200 rounded flex items-center justify-center text-slate-400 hover:bg-info hover:text-white disabled:opacity-50"
                                disabled
                            >
                                <i class="fa-solid fa-chevron-left text-xs"></i>
                            </button>
                            <button class="w-8 h-8 bg-info text-white rounded text-sm font-semibold">1</button>
                            <button
                                class="w-8 h-8 bg-white border border-slate-200 rounded text-sm hover:bg-info hover:text-white"
                            >
                                2
                            </button>
                            <button
                                class="w-8 h-8 bg-white border border-slate-200 rounded text-sm hover:bg-info hover:text-white"
                            >
                                3
                            </button>
                            <span class="text-slate-400">...</span>
                            <button
                                class="w-8 h-8 bg-white border border-slate-200 rounded text-sm hover:bg-info hover:text-white"
                            >
                                46
                            </button>
                            <button
                                class="w-8 h-8 bg-white border border-slate-200 rounded flex items-center justify-center hover:bg-info hover:text-white"
                            >
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ringkasan Informasi -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                    <div class="text-info text-2xl font-bold">456</div>
                    <div class="text-sm text-slate-500">Total Dokumen</div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                    <div class="text-info text-2xl font-bold">12</div>
                    <div class="text-sm text-slate-500">Kategori</div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                    <div class="text-info text-2xl font-bold">1.2 GB</div>
                    <div class="text-sm text-slate-500">Total Ukuran</div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                    <div class="text-info text-2xl font-bold">5.234</div>
                    <div class="text-sm text-slate-500">Total Diunduh</div>
                </div>
            </div>
        </section>
    </main>
@endsection
