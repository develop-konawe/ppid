@extends('layouts.app')

@section('title', 'Berita')

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
        .transition-soft {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hero-gradient-news {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e4b8a 50%, #0f2b5e 100%);
        }

        /* News Card Styles */
        .news-card {
            background: white;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 10px 30px -10px rgba(31, 58, 138, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(226, 232, 240, 0.6);
        }

        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -12px rgba(31, 58, 138, 0.25);
            border-color: #3b82f6;
        }

        .news-image-container {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .news-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .news-card:hover .news-image {
            transform: scale(1.05);
        }

        .news-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(31, 58, 138, 0.9);
            backdrop-filter: blur(4px);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 10;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .news-date {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
            color: #1f3a8a;
            padding: 0.4rem 1rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 10;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .news-content {
            padding: 1.75rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .news-title {
            font-size: 1.25rem;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 0.75rem;
            color: #0f172a;
            transition: color 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .news-card:hover .news-title {
            color: #1f3a8a;
        }

        .news-excerpt {
            color: #475569;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .news-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
            font-size: 0.85rem;
            color: #64748b;
        }

        .news-meta i {
            color: #1f3a8a;
            width: 16px;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #1f3a8a;
            font-weight: 600;
            font-size: 0.9rem;
            transition: gap 0.3s ease;
        }

        .read-more:hover {
            gap: 0.75rem;
            color: #172554;
        }

        /* Featured News Card */
        .featured-news-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(31, 58, 138, 0.25);
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.4s ease;
        }

        .featured-news-card:hover {
            transform: scale(1.01);
            box-shadow: 0 30px 60px -12px rgba(31, 58, 138, 0.35);
        }

        .featured-image {
            height: 100%;
            min-height: 400px;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .featured-news-card:hover .featured-image {
            transform: scale(1.02);
        }

        /* Popular Post Card */
        .popular-post {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            border-radius: 1rem;
            transition: all 0.3s ease;
            background: white;
            border: 1px solid #e2e8f0;
            margin-bottom: 0.75rem;
        }

        .popular-post:hover {
            background: #f1f5f9;
            transform: translateX(5px);
            border-color: #3b82f6;
        }

        .popular-post-image {
            width: 80px;
            height: 80px;
            border-radius: 0.75rem;
            object-fit: cover;
        }

        .popular-post-content h4 {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
            color: #0f172a;
            transition: color 0.3s ease;
        }

        .popular-post:hover h4 {
            color: #1f3a8a;
        }

        /* Filter Buttons */
        .filter-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: white;
            color: #1f3a8a;
            border: 1px solid #e2e8f0;
            cursor: pointer;
        }

        .filter-btn:hover {
            background: #eff6ff;
            border-color: #1f3a8a;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(31, 58, 138, 0.2);
        }

        .filter-btn.active {
            background: #1f3a8a;
            color: white;
            border-color: #1f3a8a;
        }

        /* Pagination */
        .pagination-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: white;
            color: #1f3a8a;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            cursor: pointer;
        }

        .pagination-btn:hover {
            background: #1f3a8a;
            color: white;
            border-color: #1f3a8a;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(31, 58, 138, 0.3);
        }

        .pagination-btn.active {
            background: #1f3a8a;
            color: white;
            border-color: #1f3a8a;
        }

        /* Loading Spinner */
        .spinner-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 400px;
            width: 100%;
        }

        .loading-spinner {
            display: inline-block;
            width: 50px;
            height: 50px;
            border: 3px solid rgba(31, 58, 138, 0.3);
            border-radius: 50%;
            border-top-color: #1f3a8a;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: white;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .news-image-container {
                height: 180px;
            }

            .news-content {
                padding: 1.25rem;
            }

            .news-title {
                font-size: 1.1rem;
            }

            .filter-btn {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }

            .featured-image {
                min-height: 250px;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .carousel-container {
                height: 70vh;
                max-height: 700px;
                min-height: 500px;
            }
        }

        @media (max-width: 768px) {
            .carousel-container {
                height: 60vh;
                max-height: 600px;
                min-height: 450px;
            }
        }

        @media (max-width: 480px) {
            .carousel-container {
                height: 55vh;
                max-height: 500px;
                min-height: 400px;
            }

            #carousel-prev,
            #carousel-next {
                width: 40px;
                height: 40px;
            }
        }

        /* Mobile menu styles */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .mobile-menu.active {
            max-height: 500px;
        }

        /* Focus styles for accessibility */
        *:focus {
            outline: 2px solid #1e3a8a;
            outline-offset: 2px;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Animation for content */
        .animate-delay-100 {
            animation-delay: 100ms;
        }

        .animate-delay-200 {
            animation-delay: 200ms;
        }

        .animate-delay-300 {
            animation-delay: 300ms;
        }

        .animate-delay-400 {
            animation-delay: 400ms;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #1e3a8a;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #172554;
        }
    </style>
@endpush

@section('content')
    @php
        // Hitung statistik
        $totalBerita = $beritas->total();
        $beritaBulanIni = \App\Models\News::whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->count();
        $kategoriCount = \App\Models\Category::count();

        // Ambil berita utama (featured) - bisa berdasarkan views tertinggi atau manual
        $featuredNews = $beritas->first(); // Atau bisa dengan kondisi tertentu
        $popularNews = \App\Models\News::orderBy('views', 'desc')->limit(5)->get();
        $categories = \App\Models\Category::all();
    @endphp

    <main>
        <!-- Hero Section with Gradient -->
        <section class="hero-gradient-news relative overflow-hidden text-white py-16 md:py-24">
            <div class="absolute inset-0 bg-black/20 z-0"></div>
            <div class="absolute top-20 right-0 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-300/20 rounded-full blur-3xl"></div>

            <div class="max-w-7xl mx-auto px-4 md:px-8 relative z-10">
                <div class="breadcrumb mb-6">
                    <a href="{{ route('home') }}"><i class="fa-solid fa-home"></i> Beranda</a>
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                    <span class="text-white">Berita & Artikel</span>
                </div>

                <div class="max-w-3xl">
                    <div
                        class="inline-block px-4 py-1.5 bg-white/20 backdrop-blur-sm rounded-full text-xs font-bold uppercase tracking-wider mb-6 border border-white/30"
                    >
                        <i class="fa-regular fa-newspaper mr-2"></i> Update Informasi Terkini
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight">
                        BERITA & <span class="text-yellow-300">ARTIKEL</span> PPID
                    </h1>
                    <p class="text-lg text-white/90 mb-8 leading-relaxed max-w-2xl">
                        Dapatkan informasi terbaru seputar kegiatan, kebijakan, dan perkembangan terkait
                        keterbukaan informasi publik di Kabupaten Konawe.
                    </p>

                    <!-- Stats -->
                    <div class="flex flex-wrap gap-8">
                        <div>
                            <p class="text-3xl font-black text-yellow-300">{{ $totalBerita }}+</p>
                            <p class="text-white/80 text-sm">Total Berita</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-yellow-300">{{ $kategoriCount }}</p>
                            <p class="text-white/80 text-sm">Kategori</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-yellow-300">{{ $beritaBulanIni }}</p>
                            <p class="text-white/80 text-sm">Berita Bulan Ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Filter & Search Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 -mt-8 relative z-20">
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-slate-100">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                    <!-- Filter Buttons by Category -->
                    <div class="flex flex-wrap gap-2" id="filter-buttons">
                        <button class="filter-btn active" data-filter="all">Semua Berita</button>
                        @foreach($categories as $category)
                            <button class="filter-btn" data-filter="{{ $category->slug }}">{{ $category->name }}</button>
                        @endforeach
                    </div>

                    <!-- Search Box -->
                    <div class="relative w-full lg:w-72">
                        <form action="{{ 'search' }}" method="GET">
                            <input
                                type="text"
                                name="q"
                                id="search-news"
                                placeholder="Cari berita..."
                                value="{{ request('q') }}"
                                class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            />
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-slate-400"></i>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured News -->
        @if($featuredNews)
            <section class="max-w-7xl mx-auto px-4 md:px-8 py-16">
                <h2 class="text-3xl md:text-4xl font-black text-dark mb-10 flex items-center">
                    <i class="fa-solid fa-star text-yellow-400 mr-3 text-3xl"></i>
                    Berita Utama
                </h2>

                <div class="featured-news-card">
                    <div class="grid grid-cols-1 lg:grid-cols-2">
                        <div class="h-64 lg:h-auto overflow-hidden">
                            @if(is_file(public_path('storage/'.$featuredNews->image)))
                                <img src="{{ asset('storage/'.$featuredNews->image) }}" alt="{{ $featuredNews->title }}" class="featured-image w-full h-full object-cover">
                            @elseif(is_file(public_path($featuredNews->image)))
                                <img src="{{ asset($featuredNews->image) }}" alt="{{ $featuredNews->title }}" class="featured-image w-full h-full object-cover">
                            @else
                                <img src="{{ asset('image/28.jpg') }}" alt="{{ $featuredNews->title }}" class="featured-image w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="p-8 md:p-10 flex flex-col">
                            <div class="flex items-center gap-3 mb-4">
                                @if($featuredNews->category)
                                    <span class="bg-primary text-white px-4 py-1.5 rounded-full text-xs font-bold">
                                    {{ strtoupper($featuredNews->category->name) }}
                                </span>
                                @endif
                                <span class="text-slate-500 text-sm">
                                <i class="fa-regular fa-calendar mr-1"></i> {{ $featuredNews->created_at->format('d F Y') }}
                            </span>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-dark mb-4 leading-tight">
                                {{ $featuredNews->title }}
                            </h3>
                            <p class="text-slate-600 mb-6 leading-relaxed">
                                {{ Str::limit(strip_tags($featuredNews->content), 200) }}
                            </p>
                            <div class="flex items-center gap-4 mb-8">
                                <div class="flex items-center">
                                    <div>
                                        <p class="font-semibold text-dark">Admin</p>
                                        <p class="text-xs text-slate-500">{{ $featuredNews->views }} dilihat</p>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('news.detail', $featuredNews->slug) }}" class="read-more mt-auto">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- News Grid Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 pb-20">
            <!-- Loading Indicator (will be hidden by default as we render server-side) -->
            <div id="loading-indicator" class="spinner-container hidden">
                <div class="loading-spinner"></div>
            </div>

            <!-- News Grid Container -->
            <div id="news-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if($beritas && $beritas->isNotEmpty())
                    @foreach($beritas as $berita)
                        <div class="news-card">
                            <div class="news-image-container">
                                @if(is_file(public_path('storage/'.$berita->image)))
                                    <img src="{{ asset('storage/'.$berita->image) }}" alt="{{ $berita->title }}" class="news-image" loading="lazy">
                                @elseif(is_file(public_path($berita->image)))
                                    <img src="{{ asset($berita->image) }}" alt="{{ $berita->title }}" class="news-image" loading="lazy">
                                @else
                                    <img src="{{ asset('image/28.jpg') }}" alt="{{ $berita->title }}" class="news-image" loading="lazy">
                                @endif

                                @if($berita->category)
                                    <span class="news-category">{{ $berita->category->name }}</span>
                                @endif
                                <span class="news-date">
                                    <i class="fa-regular fa-calendar mr-1"></i> {{ $berita->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <div class="news-content">
                                <h3 class="news-title">{{ $berita->title }}</h3>
                                <p class="news-excerpt">{{ Str::limit(strip_tags($berita->content), 120) }}</p>
                                <div class="news-meta">
                                    <span><i class="fa-regular fa-user mr-1"></i> Admin</span>
                                    <span><i class="fa-regular fa-eye mr-1"></i> {{ $berita->views }}x</span>
                                </div>
                                <a href="{{ route('news.detail', $berita->slug) }}" class="read-more mt-4">
                                    Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- No Results Message -->
            <div id="no-results" class="{{ $beritas && $beritas->isNotEmpty() ? 'hidden' : '' }} text-center py-16">
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-regular fa-newspaper text-primary text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark mb-3">Tidak Ditemukan</h3>
                <p class="text-slate-600 max-w-md mx-auto">
                    Maaf, tidak ada berita yang sesuai dengan pencarian Anda.
                </p>
            </div>

            <!-- Pagination -->
            <div id="pagination-container" class="flex justify-center items-center gap-2 mt-12">
                {{ $beritas->onEachSide(1)->links('layouts.pagination.tailwind') }}
            </div>
        </section>

        <!-- Popular News & Newsletter Section -->
        <section class="bg-slate-50 py-20">
            <div class="max-w-7xl mx-auto px-4 md:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <!-- Popular Posts -->
                    <div class="lg:col-span-2">
                        <h3 class="text-2xl font-bold text-dark mb-6 flex items-center">
                            <i class="fa-solid fa-fire-flame text-orange-500 mr-3"></i>
                            Berita Populer
                        </h3>

                        <div class="space-y-3" id="popular-posts">
                            @foreach($popularNews as $popular)
                                <a href="{{ route('news.detail', $popular->slug) }}" class="popular-post">
                                    @if(is_file(public_path('storage/'.$popular->image)))
                                        <img src="{{ asset('storage/'.$popular->image) }}" alt="{{ $popular->title }}" class="popular-post-image">
                                    @elseif(is_file(public_path($popular->image)))
                                        <img src="{{ asset($popular->image) }}" alt="{{ $popular->title }}" class="popular-post-image">
                                    @else
                                        <img src="{{ asset('image/28.jpg') }}" alt="{{ $popular->title }}" class="popular-post-image">
                                    @endif
                                    <div class="popular-post-content">
                                        <h4>{{ Str::limit($popular->title, 50) }}</h4>
                                        <p class="text-xs text-slate-500 mt-1">
                                            <i class="fa-regular fa-calendar mr-1"></i> {{ $popular->created_at->format('d F Y') }}
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            <i class="fa-regular fa-eye mr-1"></i> {{ $popular->views }} dilihat
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="bg-primary rounded-3xl p-8 text-white">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fa-regular fa-envelope text-3xl"></i>
                        </div>
                        <h4 class="text-2xl font-bold mb-3">Newsletter PPID</h4>
                        <p class="text-white/80 mb-6 text-sm leading-relaxed">
                            Dapatkan update berita terbaru langsung di email Anda. Kami tidak akan mengirim spam.
                        </p>
                        <form id="newsletter-form" action="{{ "route('newsletter.subscribe')" }}" method="POST" class="space-y-3">
                            @csrf
                            <input
                                type="text"
                                name="name"
                                placeholder="Nama Anda"
                                required
                                class="w-full px-4 py-3 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-yellow-300"
                            />
                            <input
                                type="email"
                                name="email"
                                placeholder="Email Anda"
                                required
                                class="w-full px-4 py-3 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-yellow-300"
                            />
                            <button
                                type="submit"
                                class="w-full bg-yellow-400 hover:bg-yellow-500 text-primary-dark font-bold py-3 rounded-xl transition-soft transform hover:-translate-y-0.5"
                            >
                                <i class="fa-regular fa-bell mr-2"></i> Berlangganan
                            </button>
                        </form>
                        <p class="text-white/60 text-xs mt-4">
                            Dengan berlangganan, Anda menyetujui kebijakan privasi kami.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Cloud -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 py-16">
            <h3 class="text-2xl font-bold text-dark mb-6 text-center">Kategori Populer</h3>
            <div class="flex flex-wrap justify-center gap-3">
                @foreach($categories as $category)
                    <a
                        href="{{ "route('news.category', $category->slug)" }}"
                        class="px-4 py-2 bg-primary-subtle text-primary rounded-full text-sm font-medium hover:bg-primary hover:text-white transition-soft"
                    >{{ $category->name }}</a>
                @endforeach
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        // Filter functionality with URL parameters
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const searchInput = document.getElementById('search-news');

            // Handle filter buttons
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove active class from all buttons
                    filterButtons.forEach(b => {
                        b.classList.remove('active');
                        b.classList.remove('bg-primary', 'text-white');
                        b.classList.add('bg-white', 'text-primary');
                    });

                    // Add active class to clicked button
                    this.classList.add('active');
                    this.classList.remove('bg-white', 'text-primary');
                    this.classList.add('bg-primary', 'text-white');

                    const filter = this.dataset.filter;

                    if (filter === 'all') {
                        window.location.href = '{{ route("news") }}';
                    } else {
                        window.location.href = '{{ url("berita/kategori") }}/' + filter;
                    }
                });
            });

            // Set active filter based on current URL
            const currentPath = window.location.pathname;
            if (currentPath.includes('/kategori/')) {
                const categorySlug = currentPath.split('/').pop();
                filterButtons.forEach(btn => {
                    if (btn.dataset.filter === categorySlug) {
                        btn.classList.add('active');
                        btn.classList.remove('bg-white', 'text-primary');
                        btn.classList.add('bg-primary', 'text-white');
                    }
                });
            } else {
                // If on main news page, activate 'all' button
                const allBtn = document.querySelector('[data-filter="all"]');
                if (allBtn) {
                    allBtn.classList.add('active');
                    allBtn.classList.remove('bg-white', 'text-primary');
                    allBtn.classList.add('bg-primary', 'text-white');
                }
            }

            // Newsletter form submission with AJAX
            const newsletterForm = document.getElementById('newsletter-form');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);

                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Terima kasih telah berlangganan newsletter PPID Konawe!');
                                this.reset();
                            } else {
                                alert('Terjadi kesalahan. Silakan coba lagi.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        });
                });
            }

            // Mobile Menu Toggle (if exists)
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuToggle && mobileMenu) {
                mobileMenuToggle.addEventListener('click', () => {
                    const isExpanded = mobileMenuToggle.getAttribute('aria-expanded') === 'true';
                    mobileMenuToggle.setAttribute('aria-expanded', !isExpanded);
                    mobileMenu.classList.toggle('hidden');
                    mobileMenu.classList.toggle('active');

                    const spans = mobileMenuToggle.querySelectorAll('span');
                    if (!isExpanded) {
                        spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                        spans[1].style.opacity = '0';
                        spans[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
                    } else {
                        spans[0].style.transform = 'none';
                        spans[1].style.opacity = '1';
                        spans[2].style.transform = 'none';
                    }
                });
            }
        });
    </script>
@endpush
