@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', $announcement->title)

@push('scripts-head')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#1F3A8A', dark: '#172554', light: '#3B82F6', subtle: '#EFF6FF' },
                        secondary: '#DC2626',
                        accent: '#059669',
                        info: '#0284C7',
                        exclusive: '#6B21A8',
                        announcement: '#B45309',
                        light: '#F8FAFC',
                        dark: '#0F172A',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        heading: ['Poppins', 'Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
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
    <meta property="og:title" content="{{ $announcement->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($announcement->description), 150) }}">
    <meta property="og:image" content="{{ asset('storage/'.$announcement->image) }}">
    <meta property="og:url" content="{{ route('announcement.detail', $announcement->slug) }}">
    <meta property="og:type" content="article">

    <style>
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.1); }

        .announcement-detail-hero {
            background: linear-gradient(135deg, #b45309 0%, #92400e 100%);
            position: relative;
            overflow: hidden;
        }

        /* CKEditor Responsive Styling */
        .ck-content {
            font-family: 'Inter', sans-serif;
            color: #1e293b;
            line-height: 1.7;
        }
        .ck-content h2 {
            font-size: 1.75rem; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem;
            color: #1f3a8a; border-left: 6px solid #b45309; padding-left: 1rem;
        }
        .ck-content h3 { font-size: 1.4rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.75rem; color: #2d3c5e; }
        .ck-content p { margin-bottom: 1.2rem; font-size: 1.05rem; }
        .ck-content ul, .ck-content ol { margin-left: 2rem; margin-bottom: 1.5rem; }
        .ck-content ul { list-style-type: disc; }
        .ck-content ol { list-style-type: decimal; }
        .ck-content li { margin-bottom: 0.3rem; }
        .ck-content a { color: #b45309; text-decoration: underline; }
        .ck-content blockquote {
            border-left: 5px solid #b45309; background: #fffbeb; padding: 1rem 1.5rem; font-style: italic; margin: 1.5rem 0; border-radius: 0 1rem 1rem 0;
        }
        .ck-content table { border-collapse: collapse; width: 100%; margin: 1.5rem 0; display: block; overflow-x: auto; }
        .ck-content td, .ck-content th { border: 1px solid #e2e8f0; padding: 0.75rem; text-align: left; }
        .ck-content th { background: #1f3a8a; color: white; font-weight: 600; }
        /* Memastikan gambar/video di dalam editor tidak meluber */
        .ck-content img, .ck-content iframe {
            max-width: 100%; height: auto; border-radius: 1rem; margin: 1.5rem 0; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .ck-content iframe { width: 100%; aspect-ratio: 16/9; }

        .status-badge { @apply px-3 py-1 rounded-full text-xs font-medium inline-flex items-center gap-1; }
    </style>
@endpush

@section('content')
    <main class="bg-slate-50 min-h-screen">
{{--        <section class="announcement-detail-hero py-12 md:py-16 relative overflow-hidden">--}}
{{--            <div class="absolute inset-0 bg-black/10"></div>--}}
{{--            <div class="relative max-w-7xl mx-auto px-4 md:px-8 lg:px-12 text-center text-white z-10">--}}
{{--                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-4">--}}
{{--                    <i class="fa-solid fa-file-lines text-sm"></i>--}}
{{--                    <span class="text-sm font-medium">DETAIL PENGUMUMAN</span>--}}
{{--                </div>--}}
{{--                <h2 class="text-3xl md:text-4xl font-black mb-2 animate-slide-up">#InformasiResmi</h2>--}}
{{--                <p class="text-lg text-amber-100 max-w-2xl mx-auto">--}}
{{--                    Baca selengkapnya pengumuman resmi dari PPID Kabupaten Konawe--}}
{{--                </p>--}}
{{--            </div>--}}
{{--            <div class="absolute bottom-0 left-0 right-0">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" fill="#F8FAFC">--}}
{{--                    <path d="M0,48L80,53.3C160,59,320,69,480,69.3C640,69,800,59,960,53.3C1120,48,1280,48,1360,48L1440,48L1440,80L1360,80C1280,80,1120,80,960,80C800,80,640,80,480,80C320,80,160,80,80,80L0,80Z" />--}}
{{--                </svg>--}}
{{--            </div>--}}
{{--        </section>--}}

        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-4">
            <div class="flex items-center text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-primary"><i class="fa-solid fa-home mr-1"></i> Beranda</a>
                <span class="mx-2 text-slate-400">/</span>
                <a href="{{ route('announcement') }}" class="hover:text-primary">Pengumuman</a>
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-amber-600 font-medium truncate max-w-xs md:max-w-md">{{ $announcement->title }}</span>
            </div>
        </div>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 pb-16">
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">

                <div class="p-6 md:p-8 lg:p-10 border-b border-slate-200 bg-gradient-to-r from-amber-50 to-white">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                        <div class="w-full lg:w-3/4">
                            <div class="flex flex-wrap gap-3 items-center mb-4">
                                @php
                                    $catName = strtolower($announcement->category->name ?? '');
                                    $badgeColor = 'bg-slate-100 text-slate-700'; $icon = 'fa-tag';
                                    if(Str::contains($catName, 'layan')) { $badgeColor = 'bg-amber-100 text-amber-700'; $icon = 'fa-clock'; }
                                    elseif(Str::contains($catName, 'pegawai')) { $badgeColor = 'bg-blue-100 text-blue-700'; $icon = 'fa-users'; }
                                    elseif(Str::contains($catName, 'ada')) { $badgeColor = 'bg-green-100 text-green-700'; $icon = 'fa-truck'; }
                                    elseif(Str::contains($catName, 'giat')) { $badgeColor = 'bg-orange-100 text-orange-700'; $icon = 'fa-chalkboard-user'; }
                                    elseif(Str::contains($catName, 'libur')) { $badgeColor = 'bg-purple-100 text-purple-700'; $icon = 'fa-calendar-alt'; }
                                @endphp

                                <span class="status-badge {{ $badgeColor }}  rounded-full px-2 py-1">
                                    <i class="fa-solid {{ $icon }}"></i> {{ $announcement->category->name ?? 'Umum' }}
                                </span>

                                @if($announcement->is_active)
                                    <span class="status-badge bg-red-100 text-red-600  rounded-full px-2 py-1">
                                        <i class="fa-solid fa-circle text-[8px] mr-1"></i> AKTIF
                                    </span>
                                @endif

                                @if($announcement->file_path)
                                    <span class="text-sm bg-slate-100 text-slate-700 px-3 py-1 rounded-full font-medium flex items-center">
                                        <i class="fa-regular fa-file-pdf mr-1 text-amber-600"></i> Ada Lampiran
                                    </span>
                                @endif
                            </div>

                            <h1 class="text-2xl md:text-3xl lg:text-4xl font-black text-dark mb-4 leading-tight">
                                {{ $announcement->title }}
                            </h1>

                            <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-slate-500">
                                <span><i class="fa-regular fa-calendar mr-2 text-amber-600"></i>Diterbitkan: {{ $announcement->published_at ? $announcement->published_at->translatedFormat('d F Y') : '-' }}</span>
                                <span><i class="fa-regular fa-user mr-2 text-amber-600"></i>Oleh: {{ $announcement->creator->name ?? 'Admin PPID' }}</span>
                                <span><i class="fa-regular fa-eye mr-2 text-amber-600"></i>Dilihat: {{ $announcement->views }} Kali</span>
                            </div>
                        </div>

                        <div class="flex gap-2 shrink-0 mt-4 md:mt-0">
                            <button onclick="window.print()" class="bg-white border border-slate-200 hover:bg-amber-50 text-slate-700 px-4 py-2.5 rounded-xl font-medium text-sm transition-soft shadow-sm flex items-center">
                                <i class="fa-solid fa-print mr-2"></i> Cetak
                            </button>
                            @if($announcement->file_path)
                                <a href="{{ asset('storage/' . $announcement->file_path) }}" download class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2.5 rounded-xl font-medium text-sm transition-soft shadow-md flex items-center gap-2">
                                    <i class="fa-solid fa-download"></i> Unduh File
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                @if($announcement->image)
                    <div class="w-full max-h-[500px] overflow-hidden bg-slate-100 border-b border-slate-100 flex justify-center">
                        @if(is_file(public_path('storage/'.$announcement->image)))
                            <img class="w-full h-auto object-cover" alt="{{ $announcement->title }}" src="{{ asset('storage/' . $announcement->image) }}">
                        @elseif(is_file(public_path($announcement->image)))
                            <img class="w-full h-auto object-cover" alt="{{ $announcement->title }}" src="{{ asset($announcement->image) }}">
                        @else
                            <img class="w-full h-auto object-cover" alt="Gambar Pengumuman" src="{{ asset('image/28.jpg') }}">
                        @endif
                    </div>
                @endif

                <div class="p-6 md:p-8 lg:p-10">
                    <div class="ck-content prose prose-amber max-w-none" id="announcement-content">
                        {!! html_entity_decode(str($announcement->description)->sanitizeHtml()) !!}
                    </div>

                    @if($announcement->file_path)
                        <div class="mt-10 p-6 bg-slate-50 rounded-2xl border border-slate-200">
                            <h4 class="font-bold text-lg mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-paperclip text-amber-600"></i> Dokumen Lampiran Resmi
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                <a href="{{ asset('storage/' . $announcement->file_path) }}" download class="flex items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 hover:border-amber-400 hover:shadow-md transition-soft group">
                                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-soft shrink-0">
                                        <i class="fa-regular fa-file-pdf text-xl"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="font-bold text-dark text-sm truncate group-hover:text-amber-700 transition-soft">Unduh Dokumen</p>
                                        <p class="text-xs text-slate-400 truncate">Klik untuk menyimpan file</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-10 pt-6 border-t border-slate-200">
                        <div class="flex items-center gap-3">
                            <span class="text-slate-500 text-sm">Bagikan:</span>
                            <div class="flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('announcement.detail', $announcement->slug)) }}" target="_blank" class="w-9 h-9 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-[#1877F2] hover:text-white transition-soft">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('announcement.detail', $announcement->slug)) }}&text={{ urlencode($announcement->title) }}" target="_blank" class="w-9 h-9 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-[#1DA1F2] hover:text-white transition-soft">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($announcement->title . ' - ' . route('announcement.detail', $announcement->slug)) }}" target="_blank" class="w-9 h-9 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-[#25D366] hover:text-white transition-soft">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('announcement') }}" class="text-amber-600 hover:text-amber-800 font-medium text-sm flex items-center gap-1">
                                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12">
                <h3 class="text-2xl font-black text-dark mb-6 flex items-center gap-2">
                    <i class="fa-regular fa-newspaper text-amber-600"></i> Pengumuman Lainnya
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($prev)
                        <div class="bg-white p-6 rounded-xl shadow-md border border-slate-100 card-hover flex flex-col justify-between">
                            <div>
                                <span class="status-badge bg-slate-100 text-slate-600 text-xs mb-3 inline-block rounded-full px-3 py-1">
                                    <i class="fa-solid fa-arrow-left"></i> Sebelumnya
                                </span>
                                <h4 class="font-bold text-dark mb-2 text-lg line-clamp-2">{{ $prev->title }}</h4>
                                <p class="text-xs text-slate-500 mb-4"><i class="fa-regular fa-calendar mr-1"></i> {{ $prev->published_at ? $prev->published_at->translatedFormat('d F Y') : '-' }}</p>
                            </div>
                            <a href="{{ route('announcement.detail', $prev->slug) }}" class="text-amber-600 font-medium text-sm inline-flex items-center gap-1 hover:text-amber-800 transition-soft">
                                Baca Pengumuman <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    @else
                        <div></div>
                    @endif

                    @if($next)
                        <div class="bg-white p-6 rounded-xl shadow-md border border-slate-100 card-hover flex flex-col justify-between">
                            <div>
                                <span class="status-badge bg-slate-100 text-slate-600 text-xs mb-3 inline-block rounded-full px-3 py-1">
                                    Selanjutnya <i class="fa-solid fa-arrow-right ml-1"></i>
                                </span>
                                <h4 class="font-bold text-dark mb-2 text-lg line-clamp-2">{{ $next->title }}</h4>
                                <p class="text-xs text-slate-500 mb-4"><i class="fa-regular fa-calendar mr-1"></i> {{ $next->published_at ? $next->published_at->translatedFormat('d F Y') : '-' }}</p>
                            </div>
                            <a href="{{ route('announcement.detail', $next->slug) }}" class="text-amber-600 font-medium text-sm inline-flex items-center gap-1 hover:text-amber-800 transition-soft">
                                Baca Pengumuman <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
