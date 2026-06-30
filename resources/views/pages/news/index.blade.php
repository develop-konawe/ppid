@extends('layouts.app')

@section('title', 'Berita & Artikel')

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
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideUp: { '0%': { transform: 'translateY(10px)', opacity: '0' }, '100%': { transform: 'translateY(0)', opacity: '1' } },
                    },
                },
            },
        };
    </script>
@endpush

@push('styles')
    <style>
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

        /* News Card Styles */
        .news-card {
            background: white; border-radius: 1.5rem; overflow: hidden;
            box-shadow: 0 10px 30px -10px rgba(31, 58, 138, 0.1); transition: all 0.3s ease;
            height: 100%; display: flex; flex-direction: column; border: 1px solid rgba(226, 232, 240, 0.6);
        }
        .news-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px -12px rgba(31, 58, 138, 0.25); border-color: #3b82f6; }
        .news-image-container { position: relative; height: 220px; overflow: hidden; }
        .news-image { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
        .news-card:hover .news-image { transform: scale(1.05); }
        .news-category {
            position: absolute; top: 1rem; left: 1rem; background: rgba(31, 58, 138, 0.9); backdrop-filter: blur(4px);
            color: white; padding: 0.4rem 1rem; border-radius: 2rem; font-size: 0.75rem; font-weight: 600; z-index: 10;
        }
        .news-date {
            position: absolute; top: 1rem; right: 1rem; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(4px);
            color: #1f3a8a; padding: 0.4rem 1rem; border-radius: 2rem; font-size: 0.75rem; font-weight: 600; z-index: 10;
        }
        .news-content { padding: 1.75rem; flex-grow: 1; display: flex; flex-direction: column; }
        .news-title { font-size: 1.25rem; font-weight: 700; line-height: 1.4; margin-bottom: 0.75rem; color: #0f172a; transition: color 0.3s ease; }
        .news-card:hover .news-title { color: #1f3a8a; }
        .news-excerpt { color: #475569; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1; }
        .read-more { display: inline-flex; align-items: center; gap: 0.5rem; color: #1f3a8a; font-weight: 600; font-size: 0.9rem; transition: gap 0.3s ease; }
        .read-more:hover { gap: 0.75rem; color: #172554; }

        /* Filter Buttons */
        .filter-btn { padding: 0.75rem 1.5rem; border-radius: 2rem; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease; background: white; color: #1f3a8a; border: 1px solid #e2e8f0; cursor: pointer; }
        .filter-btn:hover { background: #eff6ff; border-color: #1f3a8a; transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(31, 58, 138, 0.2); }
        .filter-btn.active { background: #1f3a8a; color: white; border-color: #1f3a8a; }

        @media (max-width: 768px) {
            .news-image-container { height: 180px; }
            .news-content { padding: 1.25rem; }
            .filter-btn { padding: 0.5rem 1rem; font-size: 0.8rem; }
        }
    </style>
@endpush

@section('content')

    <main class="overflow-hidden bg-slate-50 min-h-screen">

        <section class="bg-gradient-to-r from-primary/10 to-primary-subtle py-12 md:py-16 border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 md:px-8">

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="max-w-3xl">
                        <nav class="text-sm flex items-center gap-2 text-slate-500 mb-4 flex-wrap">
                            <a href="{{ route('home') }}" class="hover:text-primary transition-soft"><i class="fa-solid fa-home"></i> Beranda</a> /
                            <span class="text-primary font-semibold">Berita & Artikel</span>
                        </nav>

                        <h1 class="text-3xl md:text-4xl font-black text-dark uppercase tracking-tight animate-slide-up">
                            Berita & <span class="text-primary">Artikel</span>
                        </h1>
                        <p class="text-slate-600 mt-2 animate-fade-in leading-relaxed">
                            Dapatkan informasi terbaru seputar kegiatan, kebijakan, dan perkembangan terkait keterbukaan informasi publik di Kabupaten Konawe.
                        </p>
                    </div>

                    <div class="hidden md:flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-sm text-primary text-3xl border border-slate-100 transform rotate-3 hover:rotate-0 transition-transform duration-300 shrink-0">
                        <i class="fa-regular fa-newspaper"></i>
                    </div>
                </div>

            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 py-8 relative z-20">
            <div class="bg-white rounded-2xl shadow-sm p-4 md:p-6 border border-slate-200">
                <form action="{{ route('news') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..."
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition-all text-sm" />
                    </div>
                    <div class="flex gap-3 shrink-0">
                        <button type="submit"
                            class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-semibold transition-soft shadow-md flex items-center gap-2">
                            <i class="fa-solid fa-search"></i>
                            <span class="hidden md:inline">Cari</span>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('news') }}"
                                class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-3 rounded-xl font-semibold transition-soft flex items-center justify-center"
                                title="Reset Pencarian">
                                <i class="fa-solid fa-rotate-left"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 pb-20 pt-2">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl md:text-3xl font-black text-dark flex items-center gap-2">
                    <i class="fa-solid fa-newspaper text-primary"></i> Berita Terkini
                </h2>
                <span class="bg-blue-50 text-primary px-3 py-1 rounded-full text-sm font-semibold border border-blue-200">
                    Total: {{ $meta['total'] ?? 0 }} Berita
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @forelse($beritas as $berita)
                    @php
                        $imgUrl = $berita['cover_image'] ?? 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800';
                        $publishedAt = $berita['published_at'] ? \Carbon\Carbon::parse($berita['published_at']) : null;
                    @endphp
                    <div class="news-card">
                        <div class="news-image-container">
                            <img src="{{ $imgUrl }}" alt="{{ $berita['title'] }}" class="news-image" loading="lazy">
                            @if(!empty($berita['category']['name']))
                                <span class="news-category">{{ $berita['category']['name'] }}</span>
                            @endif
                            @if($publishedAt)
                                <span class="news-date">
                                    <i class="fa-regular fa-calendar mr-1"></i> {{ $publishedAt->translatedFormat('d M') }}
                                </span>
                            @endif
                        </div>
                        <div class="news-content">
                            <h3 class="news-title line-clamp-2">{{ $berita['title'] }}</h3>
                            <p class="news-excerpt line-clamp-3">{{ $berita['summary'] }}</p>

                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-slate-100">
                                <div class="text-sm text-slate-500">
                                    <i class="fa-regular fa-eye mr-1 text-primary"></i> {{ number_format($berita['views'] ?? 0) }}
                                </div>
                                <a href="{{ $berita['url'] }}" target="_blank" rel="noopener noreferrer" class="read-more">
                                    Selengkapnya <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-slate-200">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fa-regular fa-newspaper text-slate-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-2">Belum Ada Berita</h3>
                        <p class="text-slate-500 max-w-md mx-auto">Maaf, tidak ada berita yang sesuai dengan kriteria Anda saat ini.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination Manual berdasarkan metadata API --}}
            @php
                $currentPage = $meta['current_page'] ?? 1;
                $lastPage    = $meta['last_page'] ?? 1;
                $queryParams = request()->except('page');
            @endphp
            @if($lastPage > 1)
                <div class="flex justify-center items-center gap-2 mt-12">

                    {{-- Tombol Previous --}}
                    @if($currentPage <= 1)
                        <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed shadow-sm border border-slate-200">
                            <i class="fa-solid fa-chevron-left text-sm"></i>
                        </span>
                    @else
                        <a href="{{ route('news', array_merge($queryParams, ['page' => $currentPage - 1])) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-primary hover:bg-primary hover:text-white transition-all shadow-sm">
                            <i class="fa-solid fa-chevron-left text-sm"></i>
                        </a>
                    @endif

                    {{-- Angka Halaman --}}
                    @php
                        $start = max($currentPage - 2, 1);
                        $end   = min($currentPage + 2, $lastPage);
                    @endphp

                    @if($start > 1)
                        <a href="{{ route('news', array_merge($queryParams, ['page' => 1])) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-primary-subtle hover:text-primary transition-all font-semibold shadow-sm">1</a>
                        @if($start > 2)
                            <span class="w-10 h-10 flex items-center justify-center text-slate-400 font-black tracking-widest">...</span>
                        @endif
                    @endif

                    @foreach(range($start, $end) as $page)
                        @if($page == $currentPage)
                            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary text-white font-bold shadow-md transform scale-105 cursor-default">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ route('news', array_merge($queryParams, ['page' => $page])) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-primary-subtle hover:text-primary transition-all font-semibold shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if($end < $lastPage)
                        @if($end < $lastPage - 1)
                            <span class="w-10 h-10 flex items-center justify-center text-slate-400 font-black tracking-widest">...</span>
                        @endif
                        <a href="{{ route('news', array_merge($queryParams, ['page' => $lastPage])) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-primary-subtle hover:text-primary transition-all font-semibold shadow-sm">{{ $lastPage }}</a>
                    @endif

                    {{-- Tombol Next --}}
                    @if($currentPage >= $lastPage)
                        <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed shadow-sm border border-slate-200">
                            <i class="fa-solid fa-chevron-right text-sm"></i>
                        </span>
                    @else
                        <a href="{{ route('news', array_merge($queryParams, ['page' => $currentPage + 1])) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-primary hover:bg-primary hover:text-white transition-all shadow-sm">
                            <i class="fa-solid fa-chevron-right text-sm"></i>
                        </a>
                    @endif

                </div>
            @endif

        </section>

        {{-- Sumber Data --}}
        <div class="max-w-7xl mx-auto px-4 md:px-8 pb-10">
            <div class="flex items-center justify-center gap-2 text-xs text-slate-400 border-t border-slate-200 pt-8">
                <i class="fa-solid fa-link text-primary/50"></i>
                Data berita bersumber dari
                <a href="https://berita.konawekab.go.id" target="_blank" rel="noopener noreferrer"
                    class="text-primary font-semibold hover:underline">berita.konawekab.go.id</a>
            </div>
        </div>

    </main>
@endsection
