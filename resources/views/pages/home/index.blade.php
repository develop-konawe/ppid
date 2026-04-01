@extends('layouts.app')

@push('meta-head')
    <!-- Open Graph / Social Media Meta Tags -->
    <meta
        property="og:title"
        content="PPID Kabupaten Konawe - Portal Informasi Publik Transparan"
    />
    <meta
        property="og:description"
        content="Akses informasi publik Kabupaten Konawe secara transparan dan mudah"
    />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://ppid.konawelkab.go.id" />
@endpush

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
                        'slide-left': 'slideLeft 0.6s ease-out',
                        'fade-slide': 'fadeSlide 0.8s ease-out',
                        'zoom-in': 'zoomIn 1.2s ease-out',
                        float: 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'bounce-soft': 'bounceSoft 2s ease-in-out infinite',
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
                        slideLeft: {
                            '0%': { transform: 'translateX(20px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        fadeSlide: {
                            '0%': { transform: 'translateY(30px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        zoomIn: {
                            '0%': { transform: 'scale(1.1)', opacity: '0.8' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        bounceSoft: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-5px)' },
                        },
                    },
                },
            },
        };
    </script>
@endpush

@push('styles')
    <style>
        .card-hover {
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(31, 58, 138, 0.15);
        }

        /* CAROUSEL FIX - Ukuran tetap dan gambar cover penuh */
        .carousel-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 650px;
            background: linear-gradient(135deg, #1e3a8a 0%, #2d4ba0 100%);
        }

        .carousel-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .carousel-slide.active {
            opacity: 1;
            z-index: 1;
        }

        .carousel-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
            display: block;
            background: transparent;
        }

        @media (max-width: 1024px) {
            .carousel-container {
                height: 500px;
            }
        }

        @media (max-width: 768px) {
            .carousel-container {
                height: 400px;
            }
        }

        @media (max-width: 480px) {
            .carousel-container {
                height: 300px;
            }
        }

        .fade-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition:
                opacity 0.6s ease,
                transform 0.6s ease;
        }

        .fade-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .counter-value {
            display: inline-block;
            transition: all 0.3s ease;
        }

        .counter-value.changed {
            transform: scale(1.1);
            color: #1f3a8a;
        }

        .ripple-light {
            position: relative;
            overflow: hidden;
        }

        .ripple-light::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            opacity: 0;
            transition:
                transform 0.5s ease-out,
                opacity 0.3s ease-out;
        }

        .ripple-light:active::after {
            transform: translate(-50%, -50%) scale(50);
            opacity: 1;
            transition: 0s;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        #pengumuman-slider {
            will-change: transform;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .bg-gradient-to-br {
            background-size: 200% 200%;
            animation: gradientShift 15s ease infinite;
        }

        /* Social Media Hover Effects */
        .social-icon {
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-8px) scale(1.1);
        }

        .social-icon.facebook:hover {
            background: #1877f2;
            box-shadow: 0 10px 20px -5px #1877f2;
        }

        .social-icon.tiktok:hover {
            background: #000000;
            box-shadow: 0 10px 20px -5px #333;
        }

        .social-icon.instagram:hover {
            background: linear-gradient(45deg, #f09433, #d62976, #962fbf);
            box-shadow: 0 10px 20px -5px #d62976;
        }

        .social-icon.youtube:hover {
            background: #ff0000;
            box-shadow: 0 10px 20px -5px #ff0000;
        }

        .social-icon.x:hover {
            background: #000000;
            box-shadow: 0 10px 20px -5px #333;
        }

        .social-icon.threads:hover {
            background: #000000;
            box-shadow: 0 10px 20px -5px #333;
        }
    </style>
@endpush

@section('content')
    <main id="home" class="overflow-hidden">
        <!-- Full Width Hero Carousel Section - FIXED HEIGHT & COVER IMAGE -->
        <section class="relative overflow-hidden">
            <div class="carousel-container">
                <!-- Carousel Slides -->
                <div class="relative w-full h-full">
                    <!-- Slide 1 - Government Focus -->
                    <div class="carousel-slide active" data-slide="1">
                        <img
                            src="https://ppid.konawekab.go.id/storage/banners/01KGNRCM0SYD59DGMTHRGVSKK3.jpg"
                            alt="Pemerintah Kabupaten Konawe - Kantor Bupati"
                            class="carousel-image"
                            loading="eager"
                            onload="this.style.opacity = '1'"
                            style="opacity: 0; transition: opacity 0.3s"
                        />
                    </div>

                    <!-- Slide 2 - Public Service -->
                    <div class="carousel-slide" data-slide="2">
                        <img
                            src="https://ppid.konawekab.go.id/storage/banners/01KGNR3WZ6B9BT47VTTZRSGBBA.jpg"
                            alt="Pelayanan Publik di Konawe"
                            class="carousel-image"
                            loading="lazy"
                            onload="this.style.opacity = '1'"
                            style="opacity: 0; transition: opacity 0.3s"
                        />
                    </div>

                    <!-- Slide 3 - Transparency -->
                    <div class="carousel-slide" data-slide="3">
                        <img
                            src="https://images.unsplash.com/photo-1589652717521-10c0d092dea9?auto=format&fit=crop&q=80&w=1920"
                            alt="Transparansi Informasi Publik"
                            class="carousel-image"
                            loading="lazy"
                            onload="this.style.opacity = '1'"
                            style="opacity: 0; transition: opacity 0.3s"
                        />
                    </div>

                    <!-- Slide 4 - Community Engagement -->
                    <div class="carousel-slide" data-slide="4">
                        <img
                            src="https://ppid.konawekab.go.id/storage/banners/01KFW5M2Y7KFD0MTY6HPK28ZTD.png"
                            alt="Partisipasi Masyarakat Konawe"
                            class="carousel-image"
                            loading="lazy"
                            onload="this.style.opacity = '1'"
                            style="opacity: 0; transition: opacity 0.3s"
                        />
                    </div>
                </div>

                <!-- Carousel Navigation -->
                <button
                    id="carousel-prev"
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-soft z-20 hover-scale"
                >
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button
                    id="carousel-next"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-soft z-20 hover-scale"
                >
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

                <!-- Carousel Dots -->
                <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex gap-3 z-20">
                    <button
                        class="carousel-dot w-12 h-2 bg-white/50 rounded-full hover:bg-white/80 transition-soft active hover-scale"
                        data-slide="0"
                    ></button>
                    <button
                        class="carousel-dot w-12 h-2 bg-white/50 rounded-full hover:bg-white/80 transition-soft hover-scale"
                        data-slide="1"
                    ></button>
                    <button
                        class="carousel-dot w-12 h-2 bg-white/50 rounded-full hover:bg-white/80 transition-soft hover-scale"
                        data-slide="2"
                    ></button>
                    <button
                        class="carousel-dot w-12 h-2 bg-white/50 rounded-full hover:bg-white/80 transition-soft hover-scale"
                        data-slide="3"
                    ></button>
                </div>

                <!-- Slide Indicator -->
                <div
                    class="absolute top-6 right-6 bg-black/30 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium z-20"
                >
                    <span id="current-slide">1</span> / <span id="total-slides">4</span>
                </div>
            </div>

            <!-- Quick Access Bar -->
            <div class="bg-white border-t border-slate-200 py-4">
                <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
                    <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2 group">
                                <div
                                    class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-soft"
                                >
                                    <i class="fa-solid fa-file-lines text-primary group-hover:text-white"></i>
                                </div>
                                <div>
                                    <p class="text-2xl font-black text-primary counter-value" data-target="1240">
                                        1,240+
                                    </p>
                                    <p class="text-slate-600 text-xs">Dokumen Publik</p>
                                </div>
                            </div>
                            <div class="h-8 w-px bg-slate-300"></div>
                            <div class="flex items-center gap-2 group">
                                <div
                                    class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition-soft"
                                >
                                    <i
                                        class="fa-solid fa-clock-rotate-left text-green-600 group-hover:text-white"
                                    ></i>
                                </div>
                                <div>
                                    <p class="text-2xl font-black text-green-600 counter-value" data-target="100">
                                        100%
                                    </p>
                                    <p class="text-slate-600 text-xs">Kepatuhan Waktu</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <a
                                href="#download"
                                class="flex items-center gap-2 px-4 py-2 bg-primary-subtle text-primary rounded-lg hover:bg-primary hover:text-white transition-soft text-sm font-medium hover-lift"
                            >
                                <i class="fa-solid fa-download"></i>
                                <span class="hidden md:inline">Download Formulir</span>
                            </a>
                            <a
                                href="#status"
                                class="flex items-center gap-2 px-4 py-2 bg-primary-subtle text-primary rounded-lg hover:bg-primary hover:text-white transition-soft text-sm font-medium hover-lift"
                            >
                                <i class="fa-solid fa-search"></i>
                                <span class="hidden md:inline">Cek Status</span>
                            </a>
                            <a
                                href="#faq"
                                class="flex items-center gap-2 px-4 py-2 bg-primary-subtle text-primary rounded-lg hover:bg-primary hover:text-white transition-soft text-sm font-medium hover-lift"
                            >
                                <i class="fa-solid fa-question-circle"></i>
                                <span class="hidden md:inline">FAQ</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Search Section -->
        <section class="max-w-6xl mx-auto px-4 md:px-8 lg:px-12 mb-16 mt-8">

            <form action="{{ url('/search') }}" method="GET" class="bg-white p-2 rounded-2xl shadow-2xl flex flex-col md:flex-row gap-2 border border-slate-100 hover-glow">

                <div class="flex-grow flex items-center px-4">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 mr-3" aria-hidden="true"></i>
                    <input
                        type="text"
                        name="q"
                        placeholder="Cari informasi publik, dokumen, atau berita..."
                        class="w-full py-4 outline-none text-sm text-slate-700 placeholder-slate-400"
                        aria-label="Pencarian informasi publik"
                        required
                    />
                </div>

                <select name="kategori" class="md:w-56 px-4 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary/50 cursor-pointer font-medium transition-all">
                    <option value="">Semua Kategori</option>
                    <option value="berita">Berita</option>
                    <option value="pengumuman">Pengumuman</option>
                    <option value="dokumen">Dokumen Publik</option>
                    <option value="berkala">Informasi Berkala</option>
                    <option value="serta-merta">Informasi Serta Merta</option>
                    <option value="setiap-saat">Informasi Setiap Saat</option>
                </select>

                <button
                    type="submit"
                    class="bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold shadow-lg transition-soft transform hover:-translate-y-0.5 ripple-light"
                >
                    <i class="fa-solid fa-search mr-2"></i> CARI
                </button>
            </form>

            <div class="flex flex-wrap gap-3 mt-4 justify-center items-center">
                <span class="text-slate-500 text-sm">Pencarian cepat:</span>

                <a href="{{ url('/search') }}?q=APBD+2026" class="text-primary hover:text-primary-dark text-sm font-medium hover:underline hover-border">
                    APBD 2026
                </a>
                <span class="text-slate-300">•</span>

                <a href="{{ url('/search') }}?q=Peraturan+Daerah" class="text-primary hover:text-primary-dark text-sm font-medium hover:underline hover-border">
                    Peraturan Daerah
                </a>
                <span class="text-slate-300">•</span>

                <a href="{{ url('/search') }}?q=Laporan+Keuangan" class="text-primary hover:text-primary-dark text-sm font-medium hover:underline hover-border">
                    Laporan Keuangan
                </a>
                <span class="text-slate-300">•</span>

                <a href="{{ url('/search') }}?q=Profil+Pejabat" class="text-primary hover:text-primary-dark text-sm font-medium hover:underline hover-border">
                    Profil Pejabat
                </a>
            </div>

        </section>

        <!-- Jenis Informasi Section -->
        <section id="jenis-informasi" class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-20">
            <div class="text-center mb-12 fade-scroll">
                <h2 class="text-3xl md:text-4xl font-black text-dark mb-4">JENIS INFORMASI PUBLIK</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">
                    PPID Kabupaten Konawe menyediakan berbagai jenis informasi publik sesuai dengan
                    klasifikasi yang diatur dalam peraturan perundang-undangan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Informasi Berkala -->
                <div
                    class="bg-white p-8 rounded-3xl shadow-xl card-hover border border-slate-50 group fade-scroll"
                >
                    <div
                        class="w-14 h-14 bg-blue-50 text-primary rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-primary group-hover:text-white transition-soft"
                    >
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark">Informasi Berkala</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-4">
                        Informasi yang wajib diperbaharui secara rutin dan berkala setiap periode tertentu.
                    </p>
                    <a
                        href="{{ route('ppid.berkala') }}"
                        class="text-primary text-sm font-semibold inline-flex items-center group-hover:underline"
                    >
                        Lihat dokumen
                        <i
                            class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"
                        ></i>
                    </a>
                </div>

                <!-- Informasi Serta Merta -->
                <div
                    class="bg-white p-8 rounded-3xl shadow-xl card-hover border border-slate-50 group fade-scroll"
                >
                    <div
                        class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-orange-500 group-hover:text-white transition-soft"
                    >
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark">Serta Merta</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-4">
                        Informasi darurat yang dapat mengancam hajat hidup orang banyak dan harus segera
                        diumumkan.
                    </p>
                    <a
                        href="{{ route('ppid.serta-merta') }}"
                        class="text-orange-500 text-sm font-semibold inline-flex items-center group-hover:underline"
                    >
                        Lihat dokumen
                        <i
                            class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"
                        ></i>
                    </a>
                </div>

                <!-- Informasi Setiap Saat -->
                <div
                    class="bg-white p-8 rounded-3xl shadow-xl card-hover border border-slate-50 group fade-scroll"
                >
                    <div
                        class="w-14 h-14 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-green-500 group-hover:text-white transition-soft"
                    >
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark">Setiap Saat</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-4">
                        Informasi yang tersedia dan dapat diakses publik kapan saja tanpa batasan waktu.
                    </p>
                    <a
                        href="{{ route('ppid.setiap-saat') }}"
                        class="text-green-500 text-sm font-semibold inline-flex items-center group-hover:underline"
                    >
                        Lihat dokumen
                        <i
                            class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"
                        ></i>
                    </a>
                </div>

                <!-- Informasi Dikecualikan -->
                <div
                    class="bg-white p-8 rounded-3xl shadow-xl card-hover border border-slate-50 group fade-scroll"
                >
                    <div
                        class="w-14 h-14 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-purple-500 group-hover:text-white transition-soft"
                    >
                        <i class="fa-solid fa-file-shield"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark">Dikecualikan</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-4">
                        Informasi ketat dan terbatas berdasarkan undang-undang untuk melindungi kepentingan
                        negara.
                    </p>
                    <a
                        href="{{ route('ppid.dikecualikan') }}"
                        class="text-purple-500 text-sm font-semibold inline-flex items-center group-hover:underline"
                    >
                        Ketentuan
                        <i
                            class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"
                        ></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Kabar Unggulan Section -->
        <section id="kabar-unggulan" class="py-8 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">

                <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 fade-scroll gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-red-50 text-secondary rounded-full text-xs font-bold uppercase tracking-wider mb-3 border border-red-100">
                            <span class="relative flex h-2.5 w-2.5">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-secondary"></span>
                            </span>
                            Sorotan Utama
                        </div>
                        <h2 class="text-3xl md:text-4xl font-black text-dark tracking-tight">
                            KABAR <span class="text-primary">UNGGULAN</span>
                        </h2>
                    </div>
                    <p class="text-slate-500 text-sm max-w-sm border-l-2 border-slate-200 pl-4 py-1">
                        Informasi dan pengumuman prioritas dari PPID Pemerintah Kabupaten Konawe.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">

                    <div class="lg:col-span-7 relative rounded-3xl overflow-hidden shadow-xl group fade-scroll bg-slate-900 min-h-[450px] lg:min-h-[520px]">

                        <div id="news-slider-container" class="absolute inset-0 flex w-full h-full transition-transform duration-500 ease-in-out">
                            @forelse($beritas as $news)
                                @php $imgUrl = $news->image ? asset('storage/'.$news->image) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=1200'; @endphp

                                <article class="w-full h-full flex-shrink-0 relative">
                                    <img src="{{ $imgUrl }}" alt="{{ $news->title }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>

                                    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                                        <div class="flex items-center gap-3 mb-4">
                                            <span class="bg-primary text-white text-[10px] font-bold uppercase tracking-widest py-1.5 px-3 rounded-md shadow-md">
                                                {{ $news->category->name ?? 'Berita Pilihan' }}
                                            </span>
                                            <span class="text-slate-300 text-xs font-medium flex items-center bg-black/30 backdrop-blur-sm px-3 py-1.5 rounded-md">
                                                <i class="fa-regular fa-calendar mr-1.5"></i>
                                                {{ $news->created_at ? $news->created_at->translatedFormat('d M Y') : '' }}
                                            </span>
                                        </div>
                                        <a href="{{ route('news.detail', $news->slug) }}" class="block">
                                            <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-3 leading-tight hover:text-blue-300 transition-colors drop-shadow-lg">
                                                {{ $news->title }}
                                            </h3>
                                        </a>
                                        <p class="text-slate-300 text-sm md:text-base mb-6 line-clamp-2 leading-relaxed hidden md:block">
                                            {{ Str::limit(html_entity_decode(strip_tags($news->content)), 120) }}
                                        </p>
                                        <a href="{{ route('news.detail', $news->slug) }}" class="inline-flex items-center justify-center bg-white/10 hover:bg-primary text-white backdrop-blur-sm border border-white/20 px-6 py-2.5 rounded-xl font-semibold transition-all duration-300">
                                            Baca Selengkapnya <i class="fa-solid fa-arrow-right ml-2 text-sm"></i>
                                        </a>
                                    </div>
                                </article>
                            @empty
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 p-10">
                                    <i class="fa-regular fa-newspaper text-5xl mb-3 opacity-50"></i>
                                    <p class="font-medium">Belum ada Berita Unggulan.</p>
                                </div>
                            @endforelse
                        </div>

                        @if($beritas->count() > 1)
                            <button id="btn-prev-news" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/10 hover:bg-white/30 backdrop-blur-md border border-white/20 text-white rounded-full flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 -translate-x-4 group-hover:translate-x-0 z-10">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button id="btn-next-news" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/10 hover:bg-white/30 backdrop-blur-md border border-white/20 text-white rounded-full flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 translate-x-4 group-hover:translate-x-0 z-10">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                            <div class="absolute bottom-6 right-6 flex gap-2 z-10" id="news-dots">
                                @foreach($beritas as $index => $news)
                                    <button class="w-2 h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white w-6' : 'bg-white/40 hover:bg-white/70' }}" data-index="{{ $index }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="lg:col-span-5 bg-slate-50 rounded-3xl border border-slate-200 shadow-inner p-6 lg:p-8 flex flex-col relative overflow-hidden min-h-[450px] lg:min-h-[520px] fade-scroll animate-delay-100">
                        <div class="absolute -right-6 -top-6 w-32 h-32 bg-secondary/10 rounded-full blur-3xl pointer-events-none"></div>

                        <div class="flex items-center justify-between mb-6 relative z-10">
                            <h4 class="text-xl font-black text-dark flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-secondary/10 text-secondary flex items-center justify-center">
                                    <i class="fa-solid fa-thumbtack"></i>
                                </div>
                                Papan Pengumuman
                            </h4>
                            @if($pengumumans->count() > 3)
                                <div class="flex gap-1.5" id="ann-dots">
                                    @foreach($pengumumans->chunk(3) as $index => $chunk)
                                        <button class="h-1.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-secondary w-4' : 'bg-slate-300 hover:bg-slate-400 w-1.5' }}" data-index="{{ $index }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="flex-grow relative overflow-hidden group/ann">
                            <div id="ann-slider-container" class="absolute inset-0 flex transition-transform duration-500 ease-in-out w-full h-full">

                                @php
                                    // Memecah pengumuman maksimal 3 item per slide
                                    $annChunks = $pengumumans->chunk(3);
                                @endphp

                                @forelse($annChunks as $chunk)
                                    <div class="w-full h-full flex-shrink-0 flex flex-col gap-4 px-1">
                                        @foreach($chunk as $ann)
                                            <a href="{{ route('announcement.detail', $ann->slug) }}" class="flex flex-col gap-2 p-4 bg-white rounded-2xl shadow-sm hover:shadow-md border border-slate-100 hover:border-secondary/30 transition-all duration-300 hover:-translate-y-1">
                                                <div class="flex items-center justify-between gap-2">
                                                    <span class="text-[10px] font-bold text-secondary uppercase tracking-wider bg-red-50 px-2 py-1 rounded-md">
                                                        <i class="fa-solid fa-circle-exclamation mr-1"></i> Info Penting
                                                    </span>
                                                    <span class="text-[11px] font-semibold text-slate-400">
                                                        {{ $ann->published_at ? \Carbon\Carbon::parse($ann->published_at)->translatedFormat('d M Y') : '' }}
                                                    </span>
                                                </div>
                                                <h5 class="text-sm font-bold text-slate-700 hover:text-primary line-clamp-2 leading-snug mt-1">
                                                    {{ $ann->title }}
                                                </h5>
                                            </a>
                                        @endforeach
                                    </div>
                                @empty
                                    <div class="w-full h-full flex flex-col items-center justify-center text-center opacity-50">
                                        <i class="fa-solid fa-folder-open text-4xl text-slate-300 mb-3"></i>
                                        <p class="text-slate-500 text-sm">Tidak ada pengumuman saat ini.</p>
                                    </div>
                                @endforelse

                            </div>

                            @if($pengumumans->count() > 3)
                                <button id="btn-prev-ann" class="absolute left-0 top-1/2 -translate-y-1/2 w-8 h-8 bg-white shadow-md border border-slate-200 text-slate-600 rounded-full flex items-center justify-center transition-all opacity-0 group-hover/ann:opacity-100 -translate-x-2 group-hover/ann:translate-x-0 z-10 hover:text-secondary">
                                    <i class="fa-solid fa-chevron-left text-xs"></i>
                                </button>
                                <button id="btn-next-ann" class="absolute right-0 top-1/2 -translate-y-1/2 w-8 h-8 bg-white shadow-md border border-slate-200 text-slate-600 rounded-full flex items-center justify-center transition-all opacity-0 group-hover/ann:opacity-100 translate-x-2 group-hover/ann:translate-x-0 z-10 hover:text-secondary">
                                    <i class="fa-solid fa-chevron-right text-xs"></i>
                                </button>
                            @endif
                        </div>

                        <div class="mt-4 text-center relative z-10 pt-4 border-t border-slate-200/60">
                            <a href="{{ route('announcement') }}" class="text-sm font-bold text-slate-500 hover:text-primary transition-colors inline-flex items-center gap-2">
                                Lihat Semua Pengumuman <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>



        <!-- Stats Section -->
        <section id="stats" class="py-16 bg-primary-subtle">
            <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
                <div class="text-center mb-12 fade-scroll">
                    <h2 class="text-3xl md:text-4xl font-black text-dark mb-4">TRANSPARANSI DALAM ANGKA</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto">
                        Komitmen kami terhadap keterbukaan informasi publik tercermin dalam data berikut.
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="bg-white p-8 rounded-3xl shadow-lg hover-lift fade-scroll">
                        <p class="text-4xl font-black text-primary mb-2 counter-value" data-target="1240">
                            1,240
                        </p>
                        <p class="text-slate-700 font-semibold uppercase tracking-wider text-sm">
                            Total Dokumen
                        </p>
                        <p class="text-slate-500 text-xs mt-2">Tersedia untuk publik</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-lg hover-lift fade-scroll">
                        <p class="text-4xl font-black text-primary mb-2 counter-value" data-target="342">
                            342
                        </p>
                        <p class="text-slate-700 font-semibold uppercase tracking-wider text-sm">
                            Permohonan Selesai
                        </p>
                        <p class="text-slate-500 text-xs mt-2">Tahun 2025</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-lg hover-lift fade-scroll">
                        <p class="text-4xl font-black text-primary mb-2 counter-value" data-target="100">
                            100%
                        </p>
                        <p class="text-slate-700 font-semibold uppercase tracking-wider text-sm">
                            Kepatuhan Waktu
                        </p>
                        <p class="text-slate-500 text-xs mt-2">Respon permohonan</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-lg hover-lift fade-scroll">
                        <p class="text-4xl font-black text-primary mb-2 counter-value" data-target="24">24</p>
                        <p class="text-slate-700 font-semibold uppercase tracking-wider text-sm">
                            Kecamatan Terlayani
                        </p>
                        <p class="text-slate-500 text-xs mt-2">Seluruh wilayah Konawe</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== SECTION: BERITA & PENGUMUMAN TERBARU (TABBED) ===== -->
        <section id="info-terbaru" class="py-20 bg-gradient-to-br from-slate-50 to-white">
            <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
                <!-- Section Header -->
                <div class="text-center mb-12 fade-scroll">
                    <h2 class="text-3xl md:text-4xl font-black text-dark mb-4">
                        INFORMASI <span class="text-primary">TERKINI</span>
                    </h2>
                    <p class="text-slate-600 max-w-2xl mx-auto">
                        Kumpulan berita dan pengumuman terbaru dari PPID Kabupaten Konawe
                    </p>
                </div>

                <!-- Tab Navigation -->
                <div class="flex justify-center mb-10 border-b border-slate-200">
                    <button
                        id="tab-berita"
                        class="tab-button active px-6 py-3 font-semibold text-base border-b-2 transition-colors duration-200 text-primary border-primary"
                    >
                        <i class="fa-regular fa-newspaper mr-2"></i> Berita Terbaru
                    </button>
                    <button
                        id="tab-pengumuman"
                        class="tab-button px-6 py-3 font-semibold text-base border-b-2 transition-colors duration-200 text-slate-500 border-transparent hover:text-primary"
                    >
                        <i class="fa-solid fa-bullhorn mr-2"></i> Pengumuman
                    </button>
                </div>

                <!-- Tab Content: Berita -->
                <div id="content-berita" class="tab-content block">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse($latestBeritas->take(3) as $berita)
                            <article
                                class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 card-hover group"
                            >
                                <div class="h-48 overflow-hidden bg-slate-100">
                                    @if($berita->image)
                                        <img src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" onerror="this.src='https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800'"/>
                                    @else
                                        <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800" alt="Berita" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                    @endif
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                                        <span class="bg-blue-100 text-primary px-3 py-1 rounded-full font-medium">Berita</span>
                                        <span><i class="fa-regular fa-calendar mr-1"></i> {{ $berita->created_at ? $berita->created_at->translatedFormat('d M Y') : '' }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold mb-2 text-dark line-clamp-2">
                                        {{ $berita->title }}
                                    </h3>
                                    <p class="text-slate-600 text-sm mb-4 line-clamp-2">
                                        {{ html_entity_decode(strip_tags($berita->description ?? '')) }}
                                    </p>
                                    <a
                                        href="{{ route('news.detail', $berita->slug) }}"
                                        class="text-primary font-semibold text-sm inline-flex items-center hover:underline"
                                    >
                                        Baca selengkapnya <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full text-center py-10 text-slate-500 bg-white rounded-2xl border border-slate-100">Belum ada berita.</div>
                        @endforelse
                    </div>
                    <!-- View All Berita -->
                    <div class="text-center mt-10">
                        <a
                            href="{{ route('news') }}"
                            class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all"
                        >
                            Lihat Semua Berita <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Tab Content: Pengumuman -->
                <div id="content-pengumuman" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Pengumuman Card 1 -->
                        @forelse($latestPengumuman->take(3) as $item)
                            <article
                                class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 card-hover group"
                            >
                                <div class="h-48 overflow-hidden bg-gradient-to-r from-secondary/80 to-secondary">
                                    @if($item->image)
                                        <div class="w-full max-h-[500px] overflow-hidden bg-slate-100 border-b border-slate-100 flex justify-center">
                                            @if(is_file(public_path('storage/'.$item->image)))
                                                <img src="{{ asset('storage/' . $item->image) }}"
                                                     alt="{{ $item->title }}"
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90"
                                                />
                                            @elseif(is_file(public_path($item->image)))
                                                <img src="{{ asset($item->image) }}"
                                                     alt="{{ $item->title }}"
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90"
                                                />

                                            @else
                                                <img src="{{ asset('image/28.jpg') }}"
                                                     alt="{{ $item->title }}"
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90"
                                                />
                                            @endif
                                        </div>
                                    @endif
                                    <img
                                        src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?auto=format&fit=crop&q=80&w=800"
                                        alt="Pengumuman 1"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90"
                                    />
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                        <span class="bg-red-100 text-secondary px-3 py-1 rounded-full font-medium"
                        >{{ $item->category->name ?? '-' }}</span
                        >
                                        <span><i class="fa-regular fa-calendar mr-1"></i> {{ $item->published_at ? $item->published_at->translatedFormat('d M Y') : '-' }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold mb-2 text-dark line-clamp-2">
                                        {{ $item->title }}
                                    </h3>
                                    <p class="text-slate-600 text-sm mb-4 line-clamp-2">
                                        {{ html_entity_decode(strip_tags($item->description)) }}
                                    </p>
                                    <a
                                        href="{{ route('announcement.detail', $item->slug) }}"
                                        class="text-primary font-semibold text-sm inline-flex items-center hover:underline"
                                    >
                                        Baca selengkapnya <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div class="bg-white p-8 rounded-xl shadow-md text-center text-slate-500">Belum ada pengumuman.</div>
                        @endforelse


                    </div>
                    <!-- View All Pengumuman -->
                    <div class="text-center mt-10">
                        <a
                            href="{{ route('announcement') }}"
                            class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all"
                        >
                            Lihat Semua Pengumuman <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section with Zoom In Feature -->
        <section id="gallery" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
                <div class="text-center mb-12 fade-scroll">
                    <h2 class="text-3xl md:text-4xl font-black text-dark mb-4">GALERI FOTO KEGIATAN</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto">Dokumentasi berbagai kegiatan dan momen penting seputar PPID Kabupaten Konawe.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        // Ambil 6 foto terbaru jika dikirim dari controller, atau gunakan kosong sebagai fallback
                        $galleryPhotos = isset($gallery) ? $gallery->where('type', 'photo')->take(6) : [];
                        $loopIndex = 0;
                    @endphp

                    @forelse($galleryPhotos as $item)
                        @php $mediaSrc = $item->media_path ? asset('storage/' . $item->media_path) : $item->media_url; @endphp
                        <div class="gallery-item relative overflow-hidden rounded-2xl shadow-lg cursor-pointer group bg-slate-100" onclick="openLightbox({{ $loopIndex }})">
                            <img src="{{ $mediaSrc }}" alt="{{ $item->caption ?? 'Kegiatan PPID' }}" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.src='https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800'"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-4 left-4 text-white transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 pr-4">
                                <p class="text-sm font-semibold line-clamp-2">{{ $item->caption ?? 'Dokumentasi PPID' }}</p>
                            </div>
                        </div>
                        @php $loopIndex++; @endphp
                    @empty
                        <div class="col-span-full py-10 text-center bg-slate-50 rounded-2xl border border-slate-100 text-slate-500">
                            Belum ada foto galeri untuk ditampilkan.
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-12 fade-scroll">
                    <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-semibold transition-soft transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl ripple-light">
                        <i class="fa-solid fa-images"></i> Lihat Semua Galeri <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- ===== SECTION: SOCIAL MEDIA (FIXED ICONS) ===== -->
        <section id="social-media" class="py-16 bg-gradient-to-br from-primary/5 to-blue-50">
            <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
                <div class="text-center mb-10 fade-scroll">
                    <h2 class="text-3xl md:text-4xl font-black text-dark mb-4">
                        TERHUBUNG DENGAN <span class="text-primary">MEDIA SOSIAL</span>
                    </h2>
                    <p class="text-slate-600 max-w-2xl mx-auto">
                        Ikuti dan dapatkan informasi terbaru dari PPID Kabupaten Konawe melalui platform media
                        sosial resmi kami.
                    </p>
                </div>

                <div class="flex flex-wrap justify-center items-center gap-6 md:gap-8 fade-scroll">
                    @forelse($socialMedias as $socmed)
                        @php
                            // Ambil data langsung dari enum 'platform'
                            $platform = $socmed->platform;
                            $cssClass = $platform;

                            // Merapikan nama untuk ditampilkan di bawah ikon
                            $displayName = ucfirst($platform);
                            if ($platform === 'x') $displayName = 'X';
                            if ($platform === 'tiktok') $displayName = 'TikTok';
                            if ($platform === 'youtube') $displayName = 'YouTube';

                            // Cek apakah admin mengisi kolom 'icon' manual, jika tidak pakai bawaan sistem
                            if ($socmed->icon) {
                                $iconClass = 'fa-brands '.$socmed->icon;
                            } else {
                                $iconClass = match($platform) {
                                    'facebook' => 'fa-brands fa-facebook-f',
                                    'x' => 'fa-brands fa-x-twitter',
                                    'instagram' => 'fa-brands fa-instagram',
                                    'tiktok' => 'fa-brands fa-tiktok',
                                    'youtube' => 'fa-brands fa-youtube',
                                    'threads' => 'fa-brands fa-threads',
                                    default => 'fa-solid fa-link'
                                };
                            }
                        @endphp

                        <a href="{{ $socmed->url }}" target="_blank" rel="noopener noreferrer"
                           class="social-icon {{ $cssClass }} w-20 h-20 md:w-24 md:h-24 bg-white rounded-2xl shadow-lg flex flex-col items-center justify-center gap-1 text-slate-600 hover:text-white transition-all duration-300 group">

                            <i class="{{ $iconClass }} text-3xl md:text-4xl group-hover:scale-110 transition-transform"></i>
                            <span class="text-xs font-semibold">{{ $displayName }}</span>

                        </a>
                    @empty
                        <a href="#" class="social-icon facebook w-20 h-20 md:w-24 md:h-24 bg-white rounded-2xl shadow-lg flex flex-col items-center justify-center gap-1 text-slate-600 hover:text-white transition-all duration-300 group">
                            <i class="fa-brands fa-facebook-f text-3xl md:text-4xl group-hover:scale-110 transition-transform"></i>
                            <span class="text-xs font-semibold">Facebook</span>
                        </a>
                        <a href="#" class="social-icon instagram w-20 h-20 md:w-24 md:h-24 bg-white rounded-2xl shadow-lg flex flex-col items-center justify-center gap-1 text-slate-600 hover:text-white transition-all duration-300 group">
                            <i class="fa-brands fa-instagram text-3xl md:text-4xl group-hover:scale-110 transition-transform"></i>
                            <span class="text-xs font-semibold">Instagram</span>
                        </a>
                        <a href="#" class="social-icon youtube w-20 h-20 md:w-24 md:h-24 bg-white rounded-2xl shadow-lg flex flex-col items-center justify-center gap-1 text-slate-600 hover:text-white transition-all duration-300 group">
                            <i class="fa-brands fa-youtube text-3xl md:text-4xl group-hover:scale-110 transition-transform"></i>
                            <span class="text-xs font-semibold">YouTube</span>
                        </a>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>

        // Counter Animation
        function animateCounters() {
            const counters = document.querySelectorAll('.counter-value');

            counters.forEach((counter) => {
                const target = parseInt(counter.getAttribute('data-target'));
                let current = 0;
                const increment = target / 50;

                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent =
                            Math.floor(current).toLocaleString() +
                            (counter.textContent.includes('%') ? '%' : '');
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent =
                            target.toLocaleString() + (counter.textContent.includes('%') ? '%' : '');
                        counter.classList.add('changed');
                        setTimeout(() => counter.classList.remove('changed'), 300);
                    }
                };

                const observer = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                updateCounter();
                                observer.unobserve(entry.target);
                            }
                        });
                    },
                    { threshold: 0.5 },
                );

                observer.observe(counter);
            });
        }

        // Scroll Fade Animation
        function initScrollFade() {
            const fadeElements = document.querySelectorAll('.fade-scroll');

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                        }
                    });
                },
                { threshold: 0.1 },
            );

            fadeElements.forEach((element) => observer.observe(element));
        }

        // Smooth Scroll for anchor links
        function initSmoothScroll() {
            document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
                anchor.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    if (href !== '#' && href !== '#' && href.length > 1) {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start',
                            });
                        }
                    }
                });
            });
        }

        // Gallery Lightbox Functions
        const galleryImages = [
            {
                src: 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=1200',
                alt: 'Gallery Image 1',
            },
            {
                src: 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&q=80&w=1200',
                alt: 'Gallery Image 2',
            },
            {
                src: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80&w=1200',
                alt: 'Gallery Image 3',
            },
            {
                src: 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=1200',
                alt: 'Gallery Image 4',
            },
            {
                src: 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&q=80&w=1200',
                alt: 'Gallery Image 5',
            },
            {
                src: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80&w=1200',
                alt: 'Gallery Image 6',
            },
        ];

        let currentLightboxIndex = 0;
        let isZoomed = false;

        function openLightbox(index) {
            currentLightboxIndex = index;
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = galleryImages[index].src;
            lightboxImg.alt = galleryImages[index].alt;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
            updateCounter();
            isZoomed = false;
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.classList.remove('zoomed');
            lightboxImg.style.transform = 'scale(1)';
            lightboxImg.style.cursor = 'zoom-in';
            isZoomed = false;
        }

        function changeImage(direction) {
            currentLightboxIndex += direction;
            if (currentLightboxIndex < 0) {
                currentLightboxIndex = galleryImages.length - 1;
            } else if (currentLightboxIndex >= galleryImages.length) {
                currentLightboxIndex = 0;
            }

            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = galleryImages[currentLightboxIndex].src;
            lightboxImg.alt = galleryImages[currentLightboxIndex].alt;
            updateCounter();

            lightboxImg.classList.remove('zoomed');
            lightboxImg.style.transform = 'scale(1)';
            lightboxImg.style.cursor = 'zoom-in';
            isZoomed = false;
        }

        function toggleZoom() {
            const lightboxImg = document.getElementById('lightbox-img');
            if (isZoomed) {
                lightboxImg.classList.remove('zoomed');
                lightboxImg.style.transform = 'scale(1)';
                lightboxImg.style.cursor = 'zoom-in';
            } else {
                lightboxImg.classList.add('zoomed');
                lightboxImg.style.transform = 'scale(1.5)';
                lightboxImg.style.cursor = 'zoom-out';
            }
            isZoomed = !isZoomed;
        }

        function updateCounter() {
            const counter = document.getElementById('lightbox-counter');
            counter.textContent = `${currentLightboxIndex + 1} / ${galleryImages.length}`;
        }

        document.addEventListener('keydown', (e) => {
            const lightbox = document.getElementById('lightbox');
            if (lightbox.classList.contains('active')) {
                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowLeft') {
                    changeImage(-1);
                } else if (e.key === 'ArrowRight') {
                    changeImage(1);
                }
            }
        });

        // Tab functionality for Berita & Pengumuman
        function initTabs() {
            const tabBerita = document.getElementById('tab-berita');
            const tabPengumuman = document.getElementById('tab-pengumuman');
            const contentBerita = document.getElementById('content-berita');
            const contentPengumuman = document.getElementById('content-pengumuman');

            if (tabBerita && tabPengumuman) {
                tabBerita.addEventListener('click', () => {
                    tabBerita.classList.add('active', 'text-primary', 'border-primary');
                    tabBerita.classList.remove('text-slate-500', 'border-transparent');
                    tabPengumuman.classList.remove('active', 'text-primary', 'border-primary');
                    tabPengumuman.classList.add('text-slate-500', 'border-transparent');

                    contentBerita.classList.remove('hidden');
                    contentPengumuman.classList.add('hidden');
                });

                tabPengumuman.addEventListener('click', () => {
                    tabPengumuman.classList.add('active', 'text-primary', 'border-primary');
                    tabPengumuman.classList.remove('text-slate-500', 'border-transparent');
                    tabBerita.classList.remove('active', 'text-primary', 'border-primary');
                    tabBerita.classList.add('text-slate-500', 'border-transparent');

                    contentPengumuman.classList.remove('hidden');
                    contentBerita.classList.add('hidden');
                });
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new HeroCarousel();
            animateCounters();
            initScrollFade();
            initSmoothScroll();
            initTabs();

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate-fade-in');
                        }
                    });
                },
                { threshold: 0.1 },
            );

            document.querySelectorAll('.card-hover').forEach((card) => {
                observer.observe(card);
            });

            // 1. SLIDER BERITA UNGGULAN
            const newsContainer = document.getElementById('news-slider-container');
            if (newsContainer && newsContainer.children.length > 1) {
                const slides = newsContainer.children;
                const dots = document.querySelectorAll('#news-dots button');
                let currentIndex = 0;
                let interval;

                const updateNewsSlider = () => {
                    newsContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
                    dots.forEach((dot, idx) => {
                        if (idx === currentIndex) {
                            dot.className = 'w-6 h-2 rounded-full transition-all duration-300 bg-white';
                        } else {
                            dot.className = 'w-2 h-2 rounded-full transition-all duration-300 bg-white/40 hover:bg-white/70';
                        }
                    });
                };

                const nextSlide = () => { currentIndex = (currentIndex + 1) % slides.length; updateNewsSlider(); };
                const prevSlide = () => { currentIndex = (currentIndex - 1 + slides.length) % slides.length; updateNewsSlider(); };

                document.getElementById('btn-next-news')?.addEventListener('click', () => { nextSlide(); resetInterval(); });
                document.getElementById('btn-prev-news')?.addEventListener('click', () => { prevSlide(); resetInterval(); });
                dots.forEach((dot, idx) => {
                    dot.addEventListener('click', () => { currentIndex = idx; updateNewsSlider(); resetInterval(); });
                });

                const startInterval = () => { interval = setInterval(nextSlide, 5000); };
                const resetInterval = () => { clearInterval(interval); startInterval(); };

                newsContainer.parentElement.addEventListener('mouseenter', () => clearInterval(interval));
                newsContainer.parentElement.addEventListener('mouseleave', startInterval);
                startInterval();
            }

            // 2. SLIDER PENGUMUMAN UNGGULAN
            const annContainer = document.getElementById('ann-slider-container');
            if (annContainer && annContainer.children.length > 1) {
                const slides = annContainer.children;
                const dots = document.querySelectorAll('#ann-dots button');
                let currentIndex = 0;
                let interval;

                const updateAnnSlider = () => {
                    annContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
                    dots.forEach((dot, idx) => {
                        if (idx === currentIndex) {
                            dot.className = 'h-1.5 rounded-full transition-all duration-300 bg-secondary w-4';
                        } else {
                            dot.className = 'h-1.5 rounded-full transition-all duration-300 bg-slate-300 hover:bg-slate-400 w-1.5';
                        }
                    });
                };

                const nextSlide = () => { currentIndex = (currentIndex + 1) % slides.length; updateAnnSlider(); };
                const prevSlide = () => { currentIndex = (currentIndex - 1 + slides.length) % slides.length; updateAnnSlider(); };

                document.getElementById('btn-next-ann')?.addEventListener('click', () => { nextSlide(); resetInterval(); });
                document.getElementById('btn-prev-ann')?.addEventListener('click', () => { prevSlide(); resetInterval(); });
                dots.forEach((dot, idx) => {
                    dot.addEventListener('click', () => { currentIndex = idx; updateAnnSlider(); resetInterval(); });
                });

                const startInterval = () => { interval = setInterval(nextSlide, 7000); }; // Pengumuman lebih lambat (7 detik)
                const resetInterval = () => { clearInterval(interval); startInterval(); };

                // Hover area pengumuman akan mem-pause auto-slide
                annContainer.parentElement.addEventListener('mouseenter', () => clearInterval(interval));
                annContainer.parentElement.addEventListener('mouseleave', startInterval);
                startInterval();
            }
        });

    </script>
@endpush
