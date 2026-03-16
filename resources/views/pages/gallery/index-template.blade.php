@extends('layouts.app')

@section('title', 'Galeri')

@push('scripts-head')
    <!-- Simple Lightbox CSS (lebih ringan dan stabil) -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.css"
    />
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
        /* Custom Styles */
        .transition-soft {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hero-gradient {
            background: linear-gradient(135deg, #f8fafc 0%, #e8f2ff 50%, #f0f9ff 100%);
        }

        /* Gallery Card Styles */
        .gallery-card {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px -10px rgba(31, 58, 138, 0.2);
            cursor: pointer;
            height: 350px;
            display: block;
            text-decoration: none;
            background: linear-gradient(135deg, #1f3a8a 0%, #3b82f6 100%);
        }

        .gallery-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            display: block;
        }

        .gallery-card:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(31, 58, 138, 0.95), transparent);
            padding: 2rem 1.5rem 1.5rem;
            transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            color: white;
            pointer-events: none;
        }

        .gallery-card:hover .gallery-overlay {
            transform: translateY(0);
        }

        .gallery-overlay h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-family: 'Poppins', sans-serif;
        }

        .gallery-overlay p {
            font-size: 0.9rem;
            opacity: 0.9;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .gallery-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.3);
            z-index: 10;
            pointer-events: none;
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

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #64748b;
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: #1f3a8a;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: #172554;
            text-decoration: underline;
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

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Card Hover for Video Section */
        .card-hover {
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .gallery-card {
                height: 280px;
            }

            .gallery-overlay {
                padding: 1.5rem 1rem 1rem;
            }

            .gallery-overlay h3 {
                font-size: 1rem;
            }

            .gallery-overlay p {
                font-size: 0.8rem;
            }

            .filter-btn {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }
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
    <main class="overflow-hidden">
        <!-- Gallery Hero Section (Dari kode ke-2) -->
        <section class="hero-gradient relative overflow-hidden pt-20 pb-16 px-6 md:px-12">
            <div class="max-w-7xl mx-auto text-center">
                <div
                    class="inline-block px-4 py-1.5 bg-white/80 backdrop-blur-sm text-primary rounded-full text-xs font-bold uppercase tracking-wider mb-6 border border-primary/20"
                >
                    <i class="fa-solid fa-images mr-2"></i> Dokumentasi Visual
                </div>
                <h1
                    class="text-4xl md:text-5xl lg:text-6xl font-black text-dark leading-[1.15] mb-6 animate-fade-in"
                >
                    Gallery <span class="text-primary">Kegiatan</span> PPID
                </h1>
                <p class="text-lg text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Dokumentasi visual kegiatan, pelatihan, dan implementasi keterbukaan informasi publik di
                    Kabupaten Konawe. Setiap gambar bercerita tentang transparansi yang kami wujudkan.
                </p>

                <!-- Gallery Stats (Dari kode ke-2) -->
                <div class="flex flex-wrap justify-center gap-8 mb-12">
                    <div class="text-center">
                        <p class="text-3xl font-black text-primary mb-1">148+</p>
                        <p class="text-slate-600 text-sm">Foto Kegiatan</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-black text-primary mb-1">24</p>
                        <p class="text-slate-600 text-sm">Album</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-black text-primary mb-1">2023-2026</p>
                        <p class="text-slate-600 text-sm">Dokumentasi</p>
                    </div>
                </div>
            </div>

            <!-- Decorative Elements (Dari kode ke-2) -->
            <div
                class="absolute top-20 right-10 w-40 h-40 bg-primary/5 rounded-full blur-3xl"
                aria-hidden="true"
            ></div>
            <div
                class="absolute bottom-10 left-10 w-60 h-60 bg-blue-100/30 rounded-full blur-3xl"
                aria-hidden="true"
            ></div>
        </section>

        <!-- Filter Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 py-10">
            <div class="flex flex-wrap justify-center gap-3">
                <button class="filter-btn active" data-filter="all">Semua Foto</button>
                <button class="filter-btn" data-filter="kegiatan">Kegiatan PPID</button>
                <button class="filter-btn" data-filter="sosialisasi">Sosialisasi</button>
                <button class="filter-btn" data-filter="dokumentasi">Dokumentasi</button>
                <button class="filter-btn" data-filter="infrastruktur">Infrastruktur</button>
            </div>
        </section>

        <!-- Gallery Grid -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 pb-20">
            <div class="gallery-grid" id="gallery-grid">
                <!-- Gallery items akan diisi oleh JavaScript -->
            </div>
            <div class="spinner-container" id="spinner-container">
                <div class="loading-spinner"></div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12" id="load-more-container" style="display: none">
                <button
                    id="load-more"
                    class="bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold shadow-lg transition-soft transform hover:-translate-y-0.5 inline-flex items-center gap-2"
                >
                    <i class="fa-solid fa-rotate-right"></i>
                    Muat Lebih Banyak
                </button>
                <p class="text-slate-500 text-sm mt-4" id="showing-count"></p>
            </div>
        </section>

        <!-- Photo of the Month (Dari kode ke-2) -->
        <section class="py-20 max-w-7xl mx-auto px-6 md:px-12">
            <div class="bg-gradient-to-r from-primary-subtle to-blue-50 rounded-3xl p-8 md:p-12">
                <div class="flex flex-col lg:flex-row items-center gap-10">
                    <div class="lg:w-2/5">
                        <div class="bg-white rounded-2xl p-2 shadow-2xl">
                            <img
                                src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=800"
                                alt="Foto Bulan Ini"
                                class="rounded-xl w-full h-64 md:h-80 object-cover"
                            />
                        </div>
                    </div>
                    <div class="lg:w-3/5">
                        <div
                            class="inline-block px-4 py-1.5 bg-white text-primary rounded-full text-xs font-bold uppercase tracking-wider mb-6"
                        >
                            <i class="fa-solid fa-crown mr-2"></i> Foto Bulan Ini
                        </div>
                        <h2 class="text-3xl md:text-4xl font-black text-dark mb-6">
                            Pelatihan PPID bagi Pelajar
                        </h2>
                        <p class="text-slate-700 mb-6 leading-relaxed">
                            Dokumentasi kegiatan pelatihan keterbukaan informasi publik bagi pelajar SMA di
                            Kabupaten Konawe. Kegiatan ini bertujuan untuk mengenalkan pentingnya transparansi
                            informasi sejak dini dan melibatkan generasi muda dalam pengawasan publik.
                        </p>
                        <div class="flex flex-wrap gap-4 mb-8">
                            <div class="flex items-center">
                                <i class="fa-solid fa-calendar text-primary mr-2"></i>
                                <span class="text-slate-700">25 Januari 2026</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fa-solid fa-location-dot text-primary mr-2"></i>
                                <span class="text-slate-700">Aula Diskominfo Konawe</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fa-solid fa-users text-primary mr-2"></i>
                                <span class="text-slate-700">85 Peserta</span>
                            </div>
                        </div>
                        <button
                            class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-semibold transition-soft focus:outline-none focus:ring-4 focus:ring-blue-300"
                        >
                            <i class="fa-solid fa-download mr-2"></i> Unduh Foto
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Video Gallery Section (Dari kode ke-2) -->
        <section class="bg-slate-50 py-20">
            <div class="max-w-7xl mx-auto px-6 md:px-12">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-black text-dark mb-4">Video Dokumentasi</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto">
                        Rekaman kegiatan dan sosialisasi keterbukaan informasi publik di Kabupaten Konawe.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Video 1 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover">
                        <div class="relative h-48 overflow-hidden">
                            <img
                                src="https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?auto=format&fit=crop&q=80&w=800"
                                alt="Pelatihan KIP"
                                class="w-full h-full object-cover"
                            />
                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                <div
                                    class="w-16 h-16 bg-primary/90 rounded-full flex items-center justify-center cursor-pointer hover:bg-primary transition-soft"
                                    onclick="alert('Demo: Video akan diputar di sini.')"
                                >
                                    <i class="fa-solid fa-play text-white text-2xl ml-1"></i>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-xs text-slate-500 mb-3">
                  <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full font-medium">
                    <i class="fa-solid fa-video mr-1"></i> Video
                  </span>
                                <span class="mx-3">•</span>
                                <span>12:45</span>
                            </div>
                            <h3 class="text-lg font-bold mb-3 text-dark">
                                Pelatihan Keterbukaan Informasi Publik 2025
                            </h3>
                            <p class="text-slate-600 text-sm">
                                Pelatihan bagi ASN Kabupaten Konawe tentang implementasi UU KIP.
                            </p>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover">
                        <div class="relative h-48 overflow-hidden">
                            <img
                                src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&q=80&w=800"
                                alt="Sosialisasi PPID"
                                class="w-full h-full object-cover"
                            />
                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                <div
                                    class="w-16 h-16 bg-primary/90 rounded-full flex items-center justify-center cursor-pointer hover:bg-primary transition-soft"
                                    onclick="alert('Demo: Video akan diputar di sini.')"
                                >
                                    <i class="fa-solid fa-play text-white text-2xl ml-1"></i>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-xs text-slate-500 mb-3">
                  <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full font-medium">
                    <i class="fa-solid fa-video mr-1"></i> Video
                  </span>
                                <span class="mx-3">•</span>
                                <span>08:22</span>
                            </div>
                            <h3 class="text-lg font-bold mb-3 text-dark">Sosialisasi Portal PPID Konawe</h3>
                            <p class="text-slate-600 text-sm">
                                Pengenalan portal PPID Konawe kepada masyarakat di kecamatan.
                            </p>
                        </div>
                    </div>

                    <!-- Video 3 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover">
                        <div class="relative h-48 overflow-hidden">
                            <img
                                src="https://images.unsplash.com/photo-1545235617-9465d2a55698?auto=format&fit=crop&q=80&w=800"
                                alt="Wawancara Kepala Diskominfo"
                                class="w-full h-full object-cover"
                            />
                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                <div
                                    class="w-16 h-16 bg-primary/90 rounded-full flex items-center justify-center cursor-pointer hover:bg-primary transition-soft"
                                    onclick="alert('Demo: Video akan diputar di sini.')"
                                >
                                    <i class="fa-solid fa-play text-white text-2xl ml-1"></i>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-xs text-slate-500 mb-3">
                  <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full font-medium">
                    <i class="fa-solid fa-video mr-1"></i> Video
                  </span>
                                <span class="mx-3">•</span>
                                <span>15:30</span>
                            </div>
                            <h3 class="text-lg font-bold mb-3 text-dark">Wawancara Kepala Diskominfo Konawe</h3>
                            <p class="text-slate-600 text-sm">
                                Wawancara eksklusif tentang perkembangan transparansi informasi di Konawe.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <!-- Simple Lightbox JS (diletakkan di akhir) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.js"></script>

    <script>
        // Data galeri foto dengan URL yang sudah terverifikasi
        const galleryData = [
            {
                id: 1,
                src: 'https://images.pexels.com/photos/2774556/pexels-photo-2774556.jpeg?auto=compress&cs=tinysrgb&w=1200',
                thumbnail:
                    'https://images.pexels.com/photos/2774556/pexels-photo-2774556.jpeg?auto=compress&cs=tinysrgb&w=800',
                title: 'Rapat Koordinasi PPID',
                description:
                    'Rapat koordinasi tahunan PPID Kabupaten Konawe dalam rangka evaluasi kinerja pelayanan informasi publik.',
                date: '5 Februari 2026',
                category: 'kegiatan',
            },
            {
                id: 2,
                src: 'https://images.pexels.com/photos/3184424/pexels-photo-3184424.jpeg?auto=compress&cs=tinysrgb&w=1200',
                thumbnail:
                    'https://images.pexels.com/photos/3184424/pexels-photo-3184424.jpeg?auto=compress&cs=tinysrgb&w=800',
                title: 'Sosialisasi Keterbukaan Informasi',
                description:
                    'Sosialisasi UU KIP kepada masyarakat di Kecamatan Unaaha tentang hak memperoleh informasi publik.',
                date: '1 Februari 2026',
                category: 'sosialisasi',
            },
            {
                id: 3,
                src: 'https://images.pexels.com/photos/256150/pexels-photo-256150.jpeg?auto=compress&cs=tinysrgb&w=1200',
                thumbnail:
                    'https://images.pexels.com/photos/256150/pexels-photo-256150.jpeg?auto=compress&cs=tinysrgb&w=800',
                title: 'Kantor PPID Konawe',
                description:
                    'Gedung layanan PPID Kabupaten Konawe yang representatif untuk melayani masyarakat.',
                date: '28 Januari 2026',
                category: 'infrastruktur',
            },
            {
                id: 4,
                src: 'https://images.pexels.com/photos/5668470/pexels-photo-5668470.jpeg?auto=compress&cs=tinysrgb&w=1200',
                thumbnail:
                    'https://images.pexels.com/photos/5668470/pexels-photo-5668470.jpeg?auto=compress&cs=tinysrgb&w=800',
                title: 'Tim PPID Sedang Bekerja',
                description:
                    'Tim PPID Kabupaten Konawe sedang melayani permohonan informasi dari masyarakat.',
                date: '20 Januari 2026',
                category: 'dokumentasi',
            },
            {
                id: 5,
                src: 'https://images.pexels.com/photos/3194519/pexels-photo-3194519.jpeg?auto=compress&cs=tinysrgb&w=1200',
                thumbnail:
                    'https://images.pexels.com/photos/3194519/pexels-photo-3194519.jpeg?auto=compress&cs=tinysrgb&w=800',
                title: 'Pelatihan ASN PPID',
                description:
                    'Pelatihan peningkatan kapasitas ASN dalam pengelolaan informasi dan dokumentasi.',
                date: '15 Januari 2026',
                category: 'kegiatan',
            },
            {
                id: 6,
                src: 'https://images.pexels.com/photos/1181605/pexels-photo-1181605.jpeg?auto=compress&cs=tinysrgb&w=1200',
                thumbnail:
                    'https://images.pexels.com/photos/1181605/pexels-photo-1181605.jpeg?auto=compress&cs=tinysrgb&w=800',
                title: 'Layanan Informasi Publik',
                description:
                    'Suasana pelayanan informasi publik di kantor PPID Kabupaten Konawe yang ramah dan profesional.',
                date: '10 Januari 2026',
                category: 'dokumentasi',
            },
        ];

        let currentFilter = 'all';
        let visibleItems = 6;
        let filteredData = [...galleryData];
        let lightbox = null;

        // Fungsi untuk merender gallery
        function renderGallery() {
            const grid = document.getElementById('gallery-grid');
            const spinner = document.getElementById('spinner-container');
            const loadMoreContainer = document.getElementById('load-more-container');
            const showingCount = document.getElementById('showing-count');

            // Sembunyikan spinner
            if (spinner) {
                spinner.style.display = 'none';
            }

            // Filter data
            if (currentFilter === 'all') {
                filteredData = [...galleryData];
            } else {
                filteredData = galleryData.filter((item) => item.category === currentFilter);
            }

            // Ambil data yang akan ditampilkan
            const dataToShow = filteredData.slice(0, visibleItems);

            // Kosongkan grid
            grid.innerHTML = '';

            // Render setiap item gallery
            dataToShow.forEach((item) => {
                const galleryItem = document.createElement('a');
                galleryItem.href = item.src;
                galleryItem.className = 'gallery-card';

                // Buat struktur HTML untuk setiap card
                galleryItem.innerHTML = `
            <img src="${item.thumbnail}"
                 alt="${item.title}"
                 loading="lazy"
                 onload="this.style.opacity='1'"
                 style="opacity: 0; transition: opacity 0.3s ease;">
            <div class="gallery-badge">
              <i class="fa-regular fa-calendar mr-1"></i> ${item.date}
            </div>
            <div class="gallery-overlay">
              <h3>${item.title}</h3>
              <p>${item.description}</p>
            </div>
          `;

                grid.appendChild(galleryItem);
            });

            // Inisialisasi SimpleLightbox
            if (lightbox) {
                lightbox.destroy();
            }
            lightbox = new SimpleLightbox('.gallery-card', {
                captions: true,
                captionSelector: 'img',
                captionType: 'attr',
                captionsData: 'alt',
                captionPosition: 'bottom',
                captionDelay: 0,
                animationSpeed: 300,
                fadeSpeed: 300,
                overlayOpacity: 0.9,
                uniqueImages: true,
                disableScroll: true,
                close: true,
                nav: true,
                navText: ['←', '→'],
                closeText: '×',
            });

            // Update showing count
            if (showingCount) {
                const totalItems = filteredData.length;
                const showingItems = dataToShow.length;
                showingCount.textContent = `Menampilkan ${showingItems} dari ${totalItems} foto`;
            }

            // Tampilkan/sembunyikan tombol load more
            if (visibleItems >= filteredData.length || filteredData.length <= 6) {
                loadMoreContainer.style.display = 'none';
            } else {
                loadMoreContainer.style.display = 'block';
            }
        }

        // Filter functionality
        document.querySelectorAll('.filter-btn').forEach((btn) => {
            btn.addEventListener('click', (e) => {
                // Update active class
                document.querySelectorAll('.filter-btn').forEach((b) => b.classList.remove('active'));
                btn.classList.add('active');

                // Update filter
                currentFilter = btn.dataset.filter;
                visibleItems = 6; // Reset visible items
                renderGallery();

                // Scroll ke gallery
                document
                    .getElementById('gallery-grid')
                    .scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Load more functionality
        document.getElementById('load-more').addEventListener('click', () => {
            visibleItems += 3;
            renderGallery();
        });

        // Render gallery setelah DOM siap
        document.addEventListener('DOMContentLoaded', () => {
            renderGallery();
        });
    </script>
@endpush
