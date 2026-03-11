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
        .announcement-hero {
            background: linear-gradient(135deg, #b45309 0%, #92400e 100%); position: relative; overflow: hidden;
        }
        .announcement-hero::after {
            content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMzAgMTBhMjAgMjAgMCAwIDEgMjAgMjAgMjAgMjAgMCAwIDEtMjAgMjAgMjAgMjAgMCAwIDEtMjAtMjAgMjAgMjAgMCAwIDEgMjAtMjB6IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMDIiIGZpbGwtcnVsZT0iZXZlbm9kZCIvPjwvc3ZnPg==');
            opacity: 0.1; animation: slide 20s linear infinite;
        }
        @keyframes slide { from { background-position: 0 0; } to { background-position: 60px 60px; } }
        .table-row-hover:hover { background-color: #fffbeb; }
        .status-badge { @apply px-2 py-1 rounded-full text-xs font-medium inline-flex items-center gap-1; }
    </style>
@endpush

@section('content')
    <main>
        <section class="announcement-hero py-16 md:py-24 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative max-w-7xl mx-auto px-4 md:px-8 lg:px-12 text-center text-white z-10">
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                    <i class="fa-solid fa-bullhorn text-sm"></i>
                    <span class="text-sm font-medium">PENGUMUMAN RESMI PPID</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 animate-slide-up">
                    INFORMASI & PENGUMUMAN
                </h1>
                <p class="text-lg md:text-xl text-amber-100 max-w-3xl mx-auto">
                    Tetap terinformasi dengan pengumuman terbaru seputar layanan, kegiatan, dan kebijakan PPID Kabupaten Konawe.
                </p>
            </div>
            <div class="absolute bottom-0 left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" fill="#F8FAFC">
                    <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,100L1360,100C1280,100,1120,100,960,100C800,100,640,100,480,100C320,100,160,100,80,100L0,100Z"></path>
                </svg>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-6">
            <div class="flex items-center text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-primary transition-soft"><i class="fa-solid fa-home mr-1"></i> Beranda</a>
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-amber-600 font-medium">Pengumuman</span>
            </div>
        </div>

        @if($featured)
            <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
                <div class="bg-gradient-to-r from-red-500 to-red-600 text-white p-6 rounded-2xl shadow-2xl relative overflow-hidden group">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-soft"></div>
                    <div class="relative flex flex-col md:flex-row items-center gap-6 z-10">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm shrink-0">
                            <i class="fa-solid fa-circle-exclamation text-3xl animate-pulse"></i>
                        </div>
                        <div class="flex-grow text-center md:text-left">
                            <span class="text-xs font-semibold bg-white/30 px-3 py-1 rounded-full inline-block mb-2">TERBARU / PENTING</span>
                            <h2 class="text-xl md:text-2xl font-bold mb-1">{{ $featured->title }}</h2>
                            <p class="text-white/90 text-sm line-clamp-2">
                                {{ Str::limit(html_entity_decode(strip_tags($featured->description)), 120) }}
                            </p>
                        </div>
                        <a href="{{ route('announcement.detail', $featured->slug) }}" class="bg-white text-red-600 px-6 py-3 rounded-xl font-bold hover:bg-amber-50 transition-soft shadow-lg whitespace-nowrap shrink-0">
                            Selengkapnya <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <div class="bg-white p-4 rounded-xl shadow-md border border-slate-100">
                <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau isi pengumuman..." class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50" />
                    </div>
                    <div class="flex flex-wrap md:flex-nowrap gap-2">
                        <select name="category" class="px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 bg-white">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <select name="year" class="px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 bg-white">
                            <option value="">Semua Tahun</option>
                            @foreach($years as $yr)
                                <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-xl font-semibold transition-soft shadow-md flex-grow md:flex-grow-0">
                            <i class="fa-solid fa-search md:mr-2"></i><span class="hidden md:inline">Cari</span>
                        </button>

                        @if(request()->anyFilled(['search', 'category', 'year']))
                            <a href="{{ url()->current() }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-3 rounded-xl font-semibold transition-soft flex items-center justify-center">
                                <i class="fa-solid fa-rotate-left"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 text-center">
                    <div class="text-2xl font-black text-amber-600">{{ $stats['total'] }}</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider">Total Pengumuman</div>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 text-center">
                    <div class="text-2xl font-black text-amber-600">{{ $stats['tahun_ini'] }}</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider">Tahun {{ now()->year }}</div>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 text-center">
                    <div class="text-2xl font-black text-amber-600">{{ $stats['aktif'] }}</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider">Aktif</div>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 text-center">
                    <div class="text-2xl font-black text-amber-600">{{ $stats['akan_datang'] }}</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider">Akan Datang</div>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black text-dark flex items-center gap-2">
                    <i class="fa-solid fa-list text-amber-600"></i> DAFTAR PENGUMUMAN
                </h2>
                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-sm font-medium">
                    Total: {{ $pengumumans->total() }} Data
                </span>
            </div>

            <div class="hidden md:block bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-amber-600 to-amber-700 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold w-16">No</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Judul Pengumuman</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold w-40">Kategori</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold w-36">Tanggal</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold w-24">Dilihat</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold w-28">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                        @forelse($pengumumans as $index => $item)
                            @php
                                $catName = strtolower($item->category->name ?? '');
                                $badgeColor = 'bg-slate-100 text-slate-600'; $icon = 'fa-tag';
                                if(Str::contains($catName, 'layan')) { $badgeColor = 'bg-amber-100 text-amber-700'; $icon = 'fa-clock'; }
                                elseif(Str::contains($catName, 'pegawai')) { $badgeColor = 'bg-blue-100 text-blue-600'; $icon = 'fa-users'; }
                                elseif(Str::contains($catName, 'ada')) { $badgeColor = 'bg-green-100 text-green-600'; $icon = 'fa-truck'; }
                                elseif(Str::contains($catName, 'giat')) { $badgeColor = 'bg-orange-100 text-orange-600'; $icon = 'fa-chalkboard-user'; }
                                elseif(Str::contains($catName, 'libur')) { $badgeColor = 'bg-purple-100 text-purple-600'; $icon = 'fa-calendar-alt'; }
                            @endphp
                            <tr class="hover:bg-amber-50/50 transition-soft">
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $pengumumans->firstItem() + $index }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-dark line-clamp-1">{{ $item->title }}</div>
                                    <div class="text-xs text-slate-500 line-clamp-1 mt-1">{{ html_entity_decode(strip_tags($item->description)) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="status-badge {{ $badgeColor }} rounded-full px-2 py-1"><i class="fa-solid {{ $icon }} text-xs"></i> {{ $item->category->name ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $item->published_at ? $item->published_at->translatedFormat('d M Y') : '-' }}</td>
                                <td class="px-6 py-4 text-sm"><i class="fa-solid fa-eye text-slate-400 mr-1"></i> {{ $item->views }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('announcement.detail', $item->slug) }}" class="text-amber-600 hover:text-amber-800 font-medium text-sm inline-flex items-center gap-1">
                                        Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-12 text-center text-slate-500">Belum ada data pengumuman yang sesuai kriteria pencarian.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="bg-slate-50 px-6 py-4 border-t border-slate-200">
                    {{ $pengumumans->appends(request()->query())->links() }}
                </div>
            </div>

            <div class="md:hidden space-y-4">
                @forelse($pengumumans as $item)
                    @php
                        $catName = strtolower($item->category->name ?? '');
                        $badgeColor = 'bg-slate-100 text-slate-600'; $icon = 'fa-tag';
                        if(Str::contains($catName, 'layan')) { $badgeColor = 'bg-amber-100 text-amber-700'; $icon = 'fa-clock'; }
                        elseif(Str::contains($catName, 'pegawai')) { $badgeColor = 'bg-blue-100 text-blue-600'; $icon = 'fa-users'; }
                        elseif(Str::contains($catName, 'ada')) { $badgeColor = 'bg-green-100 text-green-600'; $icon = 'fa-truck'; }
                        elseif(Str::contains($catName, 'giat')) { $badgeColor = 'bg-orange-100 text-orange-600'; $icon = 'fa-chalkboard-user'; }
                        elseif(Str::contains($catName, 'libur')) { $badgeColor = 'bg-purple-100 text-purple-600'; $icon = 'fa-calendar-alt'; }
                    @endphp
                    <div class="bg-white p-5 rounded-xl shadow-md border border-slate-100 card-hover">
                        <div class="flex justify-between items-start mb-2">
                            <span class="status-badge {{ $badgeColor }}"><i class="fa-solid {{ $icon }} text-xs"></i> {{ $item->category->name ?? '-' }}</span>
                            <span class="text-xs text-slate-400"><i class="fa-solid fa-eye"></i> {{ $item->views }}</span>
                        </div>
                        <h3 class="font-bold text-dark mb-1 line-clamp-2">{{ $item->title }}</h3>
                        <p class="text-xs text-slate-500 mb-3 line-clamp-2">{{ html_entity_decode(strip_tags($item->description)) }}</p>
                        <div class="flex justify-between items-center text-sm border-t border-slate-50 pt-3">
                            <span class="text-slate-400"><i class="fa-regular fa-calendar mr-1"></i> {{ $item->published_at ? $item->published_at->translatedFormat('d M Y') : '-' }}</span>
                            <a href="{{ route('announcement.detail', $item->slug) }}" class="text-amber-600 font-medium inline-flex items-center gap-1">Detail <i class="fa-solid fa-arrow-right text-xs"></i></a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-8 rounded-xl shadow-md text-center text-slate-500">Belum ada pengumuman.</div>
                @endforelse

                <div class="mt-4">
                    {{ $pengumumans->appends(request()->query())->links() }}
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-16">
            <h2 class="text-2xl font-black text-dark mb-6 flex items-center gap-2">
                <i class="fa-solid fa-tags text-amber-600"></i> JELAJAHI KATEGORI
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($categories->take(5) as $cat)
                    @php
                        // Menyesuaikan ikon & warna berdasarkan nama secara acak/keyword
                        $cName = strtolower($cat->name);
                        $bg = 'bg-slate-50 hover:bg-slate-100'; $iconBg = 'bg-slate-200 text-slate-600 group-hover:bg-slate-600'; $icon = 'fa-folder';
                        if(Str::contains($cName, 'layan')) { $bg = 'hover:bg-amber-50'; $iconBg = 'bg-amber-100 text-amber-600 group-hover:bg-amber-600'; $icon = 'fa-clock'; }
                        elseif(Str::contains($cName, 'pegawai')) { $bg = 'hover:bg-blue-50'; $iconBg = 'bg-blue-100 text-blue-600 group-hover:bg-blue-600'; $icon = 'fa-users'; }
                        elseif(Str::contains($cName, 'ada')) { $bg = 'hover:bg-green-50'; $iconBg = 'bg-green-100 text-green-600 group-hover:bg-green-600'; $icon = 'fa-truck'; }
                        elseif(Str::contains($cName, 'giat')) { $bg = 'hover:bg-orange-50'; $iconBg = 'bg-orange-100 text-orange-600 group-hover:bg-orange-600'; $icon = 'fa-chalkboard-user'; }
                    @endphp
                    <a href="{{ url()->current() }}?category={{ $cat->id }}" class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 text-center transition-soft group {{ $bg }}">
                        <div class="w-12 h-12 {{ $iconBg }} rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:text-white transition-soft">
                            <i class="fa-solid {{ $icon }}"></i>
                        </div>
                        <p class="font-semibold text-dark text-sm line-clamp-1">{{ $cat->name }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    </main>
@endsection
