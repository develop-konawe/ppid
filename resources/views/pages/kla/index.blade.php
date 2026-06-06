@extends('layouts.app')

@section('title', 'KLA — Portal Layanan Digital Kabupaten/Kota Layak Anak | Konawe')

@push('meta-head')
    <meta name="description" content="Portal resmi Kabupaten/Kota Layak Anak (KLA) Kabupaten Konawe. Pusat layanan informasi anak, monitoring program, regulasi, galeri, dan layanan pengaduan anak yang terintegrasi." />
    <meta name="keywords" content="KLA, ILA, Kabupaten Layak Anak, Perlindungan Anak, Layanan Informasi Anak, AMPK, Konawe, PPID Konawe" />
@endpush

@push('scripts-head')
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: { DEFAULT: '#1F3A8A', dark: '#172554', light: '#3B82F6', subtle: '#EFF6FF' },
                    secondary: '#DC2626', accent: '#059669', light: '#F8FAFC', dark: '#0F172A',
                },
                fontFamily: {
                    sans: ['Inter','system-ui','-apple-system','sans-serif'],
                    heading: ['Poppins','Inter','sans-serif'],
                },
            },
        },
    };
</script>
@endpush

@push('styles')
<style>
    /* ===== RESET & BASE ===== */
    .kla-page *{box-sizing:border-box;}
    .ts{transition:all .3s cubic-bezier(.4,0,.2,1);}

    /* ===== FADE SCROLL ===== */
    .fs{opacity:0;transform:translateY(24px);transition:opacity .65s ease,transform .65s ease;}
    .fs.vis{opacity:1;transform:translateY(0);}
    .fs-d1{transition-delay:.1s;}
    .fs-d2{transition-delay:.2s;}
    .fs-d3{transition-delay:.3s;}
    .fs-d4{transition-delay:.4s;}

    /* ===== HERO ===== */
    .kla-hero{
        background:linear-gradient(135deg,#050e1f 0%,#0f1f4a 30%,#1a3270 60%,#1e3a8a 80%,#1d4ed8 100%);
        position:relative;overflow:hidden;z-index:1;
    }
    .kla-hero::before{
        content:'';position:absolute;top:-20%;right:-5%;
        width:700px;height:700px;
        background:radial-gradient(circle,rgba(99,102,241,.18) 0%,transparent 65%);
        border-radius:50%;pointer-events:none;
    }
    .kla-hero::after{
        content:'';position:absolute;bottom:-25%;left:-8%;
        width:600px;height:600px;
        background:radial-gradient(circle,rgba(59,130,246,.12) 0%,transparent 65%);
        border-radius:50%;pointer-events:none;
    }
    .kla-hero-dot{
        position:absolute;top:12%;left:6%;width:4px;height:4px;
        background:rgba(255,255,255,.25);border-radius:50%;
        box-shadow:40px 80px 0 rgba(255,255,255,.12),120px 20px 0 rgba(255,255,255,.08),
                   200px 120px 0 rgba(255,255,255,.1),80px 200px 0 rgba(255,255,255,.07),
                   300px 60px 0 rgba(255,255,255,.06),260px 160px 0 rgba(255,255,255,.09);
    }
    .hero-badge{
        display:inline-flex;align-items:center;gap:.5rem;
        padding:.45rem 1rem;background:rgba(255,255,255,.09);
        border:1px solid rgba(255,255,255,.18);border-radius:9999px;
        color:#fff;font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
        backdrop-filter:blur(8px);
    }

    /* ===== SECTION HEADERS ===== */
    .sec-badge{
        display:inline-flex;align-items:center;gap:.4rem;
        padding:.3rem .9rem;border-radius:9999px;
        font-size:.68rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
        margin-bottom:.75rem;
    }
    .sec-title{font-size:1.9rem;font-weight:900;color:#0F172A;line-height:1.15;}
    @media(min-width:768px){.sec-title{font-size:2.3rem;}}

    /* ===== DIVIDER ===== */
    .sec-divider{width:3rem;height:3px;border-radius:9999px;background:#1F3A8A;margin:.75rem auto 0;}

    /* ===== STAT MINI CARDS (hero) ===== */
    .hero-stat{
        background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);
        border-radius:1rem;padding:1rem;text-align:center;
        backdrop-filter:blur(10px);
        transition:background .3s,transform .3s;
    }
    .hero-stat:hover{background:rgba(255,255,255,.14);transform:translateY(-3px);}

    /* ===== SERVICE CARDS (ILA) ===== */
    .svc-card{
        background:#fff;border-radius:1.25rem;padding:1.5rem;
        border:1.5px solid #e2e8f0;
        transition:transform .3s ease,box-shadow .3s ease,border-color .3s ease;
    }
    .svc-card:hover{
        transform:translateY(-6px);
        box-shadow:0 20px 50px rgba(31,58,138,.12);
        border-color:#bfdbfe;
    }
    .svc-icon{
        width:3rem;height:3rem;border-radius:.875rem;
        display:flex;align-items:center;justify-content:center;
        font-size:1.2rem;margin-bottom:1rem;
        flex-shrink:0;
    }
    .svc-btn{
        display:inline-flex;align-items:center;gap:.35rem;
        font-size:.72rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;
        padding:.35rem .8rem;border-radius:.5rem;
        transition:all .25s ease;margin-top:.75rem;
    }

    /* ===== DASHBOARD MONITORING ===== */
    .dash-card{
        background:#fff;border-radius:1.25rem;padding:1.5rem;
        border:1px solid #e2e8f0;
        transition:transform .3s,box-shadow .3s;
    }
    .dash-card:hover{transform:translateY(-4px);box-shadow:0 16px 40px rgba(31,58,138,.1);}

    .progress-bar-bg{height:8px;background:#e2e8f0;border-radius:9999px;overflow:hidden;margin-top:.5rem;}
    .progress-bar-fill{height:100%;border-radius:9999px;transition:width 1.4s cubic-bezier(.4,0,.2,1);}

    .chart-bar{
        flex:1;display:flex;flex-direction:column;align-items:center;gap:.25rem;
    }
    .chart-bar-inner{
        width:100%;border-radius:.375rem .375rem 0 0;
        background:linear-gradient(180deg,#3b82f6,#1d4ed8);
        transition:height 1.2s cubic-bezier(.4,0,.2,1);
        min-height:4px;
    }
    .chart-bar-label{font-size:.6rem;color:#64748b;font-weight:600;}

    .trend-up{color:#059669;font-size:.72rem;font-weight:700;}
    .trend-down{color:#dc2626;font-size:.72rem;font-weight:700;}
    .trend-flat{color:#d97706;font-size:.72rem;font-weight:700;}

    /* ===== CLUSTER CARDS ===== */
    .cluster-card{
        border-top:4px solid;
        background:#fff;border-radius:1.25rem;padding:1.5rem;
        transition:transform .3s,box-shadow .3s;
    }
    .cluster-card:hover{transform:translateY(-5px);box-shadow:0 18px 45px rgba(31,58,138,.13);}

    /* ===== PUBLIKASI / BERITA ===== */
    .pub-card{
        background:#fff;border-radius:1.25rem;overflow:hidden;
        border:1px solid #e2e8f0;
        transition:transform .3s,box-shadow .3s;
    }
    .pub-card:hover{transform:translateY(-6px);box-shadow:0 20px 50px rgba(31,58,138,.12);}
    .pub-img{height:200px;overflow:hidden;position:relative;}
    .pub-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease;}
    .pub-card:hover .pub-img img{transform:scale(1.06);}
    .pub-cat{
        display:inline-flex;align-items:center;gap:.3rem;
        padding:.2rem .65rem;border-radius:9999px;
        font-size:.65rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;
    }

    /* ===== REGULASI ===== */
    .reg-card{
        background:#fff;border-radius:1rem;padding:1.25rem;
        border:1px solid #e2e8f0;
        transition:transform .25s,box-shadow .25s,border-color .25s;
    }
    .reg-card:hover{transform:translateY(-3px);box-shadow:0 12px 30px rgba(31,58,138,.1);border-color:#bfdbfe;}
    .reg-type-badge{
        display:inline-flex;align-items:center;gap:.3rem;
        font-size:.65rem;font-weight:700;padding:.2rem .65rem;border-radius:9999px;
    }

    /* ===== GALERI ===== */
    .gallery-item{cursor:pointer;border-radius:1rem;overflow:hidden;position:relative;}
    .gallery-item img{width:100%;height:100%;object-fit:cover;object-position:top;transition:transform .4s ease;}
    .gallery-item:hover img{transform:scale(1.07);}
    .gallery-overlay{
        position:absolute;inset:0;background:linear-gradient(to top,rgba(15,23,42,.65) 0%,transparent 55%);
        opacity:0;transition:opacity .3s;
        display:flex;flex-direction:column;justify-content:flex-end;padding:1rem;
    }
    .gallery-item:hover .gallery-overlay{opacity:1;}

    /* ===== PARTNERSHIP ===== */
    .partner-card{
        background:#fff;border-radius:1rem;padding:1.25rem;text-align:center;
        border:1px solid #e2e8f0;
        transition:transform .3s,box-shadow .3s,border-color .3s;
    }
    .partner-card:hover{transform:translateY(-4px);box-shadow:0 12px 30px rgba(31,58,138,.1);border-color:#bfdbfe;}
    .partner-logo{
        width:3.5rem;height:3.5rem;border-radius:.875rem;
        display:flex;align-items:center;justify-content:center;
        font-size:1.4rem;margin:0 auto .75rem;
    }

    /* ===== FAQ ===== */
    .faq-item{background:#fff;border:1.5px solid #e2e8f0;border-radius:1rem;overflow:hidden;transition:border-color .25s;}
    .faq-item.open{border-color:#bfdbfe;}
    .faq-answer{max-height:0;overflow:hidden;transition:max-height .38s ease;}
    .faq-item.open .faq-answer{max-height:800px;}
    .faq-icon{transition:transform .3s ease;}
    .faq-item.open .faq-icon{transform:rotate(180deg);}

    /* ===== PENGADUAN STEPS ===== */
    .step-node{
        width:2.5rem;height:2.5rem;border-radius:9999px;
        display:flex;align-items:center;justify-content:center;
        font-size:.8rem;font-weight:800;flex-shrink:0;
    }
    .step-line{flex:1;height:2px;border-radius:9999px;}

    /* ===== LIGHTBOX ===== */
    #kla-lightbox{position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:9999;
        display:none;align-items:center;justify-content:center;flex-direction:column;padding:1.5rem;}
    #kla-lightbox.open{display:flex;}

    /* ===== SCROLL INDICATOR ===== */
    .kla-tab-btn{
        padding:.5rem 1.1rem;border-radius:.625rem;font-size:.8rem;font-weight:700;
        transition:all .25s;cursor:pointer;border:none;background:transparent;white-space:nowrap;
    }
    .kla-tab-btn.active{background:#1F3A8A;color:#fff;}
    .kla-tab-btn:not(.active){color:#475569;}
    .kla-tab-btn:not(.active):hover{background:#f1f5f9;color:#1F3A8A;}

    /* ===== ALERT KEAMANAN ===== */
    .security-alert{
        background:linear-gradient(135deg,#f0f9ff,#e0f2fe);
        border:1px solid #bae6fd;border-radius:1rem;padding:1rem 1.25rem;
    }

    /* ===== RESPONSIVE UTILS ===== */
    .line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
    .line-clamp-3{display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;}

    /* ===== SEARCH BOX ===== */
    .search-box{
        display:flex;align-items:center;gap:.5rem;
        background:#fff;border:1.5px solid #e2e8f0;border-radius:.875rem;
        padding:.5rem 1rem;transition:border-color .25s,box-shadow .25s;
    }
    .search-box:focus-within{border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,.15);}
    .search-box input{border:none;outline:none;flex:1;font-size:.85rem;color:#0F172A;background:transparent;}

    /* ANIM countup */
    @keyframes klaCount{from{opacity:0;transform:translateY(6px);}to{opacity:1;transform:translateY(0);}}
    .kla-count-anim{animation:klaCount .5s ease forwards;}
</style>
@endpush

@section('content')

@php
/* ── Dummy data dipindahkan ke database/seeders/KlaDemoSeeder.php ── */
@endphp

<main class="kla-page bg-slate-50 relative z-10">

{{-- ═══════════════════════════════════════════
     SECTION 1 — HERO BANNER
═══════════════════════════════════════════ --}}
<section class="kla-hero pt-28 pb-14 md:pt-36 md:pb-20 relative">
    <div class="kla-hero-dot"></div>
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-14 relative z-10">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-blue-300 text-xs mb-7 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white ts flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i> Beranda
            </a>
            <i class="fa-solid fa-chevron-right text-[9px] opacity-40"></i>
            <span class="text-white font-semibold">KLA – Kabupaten/Kota Layak Anak</span>
        </nav>

        <div class="flex flex-col lg:flex-row items-start lg:items-center gap-10 xl:gap-16">

            {{-- Left: title + cta --}}
            <div class="flex-1 max-w-xl">
                <span class="hero-badge mb-5">
                    <i class="fa-solid fa-child-reaching text-yellow-300"></i>
                    Program Resmi Pemerintah Daerah
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-5xl font-black text-white leading-tight mb-4">
                    Portal Layanan<br>
                    <span class="text-blue-300">Kabupaten/Kota</span><br>
                    <span class="text-yellow-300">Layak Anak</span>
                </h1>
                <p class="text-blue-100/90 text-base md:text-lg leading-relaxed mb-8">
                    Pusat Informasi, Monitoring, dan Layanan Digital perlindungan serta pemenuhan hak anak di Kabupaten Konawe yang terintegrasi dan berkelanjutan.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="#layanan-ila"
                       class="inline-flex items-center gap-2 bg-white text-primary font-bold px-5 py-2.5 rounded-xl hover:bg-blue-50 ts shadow-lg hover:-translate-y-0.5 transform text-sm">
                        <i class="fa-solid fa-grid-2"></i> Layanan ILA
                    </a>

                    <a href="#pengaduan"
                       class="inline-flex items-center gap-2 bg-yellow-400/90 text-yellow-900 font-bold px-5 py-2.5 rounded-xl hover:bg-yellow-300 ts text-sm">
                        <i class="fa-solid fa-comment-exclamation"></i> Pengaduan Anak
                    </a>
                </div>
            </div>

            {{-- Right: stat mini-grid --}}
            <div class="w-full lg:w-auto grid grid-cols-2 sm:grid-cols-3 gap-3 lg:min-w-[340px]">
                @if(isset($metrics) && $metrics->isNotEmpty())
                    @foreach($metrics->take(6) as $stat)
                        <div class="hero-stat">
                            <i class="{{ $stat->icon ?? 'fa-solid fa-chart-bar' }} text-xl mb-2 block" style="color:{{ $stat->color ?? '#93c5fd' }}"></i>
                            <p class="text-xl font-black text-white">{{ $stat->value }}</p>
                            <p class="text-blue-200 text-[10px] mt-0.5 leading-snug">{{ $stat->label }}</p>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-2 sm:col-span-3 text-center py-4 bg-white/5 border border-white/10 rounded-xl backdrop-blur-sm">
                        <i class="fa-solid fa-chart-bar text-2xl text-blue-300 mb-2 opacity-50"></i>
                        <p class="text-blue-200 text-xs">Data monitoring belum tersedia.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Quick nav --}}
        <div class="mt-10 flex gap-2 overflow-x-auto pb-1 scrollbar-hide">
            @foreach([['href'=>'#tentang','label'=>'Tentang KLA'],['href'=>'#klaster','label'=>'Klaster'],['href'=>'#layanan-ila','label'=>'Layanan ILA'],['href'=>'#publikasi','label'=>'Publikasi'],['href'=>'#regulasi','label'=>'Regulasi'],['href'=>'#galeri','label'=>'Galeri'],['href'=>'#kemitraan','label'=>'Kemitraan'],['href'=>'#pengaduan','label'=>'Pengaduan'],['href'=>'#faq','label'=>'FAQ']] as $nav)
                <a href="{{ $nav['href'] }}"
                   class="flex-shrink-0 px-3.5 py-1.5 bg-white/10 border border-white/20 text-white text-xs font-semibold rounded-full hover:bg-white/20 ts backdrop-blur-sm">
                    {{ $nav['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     SECTION 2 — TENTANG KLA
═══════════════════════════════════════════ --}}
<section id="tentang" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-14">
        <div class="text-center mb-12 fs">
            <span class="sec-badge bg-blue-50 text-blue-700 border border-blue-100">
                <i class="fa-solid fa-circle-info"></i> Mengenal KLA
            </span>
            <h2 class="sec-title">Tentang <span class="text-primary">KLA</span></h2>
            <div class="sec-divider"></div>
        </div>

        @if($about)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
            <div class="fs fs-d1">
                <div class="prose prose-slate max-w-none text-slate-600 text-sm leading-relaxed">
                    {!! $about->description !!}
                </div>
            </div>
            <div class="space-y-5 fs fs-d2">
                @if($about->vision)
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
                    <h3 class="flex items-center gap-2 text-blue-800 font-bold text-sm mb-2">
                        <span class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center"><i class="fa-solid fa-eye text-blue-600 text-xs"></i></span> Visi
                    </h3>
                    <div class="text-slate-600 text-sm leading-relaxed">{!! $about->vision !!}</div>
                </div>
                @endif
                @if($about->mission)
                <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-5">
                    <h3 class="flex items-center gap-2 text-emerald-800 font-bold text-sm mb-2">
                        <span class="w-7 h-7 bg-emerald-100 rounded-lg flex items-center justify-center"><i class="fa-solid fa-bullseye text-emerald-600 text-xs"></i></span> Misi
                    </h3>
                    <div class="text-slate-600 text-sm leading-relaxed">{!! $about->mission !!}</div>
                </div>
                @endif
                @if($about->goals)
                <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5">
                    <h3 class="flex items-center gap-2 text-amber-800 font-bold text-sm mb-2">
                        <span class="w-7 h-7 bg-amber-100 rounded-lg flex items-center justify-center"><i class="fa-solid fa-star text-amber-500 text-xs"></i></span> Tujuan
                    </h3>
                    <div class="text-slate-600 text-sm leading-relaxed">{!! $about->goals !!}</div>
                </div>
                @endif
            </div>
        </div>
        @else
        {{-- Default about content --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
            <div class="fs fs-d1">
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    <strong class="text-dark">Kabupaten/Kota Layak Anak (KLA)</strong> adalah kabupaten/kota yang mempunyai sistem pembangunan berbasis hak anak melalui pengintegrasian komitmen dan sumber daya pemerintah, masyarakat, dan dunia usaha yang terencana secara menyeluruh dan berkelanjutan dalam kebijakan, program, dan kegiatan untuk menjamin terpenuhinya hak dan perlindungan anak.
                </p>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    Pemerintah Kabupaten Konawe berkomitmen mewujudkan KLA melalui penguatan kelembagaan, pengintegrasian kebijakan, penguatan program, dan peningkatan anggaran yang pro-anak di seluruh OPD.
                </p>
                <div class="grid grid-cols-2 gap-3 mt-5">
                    @if(isset($statistics) && $statistics->isNotEmpty())
                        @foreach($statistics as $kpi)
                        <div class="bg-slate-50 border border-slate-100 rounded-xl p-4 text-center">
                            <p class="text-2xl font-black text-primary">{{ $kpi->value }}</p>
                            <p class="text-slate-500 text-xs mt-0.5">{{ $kpi->label }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="space-y-4 fs fs-d2">
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
                    <h3 class="flex items-center gap-2 text-blue-800 font-bold text-sm mb-2">
                        <span class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center"><i class="fa-solid fa-eye text-blue-600 text-xs"></i></span> Visi
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Terwujudnya Kabupaten Konawe sebagai Kabupaten Layak Anak yang menjamin hak dan perlindungan setiap anak tanpa diskriminasi.</p>
                </div>
                <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-5">
                    <h3 class="flex items-center gap-2 text-emerald-800 font-bold text-sm mb-2">
                        <span class="w-7 h-7 bg-emerald-100 rounded-lg flex items-center justify-center"><i class="fa-solid fa-bullseye text-emerald-600 text-xs"></i></span> Misi
                    </h3>
                    <ul class="text-slate-600 text-sm leading-relaxed space-y-1">
                        <li class="flex items-start gap-2"><i class="fa-solid fa-check text-emerald-500 mt-0.5 text-xs flex-shrink-0"></i> Memperkuat kelembagaan perlindungan anak</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-check text-emerald-500 mt-0.5 text-xs flex-shrink-0"></i> Meningkatkan kualitas layanan dasar bagi anak</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-check text-emerald-500 mt-0.5 text-xs flex-shrink-0"></i> Membangun sistem data anak yang akurat dan terbarukan</li>
                    </ul>
                </div>
                <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5">
                    <h3 class="flex items-center gap-2 text-amber-800 font-bold text-sm mb-2">
                        <span class="w-7 h-7 bg-amber-100 rounded-lg flex items-center justify-center"><i class="fa-solid fa-star text-amber-500 text-xs"></i></span> Tujuan
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Meningkatkan status KLA Kabupaten Konawe dari Pratama menuju Madya pada tahun 2026 melalui penguatan 5 klaster dan 24 indikator KLA.</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- ═══════════════════════════════════════════
     SECTION 3 — KLASTER KLA
═══════════════════════════════════════════ --}}
<section id="klaster" class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-14">
        <div class="text-center mb-12 fs">
            <span class="sec-badge bg-indigo-50 text-indigo-700 border border-indigo-100">
                <i class="fa-solid fa-layer-group"></i> 5 Pilar Utama
            </span>
            <h2 class="sec-title">Klaster <span class="text-primary">KLA</span></h2>
            <p class="text-slate-500 text-sm mt-3 max-w-xl mx-auto">KLA diukur melalui 5 klaster hak anak yang menjadi pilar utama program ini.</p>
            <div class="sec-divider"></div>
        </div>

        @php
            $clrPalette = ['#1F3A8A','#059669','#dc2626','#7c3aed','#d97706'];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
            @if(isset($clusters) && $clusters->isNotEmpty())
                @foreach($clusters as $idx => $cl)
                    @php
                        $clName = $cl->name;
                        $clDesc = $cl->description ?? '';
                        $clIcon = $cl->icon ?? 'fa-solid fa-layer-group';
                        $clClr  = $cl->color ?: $clrPalette[$idx % 5];
                    @endphp
                    <div class="cluster-card fs" style="border-top-color:{{ $clClr }}">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl mb-4"
                             style="background:{{ $clClr }}18;color:{{ $clClr }}">
                            <i class="{{ $clIcon }}"></i>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-widest px-2 py-0.5 rounded-full"
                              style="background:{{ $clClr }}14;color:{{ $clClr }}">Klaster {{ $idx + 1 }}</span>
                        <h3 class="font-bold text-dark text-sm leading-snug mt-2 mb-2">{{ $clName }}</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">{{ Str::limit($clDesc, 130) }}</p>
                    </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-6 bg-slate-50 border border-slate-100 rounded-xl">
                    <i class="fa-solid fa-layer-group text-2xl text-slate-300 mb-2"></i>
                    <p class="text-slate-500 text-xs">Data klaster belum tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     SECTION 4 — LAYANAN ILA (10 Fitur)
═══════════════════════════════════════════ --}}
<section id="layanan-ila" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-14">
        <div class="text-center mb-12 fs">
            <span class="sec-badge bg-blue-50 text-blue-700 border border-blue-100">
                <i class="fa-solid fa-grid-2"></i> Portal Digital
            </span>
            <h2 class="sec-title">Layanan <span class="text-primary">Informasi Anak</span></h2>
            <p class="text-slate-500 text-sm mt-3 max-w-2xl mx-auto">Ekosistem layanan digital terpadu untuk perlindungan, pemenuhan hak, dan pengembangan potensi anak Kabupaten Konawe.</p>
            <div class="sec-divider"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
            @if(isset($services) && $services->isNotEmpty())
                @foreach($services as $i => $svc)
                <div class="svc-card fs group" style="--delay:{{ $i * 50 }}ms">
                    @if($svc->image)
                        <div class="w-full h-36 mb-4 rounded-xl overflow-hidden bg-slate-100 border border-slate-100 shadow-sm">
                            <img src="{{ asset('storage/' . $svc->image) }}" alt="{{ $svc->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                    @else
                        <div class="svc-icon bg-blue-50 text-primary">
                            <i class="fa-solid fa-grid-2"></i>
                        </div>
                    @endif
                    <h3 class="text-dark font-bold text-sm leading-snug mb-1.5">{{ $svc->name }}</h3>
                    <p class="text-slate-500 text-xs leading-relaxed mb-1">{{ Str::limit($svc->description, 100) }}</p>
                    <a href="#" class="svc-btn bg-blue-50 text-primary">
                        Detail <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-10 bg-slate-50 border border-slate-200 rounded-2xl">
                    <i class="fa-solid fa-box-open text-4xl text-slate-300 mb-3 block"></i>
                    <p class="text-slate-500 text-sm font-medium">Data layanan informasi anak belum tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════
     SECTION 6 — PUBLIKASI KLA (Program & Kegiatan)
═══════════════════════════════════════════ --}}
<section id="publikasi" class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-14">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4 fs">
            <div>
                <span class="sec-badge bg-rose-50 text-rose-700 border border-rose-100">
                    <i class="fa-solid fa-newspaper"></i> Terkini
                </span>
                <h2 class="sec-title">Publikasi <span class="text-primary">KLA</span></h2>
            </div>
            <div class="flex items-center gap-2">
                @foreach([['k'=>'all','label'=>'Semua'],['k'=>'sosialisasi','label'=>'Sosialisasi'],['k'=>'forum','label'=>'Forum Anak'],['k'=>'sekolah','label'=>'Sekolah Ramah']] as $tab)
                <button class="kla-tab-btn {{ $tab['k'] === 'all' ? 'active' : '' }}"
                        data-filter="{{ $tab['k'] }}"
                        onclick="filterPub(this)">{{ $tab['label'] }}</button>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if(isset($programs) && $programs->isNotEmpty())
                @foreach($programs->take(6) as $pidx => $prog)
                    @php
                        $pTitle     = $prog->title;
                        $pDesc      = Str::limit(strip_tags($prog->description ?? ''), 120);
                        $pDate      = $prog->event_date ? $prog->event_date->translatedFormat('d F Y') : '';
                        $pLoc       = $prog->location ?? '';
                        $pCat       = $prog->category->name ?? 'Program KLA';
                        $pImg       = $prog->image ? asset('storage/' . $prog->image) : null;
                        $bgColors   = ['from-blue-500 to-blue-700','from-violet-500 to-purple-700','from-emerald-500 to-green-700'];
                    @endphp
                    <article class="pub-card fs" data-cat="{{ Str::slug($pCat) }}">
                        <div class="pub-img">
                            @if($pImg)
                                <img src="{{ $pImg }}" alt="{{ $pTitle }}">
                            @else
                                <div class="w-full h-full bg-gradient-to-br {{ $bgColors[$pidx % 3] }} flex items-center justify-center">
                                    <i class="fa-solid fa-calendar-check text-white/30 text-5xl"></i>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3">
                                <span class="pub-cat bg-blue-50 text-blue-600">
                                    <i class="fa-solid fa-tag text-[8px]"></i> {{ $pCat }}
                                </span>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex flex-wrap gap-2 mb-3">
                                @if($pDate)
                                <span class="flex items-center gap-1 text-[11px] text-slate-400">
                                    <i class="fa-regular fa-calendar text-primary/60"></i> {{ $pDate }}
                                </span>
                                @endif
                                @if($pLoc)
                                <span class="flex items-center gap-1 text-[11px] text-slate-400">
                                    <i class="fa-solid fa-location-dot text-red-400/70"></i> {{ $pLoc }}
                                </span>
                                @endif
                            </div>
                            <h3 class="font-bold text-dark text-sm leading-snug mb-2 line-clamp-2">{{ $pTitle }}</h3>
                            <p class="text-slate-500 text-xs leading-relaxed line-clamp-3">{{ $pDesc }}</p>
                            <div class="flex items-center justify-between mt-4 pt-3 border-t border-slate-100">
                                <span class="text-[11px] text-slate-400">Program KLA Konawe</span>
                                <a href="{{ route('kla.program.detail', $prog->slug) }}" class="inline-flex items-center gap-1 text-primary text-xs font-bold hover:gap-2 ts">
                                    Selengkapnya <i class="fa-solid fa-arrow-right text-[9px]"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            @else
                <div class="col-span-full text-center py-12 bg-slate-50 border border-slate-200 rounded-2xl">
                    <i class="fa-solid fa-newspaper text-4xl text-slate-300 mb-3 block"></i>
                    <p class="text-slate-500 text-sm font-medium">Belum ada publikasi program/kegiatan.</p>
                </div>
            @endif
        </div>

        @if($programs->isNotEmpty() && $programs->count() > 3)
        <div class="text-center mt-8 fs">
            <a href="#" class="inline-flex items-center gap-2 px-6 py-2.5 border-2 border-primary text-primary font-bold rounded-xl hover:bg-primary hover:text-white ts text-sm">
                <i class="fa-solid fa-grid-2"></i> Lihat Semua Publikasi
            </a>
        </div>
        @endif
    </div>
</section>

{{-- ═══════════════════════════════════════════
     SECTION 7 — REGULASI & SOP
═══════════════════════════════════════════ --}}
<section id="regulasi" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-14">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div class="fs">
                <span class="sec-badge bg-violet-50 text-violet-700 border border-violet-100">
                    <i class="fa-solid fa-scale-balanced"></i> Hukum & Kebijakan
                </span>
                <h2 class="sec-title">Regulasi & <span class="text-primary">SOP</span> KLA</h2>
            </div>
            <div class="search-box w-full md:w-72 fs">
                <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm"></i>
                <input type="text" id="reg-search" placeholder="Cari regulasi…" oninput="filterReg(this.value)">
            </div>
        </div>

        <div class="space-y-3" id="reg-list">
            @if(isset($regulations) && $regulations->isNotEmpty())
                @foreach($regulations as $ri => $reg)
                    @php
                        $rTitle = $reg->title;
                        $rType  = $reg->type ?? 'Regulasi';
                        $rDate  = $reg->issue_date ? $reg->issue_date->translatedFormat('d M Y') : '-';
                        $rSum   = $reg->summary ?? '-';
                        $rFile  = $reg->doc_url ? asset('storage/' . $reg->doc_url) : null;
                    @endphp
                    <div class="reg-card fs reg-item" data-search="{{ strtolower($rTitle . ' ' . $rType) }}">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                                    <span class="reg-type-badge bg-blue-50 text-blue-700">
                                        <i class="fa-solid fa-file-lines text-[9px]"></i> {{ $rType }}
                                    </span>
                                    @if($ri === 0)
                                    <span class="text-[10px] font-bold bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Terbaru</span>
                                    @endif
                                </div>
                                <h3 class="font-bold text-dark text-sm leading-snug">{{ $rTitle }}</h3>
                                <p class="text-slate-500 text-xs mt-1 leading-relaxed">{{ $rSum }}</p>
                            </div>
                            <div class="flex items-center gap-3 flex-shrink-0">
                                <div class="text-center hidden sm:block">
                                    <p class="text-xs font-bold text-slate-700">{{ $rDate }}</p>
                                    <p class="text-[10px] text-slate-400">Tanggal Terbit</p>
                                </div>
                                @if($rFile)
                                <a href="{{ $rFile }}" target="_blank"
                                   class="inline-flex items-center gap-1.5 bg-primary text-white text-xs font-bold px-3.5 py-2 rounded-lg hover:bg-primary-dark ts">
                                    <i class="fa-solid fa-download text-[10px]"></i> Unduh
                                </a>
                                @else
                                <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-400 text-xs font-semibold px-3 py-2 rounded-lg">
                                    <i class="fa-solid fa-file text-[10px]"></i> Tersedia Segera
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-10 bg-white border border-slate-200 rounded-xl">
                    <i class="fa-solid fa-scale-balanced text-4xl text-slate-300 mb-3 block"></i>
                    <p class="text-slate-500 text-sm font-medium">Belum ada regulasi atau pedoman KLA yang diunggah.</p>
                </div>
            @endif
        </div>
        <div id="reg-empty" class="hidden text-center py-10 text-slate-400">
            <i class="fa-solid fa-magnifying-glass text-3xl mb-2 opacity-40"></i>
            <p class="text-sm">Regulasi tidak ditemukan.</p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     SECTION 8 — PRESTASI & PENGHARGAAN
═══════════════════════════════════════════ --}}
@if($achievements->isNotEmpty())
<section id="prestasi" class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-14">
        <div class="text-center mb-12 fs">
            <span class="sec-badge bg-amber-50 text-amber-700 border border-amber-100">
                <i class="fa-solid fa-trophy"></i> Capaian
            </span>
            <h2 class="sec-title">Prestasi & <span class="text-primary">Penghargaan</span></h2>
            <div class="sec-divider"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($achievements as $ach)
            <div class="dash-card text-center fs">
                @if($ach->image)
                <div class="w-16 h-16 rounded-2xl overflow-hidden mx-auto mb-3 shadow-md">
                    <img src="{{ asset('storage/'.$ach->image) }}" alt="{{ $ach->title }}" class="w-full h-full object-cover">
                </div>
                @else
                <div class="w-16 h-16 rounded-2xl bg-amber-50 flex items-center justify-center mx-auto mb-3">
                    <i class="fa-solid fa-trophy text-2xl text-amber-500"></i>
                </div>
                @endif
                <span class="inline-block bg-primary/10 text-primary text-xs font-bold px-2.5 py-0.5 rounded-full mb-2">{{ $ach->year }}</span>
                <h3 class="font-bold text-dark text-sm leading-snug">{{ $ach->title }}</h3>
                @if($ach->awarded_by)<p class="text-slate-400 text-xs mt-1">{{ $ach->awarded_by }}</p>@endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════
     SECTION 9 — GALERI & MEDIA EDUKASI
═══════════════════════════════════════════ --}}
<section id="galeri" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-14">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4 fs">
            <div>
                <span class="sec-badge bg-sky-50 text-sky-700 border border-sky-100">
                    <i class="fa-solid fa-images"></i> Dokumentasi
                </span>
                <h2 class="sec-title">Galeri & <span class="text-primary">Media Edukasi</span></h2>
            </div>
            <div class="flex gap-2">
                @foreach([['k'=>'all','l'=>'Semua'],['k'=>'photo','l'=>'Foto'],['k'=>'video','l'=>'Video']] as $gt)
                <button class="kla-tab-btn {{ $gt['k']==='all'?'active':'' }}"
                        onclick="filterGallery(this,'{{ $gt['k'] }}')">{{ $gt['l'] }}</button>
                @endforeach
            </div>
        </div>

        @if($galleries->isNotEmpty())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3" id="gallery-grid">
            @foreach($galleries as $item)
            @if($item->type === 'photo' && $item->media_path)
            <div class="gallery-item aspect-video fs" data-type="photo"
                 onclick="openKlaLightbox('{{ asset('storage/'.$item->media_path) }}','{{ addslashes($item->caption ?? '') }}')">
                <img src="{{ asset('storage/'.$item->media_path) }}" alt="{{ $item->caption ?? 'Galeri KLA' }}" loading="lazy">
                <div class="gallery-overlay">
                    <p class="text-white text-xs font-semibold">{{ $item->caption }}</p>
                    <span class="text-white/70 text-[10px] mt-0.5"><i class="fa-solid fa-expand mr-1"></i>Perbesar</span>
                </div>
            </div>
            @elseif($item->type === 'video' && $item->media_url)
            <div class="gallery-item aspect-video fs bg-slate-800 flex items-center justify-center" data-type="video">
                <a href="{{ $item->media_url }}" target="_blank" class="flex flex-col items-center gap-2 text-white p-4 w-full h-full justify-center">
                    <div class="w-12 h-12 rounded-full bg-white/15 border border-white/20 flex items-center justify-center hover:bg-red-600 ts">
                        <i class="fa-brands fa-youtube text-xl"></i>
                    </div>
                    @if($item->caption)<p class="text-[10px] text-slate-300 text-center line-clamp-2">{{ $item->caption }}</p>@endif
                </a>
            </div>
            @endif
            @endforeach
        </div>
        @else
        <div class="col-span-full text-center py-12 bg-white border border-slate-200 rounded-2xl">
            <i class="fa-solid fa-images text-4xl text-slate-300 mb-3 block"></i>
            <p class="text-slate-500 text-sm font-medium">Galeri akan tampil setelah admin menambahkan media.</p>
        </div>
        @endif
    </div>
</section>

{{-- ═══════════════════════════════════════════
     SECTION 10 — KEMITRAAN
═══════════════════════════════════════════ --}}
<section id="kemitraan" class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-14">
        <div class="text-center mb-12 fs">
            <span class="sec-badge bg-emerald-50 text-emerald-700 border border-emerald-100">
                <i class="fa-solid fa-handshake"></i> Kolaborasi
            </span>
            <h2 class="sec-title">Kemitraan <span class="text-primary">Layanan KLA</span></h2>
            <p class="text-slate-500 text-sm mt-3 max-w-xl mx-auto">Ekosistem kolaborasi lintas sektor dalam mewujudkan Kabupaten Konawe sebagai Kabupaten Layak Anak.</p>
            <div class="sec-divider"></div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-8 gap-4">
            @if(isset($partners) && $partners->isNotEmpty())
                @foreach($partners as $partner)
                <div class="partner-card fs">
                    <div class="partner-logo bg-slate-50 text-slate-400 border border-slate-100">
                        @if($partner->logo)
                            <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" class="w-full h-full object-contain p-2">
                        @else
                            <i class="fa-solid fa-handshake"></i>
                        @endif
                    </div>
                    <h4 class="text-dark text-xs font-bold leading-snug">{{ $partner->name }}</h4>
                    <p class="text-slate-400 text-[10px] mt-0.5 leading-snug">{{ Str::limit($partner->description, 50) }}</p>
                </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-8">
                    <i class="fa-solid fa-handshake text-3xl text-slate-300 mb-2"></i>
                    <p class="text-slate-500 text-xs font-medium">Data kemitraan belum tersedia.</p>
                </div>
            @endif
        </div>

        {{-- Kolaborasi CTA --}}
        <div class="mt-10 bg-gradient-to-r from-primary to-blue-600 rounded-2xl p-8 text-center text-white fs">
            <i class="fa-solid fa-handshake-angle text-3xl mb-3 opacity-80"></i>
            <h3 class="text-lg font-black mb-2">Ingin Bergabung sebagai Mitra KLA?</h3>
            <p class="text-blue-100 text-sm mb-5 max-w-md mx-auto">Daftarkan lembaga, organisasi, atau perusahaan Anda sebagai mitra dalam mewujudkan Kabupaten Konawe Layak Anak.</p>
            <a href="#pengaduan" class="inline-flex items-center gap-2 bg-white text-primary font-bold px-6 py-2.5 rounded-xl hover:bg-blue-50 ts text-sm shadow-lg">
                <i class="fa-solid fa-envelope"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     SECTION 11 — FAQ
═══════════════════════════════════════════ --}}
@if($faqs->isNotEmpty())
<section id="faq" class="py-16 bg-white">
    <div class="max-w-3xl mx-auto px-4 md:px-8 lg:px-14">
        <div class="text-center mb-12 fs">
            <span class="sec-badge bg-blue-50 text-blue-700 border border-blue-100">
                <i class="fa-solid fa-circle-question"></i> FAQ
            </span>
            <h2 class="sec-title">Pertanyaan yang <span class="text-primary">Sering Ditanyakan</span></h2>
            <div class="sec-divider"></div>
        </div>
        <div class="space-y-3">
            @foreach($faqs as $faq)
            <div class="faq-item">
                <button class="w-full flex items-center justify-between p-5 text-left hover:bg-slate-50 ts focus:outline-none"
                        onclick="toggleKlaFaq(this)">
                    <span class="font-semibold text-dark text-sm pr-4">{{ $faq->question }}</span>
                    <i class="fa-solid fa-chevron-down faq-icon text-primary text-xs flex-shrink-0"></i>
                </button>
                <div class="faq-answer">
                    <div class="px-5 pb-5 text-slate-600 text-sm leading-relaxed border-t border-slate-100 pt-4">
                        {{ $faq->answer }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════
     SECTION 12 — LAYANAN PENGADUAN ANAK
═══════════════════════════════════════════ --}}
<section id="pengaduan" class="py-16 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4 md:px-8 lg:px-14">
        <div class="text-center mb-10 fs">
            <span class="sec-badge bg-rose-50 text-rose-700 border border-rose-100">
                <i class="fa-solid fa-comment-exclamation"></i> Layanan Perlindungan
            </span>
            <h2 class="sec-title">Layanan <span class="text-primary">Pengaduan Anak</span></h2>
            <p class="text-slate-500 text-sm mt-3 max-w-xl mx-auto">
                Saluran pengaduan aman, rahasia, dan tepercaya untuk permasalahan hak anak di Kabupaten Konawe.
            </p>
            <div class="sec-divider"></div>
        </div>

        {{-- Steps --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-0 mb-8 fs">
            @foreach([['n'=>'1','t'=>'Isi Formulir','d'=>'Lengkapi data pengadu dan deskripsi masalah','c'=>'bg-blue-600'],['n'=>'2','t'=>'Verifikasi','d'=>'Tim kami memverifikasi laporan dalam 1×24 jam','c'=>'bg-violet-600'],['n'=>'3','t'=>'Proses','d'=>'Penanganan oleh tim ahli perlindungan anak','c'=>'bg-amber-500'],['n'=>'4','t'=>'Selesai','d'=>'Laporan tindak lanjut dikirim ke pelapor','c'=>'bg-emerald-600']] as $step)
            <div class="flex sm:flex-col items-center gap-3 sm:gap-2 flex-1 text-center">
                <div class="step-node text-white {{ $step['c'] }}">{{ $step['n'] }}</div>
                <div>
                    <p class="font-bold text-dark text-xs">{{ $step['t'] }}</p>
                    <p class="text-slate-400 text-[10px] leading-snug hidden sm:block mt-0.5 max-w-[100px] mx-auto">{{ $step['d'] }}</p>
                </div>
                @if(!$loop->last)<div class="step-line bg-slate-200 hidden sm:block"></div>@endif
            </div>
            @endforeach
        </div>

        {{-- Alert Kerahasiaan --}}
        <div class="security-alert flex items-start gap-3 mb-6 fs">
            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                <i class="fa-solid fa-lock text-blue-600 text-sm"></i>
            </div>
            <div>
                <p class="text-blue-800 font-bold text-sm">Kerahasiaan Data Terjamin</p>
                <p class="text-blue-600 text-xs mt-0.5 leading-relaxed">
                    Identitas pelapor dan anak yang terlibat dijaga kerahasiaannya sesuai dengan ketentuan perlindungan anak dalam UU No. 35 Tahun 2014. Data hanya digunakan untuk kepentingan penanganan kasus.
                </p>
            </div>
        </div>

        {{-- Flash Success --}}
        @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 rounded-2xl p-4 mb-6 fs">
            <div class="w-9 h-9 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-check text-white text-sm"></i>
            </div>
            <div>
                <p class="text-emerald-800 font-bold text-sm">Pengaduan Berhasil Dikirim</p>
                <p class="text-emerald-700 text-xs mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left: Kategori Pengaduan --}}
            <div class="fs">
                <h3 class="font-bold text-dark text-sm mb-3">Kategori Pengaduan</h3>
                <div class="grid grid-cols-2 lg:grid-cols-1 gap-2">
                    @foreach([['icon'=>'fa-solid fa-child-reaching','label'=>'Kekerasan pada Anak','bg'=>'#fee2e2','color'=>'#ef4444'],['icon'=>'fa-solid fa-house-crack','label'=>'Eksploitasi & Penelantaran','bg'=>'#ffedd5','color'=>'#f97316'],['icon'=>'fa-solid fa-school-circle-xmark','label'=>'Akses Pendidikan','bg'=>'#fef3c7','color'=>'#f59e0b'],['icon'=>'fa-solid fa-kit-medical','label'=>'Layanan Kesehatan','bg'=>'#e0f2fe','color'=>'#0ea5e9'],['icon'=>'fa-solid fa-comment-dots','label'=>'Aduan Lainnya','bg'=>'#f1f5f9','color'=>'#64748b']] as $cat)
                    <label class="flex items-center gap-2.5 p-2.5 rounded-xl border border-slate-200 cursor-pointer hover:border-blue-300 ts hover:bg-blue-50/50 group">
                        <input type="radio" name="complaint_cat_display" class="accent-blue-600">
                        <span class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0"
                              style="background:{{ $cat['bg'] }};color:{{ $cat['color'] }}">
                            <i class="{{ $cat['icon'] }} text-xs"></i>
                        </span>
                        <span class="text-slate-600 text-xs font-medium group-hover:text-primary">{{ $cat['label'] }}</span>
                    </label>
                    @endforeach
                </div>

                <div class="mt-5 bg-slate-50 border border-slate-200 rounded-xl p-4">
                    <h4 class="font-bold text-dark text-xs mb-2">Butuh Bantuan Segera?</h4>
                    <div class="space-y-2">
                        <a href="tel:112" class="flex items-center gap-2 text-xs text-slate-600 hover:text-primary ts">
                            <i class="fa-solid fa-phone w-4 text-red-500"></i> Hotline 112
                        </a>
                        <a href="tel:1500999" class="flex items-center gap-2 text-xs text-slate-600 hover:text-primary ts">
                            <i class="fa-solid fa-phone w-4 text-blue-500"></i> SAPA 129 (KemenPPPA)
                        </a>
                        <a href="https://wa.me/6281234567890" class="flex items-center gap-2 text-xs text-slate-600 hover:text-primary ts">
                            <i class="fa-brands fa-whatsapp w-4 text-emerald-500"></i> WhatsApp P3A Konawe
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right: Form --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm fs">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="font-bold text-dark text-sm">Formulir Pengaduan Online</h3>
                    <span class="text-[10px] text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Terenkripsi & Aman</span>
                </div>
                <form action="{{ route('kla.complaint.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1" for="kla_name">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="kla_name" name="name" value="{{ old('name') }}"
                                   placeholder="Nama pelapor"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-xs ts @error('name') border-red-400 @enderror">
                            @error('name')<p class="text-red-500 text-[10px] mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1" for="kla_email">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="kla_email" name="email" value="{{ old('email') }}"
                                   placeholder="email@contoh.com"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-xs ts @error('email') border-red-400 @enderror">
                            @error('email')<p class="text-red-500 text-[10px] mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1" for="kla_phone">
                                Nomor HP <span class="text-slate-400 font-normal">(opsional)</span>
                            </label>
                            <input type="tel" id="kla_phone" name="phone" value="{{ old('phone') }}"
                                   placeholder="0812-xxxx-xxxx"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-xs ts">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1" for="kla_subject">
                                Subjek Pengaduan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="kla_subject" name="subject" value="{{ old('subject') }}"
                                   placeholder="Topik pengaduan"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-xs ts @error('subject') border-red-400 @enderror">
                            @error('subject')<p class="text-red-500 text-[10px] mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1" for="kla_message">
                            Isi Pengaduan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="kla_message" name="message" rows="4"
                                  placeholder="Sampaikan pengaduan Anda secara jelas dan lengkap…"
                                  class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-xs ts resize-none @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                        @error('message')<p class="text-red-500 text-[10px] mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>@enderror
                    </div>
                    <div class="flex items-center justify-between pt-1">
                        <p class="text-slate-400 text-[10px]"><span class="text-red-500">*</span> Wajib diisi</p>
                        <button type="submit"
                                class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-bold px-6 py-2.5 rounded-xl ts transform hover:-translate-y-0.5 text-xs shadow-lg shadow-blue-200/50">
                            <i class="fa-solid fa-paper-plane"></i> Kirim Pengaduan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

</main>

{{-- ── LIGHTBOX ── --}}
<div id="kla-lightbox" onclick="if(event.target===this)closeKlaLightbox()">
    <button onclick="closeKlaLightbox()"
            class="absolute top-4 right-5 text-white text-3xl leading-none hover:text-red-400 ts z-10">&times;</button>
    <img id="kla-lightbox-img" src="" alt="" class="max-w-[90vw] max-h-[80vh] object-contain rounded-xl border border-white/15 shadow-2xl">
    <p id="kla-lightbox-caption" class="text-white text-xs mt-3 text-center opacity-70 max-w-md px-4"></p>
</div>

@endsection

@push('scripts')
<script>
/* ─── Intersection Observer (fade scroll) ─── */
const _fsObs = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('vis'); _fsObs.unobserve(e.target); }});
}, { threshold: 0.08 });
document.querySelectorAll('.fs').forEach(el => _fsObs.observe(el));

