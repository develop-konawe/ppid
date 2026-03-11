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
                            DEFAULT: '#1F3A8A', dark: '#172554', light: '#3B82F6', subtle: '#EFF6FF',
                        },
                        secondary: '#DC2626', accent: '#059669', light: '#F8FAFC', dark: '#0F172A',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['Poppins', 'Inter', 'sans-serif'],
                        serif: ['Lora', 'Georgia', 'serif'],
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

        /* Article Typography - Enhanced untuk CKEditor content */
        .article-content {
            font-family: 'Lora', Georgia, serif; font-size: 1.125rem; line-height: 1.8; color: #1e293b;
            word-wrap: break-word; overflow-wrap: break-word;
        }

        /* Styling elemen HTML dari CKEditor */
        .article-content h1, .article-content h2, .article-content h3, .article-content h4 { font-family: 'Poppins', sans-serif; color: #0f172a; }
        .article-content h1 { font-size: 2.25rem; font-weight: 700; margin-top: 3rem; margin-bottom: 1.5rem; line-height: 1.3; }
        .article-content h2 { font-size: 1.875rem; font-weight: 700; margin-top: 2.5rem; margin-bottom: 1.25rem; line-height: 1.3; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem; }
        .article-content h3 { font-size: 1.5rem; font-weight: 600; margin-top: 2rem; margin-bottom: 1rem; }
        .article-content h4 { font-size: 1.25rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.75rem; }

        .article-content p { margin-bottom: 1.75rem; }
        .article-content p:last-child { margin-bottom: 0; }

        .article-content blockquote {
            font-style: italic; border-left: 4px solid #1F3A8A; padding: 1.5rem 2rem; margin: 2rem 0; color: #334155;
            font-size: 1.25rem; background: #f8fafc; border-radius: 1rem; position: relative;
        }
        .article-content blockquote::before {
            content: '"'; font-size: 4rem; color: #1F3A8A; opacity: 0.2; position: absolute; top: -0.5rem; left: 0.5rem; font-family: serif;
        }

        .article-content ul, .article-content ol { margin: 1.5rem 0; padding-left: 2rem; }
        .article-content li { margin-bottom: 0.5rem; }
        .article-content ul li { list-style-type: disc; }
        .article-content ol li { list-style-type: decimal; }

        .article-content a { color: #1F3A8A; text-decoration: underline; text-underline-offset: 2px; transition: color 0.3s ease; }
        .article-content a:hover { color: #3B82F6; }

        .article-content img { max-width: 100%; height: auto; border-radius: 1rem; margin: 2rem 0; box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.2); display: block; }
        .article-content figure { margin: 2rem 0; }
        .article-content figcaption { text-align: center; font-size: 0.875rem; color: #64748b; margin-top: 0.5rem; font-style: italic; }

        .article-content table { width: 100%; border-collapse: collapse; margin: 2rem 0; font-size: 0.95rem; }
        .article-content th { background: #1F3A8A; color: white; font-weight: 600; padding: 0.75rem 1rem; text-align: left; }
        .article-content td { padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0; }
        .article-content tr:nth-child(even) { background: #f8fafc; }

        .article-content .table-responsive { overflow-x: auto; margin: 2rem 0; }
        .article-content .embed-responsive { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; margin: 2rem 0; border-radius: 1rem; }
        .article-content .embed-responsive iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0; }

        /* Table of Contents */
        .toc { background: #f8fafc; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; border: 1px solid #e2e8f0; }
        .toc-title { font-family: 'Poppins', sans-serif; font-weight: 600; color: #1F3A8A; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }
        .toc ul { list-style: none; padding: 0; margin: 0; }
        .toc li { margin-bottom: 0.5rem; }
        .toc a { color: #334155; text-decoration: none; display: inline-block; transition: all 0.3s ease; border-left: 2px solid transparent; padding-left: 0.75rem; font-family: 'Inter', sans-serif;}
        .toc a:hover { color: #1F3A8A; border-left-color: #1F3A8A; padding-left: 1rem; }

        /* Share buttons & Utilities */
        .share-btn { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; color: white; }
        .share-btn.facebook { background: #1877f2; }
        .share-btn.twitter { background: #1da1f2; }
        .share-btn.whatsapp { background: #25d366; }
        .share-btn.linkedin { background: #0a66c2; }
        .share-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.3); }

        .progress-bar { position: fixed; top: 0; left: 0; width: 0%; height: 4px; background: linear-gradient(90deg, #1F3A8A, #3B82F6); z-index: 100; transition: width 0.1s ease; }
        .reading-time { background: #e2e8f0; color: #475569; padding: 0.25rem 0.75rem; border-radius: 2rem; font-size: 0.75rem; font-weight: 500; }

        .news-card { background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 5px 15px -5px rgba(31, 58, 138, 0.1); transition: all 0.3s ease; border: 1px solid #e2e8f0; height: 100%; display: flex; flex-direction: column;}
        .news-card:hover { transform: translateY(-5px); box-shadow: 0 20px 30px -10px rgba(31, 58, 138, 0.2); }

        #back-to-top { opacity: 0; visibility: hidden; transition: all 0.3s ease; }
        #back-to-top.visible { opacity: 1; visibility: visible; }

        @media (max-width: 768px) {
            .article-content { font-size: 1rem; }
            .article-content h1 { font-size: 1.875rem; }
            .article-content h2 { font-size: 1.5rem; }
            .article-content h3 { font-size: 1.25rem; }
            .article-content blockquote { font-size: 1.1rem; padding: 1rem 1.5rem; }
        }
    </style>
@endpush

@section('content')
    <div class="progress-bar" id="progress-bar"></div>

    <main class="max-w-7xl mx-auto px-4 md:px-8 py-8 mt-6">
        <div class="flex items-center gap-2 text-slate-500 font-sans text-sm mb-6 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-primary transition-soft"><i class="fa-solid fa-home"></i> Beranda</a>
            <i class="fa-solid fa-chevron-right text-xs"></i>
            <a href="{{ route('news') }}" class="hover:text-primary transition-soft">Berita</a>
            <i class="fa-solid fa-chevron-right text-xs"></i>
            <span class="text-slate-500 truncate max-w-xs md:max-w-md">{{ $berita->title }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8">
                <article class="bg-white rounded-3xl shadow-lg p-6 md:p-10 animate-fade-in border border-slate-100">

                    <div class="flex flex-wrap items-center gap-3 mb-6 font-sans">
                        <span class="bg-primary-subtle text-primary px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                            <i class="fa-regular fa-folder mr-1"></i> {{ $berita->category->name ?? 'Berita Umum' }}
                        </span>

                        @if($berita->is_featured)
                            <span class="bg-amber-100 text-amber-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                                <i class="fa-solid fa-star mr-1"></i> Pilihan Editor
                            </span>
                        @endif

                        <span class="text-slate-500 text-sm flex items-center">
                            <i class="fa-regular fa-calendar mr-2"></i> {{ $berita->created_at->translatedFormat('d F Y') }}
                        </span>

                        <span class="text-slate-500 text-sm flex items-center ml-auto">
                            <i class="fa-regular fa-eye mr-2"></i> {{ $berita->views }} kali dilihat
                        </span>
                    </div>

                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-dark mb-6 font-heading leading-tight">
                        {{ $berita->title }}
                    </h1>

                    <div class="flex items-center justify-between flex-wrap gap-4 mb-8 pb-8 border-b border-slate-200 font-sans">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold text-xl">
                                {{ substr($berita->creator->name ?? 'A', 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-dark">{{ $berita->creator->name ?? 'Admin PPID' }}</p>
                                <p class="text-xs text-slate-500 uppercase tracking-wide">Tim Redaksi PPID</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button class="share-btn facebook" title="Bagikan ke Facebook" onclick="shareOnFacebook()"><i class="fa-brands fa-facebook-f"></i></button>
                            <button class="share-btn twitter" title="Bagikan ke Twitter" onclick="shareOnTwitter()"><i class="fa-brands fa-twitter"></i></button>
                            <button class="share-btn whatsapp" title="Bagikan ke WhatsApp" onclick="shareOnWhatsApp()"><i class="fa-brands fa-whatsapp"></i></button>
                            <button class="share-btn linkedin" title="Bagikan ke LinkedIn" onclick="shareOnLinkedIn()"><i class="fa-brands fa-linkedin-in"></i></button>
                        </div>
                    </div>

                    @if($berita->image)
                        <div class="mb-8">
                            <img src="{{ asset('storage/'.$berita->image) }}" alt="{{ $berita->title }}" class="w-full h-auto max-h-[500px] object-cover rounded-2xl shadow-md">
                        </div>
                    @endif

                    <div class="toc mb-8" id="table-of-contents" style="display: none;">
                        <div class="toc-title">
                            <i class="fa-solid fa-list-ul"></i>
                            <span>Daftar Isi Artikel</span>
                        </div>
                        <ul id="toc-list" class="font-sans text-sm">
                        </ul>
                    </div>

                    <div class="article-content" id="article-content">
                        {!! html_entity_decode($berita->content) !!}
                    </div>

                    <div class="mt-12 p-6 bg-primary-subtle rounded-2xl font-sans">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-share-nodes text-2xl text-primary"></i>
                                <span class="font-semibold text-dark">Bagikan informasi ini:</span>
                            </div>
                            <div class="flex gap-3">
                                <button class="share-btn facebook" onclick="shareOnFacebook()"><i class="fa-brands fa-facebook-f"></i></button>
                                <button class="share-btn twitter" onclick="shareOnTwitter()"><i class="fa-brands fa-twitter"></i></button>
                                <button class="share-btn whatsapp" onclick="shareOnWhatsApp()"><i class="fa-brands fa-whatsapp"></i></button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <div class="lg:col-span-4 space-y-6 font-sans">

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100">
                    <h3 class="font-bold text-lg text-dark mb-4 flex items-center">
                        <i class="fa-regular fa-pen-to-square text-primary mr-2"></i>
                        Tentang Penulis
                    </h3>
                    <div class="text-center">
                        <div class="w-20 h-20 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4 border-4 border-primary-subtle text-3xl font-bold">
                            {{ substr($berita->creator->name ?? 'A', 0, 1) }}
                        </div>
                        <h4 class="font-bold text-dark">{{ $berita->creator->name ?? 'Admin PPID' }}</h4>
                        <p class="text-sm text-slate-500 mb-3">Tim Redaksi</p>
                        <p class="text-sm text-slate-600">
                            Pengelola informasi publik pada PPID Pemerintah Kabupaten Konawe.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100 sticky top-24">
                    <h3 class="font-bold text-lg text-dark mb-4 flex items-center">
                        <i class="fa-regular fa-newspaper text-primary mr-2"></i>
                        Baca Juga
                    </h3>
                    <div class="space-y-4">
                        @if($prev)
                            <a href="{{ route('news.detail', $prev->slug) }}" class="flex gap-3 group items-center">
                                @if($prev->image)
                                    <img src="{{ asset('storage/'.$prev->image) }}" alt="Berita" class="w-20 h-16 rounded-lg object-cover group-hover:opacity-90 transition shrink-0">
                                @else
                                    <div class="w-20 h-16 rounded-lg bg-slate-100 flex items-center justify-center shrink-0">
                                        <i class="fa-regular fa-image text-slate-400"></i>
                                    </div>
                                @endif
                                <div>
                                    <span class="text-[10px] font-bold text-primary tracking-wider uppercase mb-1 block">Sebelumnya</span>
                                    <h4 class="font-semibold text-sm group-hover:text-primary transition line-clamp-2">{{ $prev->title }}</h4>
                                </div>
                            </a>
                        @endif

                        @if($next)
                            <hr class="border-slate-100">
                            <a href="{{ route('news.detail', $next->slug) }}" class="flex gap-3 group items-center">
                                @if($next->image)
                                    <img src="{{ asset('storage/'.$next->image) }}" alt="Berita" class="w-20 h-16 rounded-lg object-cover group-hover:opacity-90 transition shrink-0">
                                @else
                                    <div class="w-20 h-16 rounded-lg bg-slate-100 flex items-center justify-center shrink-0">
                                        <i class="fa-regular fa-image text-slate-400"></i>
                                    </div>
                                @endif
                                <div>
                                    <span class="text-[10px] font-bold text-primary tracking-wider uppercase mb-1 block">Selanjutnya</span>
                                    <h4 class="font-semibold text-sm group-hover:text-primary transition line-clamp-2">{{ $next->title }}</h4>
                                </div>
                            </a>
                        @endif
                    </div>

                    <div class="mt-6 text-center">
                        <a href="{{ route('news') }}" class="text-sm font-semibold text-primary hover:text-primary-dark transition-soft">
                            Lihat Indeks Berita <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <section class="mt-16 font-sans">
            <h2 class="text-2xl md:text-3xl font-black text-dark mb-8 flex items-center">
                <i class="fa-regular fa-star text-primary mr-3"></i>
                Berita Terkait
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="related-news">
                @forelse($relatedNews as $related)
                    <div class="news-card flex flex-col">
                        <div class="h-48 overflow-hidden bg-slate-100 shrink-0">
                            @if($related->image)
                                <img src="{{ asset('storage/'.$related->image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fa-regular fa-image text-4xl text-slate-300"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <div class="mb-3">
                                <span class="text-xs bg-primary-subtle text-primary px-2 py-1 rounded-full font-bold uppercase tracking-wider">
                                    {{ $related->category->name ?? 'Berita' }}
                                </span>
                            </div>
                            <h3 class="font-bold text-lg mb-2 line-clamp-2 text-dark group-hover:text-primary transition-soft">
                                <a href="{{ route('news.detail', $related->slug) }}">{{ $related->title }}</a>
                            </h3>
                            <a href="{{ route('news.detail', $related->slug) }}" class="text-primary text-sm font-semibold hover:underline mt-auto">
                                Baca selengkapnya &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-8 rounded-2xl border border-slate-100 text-center text-slate-500 shadow-sm">
                        Belum ada berita terkait lainnya.
                    </div>
                @endforelse
            </div>
        </section>
    </main>

    <button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 bg-primary text-white rounded-full shadow-lg flex items-center justify-center hover:bg-primary-dark z-50">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Generate Table of Contents
            generateTableOfContents();
            // Process responsive elements (iframe, table)
            processContentElements();
        });

        // Reading Progress Bar
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            const progressBar = document.getElementById('progress-bar');
            if(progressBar) progressBar.style.width = scrolled + '%';
        });

        // Back to Top Logic
        const backToTop = document.getElementById('back-to-top');
        if(backToTop) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backToTop.classList.add('visible');
                } else {
                    backToTop.classList.remove('visible');
                }
            });

            backToTop.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // Generate TOC from H2 headings
        function generateTableOfContents() {
            const article = document.getElementById('article-content');
            if (!article) return;

            const headings = article.querySelectorAll('h2');
            const tocList = document.getElementById('toc-list');
            const toc = document.getElementById('table-of-contents');

            if (headings.length === 0) {
                toc.style.display = 'none';
                return;
            } else {
                toc.style.display = 'block';
            }

            tocList.innerHTML = '';

            headings.forEach((heading, index) => {
                if (!heading.id) {
                    heading.id = 'heading-' + index + '-' + heading.textContent.toLowerCase().replace(/[^a-z0-9]+/g, '-');
                }

                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = '#' + heading.id;
                a.textContent = heading.textContent;

                a.addEventListener('click', (e) => {
                    e.preventDefault();
                    // Sesuaikan offset scroll karena ada fixed navbar
                    const yOffset = -100;
                    const y = heading.getBoundingClientRect().top + window.pageYOffset + yOffset;
                    window.scrollTo({top: y, behavior: 'smooth'});
                });

                li.appendChild(a);
                tocList.appendChild(li);
            });
        }

        // Process CKEditor Content
        function processContentElements() {
            const article = document.getElementById('article-content');
            if (!article) return;

            // Responsive Tables
            article.querySelectorAll('table').forEach((table) => {
                if (!table.parentElement.classList.contains('table-responsive')) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'table-responsive';
                    table.parentNode.insertBefore(wrapper, table);
                    wrapper.appendChild(table);
                }
            });

            // Responsive Iframes (Youtube/Vimeo)
            article.querySelectorAll('iframe').forEach((iframe) => {
                if (iframe.src.includes('youtube') || iframe.src.includes('youtu.be') || iframe.src.includes('vimeo')) {
                    if (!iframe.parentElement.classList.contains('embed-responsive')) {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'embed-responsive';
                        iframe.parentNode.insertBefore(wrapper, iframe);
                        wrapper.appendChild(iframe);
                    }
                }
            });
        }

        // Share Functions
        const currentUrl = encodeURIComponent(window.location.href);
        const currentTitle = encodeURIComponent('{{ $berita->title }}');

        function shareOnFacebook() {
            window.open('https://www.facebook.com/sharer/sharer.php?u=' + currentUrl, '_blank', 'width=600,height=400');
        }

        function shareOnTwitter() {
            window.open('https://twitter.com/intent/tweet?text=' + currentTitle + '&url=' + currentUrl, '_blank', 'width=600,height=400');
        }

        function shareOnWhatsApp() {
            window.open('https://api.whatsapp.com/send?text=' + currentTitle + '%20' + currentUrl, '_blank');
        }

        function shareOnLinkedIn() {
            window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + currentUrl, '_blank', 'width=600,height=400');
        }
    </script>
@endpush
