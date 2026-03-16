@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', 'Pengumuman')

@push('scripts-head')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#1F3A8A', dark: '#172554', light: '#3B82F6', subtle: '#EFF6FF', },
                        secondary: '#DC2626', accent: '#059669', info: '#0284C7', exclusive: '#6B21A8',
                        announcement: '#B45309', light: '#F8FAFC', dark: '#0F172A',
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
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-6px); box-shadow: 0 20px 30px -10px rgba(180, 83, 9, 0.2); }
        .table-row-hover:hover { background-color: #fffbeb; }
        .status-badge { @apply px-2 py-1 rounded-full text-xs font-medium inline-flex items-center gap-1; }
    </style>
@endpush

@section('content')
    <main class="bg-slate-50 min-h-screen pb-12">

        <section class="bg-gradient-to-r from-amber-500/10 to-orange-50 py-12 md:py-16 border-b border-amber-100">
            <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="max-w-3xl">
                        <nav class="text-sm flex items-center gap-2 text-slate-500 mb-4 flex-wrap">
                            <a href="{{ route('home') }}" class="hover:text-amber-600 transition-soft"><i class="fa-solid fa-home"></i> Beranda</a> /
                            <span class="text-amber-600 font-semibold">Pengumuman</span>
                        </nav>

                        <h1 class="text-3xl md:text-4xl font-black text-dark uppercase tracking-tight animate-slide-up">
                            Informasi & <span class="text-amber-600">Pengumuman</span>
                        </h1>
                        <p class="text-slate-600 mt-2 animate-fade-in leading-relaxed">
                            Tetap terinformasi dengan pengumuman terbaru seputar layanan, kegiatan, dan kebijakan resmi PPID Kabupaten Konawe.
                        </p>
                    </div>

                    <div class="hidden md:flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-sm text-amber-500 text-3xl border border-amber-100 transform -rotate-3 hover:rotate-0 transition-transform duration-300 shrink-0">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-8 relative z-20">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8 animate-fade-in">
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)] py-6 px-4 flex flex-col items-center justify-center hover:border-amber-500 transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-3xl md:text-4xl font-black text-amber-600 mb-2">{{ $stats['total'] }}</p>
                    <p class="text-slate-500 text-[11px] md:text-xs uppercase tracking-widest font-semibold text-center">Total Pengumuman</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)] py-6 px-4 flex flex-col items-center justify-center hover:border-amber-500 transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-3xl md:text-4xl font-black text-amber-600 mb-2">{{ $stats['tahun_ini'] }}</p>
                    <p class="text-slate-500 text-[11px] md:text-xs uppercase tracking-widest font-semibold text-center">Tahun {{ now()->year }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)] py-6 px-4 flex flex-col items-center justify-center hover:border-amber-500 transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-3xl md:text-4xl font-black text-amber-600 mb-2">{{ $stats['aktif'] }}</p>
                    <p class="text-slate-500 text-[11px] md:text-xs uppercase tracking-widest font-semibold text-center">Status Aktif</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)] py-6 px-4 flex flex-col items-center justify-center hover:border-amber-500 transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-3xl md:text-4xl font-black text-amber-600 mb-2">{{ $stats['akan_datang'] }}</p>
                    <p class="text-slate-500 text-[11px] md:text-xs uppercase tracking-widest font-semibold text-center">Akan Datang</p>
                </div>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-slate-200">
                <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau isi pengumuman..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 transition-all" />
                    </div>

                    <div class="flex flex-wrap md:flex-nowrap gap-3 shrink-0">
                        <select name="category" class="px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 bg-slate-50 cursor-pointer">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>

                        <select name="year" class="px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 bg-slate-50 cursor-pointer">
                            <option value="">Semua Tahun</option>
                            @foreach($years as $yr)
                                <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-xl font-semibold transition-soft shadow-md flex items-center justify-center gap-2">
                            <i class="fa-solid fa-search"></i> <span class="hidden md:inline">Cari</span>
                        </button>

                        @if(request()->anyFilled(['search', 'category', 'year']))
                            <a href="{{ url()->current() }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-3 rounded-xl font-semibold transition-soft flex items-center justify-center" title="Reset Pencarian">
                                <i class="fa-solid fa-rotate-left"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </section>

        @if($featured)
            <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
                <div class="bg-gradient-to-r from-red-500 to-red-600 text-white p-6 md:p-8 rounded-2xl shadow-xl relative overflow-hidden group">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-soft"></div>

                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

                    <div class="relative flex flex-col md:flex-row items-center gap-6 z-10">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm shrink-0 border border-white/30">
                            <i class="fa-solid fa-circle-exclamation text-3xl animate-pulse"></i>
                        </div>
                        <div class="flex-grow text-center md:text-left">
                            <span class="text-[10px] font-bold bg-white/30 px-3 py-1.5 rounded-full inline-block mb-3 uppercase tracking-wider shadow-sm">
                                <i class="fa-solid fa-bolt mr-1"></i> Penting / Sorotan
                            </span>
                            <h2 class="text-xl md:text-2xl font-bold mb-2">{{ $featured->title }}</h2>
                            <p class="text-white/90 text-sm line-clamp-2 md:line-clamp-3 leading-relaxed">
                                {{ Str::limit(html_entity_decode(strip_tags($featured->description)), 200) }}
                            </p>
                        </div>
                        <a href="{{ route('announcement.detail', $featured->slug) }}" class="bg-white text-red-600 px-6 py-3 rounded-xl font-bold hover:bg-amber-50 transition-soft shadow-lg whitespace-nowrap shrink-0 flex items-center justify-center gap-2 mt-2 md:mt-0">
                            Cek Detailnya <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black text-dark flex items-center gap-2">
                    <i class="fa-solid fa-list text-amber-600"></i> DAFTAR PENGUMUMAN
                </h2>
                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-sm font-medium border border-amber-200">
                    Total: {{ $pengumumans->total() }} Data
                </span>
            </div>

            <div class="hidden md:block bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-100 text-slate-600 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold w-16">No</th>
                            <th class="px-6 py-4 text-left text-sm font-bold">Judul Pengumuman</th>
                            <th class="px-6 py-4 text-left text-sm font-bold w-40">Kategori</th>
                            <th class="px-6 py-4 text-left text-sm font-bold w-36">Tanggal</th>
                            <th class="px-6 py-4 text-left text-sm font-bold w-24">Dilihat</th>
                            <th class="px-6 py-4 text-left text-sm font-bold w-28 text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                        @forelse($pengumumans as $index => $item)
                            @php
                                $catName = strtolower($item->category->name ?? '');
                                $badgeColor = 'bg-slate-100 text-slate-600 border border-slate-200'; $icon = 'fa-tag';
                                if(Str::contains($catName, 'layan')) { $badgeColor = 'bg-amber-50 text-amber-600 border border-amber-200'; $icon = 'fa-clock'; }
                                elseif(Str::contains($catName, 'pegawai')) { $badgeColor = 'bg-blue-50 text-blue-600 border border-blue-200'; $icon = 'fa-users'; }
                                elseif(Str::contains($catName, 'ada')) { $badgeColor = 'bg-green-50 text-green-600 border border-green-200'; $icon = 'fa-truck'; }
                                elseif(Str::contains($catName, 'giat')) { $badgeColor = 'bg-orange-50 text-orange-600 border border-orange-200'; $icon = 'fa-chalkboard-user'; }
                                elseif(Str::contains($catName, 'libur')) { $badgeColor = 'bg-purple-50 text-purple-600 border border-purple-200'; $icon = 'fa-calendar-alt'; }
                            @endphp
                            <tr class="table-row-hover transition-soft">
                                <td class="px-6 py-4 text-sm text-slate-500 font-medium">{{ $pengumumans->firstItem() + $index }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-dark line-clamp-1 mb-1">{{ $item->title }}</div>
                                    <div class="text-xs text-slate-500 line-clamp-1">{{ html_entity_decode(strip_tags($item->description)) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="status-badge {{ $badgeColor }} rounded-md px-2.5 py-1 text-[10px] font-bold tracking-wide uppercase"><i class="fa-solid {{ $icon }} text-xs mr-1"></i> {{ $item->category->name ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                    <i class="fa-regular fa-calendar text-slate-400 mr-1"></i>
                                    {{ $item->published_at ? $item->published_at->translatedFormat('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                    <i class="fa-regular fa-eye text-amber-500 mr-1"></i> {{ $item->views }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('announcement.detail', $item->slug) }}" class="bg-amber-50 hover:bg-amber-600 text-amber-600 hover:text-white px-4 py-2 rounded-lg font-semibold text-xs inline-flex items-center gap-2 transition-all border border-amber-200 hover:border-amber-600 shadow-sm">
                                        Detail <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-12 text-center text-slate-500 bg-slate-50/50">
                                    <i class="fa-regular fa-folder-open text-4xl text-slate-300 mb-3 block"></i>
                                    Belum ada data pengumuman yang sesuai kriteria pencarian.
                                </td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="bg-white px-6 py-4 border-t border-slate-200 flex justify-center">
                    {{ $pengumumans->appends(request()->query())->links('layouts.pagination.tailwind') ?? $pengumumans->links() }}
                </div>
            </div>

            <div class="md:hidden space-y-4">
                @forelse($pengumumans as $item)
                    @php
                        $catName = strtolower($item->category->name ?? '');
                        $badgeColor = 'bg-slate-100 text-slate-600 border border-slate-200'; $icon = 'fa-tag';
                        if(Str::contains($catName, 'layan')) { $badgeColor = 'bg-amber-50 text-amber-600 border border-amber-200'; $icon = 'fa-clock'; }
                        elseif(Str::contains($catName, 'pegawai')) { $badgeColor = 'bg-blue-50 text-blue-600 border border-blue-200'; $icon = 'fa-users'; }
                        elseif(Str::contains($catName, 'ada')) { $badgeColor = 'bg-green-50 text-green-600 border border-green-200'; $icon = 'fa-truck'; }
                        elseif(Str::contains($catName, 'giat')) { $badgeColor = 'bg-orange-50 text-orange-600 border border-orange-200'; $icon = 'fa-chalkboard-user'; }
                        elseif(Str::contains($catName, 'libur')) { $badgeColor = 'bg-purple-50 text-purple-600 border border-purple-200'; $icon = 'fa-calendar-alt'; }
                    @endphp
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 card-hover relative overflow-hidden">
                        <div class="flex justify-between items-start mb-3">
                            <span class="status-badge {{ $badgeColor }} text-[10px] uppercase font-bold tracking-wide rounded-md px-2 py-1"><i class="fa-solid {{ $icon }} text-xs"></i> {{ $item->category->name ?? '-' }}</span>
                            <span class="text-xs font-medium text-slate-500 bg-slate-100 px-2 py-1 rounded-md"><i class="fa-regular fa-eye text-amber-500 mr-1"></i> {{ $item->views }}</span>
                        </div>
                        <h3 class="font-bold text-dark text-lg mb-2 line-clamp-2 leading-tight">{{ $item->title }}</h3>
                        <p class="text-sm text-slate-500 mb-4 line-clamp-2">{{ html_entity_decode(strip_tags($item->description)) }}</p>

                        <div class="flex justify-between items-center text-sm border-t border-slate-100 pt-4 mt-2">
                            <span class="text-slate-500 font-medium"><i class="fa-regular fa-calendar mr-1 text-slate-400"></i> {{ $item->published_at ? $item->published_at->translatedFormat('d M Y') : '-' }}</span>
                            <a href="{{ route('announcement.detail', $item->slug) }}" class="bg-amber-50 hover:bg-amber-600 text-amber-600 hover:text-white px-3 py-1.5 rounded-lg font-semibold text-xs inline-flex items-center gap-1 transition-all border border-amber-200 hover:border-amber-600">
                                Detail <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-10 rounded-xl shadow-sm border border-slate-200 text-center text-slate-500">
                        <i class="fa-regular fa-folder-open text-4xl text-slate-300 mb-3 block"></i>
                        Belum ada pengumuman.
                    </div>
                @endforelse

                <div class="mt-6 flex justify-center">
                    {{ $pengumumans->appends(request()->query())->links('layouts.pagination.tailwind') ?? $pengumumans->links() }}
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <h2 class="text-xl font-black text-dark mb-6 flex items-center gap-2 border-b border-slate-200 pb-3">
                <i class="fa-solid fa-tags text-amber-600"></i> JELAJAHI KATEGORI
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($categories->take(5) as $cat)
                    @php
                        $cName = strtolower($cat->name);
                        $bg = 'hover:border-slate-300'; $iconBg = 'bg-slate-100 text-slate-500 group-hover:bg-slate-500'; $icon = 'fa-folder';
                        if(Str::contains($cName, 'layan')) { $bg = 'hover:border-amber-300'; $iconBg = 'bg-amber-100 text-amber-600 group-hover:bg-amber-500 group-hover:text-white'; $icon = 'fa-clock'; }
                        elseif(Str::contains($cName, 'pegawai')) { $bg = 'hover:border-blue-300'; $iconBg = 'bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white'; $icon = 'fa-users'; }
                        elseif(Str::contains($cName, 'ada')) { $bg = 'hover:border-green-300'; $iconBg = 'bg-green-100 text-green-600 group-hover:bg-green-500 group-hover:text-white'; $icon = 'fa-truck'; }
                        elseif(Str::contains($cName, 'giat')) { $bg = 'hover:border-orange-300'; $iconBg = 'bg-orange-100 text-orange-600 group-hover:bg-orange-500 group-hover:text-white'; $icon = 'fa-chalkboard-user'; }
                    @endphp
                    <a href="{{ url()->current() }}?category={{ $cat->id }}" class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 text-center transition-all duration-300 group {{ $bg }} hover:-translate-y-1 hover:shadow-md">
                        <div class="w-14 h-14 {{ $iconBg }} rounded-xl flex items-center justify-center mx-auto mb-3 transition-all duration-300">
                            <i class="fa-solid {{ $icon }} text-xl"></i>
                        </div>
                        <p class="font-bold text-slate-700 text-sm line-clamp-1 group-hover:text-dark">{{ $cat->name }}</p>
                    </a>
                @endforeach
            </div>
        </section>

    </main>
@endsection
