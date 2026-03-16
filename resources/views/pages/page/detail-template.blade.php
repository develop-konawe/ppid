@extends('layouts.app')

@section('title', $page->title)
@push('meta-head')
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ Str::limit(html_entity_decode(str($page->content)->sanitizeHtml()), 150) }}">
    <meta property="og:url" content="{{ route('news.detail', $page->slug) }}">
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
                    },
                },
            },
        };
    </script>
@endpush

@push('styles')
    <style>
        /* ===== SIDEBAR MENU STYLES ===== */
        .sidebar-menu {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px -10px rgba(31, 58, 138, 0.1);
            border: 1px solid #e2e8f0;
        }

        .sidebar-header {
            background: linear-gradient(135deg, #1f3a8a 0%, #2d4ba0 100%);
            color: white;
            padding: 1.25rem 1.5rem;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        .sidebar-header i {
            margin-right: 0.75rem;
            opacity: 0.9;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: #334155;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
            border-bottom: 1px solid #f1f5f9;
        }

        .sidebar-item:last-child {
            border-bottom: none;
        }

        .sidebar-item i {
            width: 1.5rem;
            color: #1f3a8a;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .sidebar-item:hover {
            background: #eff6ff;
            border-left-color: #1f3a8a;
            color: #1f3a8a;
        }

        .sidebar-item:hover i {
            transform: translateX(3px);
        }

        .sidebar-item.active {
            background: #eff6ff;
            border-left-color: #1f3a8a;
            color: #1f3a8a;
            font-weight: 600;
        }

        .sidebar-item.active i {
            color: #1f3a8a;
        }

        /* ===== STYLE UNTUK KONTEN DARI CKEDITOR ===== */
        .ck-content {
            font-family: 'Inter', system-ui, sans-serif;
            color: #334155;
            line-height: 1.8;
        }

        .ck-content h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f172a;
            margin-top: 2rem;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .ck-content h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
            margin-top: 1.8rem;
            margin-bottom: 0.8rem;
        }

        .ck-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0f172a;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .ck-content h4 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0f172a;
            margin-top: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .ck-content p {
            margin-bottom: 1.2rem;
        }

        .ck-content a {
            color: #1f3a8a;
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .ck-content a:hover {
            color: #172554;
        }

        .ck-content ul,
        .ck-content ol {
            margin: 1rem 0 1.5rem 1.5rem;
        }

        .ck-content li {
            margin-bottom: 0.5rem;
        }

        .ck-content blockquote {
            border-left: 4px solid #1f3a8a;
            padding: 1rem 1.5rem;
            background: #f8fafc;
            border-radius: 0 0.75rem 0.75rem 0;
            font-style: italic;
            margin: 1.5rem 0;
        }

        .ck-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
        }

        .ck-content th {
            background: #1f3a8a;
            color: white;
            padding: 0.75rem;
            font-weight: 600;
        }

        .ck-content td {
            border: 1px solid #e2e8f0;
            padding: 0.75rem;
        }

        .ck-content tr:nth-child(even) {
            background: #f8fafc;
        }

        .ck-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.75rem;
            margin: 1.5rem 0;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .ck-content .image {
            margin: 1.5rem 0;
        }

        .ck-content .image-style-side {
            float: right;
            margin-left: 1.5rem;
            max-width: 50%;
        }

        @media (max-width: 768px) {
            .ck-content .image-style-side {
                float: none;
                margin-left: 0;
                max-width: 100%;
            }
        }

        .ck-content pre {
            background: #1e293b;
            color: #e2e8f0;
            padding: 1rem;
            border-radius: 0.75rem;
            overflow-x: auto;
            font-family: monospace;
            margin: 1.5rem 0;
        }

        .ck-content .table {
            overflow-x: auto;
        }

        .ck-content hr {
            margin: 2rem 0;
            border: 0;
            border-top: 2px dashed #e2e8f0;
        }

        /* Download button style */
        .download-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #1f3a8a;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .download-btn:hover {
            background: #172554;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(31, 58, 138, 0.3);
        }
    </style>
@endpush

