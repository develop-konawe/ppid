@extends('layouts.app')

@section('title', 'Galeri Dokumentasi')

@push('scripts-head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.css" />
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
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideUp: { '0%': { transform: 'translateY(10px)', opacity: '0' }, '100%': { transform: 'translateY(0)', opacity: '1' } },
                    },
                },
            },
        };
    </script>
@endpush

@push('styles')
    <style>
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .hero-gradient { background: linear-gradient(135deg, #f8fafc 0%, #e8f2ff 50%, #f0f9ff 100%); }

        /* Gallery Card Styles */
        .gallery-card { position: relative; overflow: hidden; border-radius: 1.5rem; box-shadow: 0 10px 30px -10px rgba(31, 58, 138, 0.2); cursor: pointer; height: 350px; display: block; text-decoration: none; background: linear-gradient(135deg, #1f3a8a 0%, #3b82f6 100%); }
        .gallery-card img, .gallery-card video, .gallery-card iframe { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1); display: block; border: none; }

        /* Hanya jalankan efek zoom untuk foto */
        .gallery-card.type-photo:hover img { transform: scale(1.1); }

        .gallery-overlay { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(31, 58, 138, 0.95), transparent); padding: 2rem 1.5rem 1.5rem; transform: translateY(100%); transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1); color: white; pointer-events: none; }
        .gallery-card:hover .gallery-overlay { transform: translateY(0); }
        .gallery-overlay h3 { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem; font-family: 'Poppins', sans-serif; }
        .gallery-overlay p { font-size: 0.9rem; opacity: 0.9; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

        .gallery-badge { position: absolute; top: 1rem; right: 1rem; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px); padding: 0.5rem 1rem; border-radius: 2rem; color: white; font-size: 0.8rem; font-weight: 600; border: 1px solid rgba(255, 255, 255, 0.3); z-index: 10; pointer-events: none; }
        .gallery-badge-type { position: absolute; top: 1rem; left: 1rem; background: rgba(220, 38, 38, 0.8); backdrop-filter: blur(8px); padding: 0.4rem 0.8rem; border-radius: 2rem; color: white; font-size: 0.75rem; font-weight: 700; z-index: 10; pointer-events: none; letter-spacing: 0.05em; text-transform: uppercase; }

        /* Gallery Grid */
        .gallery-grid { display: grid; grid-template-columns: repeat(1, 1fr); gap: 1.5rem; }
        @media (min-width: 768px) { .gallery-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .gallery-grid { grid-template-columns: repeat(3, 1fr); } }

        /* Pagination Override Laravel */
        .pagination-wrapper nav { display: flex; justify-content: center; margin-top: 3rem; }
        .pagination-wrapper .flex.justify-between { display: none; }

        @media (max-width: 768px) {
            .gallery-card { height: 280px; }
            .gallery-overlay { padding: 1.5rem 1rem 1rem; }
            .gallery-overlay h3 { font-size: 1rem; }
            .gallery-overlay p { font-size: 0.8rem; }
        }
    </style>
@endpush

@section('content')
    <main class="overflow-hidden bg-slate-50 min-h-screen">
        <section class="hero-gradient relative overflow-hidden pt-20 pb-16 px-6 md:px-12 border-b border-slate-200">
            <div class="max-w-7xl mx-auto text-center relative z-10">
                <div class="inline-block px-4 py-1.5 bg-white/80 backdrop-blur-sm text-primary rounded-full text-xs font-bold uppercase tracking-wider mb-6 border border-primary/20">
                    <i class="fa-solid fa-images mr-2"></i> Dokumentasi Visual
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-dark leading-[1.15] mb-6 animate-fade-in">
                    Gallery <span class="text-primary">Kegiatan</span> PPID
                </h1>
                <p class="text-lg text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Dokumentasi visual kegiatan, pelatihan, dan implementasi keterbukaan informasi publik di Kabupaten Konawe. Setiap gambar dan video bercerita tentang transparansi yang kami wujudkan.
                </p>

                <div class="flex flex-wrap justify-center gap-8 mb-4">
                    <div class="text-center bg-white/60 backdrop-blur-md px-6 py-4 rounded-2xl border border-white shadow-sm">
                        <p class="text-3xl font-black text-primary mb-1">{{ \App\Models\Gallery::count() }}</p>
                        <p class="text-slate-600 text-sm font-medium">Total Dokumentasi</p>
                    </div>
                </div>
            </div>

            <div class="absolute top-20 right-10 w-40 h-40 bg-primary/5 rounded-full blur-3xl" aria-hidden="true"></div>
            <div class="absolute bottom-10 left-10 w-60 h-60 bg-blue-100/30 rounded-full blur-3xl" aria-hidden="true"></div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 py-16">
            <div class="gallery-grid" id="gallery-grid">
                @forelse($gallery as $item)
                    @php
                        // Prioritaskan file lokal (media_path), jika kosong gunakan link eksternal (media_url)
                        $mediaSrc = $item->media_path ? asset('storage/' . $item->media_path) : $item->media_url;
                        $captionTitle = $item->caption ?? ($item->type === 'photo' ? 'Foto Kegiatan' : 'Video Dokumentasi');
                        $description = html_entity_decode(strip_tags($item->description));
                    @endphp

                    @if($item->type === 'photo')
                        <a href="{{ $mediaSrc }}" class="gallery-card type-photo group" data-caption="<strong>{{ $captionTitle }}</strong><br/>{{ $description }}">
                            <img src="{{ $mediaSrc }}" alt="{{ $captionTitle }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800'">

                            <div class="gallery-badge">
                                <i class="fa-regular fa-calendar mr-1"></i> {{ $item->created_at->translatedFormat('d M Y') }}
                            </div>

                            <div class="gallery-overlay">
                                <h3>{{ $captionTitle }}</h3>
                                <p>{{ $description }}</p>
                            </div>
                        </a>

                    @elseif($item->type === 'video')
                        <div class="gallery-card type-video group bg-black">
                            <div class="gallery-badge-type">
                                <i class="fa-solid fa-play mr-1"></i> Video
                            </div>
                            <div class="gallery-badge">
                                <i class="fa-regular fa-calendar mr-1"></i> {{ $item->created_at->translatedFormat('d M Y') }}
                            </div>

                            @if($item->media_path)
                                <video src="{{ $mediaSrc }}" controls class="w-full h-full object-cover" preload="metadata"></video>
                            @elseif(Str::contains($item->media_url, ['youtube.com', 'youtu.be']))
                                @php
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $item->media_url, $matches);
                                    $ytId = $matches[1] ?? '';
                                @endphp

                                @if($ytId)
                                    <iframe class="w-full h-full object-cover" src="https://www.youtube.com/embed/{{ $ytId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @else
                                    <a href="{{ $item->media_url }}" target="_blank" class="w-full h-full flex flex-col items-center justify-center text-white bg-slate-800 hover:bg-slate-700 transition-soft">
                                        <i class="fa-brands fa-youtube text-5xl text-red-600 mb-3"></i>
                                        <span class="font-medium hover:underline">Tonton di YouTube</span>
                                    </a>
                                @endif
                            @else
                                <a href="{{ $item->media_url }}" target="_blank" class="w-full h-full flex flex-col items-center justify-center text-white bg-slate-800 hover:bg-slate-700 transition-soft">
                                    <i class="fa-solid fa-arrow-up-right-from-square text-4xl text-slate-400 mb-3"></i>
                                    <span class="font-medium hover:underline">Buka Tautan Media</span>
                                </a>
                            @endif

                            <div class="gallery-overlay pointer-events-none">
                                <h3>{{ $captionTitle }}</h3>
                                <p>{{ $description }}</p>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-slate-100 shadow-sm">
                        <i class="fa-regular fa-images text-6xl text-slate-300 mb-4 block"></i>
                        <p class="text-slate-500 font-medium">Belum ada dokumentasi di galeri.</p>
                    </div>
                @endforelse
            </div>

            <div class="pagination-wrapper mt-10">
                {{ $gallery->links() }}
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Inisialisasi Lightbox HANYA untuk elemen dengan class .type-photo
            // Sehingga klik pada card video tidak akan memicu error Lightbox
            let lightbox = new SimpleLightbox('#gallery-grid a.type-photo', {
                captions: true,
                captionSelector: 'self',
                captionType: 'data',
                captionsData: 'caption',
                captionPosition: 'bottom',
                captionDelay: 0,
                animationSpeed: 300,
                fadeSpeed: 300,
                overlayOpacity: 0.9,
                disableScroll: true,
                close: true,
                nav: true,
                navText: ['←', '→'],
                closeText: '×',
            });
        });
    </script>
@endpush