/* ─── Bar Chart animate ─── */
const _chartObs = new IntersectionObserver((entries) => {
    if (!entries[0].isIntersecting) return;
    document.querySelectorAll('.chart-bar-inner').forEach(bar => {
        const pct = parseInt(bar.dataset.val);
        bar.style.height = pct + '%';
    });
    _chartObs.disconnect();
}, { threshold: 0.3 });
const chartEl = document.getElementById('kla-chart');
if (chartEl) _chartObs.observe(chartEl);

/* ─── Progress bars animate ─── */
const _progObs = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.querySelectorAll('.kla-prog-bar').forEach(bar => {
                bar.style.width = bar.dataset.pct + '%';
            });
        }
    });
}, { threshold: 0.2 });
document.querySelectorAll('.dash-card, section').forEach(el => _progObs.observe(el));

/* ─── Lightbox ─── */
function openKlaLightbox(src, caption) {
    document.getElementById('kla-lightbox-img').src = src;
    document.getElementById('kla-lightbox-caption').textContent = caption || '';
    document.getElementById('kla-lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeKlaLightbox() {
    document.getElementById('kla-lightbox').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeKlaLightbox(); });

/* ─── FAQ Accordion ─── */
function toggleKlaFaq(btn) {
    const item = btn.closest('.faq-item');
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(i => i.classList.remove('open'));
    if (!isOpen) item.classList.add('open');
}

/* ─── Publikasi filter ─── */
function filterPub(btn) {
    document.querySelectorAll('.kla-tab-btn[data-filter]').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    // client-side filter placeholder — integrasikan ke server bila data dari DB
}

/* ─── Galeri filter ─── */
function filterGallery(btn, type) {
    document.querySelectorAll('#galeri .kla-tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('#gallery-grid .gallery-item').forEach(item => {
        if (type === 'all' || item.dataset.type === type) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

/* ─── Regulasi search ─── */
function filterReg(q) {
    const query = q.toLowerCase().trim();
    const items = document.querySelectorAll('.reg-item');
    let found = 0;
    items.forEach(item => {
        const match = item.dataset.search.includes(query);
        item.style.display = match ? '' : 'none';
        if (match) found++;
    });
    const empty = document.getElementById('reg-empty');
    if (empty) empty.classList.toggle('hidden', found > 0);
}
</script>
@endpush
