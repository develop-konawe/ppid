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

        {{-- Page Header --}}
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

        {{-- Search Bar --}}
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-8 relative z-20">
            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-slate-200">
                <form action="{{ route('announcement') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau isi pengumuman..."
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 transition-all" />
                    </div>

                    <div class="flex gap-3 shrink-0">
                        <button type="submit"
                            class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-xl font-semibold transition-soft shadow-md flex items-center justify-center gap-2">
                            <i class="fa-solid fa-search"></i> <span class="hidden md:inline">Cari</span>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('announcement') }}"
                                class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-3 rounded-xl font-semibold transition-soft flex items-center justify-center" title="Reset Pencarian">
                                <i class="fa-solid fa-rotate-left"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </section>

        {{-- Announcement List --}}
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black text-dark flex items-center gap-2">
                    <i class="fa-solid fa-list text-amber-600"></i> DAFTAR PENGUMUMAN
                </h2>
                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-sm font-medium border border-amber-200">
                    Total: {{ $meta['total'] ?? 0 }} Data
                </span>
            </div>

            {{-- Desktop Table --}}
            <div class="hidden md:block bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-100 text-slate-600 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold w-16">No</th>
                            <th class="px-6 py-4 text-left text-sm font-bold">Judul Pengumuman</th>
                            <th class="px-6 py-4 text-left text-sm font-bold w-48">OPD</th>
                            <th class="px-6 py-4 text-left text-sm font-bold w-36">Tanggal</th>
                            <th class="px-6 py-4 text-left text-sm font-bold w-24">Dilihat</th>
                            <th class="px-6 py-4 text-left text-sm font-bold w-28 text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                        @forelse($pengumumans as $index => $item)
                            @php
                                $publishedAt = !empty($item['published_at']) ? \Carbon\Carbon::parse($item['published_at']) : null;
                            @endphp
                            <tr class="table-row-hover transition-soft">
                                <td class="px-6 py-4 text-sm text-slate-500 font-medium">
                                    {{ (($meta['current_page'] - 1) * $meta['per_page']) + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-dark line-clamp-1 mb-1">{{ $item['title'] }}</div>
                                    <div class="text-xs text-slate-500 line-clamp-1">{{ $item['summary'] ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-amber-50 text-amber-700 border border-amber-200 rounded-md px-2.5 py-1 text-[10px] font-bold tracking-wide uppercase inline-flex items-center gap-1">
                                        <i class="fa-solid fa-building text-xs"></i>
                                        {{ Str::limit($item['opd']['name'] ?? '-', 30) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                    <i class="fa-regular fa-calendar text-slate-400 mr-1"></i>
                                    {{ $publishedAt ? $publishedAt->translatedFormat('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                    <i class="fa-regular fa-eye text-amber-500 mr-1"></i> {{ number_format($item['views'] ?? 0) }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ $item['url'] }}" target="_blank" rel="noopener noreferrer"
                                        class="bg-amber-50 hover:bg-amber-600 text-amber-600 hover:text-white px-4 py-2 rounded-lg font-semibold text-xs inline-flex items-center gap-2 transition-all border border-amber-200 hover:border-amber-600 shadow-sm">
                                        Detail <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500 bg-slate-50/50">
                                    <i class="fa-regular fa-folder-open text-4xl text-slate-300 mb-3 block"></i>
                                    Belum ada data pengumuman yang sesuai kriteria pencarian.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Desktop Pagination --}}
                @php
                    $currentPage = $meta['current_page'] ?? 1;
                    $lastPage    = $meta['last_page'] ?? 1;
                    $queryParams = request()->except('page');
                @endphp
                @if($lastPage > 1)
                    <div class="bg-white px-6 py-4 border-t border-slate-200 flex justify-center gap-2">
                        @if($currentPage <= 1)
                            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed border border-slate-200 text-sm">
                                <i class="fa-solid fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ route('announcement', array_merge($queryParams, ['page' => $currentPage - 1])) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-amber-600 hover:bg-amber-600 hover:text-white transition-all shadow-sm text-sm">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                        @endif

                        @php $start = max($currentPage - 2, 1); $end = min($currentPage + 2, $lastPage); @endphp
                        @if($start > 1)
                            <a href="{{ route('announcement', array_merge($queryParams, ['page' => 1])) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-amber-600 transition-all font-semibold shadow-sm">1</a>
                            @if($start > 2)<span class="w-10 h-10 flex items-center justify-center text-slate-400 font-black">...</span>@endif
                        @endif
                        @foreach(range($start, $end) as $page)
                            @if($page == $currentPage)
                                <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-amber-600 text-white font-bold shadow-md scale-105">{{ $page }}</span>
                            @else
                                <a href="{{ route('announcement', array_merge($queryParams, ['page' => $page])) }}"
                                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-amber-600 transition-all font-semibold shadow-sm">{{ $page }}</a>
                            @endif
                        @endforeach
                        @if($end < $lastPage)
                            @if($end < $lastPage - 1)<span class="w-10 h-10 flex items-center justify-center text-slate-400 font-black">...</span>@endif
                            <a href="{{ route('announcement', array_merge($queryParams, ['page' => $lastPage])) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-amber-600 transition-all font-semibold shadow-sm">{{ $lastPage }}</a>
                        @endif

                        @if($currentPage >= $lastPage)
                            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed border border-slate-200 text-sm">
                                <i class="fa-solid fa-chevron-right"></i>
                            </span>
                        @else
                            <a href="{{ route('announcement', array_merge($queryParams, ['page' => $currentPage + 1])) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-amber-600 hover:bg-amber-600 hover:text-white transition-all shadow-sm text-sm">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Mobile Cards --}}
            <div class="md:hidden space-y-4">
                @forelse($pengumumans as $item)
                    @php
                        $publishedAt = !empty($item['published_at']) ? \Carbon\Carbon::parse($item['published_at']) : null;
                    @endphp
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 card-hover relative overflow-hidden">
                        <div class="flex justify-between items-start mb-3">
                            <span class="bg-amber-50 text-amber-700 border border-amber-200 rounded-md px-2 py-1 text-[10px] uppercase font-bold tracking-wide inline-flex items-center gap-1">
                                <i class="fa-solid fa-building text-xs"></i> {{ Str::limit($item['opd']['name'] ?? '-', 25) }}
                            </span>
                            <span class="text-xs font-medium text-slate-500 bg-slate-100 px-2 py-1 rounded-md">
                                <i class="fa-regular fa-eye text-amber-500 mr-1"></i> {{ number_format($item['views'] ?? 0) }}
                            </span>
                        </div>
                        <h3 class="font-bold text-dark text-lg mb-2 line-clamp-2 leading-tight">{{ $item['title'] }}</h3>
                        <p class="text-sm text-slate-500 mb-4 line-clamp-2">{{ $item['summary'] ?? '' }}</p>

                        <div class="flex justify-between items-center text-sm border-t border-slate-100 pt-4 mt-2">
                            <span class="text-slate-500 font-medium">
                                <i class="fa-regular fa-calendar mr-1 text-slate-400"></i>
                                {{ $publishedAt ? $publishedAt->translatedFormat('d M Y') : '-' }}
                            </span>
                            <a href="{{ $item['url'] }}" target="_blank" rel="noopener noreferrer"
                                class="bg-amber-50 hover:bg-amber-600 text-amber-600 hover:text-white px-3 py-1.5 rounded-lg font-semibold text-xs inline-flex items-center gap-1 transition-all border border-amber-200 hover:border-amber-600">
                                Detail <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-10 rounded-xl shadow-sm border border-slate-200 text-center text-slate-500">
                        <i class="fa-regular fa-folder-open text-4xl text-slate-300 mb-3 block"></i>
                        Belum ada pengumuman.
                    </div>
                @endforelse

                {{-- Mobile Pagination --}}
                @php
                    $currentPage = $meta['current_page'] ?? 1;
                    $lastPage    = $meta['last_page'] ?? 1;
                    $queryParams = request()->except('page');
                @endphp
                @if($lastPage > 1)
                    <div class="mt-6 flex justify-center gap-2">
                        @if($currentPage > 1)
                            <a href="{{ route('announcement', array_merge($queryParams, ['page' => $currentPage - 1])) }}"
                                class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-amber-600 hover:bg-amber-600 hover:text-white transition-all font-semibold text-sm shadow-sm flex items-center gap-1">
                                <i class="fa-solid fa-chevron-left text-xs"></i> Sebelumnya
                            </a>
                        @endif
                        <span class="px-4 py-2 rounded-xl bg-amber-600 text-white font-bold text-sm shadow-md">
                            {{ $currentPage }} / {{ $lastPage }}
                        </span>
                        @if($currentPage < $lastPage)
                            <a href="{{ route('announcement', array_merge($queryParams, ['page' => $currentPage + 1])) }}"
                                class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-amber-600 hover:bg-amber-600 hover:text-white transition-all font-semibold text-sm shadow-sm flex items-center gap-1">
                                Berikutnya <i class="fa-solid fa-chevron-right text-xs"></i>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </section>

        {{-- Sumber Data --}}
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 pb-4">
            <div class="flex items-center justify-center gap-2 text-xs text-slate-400 border-t border-slate-200 pt-8">
                <i class="fa-solid fa-link text-amber-500/60"></i>
                Data pengumuman bersumber dari
                <a href="https://berita.konawekab.go.id" target="_blank" rel="noopener noreferrer"
                    class="text-amber-600 font-semibold hover:underline">berita.konawekab.go.id</a>
            </div>
        </div>

    </main>
@endsection
