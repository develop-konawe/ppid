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
    <main>
        <!-- Hero Section with Gradient -->
        <section class="hero-gradient-news relative overflow-hidden text-white py-16 md:py-24">
            <div class="absolute inset-0 bg-black/20 z-0"></div>
            <div class="absolute top-20 right-0 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-300/20 rounded-full blur-3xl"></div>

            <div class="max-w-7xl mx-auto px-4 md:px-8 relative z-10">
                <div class="breadcrumb mb-6">
                    <a href="/"><i class="fa-solid fa-home"></i> Beranda</a>
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
                            <p class="text-3xl font-black text-yellow-300">120+</p>
                            <p class="text-white/80 text-sm">Total Berita</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-yellow-300">15</p>
                            <p class="text-white/80 text-sm">Kategori</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-yellow-300">8</p>
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
                    <!-- Filter Buttons -->
                    <div class="flex flex-wrap gap-2" id="filter-buttons">
                        <button class="filter-btn active" data-filter="all">Semua Berita</button>
                        <button class="filter-btn" data-filter="kegiatan">Kegiatan</button>
                        <button class="filter-btn" data-filter="kebijakan">Kebijakan</button>
                        <button class="filter-btn" data-filter="pengumuman">Pengumuman</button>
                        <button class="filter-btn" data-filter="artikel">Artikel</button>
                        <button class="filter-btn" data-filter="press-release">Press Release</button>
                    </div>

                    <!-- Search Box -->
                    <div class="relative w-full lg:w-72">
                        <input
                            type="text"
                            id="search-news"
                            placeholder="Cari berita..."
                            class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        />
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-slate-400"></i>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured News -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 py-16">
            <h2 class="text-3xl md:text-4xl font-black text-dark mb-10 flex items-center">
                <i class="fa-solid fa-star text-yellow-400 mr-3 text-3xl"></i>
                Berita Utama
            </h2>

            <div class="featured-news-card">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="h-64 lg:h-auto overflow-hidden">
                        <img
                            src="https://images.unsplash.com/photo-1573164713714-d95e436ab78d?auto=format&fit=crop&q=80&w=1200"
                            alt="Featured News"
                            class="featured-image w-full h-full object-cover"
                        />
                    </div>
                    <div class="p-8 md:p-10 flex flex-col">
                        <div class="flex items-center gap-3 mb-4">
                <span class="bg-primary text-white px-4 py-1.5 rounded-full text-xs font-bold"
                >PRESS RELEASE</span
                >
                            <span class="text-slate-500 text-sm"
                            ><i class="fa-regular fa-calendar mr-1"></i> 15 Februari 2026</span
                            >
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold text-dark mb-4 leading-tight">
                            PPID Konawe Raih Penghargaan Keterbukaan Informasi Publik Tingkat Provinsi
                        </h3>
                        <p class="text-slate-600 mb-6 leading-relaxed">
                            PPID Kabupaten Konawe berhasil meraih penghargaan sebagai Badan Publik dengan
                            kinerja keterbukaan informasi terbaik se-Sulawesi Tenggara. Penghargaan ini
                            diberikan oleh Komisi Informasi Provinsi dalam acara Anugerah Keterbukaan Informasi
                            2026.
                        </p>
                        <div class="flex items-center gap-4 mb-8">
                            <div class="flex items-center">
                                <img
                                    src="https://randomuser.me/api/portraits/men/32.jpg"
                                    alt="Author"
                                    class="w-10 h-10 rounded-full mr-3 object-cover"
                                />
                                <div>
                                    <p class="font-semibold text-dark">Ahmad Sulaiman, S.Sos</p>
                                    <p class="text-xs text-slate-500">Kepala Diskominfo Konawe</p>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="read-more mt-auto">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- News Grid Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 pb-20">
            <!-- Loading Indicator -->
            <div id="loading-indicator" class="spinner-container">
                <div class="loading-spinner"></div>
            </div>

            <!-- News Grid Container -->
            <div
                id="news-grid"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 opacity-0 transition-opacity duration-300"
            >
                <!-- News items will be inserted here by JavaScript -->
            </div>

            <!-- No Results Message -->
            <div id="no-results" class="hidden text-center py-16">
                <div
                    class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6"
                >
                    <i class="fa-regular fa-newspaper text-primary text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark mb-3">Tidak Ditemukan</h3>
                <p class="text-slate-600 max-w-md mx-auto">
                    Maaf, tidak ada berita yang sesuai dengan pencarian atau filter Anda. Coba kata kunci
                    atau filter lainnya.
                </p>
            </div>

            <!-- Pagination -->
            <div id="pagination-container" class="flex justify-center items-center gap-2 mt-12">
                <!-- Pagination will be inserted here by JavaScript -->
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
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="bg-primary rounded-3xl p-8 text-white">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fa-regular fa-envelope text-3xl"></i>
                        </div>
                        <h4 class="text-2xl font-bold mb-3">Newsletter PPID</h4>
                        <p class="text-white/80 mb-6 text-sm leading-relaxed">
                            Dapatkan update berita terbaru langsung di email Anda. Kami tidak akan mengirim
                            spam.
                        </p>
                        <form id="newsletter-form" class="space-y-3">
                            <input
                                type="text"
                                placeholder="Nama Anda"
                                class="w-full px-4 py-3 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-yellow-300"
                            />
                            <input
                                type="email"
                                placeholder="Email Anda"
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
                <a
                    href="#"
                    class="px-4 py-2 bg-primary-subtle text-primary rounded-full text-sm font-medium hover:bg-primary hover:text-white transition-soft"
                >Kegiatan PPID</a
                >
                <a
                    href="#"
                    class="px-4 py-2 bg-primary-subtle text-primary rounded-full text-sm font-medium hover:bg-primary hover:text-white transition-soft"
                >Kebijakan Baru</a
                >
                <a
                    href="#"
                    class="px-4 py-2 bg-primary-subtle text-primary rounded-full text-sm font-medium hover:bg-primary hover:text-white transition-soft"
                >Pelatihan ASN</a
                >
                <a
                    href="#"
                    class="px-4 py-2 bg-primary-subtle text-primary rounded-full text-sm font-medium hover:bg-primary hover:text-white transition-soft"
                >Sosialisasi</a
                >
                <a
                    href="#"
                    class="px-4 py-2 bg-primary-subtle text-primary rounded-full text-sm font-medium hover:bg-primary hover:text-white transition-soft"
                >Press Release</a
                >
                <a
                    href="#"
                    class="px-4 py-2 bg-primary-subtle text-primary rounded-full text-sm font-medium hover:bg-primary hover:text-white transition-soft"
                >Layanan Publik</a
                >
                <a
                    href="#"
                    class="px-4 py-2 bg-primary-subtle text-primary rounded-full text-sm font-medium hover:bg-primary hover:text-white transition-soft"
                >Teknologi Informasi</a
                >
                <a
                    href="#"
                    class="px-4 py-2 bg-primary-subtle text-primary rounded-full text-sm font-medium hover:bg-primary hover:text-white transition-soft"
                >Dokumentasi</a
                >
            </div>
        </section>
    </main>
