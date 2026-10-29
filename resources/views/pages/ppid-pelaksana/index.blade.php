@extends('layouts.app')

@section('title', 'Daftar PPID Pelaksana')

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
                        info: '#0284C7',
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
                        float: 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                    },
                },
            },
        };
    </script>
@endpush

@push('styles')
    <style>
        .hero-ppid {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-ppid::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: rotate 30s linear infinite;
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -10px rgba(31, 58, 138, 0.2);
        }
    </style>
@endpush

@section('content')
    <main>
        <!-- Hero Section -->
        <section class="hero-ppid py-20 md:py-28 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative max-w-7xl mx-auto px-4 md:px-8 lg:px-12 text-center text-white z-10">
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6 animate-fade-in">
                    <i class="fa-solid fa-building text-sm"></i>
                    <span class="text-sm font-medium">DAFTAR OPD</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 animate-slide-up">
                    PPID <span class="text-blue-200">PELAKSANA</span>
                </h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto">
                    Daftar Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana pada Organisasi Perangkat Daerah (OPD) di lingkungan Pemerintah Kabupaten Konawe.
                </p>
            </div>

            <!-- Wave Decoration -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" fill="#F8FAFC">
                    <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,100L1360,100C1280,100,1120,100,960,100C800,100,640,100,480,100C320,100,160,100,80,100L0,100Z"></path>
                </svg>
            </div>
        </section>

        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-6">
            <div class="flex items-center text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-primary transition-soft"><i class="fa-solid fa-home mr-1"></i> Beranda</a>
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-primary font-medium">PPID Pelaksana</span>
            </div>
        </div>

        <!-- OPD List Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-10 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($opds as $opd)
                    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-slate-100 flex flex-col h-full">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-20 h-20 bg-slate-50 rounded-xl p-1.5 border border-slate-100 flex-shrink-0 flex items-center justify-center">
                                @if($opd->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($opd->logo))
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($opd->logo) }}" alt="Logo {{ $opd->singkatan ?? $opd->nama_opd }}" class="max-w-full max-h-full object-contain">
                                @else
                                    <img src="{{ asset('image/logo_konawe.png') }}" alt="Logo Kabupaten Konawe" class="max-w-full max-h-full object-contain">
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-lg leading-tight text-dark">{{ $opd->nama_opd }}</h3>
                                <div class="flex flex-wrap items-center gap-1.5 mt-1.5">
                                    @if($opd->singkatan)
                                        <span class="inline-block bg-primary/10 text-primary text-xs font-semibold px-2 py-0.5 rounded">{{ $opd->singkatan }}</span>
                                    @endif
                                    @if($opd->tipe_unit)
                                        <span class="inline-block bg-emerald-50 text-emerald-700 text-xs font-medium px-2 py-0.5 rounded border border-emerald-200">Tipe {{ $opd->tipe_unit }}</span>
                                    @endif
                                    @if($opd->id_unit)
                                        <span class="inline-block bg-slate-100 text-slate-500 text-xs px-1.5 py-0.5 rounded font-mono">{{ $opd->id_unit }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 mt-4 text-sm text-slate-600 flex-grow">
                            @if($opd->kepala_opd)
                                <div class="flex items-start gap-3">
                                    <i class="fa-solid fa-user-tie text-primary mt-1 w-4 text-center"></i>
                                    <div>
                                        <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider">Kepala OPD</span>
                                        <span class="font-medium text-slate-700">{{ $opd->kepala_opd }}</span>
                                    </div>
                                </div>
                            @endif

                            @if($opd->alamat)
                                <div class="flex items-start gap-3">
                                    <i class="fa-solid fa-location-dot text-primary mt-1 w-4 text-center"></i>
                                    <div>
                                        <span>{{ $opd->alamat }}</span>
                                        @if($opd->latitude && $opd->longitude)
                                            <div class="mt-1">
                                                <a href="https://www.google.com/maps/search/?api=1&query={{ $opd->latitude }},{{ $opd->longitude }}" target="_blank" rel="noopener noreferrer" class="text-xs text-blue-600 hover:text-blue-800 font-medium inline-flex items-center gap-1 transition-soft">
                                                    <i class="fa-solid fa-map-location-dot"></i>
                                                    <span>Lihat Rute di Maps</span>
                                                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif($opd->latitude && $opd->longitude)
                                <div class="flex items-start gap-3">
                                    <i class="fa-solid fa-map-location-dot text-primary mt-1 w-4 text-center"></i>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $opd->latitude }},{{ $opd->longitude }}" target="_blank" rel="noopener noreferrer" class="text-xs text-blue-600 hover:text-blue-800 font-medium inline-flex items-center gap-1 transition-soft">
                                        <span>Lihat Lokasi di Google Maps</span>
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                    </a>
                                </div>
                            @endif

                            @if($opd->keterangan)
                                <div class="flex items-start gap-3">
                                    <i class="fa-solid fa-scale-balanced text-primary mt-1 w-4 text-center"></i>
                                    <div class="text-xs text-slate-500">
                                        <span class="font-medium text-slate-600">Dasar Hukum:</span> {{ $opd->keterangan }}
                                        @if($opd->file_dasar_hukum)
                                            <a href="{{ $opd->file_dasar_hukum }}" target="_blank" class="text-primary hover:underline ml-1">
                                                <i class="fa-solid fa-file-pdf"></i> Unduh
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if($opd->telepon)
                                <div class="flex items-start gap-3">
                                    <i class="fa-solid fa-phone text-primary mt-1 w-4 text-center"></i>
                                    <span>{{ $opd->telepon }}</span>
                                </div>
                            @endif

                            @if($opd->email)
                                <div class="flex items-start gap-3">
                                    <i class="fa-solid fa-envelope text-primary mt-1 w-4 text-center"></i>
                                    <a href="mailto:{{ $opd->email }}" class="hover:text-primary transition-soft">{{ $opd->email }}</a>
                                </div>
                            @endif
                        </div>

                        @if($opd->website)
                            <div class="mt-6 pt-4 border-t border-slate-100 text-center">
                                <a href="{{ Str::startsWith($opd->website, ['http://', 'https://']) ? $opd->website : 'https://' . $opd->website }}" target="_blank" class="inline-flex items-center gap-2 text-primary hover:text-primary-dark font-medium text-sm transition-soft group">
                                    Kunjungi Website <i class="fa-solid fa-arrow-up-right-from-square text-xs group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-transform"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full bg-slate-50 border border-slate-100 rounded-2xl p-10 text-center">
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm text-slate-400 text-3xl">
                            <i class="fa-solid fa-building-circle-xmark"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-2">Data Belum Tersedia</h3>
                        <p class="text-slate-500">Daftar PPID Pelaksana (OPD) belum ditambahkan.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </main>
@endsection
