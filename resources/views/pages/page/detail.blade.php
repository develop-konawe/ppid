@extends('layouts.app')

@section('title', $page->title)
@push('meta-head')
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ Str::limit(html_entity_decode(strip_tags($page->content)), 150) }}">
    <meta property="og:url" content="{{ route('page.detail', $page->slug) }}">
    <meta property="og:type" content="article">
@endpush

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
                },
            },
        };
    </script>
@endpush

@push('styles')
    <style>
        /* Sidebar & General Styles */
        .sidebar-menu { background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 30px -10px rgba(31, 58, 138, 0.1); border: 1px solid #e2e8f0; }
        .sidebar-header { background: linear-gradient(135deg, #1f3a8a 0%, #2d4ba0 100%); color: white; padding: 1.25rem 1.5rem; font-weight: 700; font-size: 1.1rem; letter-spacing: 0.5px; }
        .sidebar-header i { margin-right: 0.75rem; opacity: 0.9; }
        .sidebar-item { display: flex; align-items: center; padding: 0.875rem 1.5rem; color: #334155; font-weight: 500; border-left: 3px solid transparent; transition: all 0.2s ease; border-bottom: 1px solid #f1f5f9; }
        .sidebar-item:last-child { border-bottom: none; }
        .sidebar-item i { width: 1.5rem; color: #1f3a8a; font-size: 1rem; transition: all 0.2s ease; }
        .sidebar-item:hover { background: #eff6ff; border-left-color: #1f3a8a; color: #1f3a8a; }
        .sidebar-item:hover i { transform: translateX(3px); }

        /* CKEDITOR KONTEN STYLES */
        .ck-content { font-family: 'Inter', system-ui, sans-serif; color: #334155; line-height: 1.8; }
        .ck-content h1 { font-size: 2.5rem; font-weight: 800; color: #0f172a; margin-top: 2rem; margin-bottom: 1rem; line-height: 1.2; }
        .ck-content h2 { font-size: 2rem; font-weight: 700; color: #0f172a; margin-top: 1.8rem; margin-bottom: 0.8rem; }
        .ck-content h3 { font-size: 1.5rem; font-weight: 600; color: #0f172a; margin-top: 1.5rem; margin-bottom: 0.5rem; }
        .ck-content h4 { font-size: 1.25rem; font-weight: 600; color: #0f172a; margin-top: 1.2rem; margin-bottom: 0.5rem; }
        .ck-content p { margin-bottom: 1.2rem; }
        .ck-content a { color: #1f3a8a; text-decoration: underline; text-underline-offset: 2px; }
        .ck-content a:hover { color: #172554; }
        .ck-content ul, .ck-content ol { margin: 1rem 0 1.5rem 1.5rem; }
        .ck-content ul { list-style-type: disc; }
        .ck-content ol { list-style-type: decimal; }
        .ck-content li { margin-bottom: 0.5rem; }
        .ck-content blockquote { border-left: 4px solid #1f3a8a; padding: 1rem 1.5rem; background: #f8fafc; border-radius: 0 0.75rem 0.75rem 0; font-style: italic; margin: 1.5rem 0; }
        .ck-content table { width: 100%; border-collapse: collapse; margin: 1.5rem 0; display: block; overflow-x: auto;}
        .ck-content th { background: #1f3a8a; color: white; padding: 0.75rem; font-weight: 600; }
        .ck-content td { border: 1px solid #e2e8f0; padding: 0.75rem; }
        .ck-content tr:nth-child(even) { background: #f8fafc; }
        .ck-content img { max-width: 100%; height: auto; border-radius: 0.75rem; margin: 1.5rem 0; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1); }
        .ck-content iframe { max-width: 100%; width: 100%; aspect-ratio: 16/9; border-radius: 0.75rem; margin: 1.5rem 0; }

        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .download-btn { display: inline-flex; align-items: center; gap: 0.5rem; background: #1f3a8a; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; transition: all 0.3s ease; }
        .download-btn:hover { background: #172554; transform: translateY(-2px); box-shadow: 0 10px 20px -5px rgba(31, 58, 138, 0.3); }
    </style>
@endpush

@section('content')
    <main class="overflow-hidden bg-slate-50 min-h-screen">
        <section class="bg-gradient-to-r from-primary/10 to-primary-subtle py-12 md:py-16 border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 md:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <nav class="text-sm flex items-center gap-2 text-slate-500 mb-4 flex-wrap">
                            <a href="{{ route('home') }}" class="hover:text-primary transition-soft"><i class="fa-solid fa-home"></i> Home</a> /
                            <span class="text-primary font-semibold truncate max-w-[200px] md:max-w-md">{{ $page->title }}</span>
                        </nav>

                        @php
                            // Logika untuk memisahkan kata terakhir agar berwarna biru seperti template
                            $titleWords = explode(' ', $page->title);
                            $lastWord = array_pop($titleWords);
                            $firstPart = implode(' ', $titleWords);
                        @endphp

                        <h1 class="text-3xl md:text-4xl font-black text-dark uppercase tracking-tight">
                            {{ $firstPart }} <span class="text-primary">{{ $lastWord }}</span>
                        </h1>
                        <p class="text-slate-600 mt-2">
                            Pusat Informasi Pejabat Pengelola Informasi dan Dokumentasi (PPID)
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <button onclick="window.print()" class="bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-5 py-3 rounded-xl font-semibold transition-soft shadow-sm flex items-center gap-2">
                            <i class="fa-solid fa-print"></i> Cetak Halaman
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12">
            <div class="max-w-7xl mx-auto px-4 md:px-8">
                <div class="flex flex-col lg:flex-row gap-8">

                    <div class="lg:w-full">
                        <div class="bg-white rounded-3xl shadow-xl p-6 md:p-8 lg:p-12 border border-slate-100">

                            <div class="bg-slate-50 border border-slate-100 p-5 rounded-2xl flex flex-wrap gap-x-8 gap-y-4 text-sm mb-10">
                                <div class="flex items-center text-slate-600">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center mr-3">
                                        <i class="fa-regular fa-calendar"></i>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Terakhir Diperbarui</p>
                                        <p class="font-semibold text-dark">{{ $page->updated_at->translatedFormat('d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center text-slate-600">
                                    <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3">
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Dilihat Sebanyak</p>
                                        <p class="font-semibold text-dark">{{ number_format($page->views) }} Kali</p>
                                    </div>
                                </div>
                            </div>

                            <div class="ck-content max-w-none" id="main-content">
                                {!! html_entity_decode($page->content) !!}
                            </div>

                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-16 pt-8 border-t border-slate-100">
                                <span class="font-semibold text-slate-600">Bagikan halaman ini:</span>
                                <div class="flex gap-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 bg-slate-100 text-slate-600 hover:bg-[#1877F2] hover:text-white rounded-full flex items-center justify-center transition-soft">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($page->title) }}" target="_blank" class="w-10 h-10 bg-slate-100 text-slate-600 hover:bg-[#1DA1F2] hover:text-white rounded-full flex items-center justify-center transition-soft">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($page->title . ' - ' . url()->current()) }}" target="_blank" class="w-10 h-10 bg-slate-100 text-slate-600 hover:bg-[#25D366] hover:text-white rounded-full flex items-center justify-center transition-soft">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        @if($relatedMenus->count() > 0)
                            <div class="mt-12">
                                <h3 class="font-black text-2xl text-dark mb-6 flex items-center gap-2">
                                    <i class="fa-solid fa-link text-primary"></i> Informasi Terkait
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($relatedMenus as $menu)
                                        @php
                                            // Menentukan URL berdasarkan tipe menu
                                            $url = '#';
                                            if (in_array($menu->type, ['custom', 'external']) && $menu->url) {
                                                $url = $menu->url;
                                            } elseif ($menu->type == 'page' && $menu->page) {
                                                $url = route('page.detail', $menu->page->slug);
                                            } elseif ($menu->type == 'news' && $menu->news) {
                                                $url = route('news.detail', $menu->news->slug);
                                            } elseif ($menu->type == 'announcement' && $menu->announcement) {
                                                $url = route('announcement.detail', $menu->announcement->slug);
                                            }
                                        @endphp

                                        <a href="{{ $url }}" class="flex items-center p-5 bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-primary-light hover:-translate-y-1 transition-soft group">
                                            <div class="w-10 h-10 rounded-full bg-primary-subtle text-primary flex items-center justify-center mr-4 group-hover:bg-primary group-hover:text-white transition-soft shrink-0">
                                                <i class="fa-regular fa-file-lines"></i>
                                            </div>
                                            <span class="font-semibold text-slate-700 group-hover:text-primary transition-soft line-clamp-2">
                                                {{ $menu->name }}
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </section>

        <section class="py-12 bg-primary-subtle border-t border-slate-200">
            <div class="max-w-7xl mx-auto px-4 md:px-8">
                <div class="bg-white p-8 md:p-10 rounded-3xl shadow-xl flex flex-col md:flex-row items-center justify-between gap-8 border border-slate-100">
                    <div>
                        <h3 class="text-2xl font-black text-dark mb-2">Butuh Informasi Lebih Lanjut?</h3>
                        <p class="text-slate-600 max-w-xl">
                            Silakan ajukan permohonan informasi secara online atau hubungi petugas PPID untuk mendapatkan data publik yang Anda butuhkan.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-4 shrink-0">
                        <a href="#" class="bg-primary text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-primary-dark transition-soft shadow-md flex items-center gap-2">
                            <i class="fa-regular fa-pen-to-square"></i> Ajukan Permohonan
                        </a>
                        <a href="{{ route('contact') }}" class="bg-white border-2 border-primary text-primary px-6 py-3.5 rounded-xl font-semibold hover:bg-primary hover:text-white transition-soft flex items-center gap-2">
                            <i class="fa-regular fa-message"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
