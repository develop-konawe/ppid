@extends('layouts.app')

@section('title', 'FAQ - Pertanyaan Umum')

@push('meta-head')
    <meta property="og:title" content="FAQ - PPID Kabupaten Konawe" />
    <meta property="og:description" content="Temukan jawaban atas pertanyaan umum seputar layanan informasi publik PPID Kabupaten Konawe." />
@endpush

@push('scripts-head')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#1F3A8A', dark: '#172554', light: '#3B82F6', subtle: '#EFF6FF' },
                        secondary: '#DC2626', light: '#F8FAFC', dark: '#0F172A',
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
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

        /* FAQ Accordion */
        .faq-item {
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 1rem;
            overflow: hidden;
            transition: border-color .25s, box-shadow .25s;
        }
        .faq-item:hover { border-color: #bfdbfe; }
        .faq-item.open {
            border-color: #3b82f6;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.12);
        }
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height .38s ease;
        }
        .faq-item.open .faq-answer { max-height: 800px; }
        .faq-icon { transition: transform .3s ease; }
        .faq-item.open .faq-icon { transform: rotate(180deg); }

        /* Category pills */
        .cat-pill {
            cursor: pointer;
            padding: .5rem 1.25rem;
            border-radius: 2rem;
            font-size: .875rem;
            font-weight: 600;
            transition: all .25s;
            border: 1.5px solid #e2e8f0;
            background: #fff;
            color: #475569;
        }
        .cat-pill:hover, .cat-pill.active {
            background: #1F3A8A;
            color: #fff;
            border-color: #1F3A8A;
        }
    </style>
@endpush

