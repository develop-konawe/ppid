@extends('layouts.app')

@section('title', $berita->title)
@push('meta-head')
    <meta property="og:title" content="{{ $berita->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($berita->content), 150) }}">
    <meta property="og:image" content="{{ asset('storage/'.$berita->image) }}">
    <meta property="og:url" content="{{ route('news.detail', $berita->slug) }}">
    <meta property="og:type" content="article">
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
                        serif: ['Lora', 'Georgia', 'serif'],
                    },
                    typography: (theme) => ({
                        DEFAULT: {
                            css: {
                                maxWidth: '65ch',
                                color: theme('colors.slate.700'),
                                lineHeight: '1.75',
                            },
                        },
                    }),
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
        .glass-nav {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(31, 58, 138, 0.1);
        }

        .transition-soft {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Article Typography - Enhanced untuk CKEditor content */
        .article-content {
            font-family: 'Lora', Georgia, serif;
            font-size: 1.125rem;
            line-height: 1.8;
            color: #1e293b;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Styling untuk semua elemen HTML yang mungkin dihasilkan CKEditor */
        .article-content h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.25rem;
            font-weight: 700;
            margin-top: 3rem;
            margin-bottom: 1.5rem;
            color: #0f172a;
            line-height: 1.3;
        }

        .article-content h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.875rem;
            font-weight: 700;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
            color: #0f172a;
            line-height: 1.3;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 0.5rem;
        }

        .article-content h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #0f172a;
        }

        .article-content h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            color: #0f172a;
        }

        .article-content p {
            margin-bottom: 1.75rem;
        }

        .article-content p:last-child {
            margin-bottom: 0;
        }

        .article-content blockquote {
            font-style: italic;
            border-left: 4px solid #1F3A8A;
            padding: 1.5rem 2rem;
            margin: 2rem 0;
            color: #334155;
            font-size: 1.25rem;
            background: #f8fafc;
            border-radius: 1rem;
            position: relative;
        }

        .article-content blockquote::before {
            content: '"';
            font-size: 4rem;
            color: #1F3A8A;
            opacity: 0.2;
            position: absolute;
            top: -0.5rem;
            left: 0.5rem;
            font-family: serif;
        }

        .article-content blockquote footer {
            margin-top: 1rem;
            font-size: 0.875rem;
            color: #64748b;
            font-style: normal;
        }

        .article-content ul, .article-content ol {
            margin: 1.5rem 0;
            padding-left: 2rem;
        }

        .article-content li {
            margin-bottom: 0.5rem;
        }

        .article-content ul li {
            list-style-type: disc;
        }

        .article-content ul li ul {
            margin: 0.5rem 0 0.5rem 1.5rem;
        }

        .article-content ul li ul li {
            list-style-type: circle;
        }

        .article-content ol li {
            list-style-type: decimal;
        }

        .article-content ol li ol {
            margin: 0.5rem 0 0.5rem 1.5rem;
        }

        .article-content ol li ol li {
            list-style-type: lower-alpha;
        }

        .article-content a {
            color: #1F3A8A;
            text-decoration: underline;
            text-decoration-thickness: 1px;
            text-underline-offset: 2px;
            transition: color 0.3s ease;
        }

        .article-content a:hover {
            color: #3B82F6;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 1rem;
            margin: 2rem 0;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.2);
            display: block;
        }

        .article-content figure {
            margin: 2rem 0;
        }

        .article-content figure img {
            margin: 0 0 0.5rem 0;
        }

        .article-content figcaption {
            text-align: center;
            font-size: 0.875rem;
            color: #64748b;
            margin-top: 0.5rem;
            font-style: italic;
        }

        .article-content hr {
            margin: 3rem 0;
            border: none;
            border-top: 2px dashed #e2e8f0;
        }

        .article-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
            font-size: 0.95rem;
        }

        .article-content th {
            background: #1F3A8A;
            color: white;
            font-weight: 600;
            padding: 0.75rem 1rem;
            text-align: left;
        }

        .article-content td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .article-content tr:nth-child(even) {
            background: #f8fafc;
        }

        .article-content pre {
            background: #1e1e2f;
            color: #fff;
            padding: 1.5rem;
            border-radius: 1rem;
            overflow-x: auto;
            margin: 2rem 0;
            font-family: 'Fira Code', 'Courier New', monospace;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .article-content code {
            background: #e2e8f0;
            color: #0f172a;
            padding: 0.2rem 0.4rem;
            border-radius: 0.375rem;
            font-family: 'Fira Code', 'Courier New', monospace;
            font-size: 0.9em;
        }

        .article-content pre code {
            background: transparent;
            color: inherit;
            padding: 0;
            border-radius: 0;
        }

        .article-content .table-responsive {
            overflow-x: auto;
            margin: 2rem 0;
        }

        .article-content .embed-responsive {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
            overflow: hidden;
            margin: 2rem 0;
            border-radius: 1rem;
        }

        .article-content .embed-responsive iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* CKEditor specific classes */
        .article-content .text-tiny {
            font-size: 0.875rem;
        }

        .article-content .text-small {
            font-size: 1rem;
        }

        .article-content .text-big {
            font-size: 1.25rem;
        }

        .article-content .text-huge {
            font-size: 1.5rem;
        }

        .article-content .marker {
            background: #fef08a;
            padding: 0.1rem 0.3rem;
            border-radius: 0.25rem;
        }

        .article-content .spoiler {
            background: #1e293b;
            color: transparent;
            padding: 0.1rem 0.3rem;
            border-radius: 0.25rem;
            transition: all 0.3s ease;
        }

        .article-content .spoiler:hover {
            background: transparent;
            color: inherit;
        }

        /* Table of Contents */
        .toc {
            background: #f8fafc;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
        }

        .toc-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #1F3A8A;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .toc ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .toc li {
            margin-bottom: 0.5rem;
        }

        .toc a {
            color: #334155;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            border-left: 2px solid transparent;
            padding-left: 0.75rem;
        }

        .toc a:hover {
            color: #1F3A8A;
            border-left-color: #1F3A8A;
            padding-left: 1rem;
        }

        /* Share buttons */
        .share-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: white;
        }

        .share-btn.facebook {
            background: #1877f2;
        }
        .share-btn.twitter {
            background: #1da1f2;
        }
        .share-btn.whatsapp {
            background: #25d366;
        }
        .share-btn.linkedin {
            background: #0a66c2;
        }
        .share-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.3);
        }

        /* Reading progress bar */
        .progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: linear-gradient(90deg, #1F3A8A, #3B82F6);
            z-index: 100;
            transition: width 0.1s ease;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #64748B;
            font-size: 0.9rem;
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: #1F3A8A;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: #172554;
            text-decoration: underline;
        }

        /* News Card */
        .news-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 5px 15px -5px rgba(31, 58, 138, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -10px rgba(31, 58, 138, 0.2);
        }

        /* Back to top button */
        #back-to-top {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        #back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        /* Reading time badge */
        .reading-time {
            background: #e2e8f0;
            color: #475569;
            padding: 0.25rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* Gallery grid for CKEditor */
        .article-content .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin: 2rem 0;
        }

        .article-content .gallery img {
            margin: 0;
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        /* Clearfix */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Alignment classes from CKEditor */
        .article-content .text-left {
            text-align: left;
        }
        .article-content .text-center {
            text-align: center;
        }
        .article-content .text-right {
            text-align: right;
        }
        .article-content .text-justify {
            text-align: justify;
        }
        .article-content .image-left {
            float: left;
            margin: 0.5rem 1.5rem 0.5rem 0;
            max-width: 50%;
        }
        .article-content .image-right {
            float: right;
            margin: 0.5rem 0 0.5rem 1.5rem;
            max-width: 50%;
        }
        .article-content .image-style-side {
            float: right;
            margin-left: 1.5rem;
            max-width: 50%;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .article-content {
                font-size: 1rem;
            }

            .article-content h1 {
                font-size: 1.875rem;
            }

            .article-content h2 {
                font-size: 1.5rem;
            }

            .article-content h3 {
                font-size: 1.25rem;
            }

            .article-content blockquote {
                font-size: 1.1rem;
                padding: 1rem 1.5rem;
            }

            .article-content .image-left,
            .article-content .image-right,
            .article-content .image-style-side {
                float: none;
                margin: 1rem 0;
                max-width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <main class="max-w-7xl mx-auto px-4 md:px-8 py-8">
        <!-- Breadcrumb -->
        <div class="breadcrumb mb-6">
            <a href="/"><i class="fa-solid fa-home"></i> Beranda</a>
            <i class="fa-solid fa-chevron-right text-xs"></i>
            <a href="{{ route('news') }}">Berita</a>
            <i class="fa-solid fa-chevron-right text-xs"></i>
            <span class="text-slate-500" id="breadcrumb-title">PPID Konawe Raih Penghargaan</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-8">
                <article class="bg-white rounded-3xl shadow-lg p-6 md:p-10 animate-fade-in">
                    <!-- Category & Date -->
                    <div class="flex flex-wrap items-center gap-3 mb-6">
              <span class="bg-primary-subtle text-primary px-4 py-1.5 rounded-full text-xs font-bold" id="news-category">
                <i class="fa-regular fa-star mr-1"></i> PRESS RELEASE
              </span>
                        <span class="text-slate-500 text-sm flex items-center" id="news-date">
                <i class="fa-regular fa-calendar mr-2"></i> 15 Februari 2026
              </span>
                        <span class="reading-time flex items-center" id="reading-time">
                <i class="fa-regular fa-clock mr-1"></i> 5 menit membaca
              </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-dark mb-6 font-heading leading-tight" id="news-title">
                        PPID Konawe Raih Penghargaan Keterbukaan Informasi Publik Tingkat Provinsi
                    </h1>

                    <!-- Author Info -->
                    <div class="flex items-center justify-between flex-wrap gap-4 mb-8 pb-8 border-b border-slate-200">
                        <div class="flex items-center gap-4">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Ahmad Sulaiman" class="w-14 h-14 rounded-full object-cover border-3 border-primary" id="author-image">
                            <div>
                                <p class="font-bold text-dark" id="author-name">Ahmad Sulaiman, S.Sos</p>
                                <p class="text-sm text-slate-500" id="author-title">Kepala Diskominfo Kabupaten Konawe</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="#" class="share-btn facebook" title="Bagikan ke Facebook" onclick="shareOnFacebook()">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="#" class="share-btn twitter" title="Bagikan ke Twitter" onclick="shareOnTwitter()">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="#" class="share-btn whatsapp" title="Bagikan ke WhatsApp" onclick="shareOnWhatsApp()">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                            <a href="#" class="share-btn linkedin" title="Bagikan ke LinkedIn" onclick="shareOnLinkedIn()">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="mb-8" id="featured-image-container">
                        <img src="https://images.unsplash.com/photo-1573164713714-d95e436ab78d?auto=format&fit=crop&q=80&w=1200" alt="PPID Konawe Raih Penghargaan" class="w-full h-auto rounded-2xl shadow-xl" id="featured-image">
                        <p class="text-sm text-slate-500 mt-3 text-center" id="image-caption">Suasana penyerahan penghargaan oleh Komisi Informasi Provinsi Sulawesi Tenggara</p>
                    </div>

                    <!-- Table of Contents (Dinamis) -->
                    <div class="toc mb-8" id="table-of-contents">
                        <div class="toc-title">
                            <i class="fa-solid fa-list-ul"></i>
                            <span>Daftar Isi</span>
                        </div>
                        <ul id="toc-list">
                            <!-- Akan diisi oleh JavaScript -->
                        </ul>
                    </div>

                    <!-- Article Content - Area untuk konten dari CKEditor -->
                    <div class="article-content" id="article-content">
                        <!--
                =====================================================
                KONTEN INI AKAN DIGANTI DENGAN OUTPUT DARI CKEDITOR
                =====================================================
                Data dari Filament / CKEditor akan dimasukkan di sini
                Menggunakan {!! $berita->content !!} di Blade, atau
                document.getElementById('article-content').innerHTML = data.content
              -->
                    </div>

                    <!-- Tags -->
                    <div class="mt-10 pt-8 border-t border-slate-200">
                        <div class="flex flex-wrap items-center gap-3" id="tags-container">
                            <span class="font-semibold text-dark"><i class="fa-solid fa-tags mr-2"></i> Tags:</span>
                            <a href="#" class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft">Penghargaan</a>
                            <a href="#" class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft">Keterbukaan Informasi</a>
                            <a href="#" class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft">PPID Konawe</a>
                            <a href="#" class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft">Komisi Informasi</a>
                        </div>
                    </div>

                    <!-- Share Bottom -->
                    <div class="mt-8 p-6 bg-primary-subtle rounded-2xl">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-share-nodes text-2xl text-primary"></i>
                                <span class="font-semibold text-dark">Bagikan artikel ini:</span>
                            </div>
                            <div class="flex gap-3">
                                <a href="#" class="share-btn facebook" onclick="shareOnFacebook()"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="share-btn twitter" onclick="shareOnTwitter()"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#" class="share-btn whatsapp" onclick="shareOnWhatsApp()"><i class="fa-brands fa-whatsapp"></i></a>
                                <a href="#" class="share-btn linkedin" onclick="shareOnLinkedIn()"><i class="fa-brands fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Author Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                    <h3 class="font-bold text-lg text-dark mb-4 flex items-center">
                        <i class="fa-regular fa-pen-to-square text-primary mr-2"></i>
                        Tentang Penulis
                    </h3>
                    <div class="text-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Ahmad Sulaiman" class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-primary" id="sidebar-author-image">
                        <h4 class="font-bold text-dark" id="sidebar-author-name">Ahmad Sulaiman, S.Sos</h4>
                        <p class="text-sm text-slate-500 mb-3" id="sidebar-author-title">Kepala Diskominfo Kabupaten Konawe</p>
                        <p class="text-sm text-slate-600 mb-4" id="author-bio">
                            Memimpin transformasi digital dan keterbukaan informasi publik di Kabupaten Konawe sejak 2023.
                        </p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-primary hover:text-primary-dark"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="#" class="text-primary hover:text-primary-dark"><i class="fa-regular fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Recent News -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-bold text-lg text-dark mb-4 flex items-center">
                        <i class="fa-regular fa-newspaper text-primary mr-2"></i>
                        Berita Terbaru
                    </h3>
                    <div class="space-y-4" id="recent-news">
                        <a href="#" class="flex gap-3 group">
                            <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&q=80&w=100" alt="Berita" class="w-16 h-16 rounded-lg object-cover group-hover:opacity-90 transition">
                            <div>
                                <h4 class="font-semibold text-sm group-hover:text-primary transition line-clamp-2">Rapat Koordinasi PPID Se-Kabupaten Konawe 2026</h4>
                                <p class="text-xs text-slate-500 mt-1"><i class="fa-regular fa-calendar mr-1"></i> 10 Feb 2026</p>
                            </div>
                        </a>
                        <a href="#" class="flex gap-3 group">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=100" alt="Berita" class="w-16 h-16 rounded-lg object-cover group-hover:opacity-90 transition">
                            <div>
                                <h4 class="font-semibold text-sm group-hover:text-primary transition line-clamp-2">Kebijakan Baru: Permohonan Informasi Online</h4>
                                <p class="text-xs text-slate-500 mt-1"><i class="fa-regular fa-calendar mr-1"></i> 5 Feb 2026</p>
                            </div>
                        </a>
                        <a href="#" class="flex gap-3 group">
                            <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&q=80&w=100" alt="Berita" class="w-16 h-16 rounded-lg object-cover group-hover:opacity-90 transition">
                            <div>
                                <h4 class="font-semibold text-sm group-hover:text-primary transition line-clamp-2">Sosialisasi UU KIP di Kecamatan Unaaha</h4>
                                <p class="text-xs text-slate-500 mt-1"><i class="fa-regular fa-calendar mr-1"></i> 1 Feb 2026</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Popular Tags -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-bold text-lg text-dark mb-4 flex items-center">
                        <i class="fa-solid fa-tags text-primary mr-2"></i>
                        Tags Populer
                    </h3>
                    <div class="flex flex-wrap gap-2" id="popular-tags">
                        <a href="#" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft">PPID</a>
                        <a href="#" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft">Keterbukaan</a>
                        <a href="#" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft">Informasi Publik</a>
                        <a href="#" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft">Pelayanan</a>
                        <a href="#" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft">Penghargaan</a>
                        <a href="#" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft">Konawe</a>
                        <a href="#" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft">Diskominfo</a>
                        <a href="#" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft">Regulasi</a>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="bg-primary rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="font-bold text-lg mb-3">Newsletter PPID</h3>
                    <p class="text-sm text-white/80 mb-4">Dapatkan update berita terbaru langsung di email Anda.</p>
                    <form id="sidebar-newsletter">
                        <input type="email" placeholder="Email Anda" class="w-full px-4 py-2.5 rounded-xl text-slate-800 mb-3 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                        <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-primary-dark font-semibold py-2.5 rounded-xl transition-soft">
                            <i class="fa-regular fa-bell mr-2"></i> Berlangganan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Related News -->
        <section class="mt-16">
            <h2 class="text-2xl md:text-3xl font-black text-dark mb-8 flex items-center">
                <i class="fa-regular fa-star text-primary mr-3"></i>
                Berita Terkait
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="related-news">
                <div class="news-card">
                    <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&q=80&w=800" alt="Berita Terkait" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-xs bg-primary-subtle text-primary px-2 py-1 rounded-full">KEGIATAN</span>
                        <h3 class="font-bold text-lg mt-3 mb-2">Rapat Koordinasi PPID Se-Kabupaten Konawe 2026</h3>
                        <a href="#" class="text-primary text-sm font-semibold hover:underline">Baca selengkapnya →</a>
                    </div>
                </div>
                <div class="news-card">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800" alt="Berita Terkait" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-xs bg-primary-subtle text-primary px-2 py-1 rounded-full">KEBIJAKAN</span>
                        <h3 class="font-bold text-lg mt-3 mb-2">Kebijakan Baru: Permohonan Informasi Online</h3>
                        <a href="#" class="text-primary text-sm font-semibold hover:underline">Baca selengkapnya →</a>
                    </div>
                </div>
                <div class="news-card">
                    <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&q=80&w=800" alt="Berita Terkait" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-xs bg-primary-subtle text-primary px-2 py-1 rounded-full">SOSIALISASI</span>
                        <h3 class="font-bold text-lg mt-3 mb-2">Sosialisasi UU KIP di Kecamatan Unaaha</h3>
                        <a href="#" class="text-primary text-sm font-semibold hover:underline">Baca selengkapnya →</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        /**
         * Contoh data dari CKEditor / Filament
         * Ini hanya contoh - di implementasi nyata, data berasal dari database
         */
        document.addEventListener('DOMContentLoaded', () => {
            // Contoh data - ganti dengan data dari server
            const newsData = {
                title: '{!! $berita->title !!}',
                category_display: 'PRESS RELEASE',
                category: 'press-release',
                date: '{{ $berita->created_at->format('M d, Y') }}',
                reading_time: 5,
                author: {
                    name: 'Admin',
                    title: 'Admin PPID Konawe',
                    image: 'https://randomuser.me/api/portraits/men/32.jpg',
                    bio: 'Memimpin transformasi digital dan keterbukaan informasi publik di Kabupaten Konawe sejak 2023.',
                },
                featured_image:
                    'https://images.unsplash.com/photo-1573164713714-d95e436ab78d?auto=format&fit=crop&q=80&w=1200',
                image_caption:
                    '{{ $berita->image ? $berita->image : "Tidak ada caption" }}',
                content: `{!! $berita->content !!}`, // Ganti dengan konten dari CKEditor
                tags: ['Penghargaan', 'Keterbukaan Informasi', 'PPID Konawe', 'Komisi Informasi'],
            };

            // Panggil fungsi untuk memuat data
            loadNewsContent(newsData);

        });


        // Reading Progress Bar
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height =
                document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById('progress-bar').style.width = scrolled + '%';
        });

        // Back to Top Button
        const backToTop = document.getElementById('back-to-top');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            });
        });

        // Newsletter form
        document.getElementById('sidebar-newsletter').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Terima kasih telah berlangganan newsletter PPID Konawe!');
        });

        /**
         * =====================================================
         * FUNGSI UNTUK MEMUAT KONTEN DARI CKEDITOR / FILAMENT
         * =====================================================
         *
         * Contoh penggunaan di Blade Laravel:
         *
         * <script>
         *   loadNewsContent({
         *     title: '{{ $berita->title }}',
         *     content: '{!! addslashes($berita->content) !!}', // Escape untuk JavaScript
         *     category: '{{ $berita->category }}',
         *     date: '{{ $berita->created_at->format("d F Y") }}',
         *     author: {
         *       name: '{{ "$berita->author->name" }}',
         *       title: '{{ "$berita->author->title" }}',
         *       image: '{{ "$berita->author->image" }}',
         *       bio: '{{ "$berita->author->bio" }}'
         *     },
         *     featured_image: '{{ $berita->image }}',
         *     image_caption: '{{ $berita->image }}',
         *     tags: ['Penghargaan', 'Keterbukaan Informasi'],
         *     reading_time: 5
         *   });
         * <\/script>
         */

        function loadNewsContent(newsData) {
            // Set title dan breadcrumb
            document.getElementById('news-title').textContent = newsData.title;
            document.getElementById('breadcrumb-title').textContent = newsData.title;
            document.title = newsData.title + ' - PPID Kabupaten Konawe';

            // Set kategori
            const categorySpan = document.getElementById('news-category');
            categorySpan.innerHTML = `<i class="fa-regular fa-star mr-1"></i> ${newsData.category_display || newsData.category}`;

            // Set tanggal
            document.getElementById('news-date').innerHTML =
                `<i class="fa-regular fa-calendar mr-2"></i> ${newsData.date}`;

            // Set reading time
            if (newsData.reading_time) {
                document.getElementById('reading-time').innerHTML =
                    `<i class="fa-regular fa-clock mr-1"></i> ${newsData.reading_time} menit membaca`;
            }

            // Set author
            if (newsData.author) {
                document.getElementById('author-name').textContent = newsData.author.name;
                document.getElementById('author-title').textContent = newsData.author.title || '';
                document.getElementById('author-image').src =
                    newsData.author.image || 'https://randomuser.me/api/portraits/men/32.jpg';
                document.getElementById('sidebar-author-name').textContent = newsData.author.name;
                document.getElementById('sidebar-author-title').textContent = newsData.author.title || '';
                if (newsData.author.bio) {
                    document.getElementById('author-bio').textContent = newsData.author.bio;
                }
            }

            // Set featured image
            if (newsData.featured_image) {
                document.getElementById('featured-image').src = newsData.featured_image;
                document.getElementById('featured-image').alt = newsData.title;
            }
            if (newsData.image_caption) {
                document.getElementById('image-caption').textContent = newsData.image_caption;
            }

            // Set konten utama - INI YANG PALING PENTING UNTUK CKEDITOR
            const articleContent = document.getElementById('article-content');
            articleContent.innerHTML = newsData.content; // Langsung memasukkan HTML dari CKEditor

            // Set tags
            if (newsData.tags && newsData.tags.length > 0) {
                const tagsContainer = document.getElementById('tags-container');
                // Hapus tags lama kecuali label "Tags:"
                while (tagsContainer.children.length > 1) {
                    tagsContainer.removeChild(tagsContainer.lastChild);
                }

                newsData.tags.forEach((tag) => {
                    const tagLink = document.createElement('a');
                    tagLink.href = '#';
                    tagLink.className =
                        'px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-primary hover:text-white transition-soft';
                    tagLink.textContent = tag;
                    tagsContainer.appendChild(tagLink);
                });
            }

            // Generate Table of Contents dari heading dalam konten
            generateTableOfContents();

            // Terapkan syntax highlighting jika ada kode
            if (typeof Prism !== 'undefined') {
                Prism.highlightAll();
            }

            // Proses gambar dan elemen lainnya
            processContentElements();
        }

        /**
         * Generate Table of Contents dari heading H2 dalam konten
         */
        function generateTableOfContents() {
            const article = document.getElementById('article-content');
            const headings = article.querySelectorAll('h2');
            const tocList = document.getElementById('toc-list');

            // Sembunyikan TOC jika tidak ada heading
            const toc = document.getElementById('table-of-contents');
            if (headings.length === 0) {
                toc.style.display = 'none';
                return;
            } else {
                toc.style.display = 'block';
            }

            tocList.innerHTML = '';

            headings.forEach((heading, index) => {
                // Beri ID jika belum ada
                if (!heading.id) {
                    heading.id =
                        'heading-' +
                        index +
                        '-' +
                        heading.textContent.toLowerCase().replace(/[^a-z0-9]+/g, '-');
                }

                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = '#' + heading.id;
                a.textContent = heading.textContent;

                // Smooth scroll
                a.addEventListener('click', (e) => {
                    e.preventDefault();
                    heading.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });

                li.appendChild(a);
                tocList.appendChild(li);
            });
        }

        /**
         * Proses elemen-elemen dalam konten
         * - Tambahkan class untuk responsive tables
         * - Proses embed
         * - Dll
         */
        function processContentElements() {
            const article = document.getElementById('article-content');

            // Bungkus tabel dengan div responsive
            article.querySelectorAll('table').forEach((table) => {
                // Cek apakah sudah dibungkus
                if (!table.parentElement.classList.contains('table-responsive')) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'table-responsive';
                    table.parentNode.insertBefore(wrapper, table);
                    wrapper.appendChild(table);
                }
            });

            // Proses iframe (YouTube, dll) untuk responsive
            article.querySelectorAll('iframe').forEach((iframe) => {
                // Cek apakah dari YouTube/Vimeo
                if (
                    iframe.src.includes('youtube') ||
                    iframe.src.includes('youtu.be') ||
                    iframe.src.includes('vimeo')
                ) {
                    if (!iframe.parentElement.classList.contains('embed-responsive')) {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'embed-responsive';
                        iframe.parentNode.insertBefore(wrapper, iframe);
                        wrapper.appendChild(iframe);
                    }
                }
            });
        }



        // Fungsi share media sosial
        function shareOnFacebook() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.getElementById('news-title').textContent);
            window.open(
                'https://www.facebook.com/sharer/sharer.php?u=' + url,
                '_blank',
                'width=600,height=400',
            );
        }

        function shareOnTwitter() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.getElementById('news-title').textContent);
            window.open(
                'https://twitter.com/intent/tweet?text=' + title + '&url=' + url,
                '_blank',
                'width=600,height=400',
            );
        }

        function shareOnWhatsApp() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.getElementById('news-title').textContent);
            window.open('https://api.whatsapp.com/send?text=' + title + '%20' + url, '_blank');
        }

        function shareOnLinkedIn() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.getElementById('news-title').textContent);
            window.open(
                'https://www.linkedin.com/sharing/share-offsite/?url=' + url,
                '_blank',
                'width=600,height=400',
            );
        }
    </script>
@endpush
