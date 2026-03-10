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

        /* Badge colors for different categories */
        .badge-keuangan { background-color: #DBEAFE; color: #1E40AF; }
        .badge-perencanaan { background-color: #DCFCE7; color: #166534; }
        .badge-profil { background-color: #F3E8FF; color: #6B21A8; }
        .badge-kinerja { background-color: #FEF3C7; color: #92400E; }
        .badge-pelayanan { background-color: #FFE4E6; color: #9F1239; }
        .badge-default { background-color: #E2E8F0; color: #334155; }
    </style>
@endpush

@section('content')
    @php
        use Illuminate\Support\Carbon;
        use Illuminate\Support\Str;

        // Pastikan variabel $data tersedia (dari controller Anda menggunakan $data, bukan $informations)
        $informations = $informations ?? collect([]);

        // Hitung statistik
        $totalDokumen = $informations instanceof \Illuminate\Pagination\LengthAwarePaginator
            ? $informations->total()
            : $informations->count();

        // Fungsi untuk memformat tanggal dengan aman
        function formatDateSafe($date, $format = 'd M Y') {
            if (empty($date)) {
                return '-';
            }

            if ($date instanceof Carbon) {
                return $date->format($format);
            }

            // Jika string, coba konversi ke Carbon
            try {
                return Carbon::parse($date)->format($format);
            } catch (\Exception $e) {
                return $date; // Kembalikan string asli jika gagal parse
            }
        }

        // Cari tanggal terbaru
        $lastUpdate = null;
        if ($informations->isNotEmpty()) {
            $dates = $informations->pluck('published_at')->filter()->map(function($item) {
                return $item instanceof Carbon ? $item : (is_string($item) ? Carbon::parse($item) : null);
            })->filter();

            $lastUpdate = $dates->isNotEmpty() ? $dates->max() : now();
        } else {
            $lastUpdate = now();
        }

        // Ambil daftar tahun unik untuk filter (gunakan query terpisah atau dari data yang ada)
        $tahunList = \App\Models\PublicInformation::where('information_type', 'berkala')
                        ->where('status', 'published')
                        ->whereNotNull('year')
                        ->distinct()
                        ->orderBy('year', 'desc')
                        ->pluck('year');

        // Ambil daftar kategori untuk filter - PERBAIKAN: gunakan query builder langsung
        $kategoriIds = \App\Models\PublicInformation::where('information_type', 'berkala')
            ->where('status', 'published')
            ->whereNotNull('category_id')
            ->distinct()
            ->pluck('category_id');

        $kategoriList = \App\Models\InformationCategory::whereIn('id', $kategoriIds)
            ->orderBy('name')
            ->get();
    @endphp

    <main class="py-8 md:py-12">
        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-6">
            <div class="flex items-center text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-primary transition-soft">
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
                            <span class="text-sm font-semibold text-primary bg-primary-subtle px-4 py-1.5 rounded-full">
                                PPID KABUPATEN KONAWE
                            </span>
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
                            <p class="text-3xl font-black text-primary">{{ $totalDokumen }}</p>
                            <p class="text-slate-600 text-sm">Total Dokumen</p>
                            <p class="text-xs text-slate-500 mt-1">
                                Terakhir diperbarui: {{ formatDateSafe($lastUpdate, 'M Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Filter & Search Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="bg-white p-5 rounded-2xl shadow-lg border border-slate-100">
                <form action="{{ route('ppid.berkala') }}" method="GET" id="filter-form">
                    <div class="flex flex-col md:flex-row gap-4">
                        <!-- Search -->
                        <div class="flex-grow relative">
                            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari dokumen informasi berkala..."
                                class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-soft"
                            />
                        </div>

                        <!-- Tahun Filter -->
                        <select name="year" class="md:w-48 px-4 py-3 border border-slate-200 rounded-xl text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                            <option value="">Semua Tahun</option>
                            @foreach($tahunList as $tahun)
                                <option value="{{ $tahun }}" {{ request('year') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Kategori Filter -->
                        <select name="category" class="md:w-48 px-4 py-3 border border-slate-200 rounded-xl text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoriList as $kategori)
                                <option value="{{ $kategori->id }}" {{ request('category') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- OPD Filter -->
                        @php
                            $opdList = \App\Models\Opd::orderBy('nama_opd')->get();
                        @endphp
                        <select name="opd" class="md:w-48 px-4 py-3 border border-slate-200 rounded-xl text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                            <option value="">Semua OPD</option>
                            @foreach($opdList as $opd)
                                <option value="{{ $opd->id }}" {{ request('opd') == $opd->id ? 'selected' : '' }}>
                                    {{ $opd->nama_opd }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="md:w-48 bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-semibold transition-soft flex items-center justify-center gap-2">
                            <i class="fa-solid fa-filter"></i>
                            FILTER
                        </button>

                        @if(request()->anyFilled(['search', 'year', 'category', 'opd']))
                            <a href="{{ route('ppid.berkala') }}" class="md:w-48 bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-3 rounded-xl font-semibold transition-soft flex items-center justify-center gap-2">
                                <i class="fa-solid fa-rotate-left"></i>
                                RESET
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Active Filters -->
                @if(request()->anyFilled(['search', 'year', 'category', 'opd']))
                    <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-slate-100">
                        <span class="text-sm text-slate-500 mr-2">Filter aktif:</span>

                        @if(request('search'))
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-primary-subtle text-primary rounded-full text-sm">
                                Pencarian: "{{ request('search') }}"
                                <a href="{{ route('ppid.berkala', array_merge(request()->except('search'), ['page' => null])) }}" class="ml-1 hover:text-primary-dark">
                                    <i class="fa-solid fa-xmark cursor-pointer"></i>
                                </a>
                            </span>
                        @endif

                        @if(request('year'))
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-primary-subtle text-primary rounded-full text-sm">
                                Tahun {{ request('year') }}
                                <a href="{{ route('ppid.berkala', array_merge(request()->except('year'), ['page' => null])) }}" class="ml-1 hover:text-primary-dark">
                                    <i class="fa-solid fa-xmark cursor-pointer"></i>
                                </a>
                            </span>
                        @endif

                        @if(request('category') && $selectedCategory = $kategoriList->firstWhere('id', request('category')))
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-primary-subtle text-primary rounded-full text-sm">
                                {{ $selectedCategory->name }}
                                <a href="{{ route('ppid.berkala', array_merge(request()->except('category'), ['page' => null])) }}" class="ml-1 hover:text-primary-dark">
                                    <i class="fa-solid fa-xmark cursor-pointer"></i>
                                </a>
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </section>

        <!-- Table Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-16">
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                <!-- Table Header with Info -->
                <div class="bg-gradient-to-r from-primary to-primary-dark px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-white font-bold text-lg">DAFTAR INFORMASI BERKALA</h2>
                        <span class="text-white/80 text-sm">
                            Diperbarui: {{ formatDateSafe($lastUpdate, 'd F Y') }}
                        </span>
                    </div>
                </div>

                <!-- Table Wrapper for Responsive -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <!-- Table Head -->
                        <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                Judul Informasi
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                Tahun
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                Tanggal Publikasi
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <!-- Table Body -->
                        <tbody class="divide-y divide-slate-200">
                        @forelse($informations as $index => $info)
                            @php
                                // Tentukan class badge berdasarkan kategori
                                $categoryName = $info->category->name ?? 'Lainnya';
                                $badgeClass = 'badge-default';

                                if (Str::contains(strtolower($categoryName), ['keuangan', 'anggaran', 'laporan keuangan'])) {
                                    $badgeClass = 'badge-keuangan';
                                } elseif (Str::contains(strtolower($categoryName), ['perencanaan', 'rencana', 'rpjmd', 'renstra'])) {
                                    $badgeClass = 'badge-perencanaan';
                                } elseif (Str::contains(strtolower($categoryName), ['profil', 'kelembagaan', 'struktur'])) {
                                    $badgeClass = 'badge-profil';
                                } elseif (Str::contains(strtolower($categoryName), ['kinerja', 'lkj', 'akuntabilitas'])) {
                                    $badgeClass = 'badge-kinerja';
                                } elseif (Str::contains(strtolower($categoryName), ['pelayanan', 'layanan'])) {
                                    $badgeClass = 'badge-pelayanan';
                                }
                            @endphp

                            <tr class="table-row-hover transition-soft">
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $informations->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-dark">
                                            {{ $info->title }}
                                        </p>
                                        @if($info->description)
                                            <p class="text-xs text-slate-500 mt-1">
                                                {{ Str::limit(strip_tags($info->description), 80) }}
                                            </p>
                                        @endif

                                        @if($info->opd)
                                            <p class="text-xs text-primary mt-1">
                                                {{ $info->opd->name }}
                                            </p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $badgeClass }}">
                                        {{ $categoryName }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $info->year ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    @if($info->published_at)
                                        {{ formatDateSafe($info->published_at, 'd M Y') }}
                                    @else
                                        {{ formatDateSafe($info->created_at, 'd M Y') }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if($info->file_path)
                                            <a href="{{ asset('storage/'.$info->file_path) }}"
                                               download
                                               class="w-8 h-8 bg-primary-subtle text-primary rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                               title="Download">
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route('berkala.detail', $info->id) }}"
                                           class="w-8 h-8 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-soft"
                                           title="Lihat Detail">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="fa-solid fa-file-circle-exclamation text-3xl text-slate-400"></i>
                                        </div>
                                        <p class="text-slate-500 font-medium">Belum ada data informasi berkala</p>
                                        <p class="text-sm text-slate-400 mt-1">
                                            Data akan segera tersedia setelah dipublikasikan oleh PPID
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer with Pagination -->
                @if($informations instanceof \Illuminate\Pagination\LengthAwarePaginator && $informations->hasPages())
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200">
                        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                            <p class="text-sm text-slate-600">
                                Menampilkan
                                <span class="font-semibold">{{ $informations->firstItem() ?? 0 }}</span> -
                                <span class="font-semibold">{{ $informations->lastItem() ?? 0 }}</span>
                                dari <span class="font-semibold">{{ $informations->total() }}</span> dokumen
                            </p>

                            <div class="flex items-center gap-2">
                                @if($informations->onFirstPage())
                                    <button class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 cursor-not-allowed" disabled>
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                @else
                                    <a href="{{ $informations->previousPageUrl() }}" class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition-soft">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </a>
                                @endif

                                @foreach($informations->getUrlRange(1, $informations->lastPage()) as $page => $url)
                                    @if($page == $informations->currentPage())
                                        <span class="w-10 h-10 bg-primary text-white rounded-lg font-semibold flex items-center justify-center">
                                        {{ $page }}
                                    </span>
                                    @elseif($page > $informations->currentPage() - 2 && $page < $informations->currentPage() + 2)
                                        <a href="{{ $url }}" class="w-10 h-10 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition-soft flex items-center justify-center">
                                            {{ $page }}
                                        </a>
                                    @elseif($page == 1 || $page == $informations->lastPage())
                                        <a href="{{ $url }}" class="w-10 h-10 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition-soft flex items-center justify-center">
                                            {{ $page }}
                                        </a>
                                    @elseif($page == $informations->currentPage() - 3 || $page == $informations->currentPage() + 3)
                                        <span class="text-slate-400">...</span>
                                    @endif
                                @endforeach

                                @if($informations->hasMorePages())
                                    <a href="{{ $informations->nextPageUrl() }}" class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition-soft">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </a>
                                @else
                                    <button class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 cursor-not-allowed" disabled>
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
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
                            <span class="text-slate-600">
                                Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik
                            </span>
                        </li>
                        <li class="flex items-start gap-3 text-sm">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full mt-2"></span>
                            <span class="text-slate-600">
                                Peraturan Komisi Informasi Nomor 1 Tahun 2010 tentang Standar Layanan Informasi Publik
                            </span>
                        </li>
                        <li class="flex items-start gap-3 text-sm">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full mt-2"></span>
                            <span class="text-slate-600">
                                Peraturan Bupati Konawe Nomor 15 Tahun 2020 tentang Pedoman Pengelolaan Informasi dan Dokumentasi
                            </span>
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
                            <span class="text-slate-600">
                                Informasi Berkala diperbarui setiap 6 bulan atau 1 tahun sekali
                            </span>
                        </li>
                        <li class="flex items-start gap-3 text-sm">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full mt-2"></span>
                            <span class="text-slate-600">
                                Dapat diakses langsung melalui website atau mengajukan permohonan
                            </span>
                        </li>
                        <li class="flex items-start gap-3 text-sm">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full mt-2"></span>
                            <span class="text-slate-600">
                                Respon maksimal 10 hari kerja untuk permohonan informasi
                            </span>
                        </li>
                    </ul>
                    <a href="{{ "route('permohonan.create')" }}" class="inline-flex items-center gap-2 mt-4 text-primary font-semibold text-sm hover:underline">
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
                            Tidak dipungut biaya, hanya membayar biaya penggandaan jika diperlukan dokumen fisik.
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm">
                        <h3 class="font-semibold text-dark mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-circle-question text-primary text-sm"></i>
                            Kapan diperbarui?
                        </h3>
                        <p class="text-sm text-slate-600">
                            Informasi diperbarui sesuai periode yang ditentukan, umumnya setiap awal semester atau tahun.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        // Auto-submit form when select changes
        document.querySelectorAll('select[name="year"], select[name="category"], select[name="opd"]').forEach(select => {
            if (select) {
                select.addEventListener('change', function() {
                    document.getElementById('filter-form').submit();
                });
            }
        });

        // Debounce search input
        let searchTimeout;
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    document.getElementById('filter-form').submit();
                }, 500);
            });
        }
    </script>
@endpush