@section('content')
<main class="bg-slate-50 min-h-screen">

    {{-- Page Header --}}
    <section class="bg-gradient-to-br from-primary to-primary-dark py-16 md:py-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-40 h-40 rounded-full bg-white blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-60 h-60 rounded-full bg-blue-300 blur-3xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 md:px-8 lg:px-12 text-center text-white z-10">
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-5">
                <i class="fa-solid fa-circle-question text-sm"></i>
                <span class="text-sm font-medium">Pertanyaan yang Sering Diajukan</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">
                FAQ <span class="text-blue-200">PPID Konawe</span>
            </h1>
            <p class="text-blue-100 max-w-2xl mx-auto text-lg leading-relaxed">
                Temukan jawaban atas pertanyaan umum seputar layanan keterbukaan informasi publik
                di Kabupaten Konawe.
            </p>

            {{-- Breadcrumb --}}
            <nav class="flex justify-center items-center gap-2 text-sm text-blue-200 mt-6">
                <a href="{{ route('home') }}" class="hover:text-white transition-soft">
                    <i class="fa-solid fa-home mr-1"></i> Beranda
                </a>
                <span class="text-blue-300">/</span>
                <span class="text-white font-semibold">FAQ</span>
            </nav>
        </div>
    </section>

    {{-- Search Box --}}
    <section class="max-w-3xl mx-auto px-4 md:px-8 -mt-8 relative z-20">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-4 flex gap-3 items-center">
            <i class="fa-solid fa-magnifying-glass text-slate-400 text-lg ml-2"></i>
            <input
                type="text"
                id="faq-search"
                placeholder="Cari pertanyaan..."
                class="flex-1 py-2 text-sm text-slate-700 placeholder-slate-400 focus:outline-none bg-transparent"
            />
            <button onclick="clearSearch()"
                id="clear-search-btn"
                class="hidden text-slate-400 hover:text-slate-600 transition-soft mr-1">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
    </section>

    {{-- FAQ List --}}
    <section class="max-w-3xl mx-auto px-4 md:px-8 py-12">

        @if($faqs->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl border border-slate-200 shadow-sm">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-5">
                    <i class="fa-regular fa-folder-open text-slate-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark mb-2">Belum Ada FAQ</h3>
                <p class="text-slate-500 max-w-sm mx-auto text-sm">
                    Pertanyaan umum belum tersedia. Silakan hubungi kami secara langsung.
                </p>
                <a href="{{ route('contact') }}"
                    class="mt-6 inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-primary-dark transition-soft">
                    <i class="fa-solid fa-headset"></i> Hubungi Kami
                </a>
            </div>
        @else
            {{-- Stats --}}
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-black text-dark flex items-center gap-2">
                    <i class="fa-solid fa-list-ul text-primary text-lg"></i>
                    Daftar Pertanyaan
                </h2>
                <span class="bg-blue-50 text-primary px-3 py-1 rounded-full text-sm font-semibold border border-blue-100">
                    {{ $faqs->count() }} Pertanyaan
                </span>
            </div>

            <div id="faq-container" class="space-y-4">
                @foreach($faqs as $index => $faq)
                    <div class="faq-item" data-question="{{ strtolower($faq->question) }}">
                        <button
                            class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left"
                            onclick="toggleFaq(this)">
                            <div class="flex items-start gap-3">
                                <span class="shrink-0 w-7 h-7 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center mt-0.5">
                                    {{ $index + 1 }}
                                </span>
                                <span class="font-semibold text-dark text-sm leading-relaxed">{{ $faq->question }}</span>
                            </div>
                            <i class="fa-solid fa-chevron-down faq-icon text-primary text-xs flex-shrink-0"></i>
                        </button>
                        <div class="faq-answer">
                            <div class="px-6 pb-5 ml-10 text-slate-600 text-sm leading-relaxed border-t border-slate-100 pt-4">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Empty search state --}}
            <div id="no-results" class="hidden text-center py-16 bg-white rounded-2xl border border-slate-200 shadow-sm mt-4">
                <i class="fa-regular fa-face-sad-tear text-slate-300 text-5xl mb-4 block"></i>
                <p class="text-slate-500 font-medium">Tidak ada pertanyaan yang cocok.</p>
                <button onclick="clearSearch()" class="mt-4 text-primary text-sm font-semibold hover:underline">
                    Reset Pencarian
                </button>
            </div>
        @endif

    </section>

    {{-- CTA Kontak --}}
    <section class="max-w-7xl mx-auto px-4 md:px-8 pb-16">
        <div class="bg-gradient-to-r from-primary to-primary-dark rounded-3xl p-10 md:p-14 text-center text-white relative overflow-hidden shadow-2xl">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-60 h-60 bg-white rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-60 h-60 bg-blue-300 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
            </div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h2 class="text-2xl md:text-3xl font-black mb-3">Masih Punya Pertanyaan?</h2>
                <p class="text-blue-100 max-w-xl mx-auto mb-8 text-sm leading-relaxed">
                    Jika pertanyaan Anda belum terjawab, tim kami siap membantu. Hubungi langsung
                    melalui formulir kontak atau datang ke kantor kami.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}"
                        class="bg-white text-primary px-8 py-3.5 rounded-xl font-bold text-sm hover:bg-blue-50 transition-soft inline-flex items-center justify-center gap-2 shadow-lg">
                        <i class="fa-regular fa-envelope"></i> Kirim Pesan
                    </a>
                    <a href="{{ route('permohonan.index') }}"
                        class="bg-white/10 hover:bg-white/20 border border-white/30 text-white px-8 py-3.5 rounded-xl font-bold text-sm transition-soft inline-flex items-center justify-center gap-2">
                        <i class="fa-solid fa-file-import"></i> Ajukan Permohonan
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection

@push('scripts')
<script>
    // FAQ Accordion
    function toggleFaq(btn) {
        const item = btn.closest('.faq-item');
        const isOpen = item.classList.contains('open');

        // Tutup semua
        document.querySelectorAll('.faq-item.open').forEach(i => i.classList.remove('open'));

        // Buka yang diklik (toggle)
        if (!isOpen) item.classList.add('open');
    }

    // Search
    const searchInput = document.getElementById('faq-search');
    const clearBtn    = document.getElementById('clear-search-btn');
    const faqItems    = document.querySelectorAll('#faq-container .faq-item');
    const noResults   = document.getElementById('no-results');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const query = this.value.trim().toLowerCase();
            clearBtn.classList.toggle('hidden', !query);

            let found = 0;
            faqItems.forEach(item => {
                const question = item.dataset.question || '';
                const answer   = item.querySelector('.faq-answer')?.textContent.toLowerCase() || '';
                const match    = !query || question.includes(query) || answer.includes(query);
                item.style.display = match ? '' : 'none';
                if (match) found++;
            });

            noResults.classList.toggle('hidden', found > 0 || !query);
        });
    }

    function clearSearch() {
        if (searchInput) {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
            searchInput.focus();
        }
    }
</script>
@endpush
