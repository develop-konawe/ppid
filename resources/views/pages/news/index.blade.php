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

        /* Popular Post */
        .popular-post { display: flex; gap: 1rem; padding: 1rem; border-radius: 1rem; transition: all 0.3s ease; background: white; border: 1px solid #e2e8f0; margin-bottom: 0.75rem; }
        .popular-post:hover { background: #f1f5f9; transform: translateX(5px); border-color: #3b82f6; }
        .popular-post-image { width: 80px; height: 80px; border-radius: 0.75rem; object-fit: cover; }
        .popular-post-content h4 { font-weight: 600; font-size: 1rem; margin-bottom: 0.25rem; color: #0f172a; transition: color 0.3s ease; }
        .popular-post:hover h4 { color: #1f3a8a; }

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

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8 animate-fade-in">
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)] py-6 px-4 flex flex-col items-center justify-center hover:border-primary transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-3xl md:text-4xl font-black text-primary-500 mb-2">{{ $totalBerita }}</p>
                    <p class="text-slate-500 text-[11px] md:text-xs uppercase tracking-widest font-semibold text-center">Total Publikasi</p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)] py-6 px-4 flex flex-col items-center justify-center hover:border-primary transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-3xl md:text-4xl font-black text-primary-500 mb-2">{{ $beritaBulanIni }}</p>
                    <p class="text-slate-500 text-[11px] md:text-xs uppercase tracking-widest font-semibold text-center">Bulan Ini</p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)] py-6 px-4 flex flex-col items-center justify-center hover:border-primary transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-3xl md:text-4xl font-black text-primary-500 mb-2">{{ $kategoriCount }}</p>
                    <p class="text-slate-500 text-[11px] md:text-xs uppercase tracking-widest font-semibold text-center">Kategori</p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)] py-6 px-4 flex flex-col items-center justify-center hover:border-primary transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-3xl md:text-4xl font-black text-primary-500 mb-2">{{ number_format($totalViews, 0, ',', '.') }}</p>
                    <p class="text-slate-500 text-[11px] md:text-xs uppercase tracking-widest font-semibold text-center">Total Dilihat</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-4 md:p-6 border border-slate-200">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">

                    <div class="flex flex-wrap gap-2" id="filter-buttons">
                        <a href="{{ route('news') }}" class="filter-btn active">Semua Berita</a>
                        @foreach($categories as $category)
                            <a href="{{ url('berita/kategori/' . $category->slug) }}" class="filter-btn">{{ $category->name }}</a>
                        @endforeach
                    </div>

                    <div class="relative w-full lg:w-72 shrink-0">
                        <form action="{{ url('berita/search') }}" method="GET">
                            <input type="text" name="q" placeholder="Cari berita..." value="{{ request('q') }}" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition-all" />
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-slate-400"></i>
                        </form>
                    </div>

                </div>
            </div>

        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 pb-20 pt-6">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl md:text-3xl font-black text-dark flex items-center gap-2">
                    <i class="fa-solid fa-newspaper text-primary"></i> Berita Terkini
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @forelse($beritas as $berita)
                    <div class="news-card">
                        <div class="news-image-container">
                            @php $imgUrl = $berita->image ? asset('storage/'.$berita->image) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800'; @endphp
                            <img src="{{ $imgUrl }}" alt="{{ $berita->title }}" class="news-image" loading="lazy">
                            @if($berita->category)
                                <span class="news-category">{{ $berita->category->name }}</span>
                            @endif
                            <span class="news-date">
                                <i class="fa-regular fa-calendar mr-1"></i> {{ $berita->created_at->format('d M') }}
                            </span>
                        </div>
                        <div class="news-content">
                            <h3 class="news-title line-clamp-2">{{ $berita->title }}</h3>
                            <p class="news-excerpt line-clamp-3">{{ Str::limit(html_entity_decode(strip_tags($berita->content)), 120) }}</p>

                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-slate-100">
                                <div class="text-sm text-slate-500">
                                    <i class="fa-regular fa-eye mr-1 text-primary"></i> {{ $berita->views }}
                                </div>
                                <a href="{{ route('news.detail', $berita->slug) }}" class="read-more">
                                    Selengkapnya <i class="fa-solid fa-arrow-right text-xs"></i>
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

            @if (method_exists($beritas, 'hasPages') && $beritas->hasPages())
                <div class="flex justify-center items-center gap-2 mt-12">

                    {{-- Tombol Previous --}}
                    @if ($beritas->onFirstPage())
                        <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed shadow-sm border border-slate-200">
                            <i class="fa-solid fa-chevron-left text-sm"></i>
                        </span>
                    @else
                        <a href="{{ $beritas->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-primary hover:bg-primary hover:text-white transition-all shadow-sm">
                            <i class="fa-solid fa-chevron-left text-sm"></i>
                        </a>
                    @endif

                    {{-- Logika Penomoran Halaman Dinamis --}}
                    @php
                        $start = max($beritas->currentPage() - 2, 1);
                        $end = min($beritas->currentPage() + 2, $beritas->lastPage());
                    @endphp

                    {{-- Angka 1 dan titik-titik awal --}}
                    @if($start > 1)
                        <a href="{{ $beritas->url(1) }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-primary-subtle hover:text-primary transition-all font-semibold shadow-sm">1</a>
                        @if($start > 2)
                            <span class="w-10 h-10 flex items-center justify-center text-slate-400 font-black tracking-widest">...</span>
                        @endif
                    @endif

                    {{-- Looping Angka Halaman Tengah --}}
                    @foreach (range($start, $end) as $page)
                        @if ($page == $beritas->currentPage())
                            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary text-white font-bold shadow-md transform scale-105 cursor-default">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $beritas->url($page) }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-primary-subtle hover:text-primary transition-all font-semibold shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Titik-titik akhir dan Halaman Terakhir --}}
                    @if($end < $beritas->lastPage())
                        @if($end < $beritas->lastPage() - 1)
                            <span class="w-10 h-10 flex items-center justify-center text-slate-400 font-black tracking-widest">...</span>
                        @endif
                        <a href="{{ $beritas->url($beritas->lastPage()) }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-primary-subtle hover:text-primary transition-all font-semibold shadow-sm">{{ $beritas->lastPage() }}</a>
                    @endif

                    {{-- Tombol Next --}}
                    @if ($beritas->hasMorePages())
                        <a href="{{ $beritas->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-primary hover:bg-primary hover:text-white transition-all shadow-sm">
                            <i class="fa-solid fa-chevron-right text-sm"></i>
                        </a>
                    @else
                        <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed shadow-sm border border-slate-200">
                            <i class="fa-solid fa-chevron-right text-sm"></i>
                        </span>
                    @endif

                </div>
            @endif
        </section>

        <section class="bg-white border-t border-slate-200 py-20">
            <div class="max-w-7xl mx-auto px-4 md:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-16">

                    <div class="lg:col-span-2">
                        <h3 class="text-2xl font-black text-dark mb-8 flex items-center border-b border-slate-100 pb-4">
                            <i class="fa-solid fa-fire-flame-curved text-orange-500 mr-3"></i> Sedang Hangat Dibicarakan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($popularNews as $popular)
                                <a href="{{ route('news.detail', $popular->slug) }}" class="popular-post">
                                    @php $popImg = $popular->image ? asset('storage/'.$popular->image) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=300'; @endphp
                                    <img src="{{ $popImg }}" alt="{{ $popular->title }}" class="popular-post-image shrink-0">
                                    <div class="popular-post-content flex flex-col justify-center">
                                        <span class="text-[10px] font-bold text-primary uppercase tracking-wider mb-1 block">
                                            {{ $popular->category->name ?? 'Berita' }}
                                        </span>
                                        <h4 class="line-clamp-2 leading-snug">{{ $popular->title }}</h4>
                                        <div class="flex items-center gap-3 mt-2">
                                            <p class="text-[11px] text-slate-500 font-medium">
                                                <i class="fa-regular fa-calendar mr-1"></i> {{ $popular->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-primary to-primary-dark rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-blue-400/20 rounded-full blur-2xl"></div>

                        <div class="relative z-10">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-sm border border-white/20 rounded-2xl flex items-center justify-center mb-6">
                                <i class="fa-regular fa-envelope text-2xl text-white"></i>
                            </div>
                            <h4 class="text-2xl font-black mb-2">Berlangganan Info</h4>
                            <p class="text-blue-100 mb-8 text-sm leading-relaxed">
                                Dapatkan ringkasan berita terbaru PPID Konawe langsung ke email Anda.
                            </p>

                            <form action="#" method="POST" class="space-y-4">
                                @csrf
                                <div class="relative">
                                    <i class="fa-regular fa-user absolute left-4 top-3.5 text-slate-400"></i>
                                    <input type="text" name="name" placeholder="Nama Lengkap" required class="w-full pl-11 pr-4 py-3 rounded-xl text-slate-800 bg-white border-0 focus:ring-2 focus:ring-yellow-400 text-sm" />
                                </div>
                                <div class="relative">
                                    <i class="fa-regular fa-envelope absolute left-4 top-3.5 text-slate-400"></i>
                                    <input type="email" name="email" placeholder="Alamat Email" required class="w-full pl-11 pr-4 py-3 rounded-xl text-slate-800 bg-white border-0 focus:ring-2 focus:ring-yellow-400 text-sm" />
                                </div>
                                <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-slate-900 font-bold py-3.5 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 mt-2 flex justify-center items-center gap-2">
                                    Berlangganan Sekarang <i class="fa-solid fa-paper-plane text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
