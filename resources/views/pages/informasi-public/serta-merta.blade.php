@extends('layouts.app')

@section('title', 'Informasi Publik Serta Merta')

@push('scripts-head')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#1F3A8A', dark: '#172554', light: '#3B82F6', subtle: '#EFF6FF', },
                        secondary: '#DC2626', accent: '#059669', light: '#F8FAFC', dark: '#0F172A',
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
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' }, },
                        slideUp: { '0%': { transform: 'translateY(10px)', opacity: '0' }, '100%': { transform: 'translateY(0)', opacity: '1' }, },
                    },
                },
            },
        };
    </script>
@endpush

@push('styles')
    <style>
        .alert-banner { background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); position: relative; overflow: hidden; }
        .alert-banner::before {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }
        .table-header { background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); }
        .table-row-hover:hover { background-color: #fef2f2; }
    </style>
@endpush

@section('content')
    <div class="alert-banner text-white py-3 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 relative z-10">
            <div class="flex items-center justify-center md:justify-between flex-wrap gap-3">
                <div class="flex items-center gap-3">
                    <span class="flex h-6 w-6 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-6 w-6 bg-white/30 backdrop-blur-sm items-center justify-center">
                            <i class="fa-solid fa-bolt text-xs"></i>
                        </span>
                    </span>
                    <p class="text-sm font-medium">
                        <span class="font-black">INFORMASI SERTA MERTA:</span> Informasi darurat yang harus segera diketahui masyarakat
                    </p>
                </div>
                <div class="flex gap-2">
                    <span class="text-xs bg-white/20 px-3 py-1 rounded-full backdrop-blur-sm">
                        <i class="fa-regular fa-bell mr-1"></i> {{ $latestAlerts->count() ?? 0 }} Informasi Baru
                    </span>
                </div>
            </div>
        </div>
    </div>

    <main class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-6">
            <div class="flex items-center text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-primary transition-soft">
                    <i class="fa-solid fa-home mr-1"></i> Beranda
                </a>
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-secondary font-medium">Informasi Serta Merta</span>
            </div>
        </div>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="animate-slide-up">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-secondary/10 rounded-2xl flex items-center justify-center">
                            <i class="fa-solid fa-bolt text-2xl text-secondary"></i>
                        </div>
                        <div>
                            <span class="text-sm font-semibold text-secondary bg-secondary/10 px-4 py-1.5 rounded-full">
                                INFORMASI DARURAT & STRATEGIS
                            </span>
                        </div>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-black text-dark mb-4">
                        INFORMASI <span class="text-secondary">SERTA MERTA</span>
                    </h1>
                    <p class="text-slate-600 max-w-2xl text-lg leading-relaxed">
                        Informasi yang dapat mengancam hajat hidup orang banyak dan ketertiban umum, serta wajib segera diumumkan kepada masyarakat tanpa penundaan.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100 min-w-[250px]">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-secondary/10 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-chart-line text-2xl text-secondary"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-secondary">{{ $stats['total'] ?? 0 }}</p>
                            <p class="text-slate-600 text-sm">Total Informasi</p>
                            <p class="text-xs text-slate-500 mt-1">Serta Merta</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-600">Tahun ini:</span>
                            <span class="font-semibold text-secondary">{{ $stats['tahun_ini'] ?? 0 }} informasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if(isset($latestAlerts) && $latestAlerts->count() > 0)
            <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($latestAlerts as $alert)
                        @php
                            // Menentukan warna background & ikon berdasarkan nama kategori (sebagai fallback)
                            $catName = strtolower($alert->category->name ?? '');
                            $bgClass = 'from-slate-50 to-slate-100 border-slate-400';
                            $iconClass = 'fa-circle-exclamation text-slate-500';
                            $textClass = 'text-slate-700';

                            if(Str::contains($catName, ['bencana', 'cuaca', 'longsor'])) {
                                $bgClass = 'from-red-50 to-orange-50 border-secondary'; $iconClass = 'fa-cloud-rain text-secondary/30'; $textClass = 'text-secondary';
                            } elseif(Str::contains($catName, ['kesehatan', 'virus', 'penyakit'])) {
                                $bgClass = 'from-yellow-50 to-amber-50 border-amber-500'; $iconClass = 'fa-biohazard text-amber-500/30'; $textClass = 'text-amber-700';
                            } elseif(Str::contains($catName, ['jalan', 'transportasi'])) {
                                $bgClass = 'from-blue-50 to-indigo-50 border-blue-500'; $iconClass = 'fa-road-bridge text-blue-500/30'; $textClass = 'text-blue-700';
                            } else {
                                $bgClass = 'from-red-50 to-orange-50 border-secondary'; $iconClass = 'fa-bullhorn text-secondary/30'; $textClass = 'text-secondary';
                            }
                        @endphp

                        <div class="bg-gradient-to-br {{ $bgClass }} p-5 rounded-xl border-l-4">
                            <div class="flex items-start justify-between">
                                <div>
                                <span class="inline-flex items-center gap-1 bg-white/50 {{ $textClass }} px-3 py-1 rounded-full text-[10px] uppercase font-bold tracking-wider mb-3 shadow-sm border border-white/60">
                                    <i class="fa-solid fa-tag text-xs"></i> {{ $alert->category->name ?? 'Darurat' }}
                                </span>
                                    <h3 class="font-bold text-dark mb-1 line-clamp-2">{{ $alert->title }}</h3>
                                    <p class="text-xs text-slate-600 mb-2">
                                        {{ $alert->opd->singkatan ?? 'PPID' }} - {{ $alert->published_at ? \Carbon\Carbon::parse($alert->published_at)->translatedFormat('d M Y') : '' }}
                                    </p>
                                </div>
                                <i class="fa-solid {{ $iconClass }} text-3xl shrink-0"></i>
                            </div>
                            <a href="{{ route('serta-merta.detail', $alert->id) }}" class="{{ $textClass }} text-sm font-semibold inline-flex items-center hover:underline">
                                Lihat Detail <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <form action="{{ url()->current() }}" method="GET" class="bg-white p-5 rounded-2xl shadow-lg border border-slate-100">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari informasi serta merta..." class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition-soft" />
                    </div>

                    <select name="category" class="md:w-48 px-4 py-3 border border-slate-200 rounded-xl text-slate-600 focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary">
                        <option value="">Semua Kategori</option>
                        @if(isset($categories))
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        @endif
                    </select>

                    <button type="submit" class="md:w-40 bg-secondary hover:bg-red-700 text-white px-6 py-3 rounded-xl font-semibold transition-soft flex items-center justify-center gap-2">
                        <i class="fa-solid fa-filter"></i> FILTER
                    </button>

                    @if(request()->anyFilled(['search', 'category']))
                        <a href="{{ url()->current() }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-3 rounded-xl font-semibold transition-soft flex items-center justify-center">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </div>
            </form>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-16">
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                <div class="bg-gradient-to-r from-secondary to-red-700 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-white font-bold text-lg flex items-center gap-2">
                            <i class="fa-solid fa-bolt"></i> DAFTAR INFORMASI SERTA MERTA
                        </h2>
                        <div class="hidden md:flex items-center gap-3">
                            <span class="bg-white/20 text-white px-3 py-1 rounded-full text-xs">
                                Total: {{ isset($informations) ? $informations->total() : 0 }} Data
                            </span>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-red-50 border-b border-red-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-secondary uppercase tracking-wider w-16">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-secondary uppercase tracking-wider">Informasi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-secondary uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-secondary uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-secondary uppercase tracking-wider">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                        @if(isset($informations) && $informations->count() > 0)
                            @foreach($informations as $index => $info)
                                <tr class="table-row-hover transition-soft {{ $index === 0 && request()->page == 1 ? 'bg-red-50/30' : '' }}">
                                    <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                        @if($index === 0 || request()->page == 1)
                                            <span class="flex items-center">
                                                    <span class="relative flex h-3 w-3 mr-2">
                                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-secondary"></span>
                                                    </span>
                                                    {{ $informations->firstItem() + $index }}
                                                </span>
                                        @else
                                            {{ $informations->firstItem() + $index }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-bold text-dark line-clamp-1 mb-1">{{ $info->title }}</p>
                                            <p class="text-xs text-slate-500 line-clamp-1">{{ $info->opd->nama_opd ?? 'Pemerintah Kab. Konawe' }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                            <span class="px-3 py-1 bg-red-100 text-secondary border border-red-200 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                                {{ $info->category->name ?? 'Darurat' }}
                                            </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                        <i class="fa-regular fa-calendar text-slate-400 mr-1"></i>
                                        {{ $info->published_at ? \Carbon\Carbon::parse($info->published_at)->translatedFormat('d M Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('serta-merta.detail', $info->id) }}" class="w-8 h-8 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center hover:bg-secondary hover:text-white transition-soft" title="Lihat Detail">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            @php
                                                $fileUrl = '#';
                                                if (!empty($info->file_url)) $fileUrl = $info->file_url;
                                                elseif (!empty($info->file_path)) $fileUrl = asset('storage/' . $info->file_path);
                                            @endphp

                                            @if($fileUrl !== '#')
                                                <a href="{{ $fileUrl }}" target="_blank" class="w-8 h-8 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center hover:bg-green-600 hover:text-white transition-soft" title="Download Lampiran">
                                                    <i class="fa-solid fa-download"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500 bg-slate-50/50">
                                    <i class="fa-solid fa-folder-open text-4xl text-slate-300 mb-3 block"></i>
                                    Belum ada data Informasi Serta Merta yang tersedia saat ini.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                @if(isset($informations) && $informations->hasPages())
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex justify-center md:justify-between items-center">
                        <div class="hidden md:block text-sm text-slate-500">
                            Menampilkan {{ $informations->firstItem() }} sampai {{ $informations->lastItem() }} dari {{ $informations->total() }} data
                        </div>
                        <div>
                            {{ $informations->appends(request()->query())->links('layouts.pagination.tailwind') ?? $informations->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 h-full">
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-secondary/10 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-scale-balanced text-secondary"></i>
                        </div>
                        <h3 class="font-bold text-lg text-dark">Dasar Hukum</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-sm">
                            <span class="w-1.5 h-1.5 bg-secondary rounded-full mt-2 shrink-0"></span>
                            <span class="text-slate-600">UU No. 14/2008 tentang Keterbukaan Informasi Publik (Pasal 10)</span>
                        </li>
                        <li class="flex items-start gap-3 text-sm">
                            <span class="w-1.5 h-1.5 bg-secondary rounded-full mt-2 shrink-0"></span>
                            <span class="text-slate-600">Perki No. 1/2021 tentang Standar Layanan Informasi Publik</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-gradient-to-r from-secondary to-red-700 p-6 rounded-2xl shadow-lg text-white flex flex-col justify-center">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fa-solid fa-headset text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xl">Pusat Layanan Darurat</h4>
                            <p class="text-white/80 text-sm">Laporkan jika ada informasi serta merta yang belum terpublikasi.</p>
                        </div>
                    </div>
                    <div class="mt-2 bg-white/10 rounded-lg p-3 text-center border border-white/20">
                        <span class="text-sm font-medium opacity-80 block mb-1">Call Center BPBD / PPID Konawe:</span>
                        <span class="text-2xl font-black tracking-widest">(0408) 112 / 119</span>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
