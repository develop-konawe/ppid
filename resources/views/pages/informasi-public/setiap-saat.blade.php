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
                    <span class="text-2xl font-bold text-info">{{ $data->total() }}</span>
                    <span class="text-sm text-slate-500 ml-1">Dokumen</span>
                </div>
            </div>
        </section>

        <!-- Filter Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-6">
            <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                <form action="{{ route('ppid.setiap-saat') ?? '#' }}" method="GET" class="flex flex-col md:flex-row gap-3">
                    <div class="flex-grow relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari dokumen..."
                            class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-info focus:ring-1 focus:ring-info"
                        />
                    </div>
                    
                    @php
                        $kategoriIds = \App\Models\PublicInformation::where('information_type', 'setiap_saat')
                            ->where('status', 'published')
                            ->whereNotNull('category_id')
                            ->distinct()
                            ->pluck('category_id');
                    
                        $kategoriList = \App\Models\InformationCategory::whereIn('id', $kategoriIds)
                            ->orderBy('name')
                            ->get();
                            
                        $tahunList = \App\Models\PublicInformation::where('information_type', 'setiap_saat')
                            ->where('status', 'published')
                            ->whereNotNull('year')
                            ->distinct()
                            ->orderBy('year', 'desc')
                            ->pluck('year');
                            
                        $opdList = \App\Models\Opd::orderBy('nama_opd')->get();
                    @endphp
                    
                    <div class="md:w-32 w-full shrink-0">
                        <select name="year" class="select2 w-full px-3 py-2 border border-slate-200 rounded-lg text-sm text-slate-600 focus:outline-none focus:border-info focus:ring-1 focus:ring-info">
                            <option value="">Semua Tahun</option>
                            @foreach($tahunList as $tahun)
                                <option value="{{ $tahun }}" {{ request('year') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:w-40 w-full shrink-0">
                        <select name="category" class="select2 w-full px-3 py-2 border border-slate-200 rounded-lg text-sm text-slate-600 focus:outline-none focus:border-info focus:ring-1 focus:ring-info">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoriList as $kategori)
                                <option value="{{ $kategori->id }}" {{ request('category') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:w-48 w-full shrink-0">
                        <select name="opd" class="select2 w-full px-3 py-2 border border-slate-200 rounded-lg text-sm text-slate-600 focus:outline-none focus:border-info focus:ring-1 focus:ring-info">
                            <option value="">Semua OPD</option>
                            @foreach($opdList as $opd)
                                <option value="{{ $opd->id }}" {{ request('opd') == $opd->id ? 'selected' : '' }}>
                                    {{ $opd->nama_opd }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="bg-info hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition-soft flex items-center justify-center">
                        <i class="fa-solid fa-filter mr-2"></i> FILTER
                    </button>
                    
                    @if(request()->anyFilled(['search', 'year', 'category', 'opd']))
                        <a href="{{ route('ppid.setiap-saat') ?? '#' }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-semibold transition-soft flex items-center justify-center">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </form>
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
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Judul Informasi</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">OPD</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Tahun</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-slate-600 uppercase">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($data as $index => $item)
                                <tr class="table-row-hover transition-soft">
                                    <td class="px-4 py-3 text-sm text-slate-600">{{ $data->firstItem() + $index }}</td>
                                    <td class="px-4 py-3">
                                        <span class="font-medium text-dark">{{ $item->title }}</span>
                                        <p class="text-xs text-slate-500">{{ Str::limit(strip_tags($item->description), 50) }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded-full text-xs">
                                            {{ $item->category->name ?? 'Umum' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->opd->singkatan ?? $item->opd->nama_opd ?? 'PPID' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $item->year ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2 justify-center">
                                            @if($item->file_url)
                                                <a href="{{ $item->file_url }}" target="_blank" class="w-8 h-8 bg-info/10 text-info rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft" title="Buka Eksternal">
                                                    <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                                </a>
                                            @elseif($item->file_path)
                                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="w-8 h-8 bg-info/10 text-info rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft" title="Download">
                                                    <i class="fa-solid fa-download text-xs"></i>
                                                </a>
                                            @endif
                                            
                                            <a href="{{ route('setiap-saat.detail', $item->id) }}" class="w-8 h-8 bg-slate-100 text-slate-600 rounded flex items-center justify-center hover:bg-info hover:text-white transition-soft" title="Lihat Detail">
                                                <i class="fa-solid fa-eye text-xs"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-slate-500">
                                        <i class="fa-regular fa-folder-open text-4xl mb-3 text-slate-300"></i>
                                        <p>Belum ada data informasi setiap saat.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($data->hasPages())
                <div class="bg-slate-50 px-4 py-3 border-t border-slate-200">
                    {{ $data->links() }}
                </div>
                @endif
            </div>
        </section>

        <!-- Ringkasan Informasi -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                    <div class="text-info text-2xl font-bold">{{ number_format($totalDokumen ?? 0, 0, ',', '.') }}</div>
                    <div class="text-sm text-slate-500">Total Dokumen</div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                    <div class="text-info text-2xl font-bold">{{ number_format($totalKategori ?? 0, 0, ',', '.') }}</div>
                    <div class="text-sm text-slate-500">Kategori</div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                    <div class="text-info text-2xl font-bold">{{ $totalUkuran ?? '0 B' }}</div>
                    <div class="text-sm text-slate-500">Total Ukuran</div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                    <div class="text-info text-2xl font-bold">{{ number_format($totalDiunduh ?? 0, 0, ',', '.') }}</div>
                    <div class="text-sm text-slate-500">Total Diunduh</div>
                </div>
            </div>
        </section>
    </main>
@endsection