@section('content')
    <!-- ==================== MAIN CONTENT - TEMPLATE HALAMAN PROFIL ==================== -->
    <main class="overflow-hidden">
        <!-- Page Header (Dinamis - berubah sesuai halaman) -->
        <section class="bg-gradient-to-r from-primary/10 to-primary-subtle py-12 md:py-16">
            <div class="max-w-7xl mx-auto px-4 md:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <nav class="text-sm breadcrumbs text-slate-500 mb-2">
                            <a href="index.html" class="hover:text-primary">Home</a> /
                            <a href="profil.html" class="hover:text-primary">Profil</a> /
                            <span class="text-primary font-semibold" id="page-title">Profil Singkat PPID</span>
                        </nav>
                        <h1 class="text-3xl md:text-4xl font-black text-dark" id="page-heading">
                            PROFIL <span class="text-primary" id="page-heading-accent">SINGKAT</span>
                        </h1>
                        <p class="text-slate-600 mt-2" id="page-description">
                            Informasi mengenai PPID Kabupaten Konawe
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <a href="#" class="download-btn"> <i class="fa-solid fa-download"></i> Unduh PDF </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Content dengan Sidebar -->
        <section class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 md:px-8">
                <div class="flex flex-col lg:flex-row gap-8">

                    <!-- KONTEN UTAMA - AREA CKEDITOR (DINAMIS) -->
                    <div class="lg:w-full fade-scroll">
                        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-slate-100">
                            <!-- Metadata Halaman (Dinamis) -->
                            <div class="bg-primary-subtle p-4 rounded-xl flex flex-wrap gap-6 text-sm mb-8">
                                <div>
                                    <i class="fa-regular fa-calendar text-primary mr-2"></i>Diperbaharui:
                                    <span class="font-semibold" id="update-date">15 Februari 2026</span>
                                </div>
                                <div>
                                    <i class="fa-regular fa-folder-open text-primary mr-2"></i>Kategori:
                                    <span class="font-semibold" id="page-category">Profil</span>
                                </div>
                                <div>
                                    <i class="fa-regular fa-eye text-primary mr-2"></i>Dilihat:
                                    <span class="font-semibold" id="page-views">1,234 kali</span>
                                </div>
                            </div>

                            <!-- ================================================= -->
                            <!-- KONTEN UTAMA - DIISI DARI CKEDITOR (DATABASE)    -->
                            <!-- ================================================= -->
                            <div class="ck-content prose prose-lg max-w-none" id="main-content">
                                {!! html_entity_decode($page->content) !!}
                                <!-- END CONTOH KONTEN -->
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="flex flex-wrap gap-4 justify-center mt-12">
                                <a href="#" class="download-btn"
                                ><i class="fa-regular fa-file-pdf mr-2"></i> Unduh Dokumen (PDF)</a
                                >
                                <a
                                    href="#"
                                    class="bg-slate-100 text-slate-700 px-6 py-3 rounded-xl font-semibold hover:bg-slate-200 transition-soft"
                                ><i class="fa-regular fa-share-from-square mr-2"></i> Bagikan</a
                                >
                            </div>
                        </div>
                        <div class="border-t border-slate-200 mt-12 pt-8">
                            <h3 class="font-bold text-lg mb-4">Informasi Terkait:</h3>
                            <div class="grid md:grid-cols-3 gap-4">
                                <a
                                    href="#"
                                    class="block p-4 bg-primary-subtle rounded-xl hover:bg-primary hover:text-white transition-soft"
                                >
                                    <i class="fa-regular fa-file-lines mr-2"></i> APBD 2026
                                </a>
                                <a
                                    href="#"
                                    class="block p-4 bg-primary-subtle rounded-xl hover:bg-primary hover:text-white transition-soft"
                                >
                                    <i class="fa-regular fa-file-lines mr-2"></i> LKPD 2024
                                </a>
                                <a
                                    href="#"
                                    class="block p-4 bg-primary-subtle rounded-xl hover:bg-primary hover:text-white transition-soft"
                                >
                                    <i class="fa-regular fa-file-lines mr-2"></i> Rencana Pembangunan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form Permintaan Informasi (opsional) -->
        <section class="py-12 bg-light">
            <div class="max-w-7xl mx-auto px-4 md:px-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <h3 class="text-2xl font-bold mb-4">Butuh Informasi Lebih Lanjut?</h3>
                    <p class="text-slate-600 mb-6">
                        Silakan ajukan permohonan informasi atau hubungi petugas PPID untuk mendapatkan data
                        yang Anda butuhkan.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a
                            href="#"
                            class="bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary-dark transition-soft"
                        >
                            <i class="fa-regular fa-pen-to-square mr-2"></i> Ajukan Permohonan
                        </a>
                        <a
                            href="kontak.html"
                            class="border border-primary text-primary px-6 py-3 rounded-xl font-semibold hover:bg-primary hover:text-white transition-soft"
                        >
                            <i class="fa-regular fa-message mr-2"></i> Hubungi PPID
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
@endpush
