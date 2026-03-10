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
            <div
                class="bg-white p-2 rounded-2xl shadow-2xl flex flex-col md:flex-row gap-2 border border-slate-100 hover-glow"
            >
                <div class="flex-grow flex items-center px-4">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 mr-3" aria-hidden="true"></i>
                    <input
                        type="text"
                        placeholder="Cari informasi publik, dokumen, atau berita..."
                        class="w-full py-4 outline-none text-sm text-slate-700 placeholder-slate-400"
                        aria-label="Pencarian informasi publik"
                    />
                </div>
                <select
                    class="md:w-48 px-4 py-4 border-l border-slate-200 text-slate-600 text-sm focus:outline-none hover:bg-primary-subtle transition-soft"
                >
                    <option>Semua Kategori</option>
                    <option>Informasi Berkala</option>
                    <option>Informasi Serta Merta</option>
                    <option>Informasi Setiap Saat</option>
                    <option>Dokumen Publik</option>
                    <option>Berita & Pengumuman</option>
                </select>
                <button
                    class="bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold shadow-lg transition-soft transform hover:-translate-y-0.5 ripple-light"
                >
                    <i class="fa-solid fa-search mr-2"></i> CARI
                </button>
            </div>
            <div class="flex flex-wrap gap-3 mt-4 justify-center">
                <span class="text-slate-500 text-sm">Pencarian cepat:</span>
                <a
                    href="#"
                    class="text-primary hover:text-primary-dark text-sm font-medium hover:underline hover-border"
                >
                    APBD 2026
                </a>
                <span class="text-slate-300">•</span>
                <a
                    href="#"
                    class="text-primary hover:text-primary-dark text-sm font-medium hover:underline hover-border"
                >
                    Peraturan Daerah
                </a>
                <span class="text-slate-300">•</span>
                <a
                    href="#"
                    class="text-primary hover:text-primary-dark text-sm font-medium hover:underline hover-border"
                >
                    Laporan Keuangan
                </a>
                <span class="text-slate-300">•</span>
                <a
                    href="#"
                    class="text-primary hover:text-primary-dark text-sm font-medium hover:underline hover-border"
                >
                    Profil Pejabat
                </a>
            </div>
        </section>

        <!-- Quick Services Section -->
        <section id="layanan" class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-20">
            <div class="text-center mb-12 fade-scroll">
                <h2 class="text-3xl md:text-4xl font-black text-dark mb-4">LAYANAN CEPAT PPID KONAWE</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">
                    Akses berbagai layanan informasi publik dengan mudah melalui portal resmi PPID Kabupaten
                    Konawe
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Service 1 -->
                <div
                    class="bg-white p-6 rounded-2xl shadow-lg card-hover border border-slate-100 group fade-scroll"
                >
                    <div class="flex items-start gap-4 mb-4">
                        <div
                            class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center text-xl group-hover:bg-primary group-hover:text-white transition-soft"
                        >
                            <i class="fa-solid fa-file-circle-plus"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-dark mb-1">Permohonan Informasi</h3>
                            <p class="text-slate-500 text-sm">Ajukan secara online</p>
                        </div>
                    </div>
                    <p class="text-slate-600 text-sm mb-4">
                        Ajukan permohonan informasi publik secara online dengan mudah dan dapatkan respon
                        dalam waktu 10 hari kerja.
                    </p>
                    <a
                        href="#permohonan"
                        class="text-primary text-sm font-semibold inline-flex items-center group-hover:underline"
                    >
                        Ajukan Sekarang
                        <i
                            class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"
                        ></i>
                    </a>
                </div>

                <!-- Service 2 -->
                <div
                    class="bg-white p-6 rounded-2xl shadow-lg card-hover border border-slate-100 group fade-scroll"
                >
                    <div class="flex items-start gap-4 mb-4">
                        <div
                            class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-green-600 group-hover:text-white transition-soft"
                        >
                            <i class="fa-solid fa-file-circle-check"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-dark mb-1">Cek Status</h3>
                            <p class="text-slate-500 text-sm">Pantau perkembangan</p>
                        </div>
                    </div>
                    <p class="text-slate-600 text-sm mb-4">
                        Pantau status permohonan informasi yang telah diajukan dengan nomor tracking yang
                        diberikan.
                    </p>
                    <a
                        href="#status"
                        class="text-green-600 text-sm font-semibold inline-flex items-center group-hover:underline"
                    >
                        Cek Status
                        <i
                            class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"
                        ></i>
                    </a>
                </div>

                <!-- Service 3 -->
                <div
                    class="bg-white p-6 rounded-2xl shadow-lg card-hover border border-slate-100 group fade-scroll"
                >
                    <div class="flex items-start gap-4 mb-4">
                        <div
                            class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-orange-600 group-hover:text-white transition-soft"
                        >
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-dark mb-1">Bantuan & Konsultasi</h3>
                            <p class="text-slate-500 text-sm">Hubungi kami</p>
                        </div>
                    </div>
                    <p class="text-slate-600 text-sm mb-4">
                        Butuh bantuan atau konsultasi? Tim PPID siap membantu Anda dalam mengakses informasi
                        publik.
                    </p>
                    <a
                        href="#kontak"
                        class="text-orange-600 text-sm font-semibold inline-flex items-center group-hover:underline"
                    >
                        Hubungi Kami
                        <i
                            class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"
                        ></i>
                    </a>
                </div>
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
                        href="informasi-berkala"
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
                        href="informasi-serta-merta"
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
                        href="informasi-setiap-saat"
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
                        href="informasi-dikecualikan.html"
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
                        <!-- Berita Card 1 -->
                        <article
                            class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 card-hover group"
                        >
                            <div class="h-48 overflow-hidden">
                                <img
                                    src="https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800"
                                    alt="Berita 1"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                />
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                        <span class="bg-blue-100 text-primary px-3 py-1 rounded-full font-medium"
                        >Berita</span
                        >
                                    <span><i class="fa-regular fa-calendar mr-1"></i> 5 Feb 2026</span>
                                </div>
                                <h3 class="text-lg font-bold mb-2 text-dark line-clamp-2">
                                    Pelatihan Keterbukaan Informasi Publik bagi ASN se-Kabupaten Konawe
                                </h3>
                                <p class="text-slate-600 text-sm mb-4 line-clamp-2">
                                    Diskominfo Konawe menyelenggarakan pelatihan keterbukaan informasi publik bagi
                                    Aparatur Sipil Negara di lingkungan Pemkab Konawe.
                                </p>
                                <a
                                    href="#"
                                    class="text-primary font-semibold text-sm inline-flex items-center hover:underline"
                                >
                                    Baca selengkapnya <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </article>

                        <!-- Berita Card 2 -->
                        <article
                            class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 card-hover group"
                        >
                            <div class="h-48 overflow-hidden">
                                <img
                                    src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&q=80&w=800"
                                    alt="Berita 2"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                />
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                        <span class="bg-blue-100 text-primary px-3 py-1 rounded-full font-medium"
                        >Berita</span
                        >
                                    <span><i class="fa-regular fa-calendar mr-1"></i> 2 Feb 2026</span>
                                </div>
                                <h3 class="text-lg font-bold mb-2 text-dark line-clamp-2">
                                    PPID Konawe Raih Penghargaan Keterbukaan Informasi Publik 2025
                                </h3>
                                <p class="text-slate-600 text-sm mb-4 line-clamp-2">
                                    Prestasi membanggakan diraih PPID Kabupaten Konawe sebagai salah satu badan
                                    publik dengan kategori informatif.
                                </p>
                                <a
                                    href="#"
                                    class="text-primary font-semibold text-sm inline-flex items-center hover:underline"
                                >
                                    Baca selengkapnya <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </article>

                        <!-- Berita Card 3 -->
                        <article
                            class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 card-hover group"
                        >
                            <div class="h-48 overflow-hidden">
                                <img
                                    src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80&w=800"
                                    alt="Berita 3"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                />
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                        <span class="bg-blue-100 text-primary px-3 py-1 rounded-full font-medium"
                        >Berita</span
                        >
                                    <span><i class="fa-regular fa-calendar mr-1"></i> 28 Jan 2026</span>
                                </div>
                                <h3 class="text-lg font-bold mb-2 text-dark line-clamp-2">
                                    Rapat Koordinasi PPID Utama dan PPID Pembantu se-Konawe
                                </h3>
                                <p class="text-slate-600 text-sm mb-4 line-clamp-2">
                                    Dilaksanakan rapat koordinasi untuk meningkatkan sinergi dan kualitas layanan
                                    informasi publik di seluruh OPD.
                                </p>
                                <a
                                    href="#"
                                    class="text-primary font-semibold text-sm inline-flex items-center hover:underline"
                                >
                                    Baca selengkapnya <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    <!-- View All Berita -->
                    <div class="text-center mt-10">
                        <a
                            href="#"
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
                        <article
                            class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 card-hover group"
                        >
                            <div class="h-48 overflow-hidden bg-gradient-to-r from-secondary/80 to-secondary">
                                <img
                                    src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?auto=format&fit=crop&q=80&w=800"
                                    alt="Pengumuman 1"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90"
                                />
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                        <span class="bg-red-100 text-secondary px-3 py-1 rounded-full font-medium"
                        >Penting</span
                        >
                                    <span><i class="fa-regular fa-calendar mr-1"></i> 10 Feb 2026</span>
                                </div>
                                <h3 class="text-lg font-bold mb-2 text-dark line-clamp-2">
                                    Libur Nasional dan Cuti Bersama Hari Raya Nyepi 2026
                                </h3>
                                <p class="text-slate-600 text-sm mb-4 line-clamp-2">
                                    Pemerintah Kabupaten Konawe menetapkan libur nasional dan cuti bersama dalam
                                    rangka Hari Raya Nyepi.
                                </p>
                                <a
                                    href="#"
                                    class="text-primary font-semibold text-sm inline-flex items-center hover:underline"
                                >
                                    Baca selengkapnya <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </article>

                        <!-- Pengumuman Card 2 -->
                        <article
                            class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 card-hover group"
                        >
                            <div class="h-48 overflow-hidden bg-gradient-to-r from-green-600 to-green-500">
                                <img
                                    src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&q=80&w=800"
                                    alt="Pengumuman 2"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                />
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                        <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full font-medium"
                        >Rekrutmen</span
                        >
                                    <span><i class="fa-regular fa-calendar mr-1"></i> 8 Feb 2026</span>
                                </div>
                                <h3 class="text-lg font-bold mb-2 text-dark line-clamp-2">
                                    Seleksi Terbuka PPPK Teknis 2026
                                </h3>
                                <p class="text-slate-600 text-sm mb-4 line-clamp-2">
                                    Pengumuman hasil seleksi administrasi dan jadwal ujian kompetensi PPPK teknis di
                                    lingkungan Pemkab Konawe.
                                </p>
                                <a
                                    href="#"
                                    class="text-primary font-semibold text-sm inline-flex items-center hover:underline"
                                >
                                    Baca selengkapnya <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </article>

                        <!-- Pengumuman Card 3 -->
                        <article
                            class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 card-hover group"
                        >
                            <div class="h-48 overflow-hidden bg-gradient-to-r from-amber-600 to-amber-500">
                                <img
                                    src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=800"
                                    alt="Pengumuman 3"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                />
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                        <span class="bg-amber-100 text-amber-600 px-3 py-1 rounded-full font-medium"
                        >Sosialisasi</span
                        >
                                    <span><i class="fa-regular fa-calendar mr-1"></i> 5 Feb 2026</span>
                                </div>
                                <h3 class="text-lg font-bold mb-2 text-dark line-clamp-2">
                                    Sosialisasi Aplikasi SatuData Konawe
                                </h3>
                                <p class="text-slate-600 text-sm mb-4 line-clamp-2">
                                    Undangan sosialisasi penggunaan aplikasi SatuData bagi admin data di seluruh
                                    perangkat daerah.
                                </p>
                                <a
                                    href="#"
                                    class="text-primary font-semibold text-sm inline-flex items-center hover:underline"
                                >
                                    Baca selengkapnya <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    <!-- View All Pengumuman -->
                    <div class="text-center mt-10">
                        <a
                            href="#"
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
                    <p class="text-slate-600 max-w-2xl mx-auto">
                        Dokumentasi berbagai kegiatan dan momen penting seputar PPID Kabupaten Konawe.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Gallery Item 1 -->
                    <div
                        class="gallery-item relative overflow-hidden rounded-2xl shadow-lg cursor-pointer group"
                        onclick="openLightbox(0)"
                    >
                        <img
                            src="https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800"
                            alt="Gallery Image 1"
                            class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        ></div>
                        <div
                            class="absolute bottom-4 left-4 text-white transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300"
                        >
                            <p class="text-sm font-semibold">Pelatihan Keterbukaan Informasi</p>
                        </div>
                    </div>

                    <!-- Gallery Item 2 -->
                    <div
                        class="gallery-item relative overflow-hidden rounded-2xl shadow-lg cursor-pointer group"
                        onclick="openLightbox(1)"
                    >
                        <img
                            src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&q=80&w=800"
                            alt="Gallery Image 2"
                            class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        ></div>
                        <div
                            class="absolute bottom-4 left-4 text-white transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300"
                        >
                            <p class="text-sm font-semibold">Launching Portal PPID</p>
                        </div>
                    </div>

                    <!-- Gallery Item 3 -->
                    <div
                        class="gallery-item relative overflow-hidden rounded-2xl shadow-lg cursor-pointer group"
                        onclick="openLightbox(2)"
                    >
                        <img
                            src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80&w=800"
                            alt="Gallery Image 3"
                            class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        ></div>
                        <div
                            class="absolute bottom-4 left-4 text-white transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300"
                        >
                            <p class="text-sm font-semibold">Rapat Koordinasi PPID</p>
                        </div>
                    </div>
                </div>

                <!-- View All Gallery Button -->
                <div class="text-center mt-12 fade-scroll">
                    <a
                        href="#"
                        class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-semibold transition-soft transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl ripple-light"
                    >
                        <i class="fa-solid fa-images"></i>
                        Lihat Semua Galeri
                        <i class="fa-solid fa-arrow-right ml-2"></i>
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
                    <!-- Facebook -->
                    <a
                        href="#"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-icon facebook w-20 h-20 md:w-24 md:h-24 bg-white rounded-2xl shadow-lg flex flex-col items-center justify-center gap-1 text-slate-600 hover:text-white transition-all duration-300 group"
                    >
                        <i
                            class="fa-brands fa-facebook-f text-3xl md:text-4xl group-hover:scale-110 transition-transform"
                        ></i>
                        <span class="text-xs font-semibold">Facebook</span>
                    </a>

                    <!-- TikTok -->
                    <a
                        href="#"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-icon tiktok w-20 h-20 md:w-24 md:h-24 bg-white rounded-2xl shadow-lg flex flex-col items-center justify-center gap-1 text-slate-600 hover:text-white transition-all duration-300 group"
                    >
                        <i
                            class="fa-brands fa-tiktok text-3xl md:text-4xl group-hover:scale-110 transition-transform"
                        ></i>
                        <span class="text-xs font-semibold">TikTok</span>
                    </a>

                    <!-- Instagram -->
                    <a
                        href="#"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-icon instagram w-20 h-20 md:w-24 md:h-24 bg-white rounded-2xl shadow-lg flex flex-col items-center justify-center gap-1 text-slate-600 hover:text-white transition-all duration-300 group"
                    >
                        <i
                            class="fa-brands fa-instagram text-3xl md:text-4xl group-hover:scale-110 transition-transform"
                        ></i>
                        <span class="text-xs font-semibold">Instagram</span>
                    </a>

                    <!-- YouTube -->
                    <a
                        href="#"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-icon youtube w-20 h-20 md:w-24 md:h-24 bg-white rounded-2xl shadow-lg flex flex-col items-center justify-center gap-1 text-slate-600 hover:text-white transition-all duration-300 group"
                    >
                        <i
                            class="fa-brands fa-youtube text-3xl md:text-4xl group-hover:scale-110 transition-transform"
                        ></i>
                        <span class="text-xs font-semibold">YouTube</span>
                    </a>

                    <!-- X (Twitter) - Menggunakan fa-x-twitter -->
                    <a
                        href="#"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-icon x w-20 h-20 md:w-24 md:h-24 bg-white rounded-2xl shadow-lg flex flex-col items-center justify-center gap-1 text-slate-600 hover:text-white transition-all duration-300 group"
                    >
                        <i
                            class="fa-brands fa-x-twitter text-3xl md:text-4xl group-hover:scale-110 transition-transform"
                        ></i>
                        <span class="text-xs font-semibold">X</span>
                    </a>

                    <!-- Threads - Menggunakan fa-threads -->
                    <a
                        href="#"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-icon threads w-20 h-20 md:w-24 md:h-24 bg-white rounded-2xl shadow-lg flex flex-col items-center justify-center gap-1 text-slate-600 hover:text-white transition-all duration-300 group"
                    >
                        <i
                            class="fa-brands fa-threads text-3xl md:text-4xl group-hover:scale-110 transition-transform"
                        ></i>
                        <span class="text-xs font-semibold">Threads</span>
                    </a>
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
        });

    </script>
@endpush
