@extends('layouts.app')

@section('title', 'Informasi Publik Dikecualikan')

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
                        exclusive: '#6B21A8', // Ungu untuk informasi dikecualikan
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
        .table-row-hover:hover {
            background-color: #f5f0ff;
        }

        .table-header {
            background: linear-gradient(135deg, #6b21a8 0%, #581c87 100%);
        }

        .exclusive-card {
            border-left: 4px solid #6b21a8;
        }

        .legal-card {
            background: linear-gradient(135deg, #f9f5ff 0%, #ffffff 100%);
        }
    </style>
@endpush

@section('content')
    <!-- Info Bar -->
    <div class="bg-exclusive text-white py-2">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
            <div class="flex items-center justify-between text-sm">
          <span
          ><i class="fa-solid fa-shield-halved mr-2"></i> Informasi Dikecualikan - Tidak Dapat
            Diakses Publik</span
          >
                <span
                ><i class="fa-regular fa-file-lines mr-2"></i> Berdasarkan UU No. 14 Tahun 2008</span
                >
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="py-8 md:py-12">
        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-6">
            <div class="flex items-center text-sm text-slate-500">
                <a href="/" class="hover:text-primary transition-soft"
                ><i class="fa-solid fa-home mr-1"></i> Beranda</a
                >
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-exclusive font-medium">Informasi Dikecualikan</span>
            </div>
        </div>

        <!-- Header -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-exclusive/10 rounded-2xl flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved text-2xl text-exclusive"></i>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-dark">
                        INFORMASI <span class="text-exclusive">DIKECUALIKAN</span>
                    </h1>
                    <p class="text-slate-600">
                        Informasi yang tidak dapat diakses publik berdasarkan ketentuan perundang-undangan
                    </p>
                </div>
            </div>
        </section>

        <!-- Penjelasan Card -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 exclusive-card">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="md:w-2/3">
                        <h2 class="text-lg font-bold text-dark mb-3">Apa itu Informasi Dikecualikan?</h2>
                        <p class="text-slate-600 text-sm leading-relaxed mb-3">
                            Informasi Dikecualikan adalah informasi yang tidak dapat diberikan kepada pemohon
                            informasi publik karena bersifat ketat, terbatas, dan dilindungi kerahasiaannya
                            berdasarkan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik
                            dan peraturan pelaksanaannya.
                        </p>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Informasi ini dikecualikan untuk melindungi kepentingan negara, keamanan nasional,
                            kekayaan intelektual, privasi pribadi, serta rahasia bisnis dan jabatan tertentu.
                        </p>
                    </div>
                    <div class="md:w-1/3 bg-exclusive/5 p-4 rounded-lg">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fa-solid fa-scale-balanced text-exclusive"></i>
                            <span class="font-semibold text-dark">Dasar Hukum</span>
                        </div>
                        <ul class="text-xs text-slate-600 space-y-2">
                            <li>• UU No. 14 Tahun 2008 Pasal 17</li>
                            <li>• PP No. 61 Tahun 2010</li>
                            <li>• Perki No. 1 Tahun 2010</li>
                            <li>• Perbup Konawe No. 15/2020</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kategori Informasi Dikecualikan -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <h2 class="text-lg font-bold text-dark mb-4">Kategori Informasi Dikecualikan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Kategori 1 -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 bg-exclusive/10 rounded-lg flex items-center justify-center flex-shrink-0"
                        >
                            <i class="fa-solid fa-lock text-exclusive text-sm"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-sm">Keamanan Negara</h3>
                            <p class="text-xs text-slate-500 mt-1">
                                Informasi yang dapat membahayakan pertahanan dan keamanan negara
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Kategori 2 -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 bg-exclusive/10 rounded-lg flex items-center justify-center flex-shrink-0"
                        >
                            <i class="fa-solid fa-handcuffs text-exclusive text-sm"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-sm">Penegakan Hukum</h3>
                            <p class="text-xs text-slate-500 mt-1">
                                Informasi yang dapat menghambat proses penegakan hukum
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Kategori 3 -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 bg-exclusive/10 rounded-lg flex items-center justify-center flex-shrink-0"
                        >
                            <i class="fa-solid fa-copyright text-exclusive text-sm"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-sm">Hak Kekayaan Intelektual</h3>
                            <p class="text-xs text-slate-500 mt-1">
                                Informasi yang dilindungi hak cipta, paten, dan rahasia dagang
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Kategori 4 -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 bg-exclusive/10 rounded-lg flex items-center justify-center flex-shrink-0"
                        >
                            <i class="fa-solid fa-user-secret text-exclusive text-sm"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-sm">Privasi Pribadi</h3>
                            <p class="text-xs text-slate-500 mt-1">
                                Data pribadi seperti riwayat kesehatan, keuangan, dan keluarga
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Kategori 5 -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 bg-exclusive/10 rounded-lg flex items-center justify-center flex-shrink-0"
                        >
                            <i class="fa-solid fa-building text-exclusive text-sm"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-sm">Rahasia Bisnis</h3>
                            <p class="text-xs text-slate-500 mt-1">
                                Informasi yang dapat merugikan daya saing perusahaan
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Kategori 6 -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 bg-exclusive/10 rounded-lg flex items-center justify-center flex-shrink-0"
                        >
                            <i class="fa-solid fa-file-signature text-exclusive text-sm"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark text-sm">Rahasia Jabatan</h3>
                            <p class="text-xs text-slate-500 mt-1">
                                Informasi internal yang belum ditetapkan statusnya
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tabel Informasi Dikecualikan -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden">
                <!-- Table Header -->
                <div class="table-header px-6 py-3">
                    <h2 class="text-white font-semibold">DAFTAR INFORMASI YANG DIKECUALIKAN</h2>
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
                                Kategori
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">
                                Uraian Informasi
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">
                                Dasar Pengecualian
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">
                                Jangka Waktu
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">
                                Keterangan
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                        <!-- Row 1 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm text-slate-600">1</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-exclusive/10 text-exclusive rounded-full text-xs"
                    >Keamanan Negara</span
                    >
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-dark">Dokumen Rencana Kontijensi Bencana</span>
                                <p class="text-xs text-slate-500">Data strategis penanggulangan bencana</p>
                            </td>
                            <td class="px-4 py-3 text-sm">Pasal 17(a) UU KIP</td>
                            <td class="px-4 py-3 text-sm">10 tahun</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs"
                    >Terbatas</span
                    >
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">2</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-exclusive/10 text-exclusive rounded-full text-xs"
                    >Penegakan Hukum</span
                    >
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-dark">Berkas Perkara Tindak Pidana Korupsi</span>
                                <p class="text-xs text-slate-500">Dokumen penyidikan dan penuntutan</p>
                            </td>
                            <td class="px-4 py-3 text-sm">Pasal 17(b) UU KIP</td>
                            <td class="px-4 py-3 text-sm">5 tahun</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-red-100 text-red-600 rounded-full text-xs"
                    >Rahasia</span
                    >
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">3</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-exclusive/10 text-exclusive rounded-full text-xs"
                    >Hak Kekayaan Intelektual</span
                    >
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-dark">Dokumen Paten Inovasi Daerah</span>
                                <p class="text-xs text-slate-500">Data teknis inovasi yang dipatenkan</p>
                            </td>
                            <td class="px-4 py-3 text-sm">Pasal 17(c) UU KIP</td>
                            <td class="px-4 py-3 text-sm">20 tahun</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded-full text-xs"
                    >Terdaftar</span
                    >
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">4</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-exclusive/10 text-exclusive rounded-full text-xs"
                    >Privasi Pribadi</span
                    >
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-dark">Data Kesehatan Pejabat Negara</span>
                                <p class="text-xs text-slate-500">Rekam medis dan riwayat kesehatan</p>
                            </td>
                            <td class="px-4 py-3 text-sm">Pasal 17(d) UU KIP</td>
                            <td class="px-4 py-3 text-sm">Selamanya</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-purple-100 text-purple-600 rounded-full text-xs"
                    >Privat</span
                    >
                            </td>
                        </tr>
                        <!-- Row 5 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">5</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-exclusive/10 text-exclusive rounded-full text-xs"
                    >Rahasia Bisnis</span
                    >
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-dark">Dokumen Penawaran Tender</span>
                                <p class="text-xs text-slate-500">Data strategis peserta lelang</p>
                            </td>
                            <td class="px-4 py-3 text-sm">Pasal 17(e) UU KIP</td>
                            <td class="px-4 py-3 text-sm">3 tahun</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-amber-100 text-amber-600 rounded-full text-xs"
                    >Komersial</span
                    >
                            </td>
                        </tr>
                        <!-- Row 6 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">6</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-exclusive/10 text-exclusive rounded-full text-xs"
                    >Rahasia Jabatan</span
                    >
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-dark">Notulen Rapat Internal</span>
                                <p class="text-xs text-slate-500">Pembahasan kebijakan strategis</p>
                            </td>
                            <td class="px-4 py-3 text-sm">Pasal 17(f) UU KIP</td>
                            <td class="px-4 py-3 text-sm">2 tahun</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs"
                    >Internal</span
                    >
                            </td>
                        </tr>
                        <!-- Row 7 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">7</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-exclusive/10 text-exclusive rounded-full text-xs"
                    >Keamanan Negara</span
                    >
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-dark">Data Intelijen Wilayah</span>
                                <p class="text-xs text-slate-500">Informasi strategis keamanan</p>
                            </td>
                            <td class="px-4 py-3 text-sm">Pasal 17(a) UU KIP</td>
                            <td class="px-4 py-3 text-sm">30 tahun</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-red-100 text-red-600 rounded-full text-xs"
                    >Sangat Rahasia</span
                    >
                            </td>
                        </tr>
                        <!-- Row 8 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">8</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-exclusive/10 text-exclusive rounded-full text-xs"
                    >Privasi Pribadi</span
                    >
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-dark">Data Keuangan Wajib Pajak</span>
                                <p class="text-xs text-slate-500">Informasi SPT dan pembayaran pajak</p>
                            </td>
                            <td class="px-4 py-3 text-sm">Pasal 17(d) UU KIP</td>
                            <td class="px-4 py-3 text-sm">10 tahun</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-purple-100 text-purple-600 rounded-full text-xs"
                    >Rahasia</span
                    >
                            </td>
                        </tr>
                        <!-- Row 9 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">9</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-exclusive/10 text-exclusive rounded-full text-xs"
                    >Rahasia Bisnis</span
                    >
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-dark">Struktur Biaya Produksi</span>
                                <p class="text-xs text-slate-500">Rincian biaya BUMD</p>
                            </td>
                            <td class="px-4 py-3 text-sm">Pasal 17(e) UU KIP</td>
                            <td class="px-4 py-3 text-sm">5 tahun</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-amber-100 text-amber-600 rounded-full text-xs"
                    >Komersial</span
                    >
                            </td>
                        </tr>
                        <!-- Row 10 -->
                        <tr class="table-row-hover transition-soft">
                            <td class="px-4 py-3 text-sm">10</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-exclusive/10 text-exclusive rounded-full text-xs"
                    >Penegakan Hukum</span
                    >
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-medium text-dark">Identitas Saksi dan Pelapor</span>
                                <p class="text-xs text-slate-500">Data whistleblower</p>
                            </td>
                            <td class="px-4 py-3 text-sm">Pasal 17(b) UU KIP</td>
                            <td class="px-4 py-3 text-sm">Selamanya</td>
                            <td class="px-4 py-3">
                    <span class="px-2 py-1 bg-red-100 text-red-600 rounded-full text-xs"
                    >Dilindungi</span
                    >
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-slate-50 px-4 py-3 border-t border-slate-200">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-3">
                        <p class="text-sm text-slate-600">Menampilkan 1-10 dari 24 informasi dikecualikan</p>
                        <div class="flex gap-2">
                            <button
                                class="w-8 h-8 bg-white border border-slate-200 rounded flex items-center justify-center text-slate-400 hover:bg-exclusive hover:text-white disabled:opacity-50"
                                disabled
                            >
                                <i class="fa-solid fa-chevron-left text-xs"></i>
                            </button>
                            <button class="w-8 h-8 bg-exclusive text-white rounded text-sm font-semibold">
                                1
                            </button>
                            <button
                                class="w-8 h-8 bg-white border border-slate-200 rounded text-sm hover:bg-exclusive hover:text-white"
                            >
                                2
                            </button>
                            <button
                                class="w-8 h-8 bg-white border border-slate-200 rounded text-sm hover:bg-exclusive hover:text-white"
                            >
                                3
                            </button>
                            <button
                                class="w-8 h-8 bg-white border border-slate-200 rounded flex items-center justify-center hover:bg-exclusive hover:text-white"
                            >
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Prosedur Keberatan -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Prosedur Keberatan -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-exclusive/10 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-file-shield text-exclusive"></i>
                        </div>
                        <h3 class="font-bold text-dark">Prosedur Keberatan</h3>
                    </div>
                    <p class="text-sm text-slate-600 mb-4">
                        Jika pemohon informasi keberatan dengan alasan pengecualian, dapat mengajukan
                        keberatan kepada:
                    </p>
                    <ol class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                <span
                    class="w-5 h-5 bg-exclusive/10 text-exclusive rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0"
                >1</span
                >
                            <span class="text-slate-600">Atasan PPID dalam waktu 30 hari kerja</span>
                        </li>
                        <li class="flex items-start gap-3">
                <span
                    class="w-5 h-5 bg-exclusive/10 text-exclusive rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0"
                >2</span
                >
                            <span class="text-slate-600"
                            >Komisi Informasi Provinsi jika keberatan tidak direspons</span
                            >
                        </li>
                        <li class="flex items-start gap-3">
                <span
                    class="w-5 h-5 bg-exclusive/10 text-exclusive rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0"
                >3</span
                >
                            <span class="text-slate-600">Upaya hukum melalui Pengadilan Tata Usaha Negara</span>
                        </li>
                    </ol>
                </div>

                <!-- Masa Pengecualian -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-exclusive/10 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-clock text-exclusive"></i>
                        </div>
                        <h3 class="font-bold text-dark">Masa Pengecualian</h3>
                    </div>
                    <ul class="space-y-3 text-sm">
                        <li class="flex justify-between items-center">
                            <span class="text-slate-600">Keamanan Negara</span>
                            <span class="font-semibold text-exclusive">10-30 tahun</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-slate-600">Penegakan Hukum</span>
                            <span class="font-semibold text-exclusive">5 tahun</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-slate-600">Hak Kekayaan Intelektual</span>
                            <span class="font-semibold text-exclusive">20 tahun</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-slate-600">Privasi Pribadi</span>
                            <span class="font-semibold text-exclusive">Selamanya</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-slate-600">Rahasia Bisnis</span>
                            <span class="font-semibold text-exclusive">3-5 tahun</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- FAQ Informasi Dikecualikan -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <h2 class="text-lg font-bold text-dark mb-4">Pertanyaan Umum</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <h3 class="font-semibold text-dark text-sm mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-exclusive text-xs"></i>
                        Apakah semua informasi bisa dikecualikan?
                    </h3>
                    <p class="text-xs text-slate-600">
                        Tidak. Hanya informasi yang tercantum dalam UU No. 14/2008 Pasal 17 yang dapat
                        dikecualikan dengan uji konsekuensi.
                    </p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <h3 class="font-semibold text-dark text-sm mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-exclusive text-xs"></i>
                        Bagaimana cara mengetahui informasi dikecualikan?
                    </h3>
                    <p class="text-xs text-slate-600">
                        PPID wajib memberikan alasan tertulis dan dasar hukum pengecualian kepada pemohon.
                    </p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <h3 class="font-semibold text-dark text-sm mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-exclusive text-xs"></i>
                        Apakah pengecualian bersifat permanen?
                    </h3>
                    <p class="text-xs text-slate-600">
                        Tidak. Setelah jangka waktu tertentu, informasi dapat dibuka kembali atau ditinjau
                        ulang statusnya.
                    </p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <h3 class="font-semibold text-dark text-sm mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-exclusive text-xs"></i>
                        Apa yang dimaksud uji konsekuensi?
                    </h3>
                    <p class="text-xs text-slate-600">
                        Proses evaluasi untuk memastikan bahwa pengecualian informasi benar-benar diperlukan
                        dan sesuai ketentuan.
                    </p>
                </div>
            </div>
        </section>

        <!-- Ringkasan -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                    <div class="text-exclusive text-2xl font-bold">24</div>
                    <div class="text-sm text-slate-500">Total Informasi Dikecualikan</div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                    <div class="text-exclusive text-2xl font-bold">6</div>
                    <div class="text-sm text-slate-500">Kategori Pengecualian</div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                    <div class="text-exclusive text-2xl font-bold">17</div>
                    <div class="text-sm text-slate-500">Pasal UU KIP</div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                    <div class="text-exclusive text-2xl font-bold">3</div>
                    <div class="text-sm text-slate-500">Tingkat Keberatan</div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('back-to-top')
    <!-- Back to Top Button -->
    <button
        id="back-to-top"
        class="fixed bottom-6 right-6 w-10 h-10 bg-exclusive text-white rounded-full shadow-lg flex items-center justify-center hover:bg-purple-800 transition-soft z-40 hidden"
    >
        <i class="fa-solid fa-arrow-up"></i>
    </button>
@endpush