@endsection

@push('scripts')

    <!-- JavaScript -->
    <script>
        // News Data
        const newsData = [
            {
                id: 1,
                title: 'PPID Konawe Raih Penghargaan Keterbukaan Informasi Publik',
                excerpt:
                    'PPID Kabupaten Konawe berhasil meraih penghargaan sebagai Badan Publik dengan kinerja keterbukaan informasi terbaik se-Sulawesi Tenggara.',
                content: 'Lengkap...',
                image:
                    'https://images.unsplash.com/photo-1573164713714-d95e436ab78d?auto=format&fit=crop&q=80&w=800',
                category: 'press-release',
                date: '15 Februari 2026',
                author: 'Tim Redaksi',
                views: 1234,
                featured: true,
            },
            {
                id: 2,
                title: 'Rapat Koordinasi PPID Se-Kabupaten Konawe 2026',
                excerpt:
                    'Seluruh PPID Kecamatan se-Kabupaten Konawe mengikuti rapat koordinasi di Aula Diskominfo untuk evaluasi layanan informasi.',
                image:
                    'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&q=80&w=800',
                category: 'kegiatan',
                date: '10 Februari 2026',
                author: 'Humas PPID',
                views: 856,
                featured: false,
            },
            {
                id: 3,
                title: 'Kebijakan Baru: Permohonan Informasi Online',
                excerpt:
                    'PPID Konawe meluncurkan sistem permohonan informasi online untuk memudahkan masyarakat mengakses informasi publik.',
                image:
                    'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800',
                category: 'kebijakan',
                date: '5 Februari 2026',
                author: 'Admin',
                views: 2103,
                featured: false,
            },
            {
                id: 4,
                title: 'Sosialisasi UU KIP di Kecamatan Unaaha',
                excerpt:
                    'Tim PPID melakukan sosialisasi Undang-Undang Keterbukaan Informasi Publik kepada masyarakat di Kecamatan Unaaha.',
                image:
                    'https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&q=80&w=800',
                category: 'kegiatan',
                date: '1 Februari 2026',
                author: 'Tim Lapangan',
                views: 567,
                featured: false,
            },
            {
                id: 5,
                title: 'Artikel: Pentingnya Transparansi Informasi',
                excerpt:
                    'Opini dari Kepala Diskominfo tentang peran transparansi informasi dalam mewujudkan good governance di daerah.',
                image:
                    'https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&q=80&w=800',
                category: 'artikel',
                date: '28 Januari 2026',
                author: 'Ahmad Sulaiman',
                views: 1432,
                featured: false,
            },
            {
                id: 6,
                title: 'Pengumuman: Layanan Libur Hari Raya',
                excerpt: 'Informasi jadwal layanan PPID selama libur Hari Raya Idul Fitri 1447 H.',
                image:
                    'https://images.unsplash.com/photo-1586473213554-a6d4be3aad8a?auto=format&fit=crop&q=80&w=800',
                category: 'pengumuman',
                date: '25 Januari 2026',
                author: 'Admin',
                views: 723,
                featured: false,
            },
            {
                id: 7,
                title: 'Pelatihan Pengelolaan Website PPID Desa',
                excerpt: 'Bimbingan teknis bagi operator website PPID desa se-Kabupaten Konawe.',
                image:
                    'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&q=80&w=800',
                category: 'kegiatan',
                date: '20 Januari 2026',
                author: 'Tim IT',
                views: 891,
                featured: false,
            },
            {
                id: 8,
                title: 'Press Release: Kunjungan Kerja Komisi Informasi Provinsi',
                excerpt:
                    'Komisi Informasi Provinsi melakukan visitasi ke PPID Kabupaten Konawe untuk monitoring kinerja.',
                image:
                    'https://images.unsplash.com/photo-1560179707-f14e90ef3623?auto=format&fit=crop&q=80&w=800',
                category: 'press-release',
                date: '15 Januari 2026',
                author: 'Humas',
                views: 634,
                featured: false,
            },
            {
                id: 9,
                title: 'Layanan Informasi Publik Capai 500 Permohonan',
                excerpt:
                    'Sepanjang tahun 2025, PPID Konawe telah melayani lebih dari 500 permohonan informasi dari masyarakat.',
                image:
                    'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&q=80&w=800',
                category: 'artikel',
                date: '10 Januari 2026',
                author: 'Statistik PPID',
                views: 1102,
                featured: false,
            },
        ];

        // State
        let currentFilter = 'all';
        let currentPage = 1;
        let searchTerm = '';
        const itemsPerPage = 6;
        let filteredNews = [...newsData];

        // DOM Elements
        const newsGrid = document.getElementById('news-grid');
        const loadingIndicator = document.getElementById('loading-indicator');
        const noResults = document.getElementById('no-results');
        const paginationContainer = document.getElementById('pagination-container');
        const popularPostsContainer = document.getElementById('popular-posts');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const searchInput = document.getElementById('search-news');

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            // Simulate loading
            setTimeout(() => {
                renderNews();
                renderPopularPosts();
                loadingIndicator.style.display = 'none';
                newsGrid.style.opacity = '1';
            }, 800);

            // Update current date
            const currentDateElement = document.getElementById('current-date');
            if (currentDateElement) {
                const now = new Date();
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                currentDateElement.textContent = now.toLocaleDateString('id-ID', options);
            }
        });

        // Render News
        function renderNews() {
            // Filter by category
            if (currentFilter === 'all') {
                filteredNews = [...newsData];
            } else {
                filteredNews = newsData.filter((item) => item.category === currentFilter);
            }

            // Filter by search term
            if (searchTerm) {
                filteredNews = filteredNews.filter(
                    (item) =>
                        item.title.toLowerCase().includes(searchTerm) ||
                        item.excerpt.toLowerCase().includes(searchTerm),
                );
            }

            // Pagination
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const newsToShow = filteredNews.slice(startIndex, endIndex);
            const totalPages = Math.ceil(filteredNews.length / itemsPerPage);

            // Clear grid
            newsGrid.innerHTML = '';

            if (newsToShow.length === 0) {
                noResults.classList.remove('hidden');
                paginationContainer.innerHTML = '';
                return;
            }

            noResults.classList.add('hidden');

            // Render news items
            newsToShow.forEach((item) => {
                const newsCard = document.createElement('div');
                newsCard.className = 'news-card';

                // Format category for display
                const categoryDisplay =
                    {
                        kegiatan: 'Kegiatan',
                        kebijakan: 'Kebijakan',
                        pengumuman: 'Pengumuman',
                        artikel: 'Artikel',
                        'press-release': 'Press Release',
                    }[item.category] || item.category;

                newsCard.innerHTML = `
            <div class="news-image-container">
              <img src="${item.image}" alt="${item.title}" class="news-image" loading="lazy">
              <span class="news-category">${categoryDisplay}</span>
              <span class="news-date"><i class="fa-regular fa-calendar mr-1"></i> ${item.date}</span>
            </div>
            <div class="news-content">
              <h3 class="news-title">${item.title}</h3>
              <p class="news-excerpt">${item.excerpt}</p>
              <div class="news-meta">
                <span><i class="fa-regular fa-user mr-1"></i> ${item.author}</span>
                <span><i class="fa-regular fa-eye mr-1"></i> ${item.views}x</span>
              </div>
              <a href="#" class="read-more mt-4">
                Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          `;

                newsGrid.appendChild(newsCard);
            });

            // Render pagination
            renderPagination(totalPages);
        }

        // Render Pagination
        function renderPagination(totalPages) {
            if (totalPages <= 1) {
                paginationContainer.innerHTML = '';
                return;
            }

            let paginationHTML = `
          <button class="pagination-btn" id="prev-page" ${currentPage === 1 ? 'disabled style="opacity:0.5; cursor:not-allowed;"' : ''}>
            <i class="fa-solid fa-chevron-left"></i>
          </button>
        `;

            for (let i = 1; i <= totalPages; i++) {
                paginationHTML += `
            <button class="pagination-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">
              ${i}
            </button>
          `;
            }

            paginationHTML += `
          <button class="pagination-btn" id="next-page" ${currentPage === totalPages ? 'disabled style="opacity:0.5; cursor:not-allowed;"' : ''}>
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        `;

            paginationContainer.innerHTML = paginationHTML;

            // Add event listeners to pagination buttons
            document.querySelectorAll('.pagination-btn[data-page]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    currentPage = parseInt(btn.dataset.page);
                    renderNews();
                    window.scrollTo({ top: newsGrid.offsetTop - 100, behavior: 'smooth' });
                });
            });

            const prevBtn = document.getElementById('prev-page');
            const nextBtn = document.getElementById('next-page');

            if (prevBtn && currentPage > 1) {
                prevBtn.addEventListener('click', () => {
                    currentPage--;
                    renderNews();
                    window.scrollTo({ top: newsGrid.offsetTop - 100, behavior: 'smooth' });
                });
            }

            if (nextBtn && currentPage < totalPages) {
                nextBtn.addEventListener('click', () => {
                    currentPage++;
                    renderNews();
                    window.scrollTo({ top: newsGrid.offsetTop - 100, behavior: 'smooth' });
                });
            }
        }

        // Render Popular Posts
        function renderPopularPosts() {
            // Sort by views and take top 5
            const popular = [...newsData].sort((a, b) => b.views - a.views).slice(0, 5);

            popularPostsContainer.innerHTML = '';

            popular.forEach((item) => {
                const post = document.createElement('a');
                post.href = '#';
                post.className = 'popular-post';

                post.innerHTML = `
            <img src="${item.image}" alt="${item.title}" class="popular-post-image">
            <div class="popular-post-content">
              <h4>${item.title}</h4>
              <p class="text-xs text-slate-500 mt-1">
                <i class="fa-regular fa-calendar mr-1"></i> ${item.date}
              </p>
              <p class="text-xs text-slate-500">
                <i class="fa-regular fa-eye mr-1"></i> ${item.views} dilihat
              </p>
            </div>
          `;

                popularPostsContainer.appendChild(post);
            });
        }

        // Filter functionality
        filterButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                filterButtons.forEach((b) => {
                    b.classList.remove('active');
                    b.classList.remove('bg-primary', 'text-white');
                    b.classList.add('bg-white', 'text-primary');
                });

                btn.classList.add('active');
                btn.classList.remove('bg-white', 'text-primary');
                btn.classList.add('bg-primary', 'text-white');

                currentFilter = btn.dataset.filter;
                currentPage = 1;
                renderNews();
            });
        });

        // Search functionality
        searchInput.addEventListener('input', (e) => {
            searchTerm = e.target.value.toLowerCase().trim();
            currentPage = 1;
            renderNews();
        });
        

        // Newsletter form
        document.getElementById('newsletter-form').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Terima kasih telah berlangganan newsletter PPID Konawe!');
        });
    </script>
@endpush

