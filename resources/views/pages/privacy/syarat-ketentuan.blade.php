@extends('layouts.app')

@section('title', 'Syarat & Ketentuan - PPID Kabupaten Konawe')

@push('meta-head')
    <meta name="description" content="Syarat dan Ketentuan penggunaan layanan digital PPID Kabupaten Konawe. Pelajari hak dan kewajiban pengguna dalam mengakses layanan informasi publik.">
    <meta property="og:title" content="Syarat & Ketentuan - PPID Kabupaten Konawe">
    <meta property="og:url" content="{{ route('syarat-ketentuan') }}">
    <meta property="og:type" content="website">
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
        .terms-content h2 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }
        .terms-content h2 .section-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            min-width: 2rem;
            background: #059669;
            color: white;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 700;
        }
        .terms-content p { color: #475569; line-height: 1.85; margin-bottom: 1rem; }
        .terms-content ul {
            list-style: none;
            padding: 0;
            margin: 0.5rem 0 1.25rem 0;
        }
        .terms-content ul li {
            position: relative;
            display: block;
            padding-left: 1.25rem;
            color: #475569;
            padding-top: 0.35rem;
            padding-bottom: 0.35rem;
            line-height: 1.75;
        }
        .terms-content ul li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.65rem;
            width: 0.45rem;
            height: 0.45rem;
            background: #059669;
            border-radius: 9999px;
        }
        .toc-link:hover { background: #f0fdf4; color: #059669; }
        .toc-link.active { background: #f0fdf4; color: #059669; font-weight: 600; border-left: 3px solid #059669; padding-left: calc(0.75rem - 3px); }
        .toc-link.active span { background: #059669; color: #fff; }
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .highlight-box { background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid #bbf7d0; border-radius: 1rem; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; }
    </style>
@endpush

@section('content')
    <main class="overflow-x-hidden bg-slate-50 min-h-screen">

        {{-- Hero Section --}}
        <section class="bg-gradient-to-br from-accent to-emerald-700 py-14 md:py-20 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            <div class="max-w-7xl mx-auto px-4 md:px-8 relative">
                <nav class="text-sm flex items-center gap-2 text-white/60 mb-6 flex-wrap">
                    <a href="{{ route('home') }}" class="hover:text-white transition-soft"><i class="fa-solid fa-home"></i> Beranda</a>
                    <span>/</span>
                    <span class="text-white font-medium">Syarat &amp; Ketentuan</span>
                </nav>
                <div class="flex items-start gap-5">
                    <div class="w-16 h-16 bg-white/15 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/25 shrink-0">
                        <i class="fa-solid fa-file-contract text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-white mb-3">Syarat &amp; Ketentuan</h1>
                        <p class="text-white/80 text-base md:text-lg max-w-2xl leading-relaxed">
                            Ketentuan penggunaan layanan digital PPID Kabupaten Konawe yang mengikat setiap pengguna
                        </p>
                        <div class="flex flex-wrap gap-3 mt-5">
                            <span class="inline-flex items-center gap-1.5 bg-white/15 text-white text-xs font-semibold px-3 py-1.5 rounded-full border border-white/20">
                                <i class="fa-regular fa-calendar"></i> Berlaku sejak: 1 Agustus 2025
                            </span>
                            <span class="inline-flex items-center gap-1.5 bg-white/15 text-white text-xs font-semibold px-3 py-1.5 rounded-full border border-white/20">
                                <i class="fa-solid fa-rotate"></i> Diperbarui: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Main Content --}}
        <section class="py-12">
            <div class="max-w-7xl mx-auto px-4 md:px-8">
                <div class="flex flex-col lg:flex-row gap-8 items-start">

                    {{-- Sidebar TOC (Fixed Float) --}}
                    <aside class="lg:w-72 shrink-0 hidden lg:block" id="toc-sidebar">
                        <div id="toc-fixed-inner" class="lg:w-72">
                            <div class="bg-white rounded-2xl border border-slate-200 shadow-lg overflow-hidden">
                                <div class="bg-accent px-5 py-4">
                                    <h2 class="text-white font-bold flex items-center gap-2 text-sm">
                                        <i class="fa-solid fa-list-ul"></i> Daftar Isi
                                    </h2>
                                </div>
                                <nav class="p-3 max-h-[70vh] overflow-y-auto" id="toc-nav">
                                    <ul class="space-y-0.5 text-sm">
                                        <li><a href="#t1" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-accent/10 text-accent rounded text-xs font-bold flex items-center justify-center shrink-0">1</span> Penerimaan Ketentuan</a></li>
                                        <li><a href="#t2" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-accent/10 text-accent rounded text-xs font-bold flex items-center justify-center shrink-0">2</span> Penggunaan Layanan</a></li>
                                        <li><a href="#t3" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-accent/10 text-accent rounded text-xs font-bold flex items-center justify-center shrink-0">3</span> Hak &amp; Kewajiban Pengguna</a></li>
                                        <li><a href="#t4" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-accent/10 text-accent rounded text-xs font-bold flex items-center justify-center shrink-0">4</span> Hak Kekayaan Intelektual</a></li>
                                        <li><a href="#t5" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-accent/10 text-accent rounded text-xs font-bold flex items-center justify-center shrink-0">5</span> Batasan Tanggung Jawab</a></li>
                                        <li><a href="#t6" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-accent/10 text-accent rounded text-xs font-bold flex items-center justify-center shrink-0">6</span> Tautan Pihak Ketiga</a></li>
                                        <li><a href="#t7" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-accent/10 text-accent rounded text-xs font-bold flex items-center justify-center shrink-0">7</span> Perubahan Layanan</a></li>
                                        <li><a href="#t8" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-accent/10 text-accent rounded text-xs font-bold flex items-center justify-center shrink-0">8</span> Hukum yang Berlaku</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="mt-4">
                                <button onclick="window.print()" class="w-full flex items-center justify-center gap-2 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-4 py-2.5 rounded-xl text-sm font-semibold transition-soft shadow-sm">
                                    <i class="fa-solid fa-print"></i> Cetak Halaman Ini
                                </button>
                            </div>
                        </div>
                    </aside>

                    {{-- Content --}}
                    <article class="flex-1 min-w-0">
                        <div class="bg-white rounded-3xl shadow-xl p-7 md:p-10 border border-slate-100 terms-content">

                            <div class="highlight-box mb-8">
                                <p class="text-accent font-semibold text-sm flex items-start gap-2 !mb-0">
                                    <i class="fa-solid fa-circle-info mt-0.5 shrink-0"></i>
                                    Dengan mengakses dan menggunakan layanan PPID Kabupaten Konawe, Anda menyatakan telah membaca, memahami, dan menyetujui Syarat dan Ketentuan ini. Jika Anda tidak menyetujui ketentuan ini, mohon untuk tidak menggunakan layanan kami.
                                </p>
                            </div>

                            <div id="t1" class="scroll-mt-20">
                                <h2><span class="section-num">1</span> Penerimaan Ketentuan</h2>
                                <p>Layanan PPID Kabupaten Konawe (selanjutnya disebut "Layanan") dioperasikan oleh Dinas Komunikasi dan Informatika Kabupaten Konawe. Syarat dan Ketentuan ini mengatur penggunaan seluruh fitur dan layanan yang tersedia di <strong>ppid.konawekab.go.id</strong>.</p>
                                <p>Pengguna yang mengakses layanan ini wajib mematuhi ketentuan yang berlaku, termasuk peraturan perundang-undangan Republik Indonesia yang berlaku.</p>
                            </div>

                            <div id="t2" class="scroll-mt-20">
                                <h2><span class="section-num">2</span> Penggunaan Layanan</h2>
                                <p>Layanan ini disediakan khusus untuk keperluan:</p>
                                <ul>
                                    <li>Mengakses informasi publik yang tersedia sesuai UU No. 14 Tahun 2008</li>
                                    <li>Mengajukan permohonan informasi publik secara resmi</li>
                                    <li>Memperoleh informasi tentang regulasi, pengumuman, dan kegiatan Pemerintah Kabupaten Konawe</li>
                                    <li>Menghubungi PPID untuk keperluan yang sah dan terkait layanan publik</li>
                                </ul>
                                <p>Pengguna dilarang menggunakan layanan ini untuk tujuan yang melanggar hukum, merugikan pihak lain, atau merusak sistem informasi yang digunakan.</p>
                            </div>

                            <div id="t3" class="scroll-mt-20">
                                <h2><span class="section-num">3</span> Hak dan Kewajiban Pengguna</h2>
                                <p><strong>Hak Pengguna:</strong></p>
                                <ul>
                                    <li>Mengakses informasi publik yang tersedia secara bebas dan terbuka</li>
                                    <li>Mengajukan permohonan informasi dan mendapatkan respons dalam jangka waktu yang ditetapkan</li>
                                    <li>Mengajukan keberatan atas penolakan permohonan informasi sesuai mekanisme yang berlaku</li>
                                    <li>Mendapatkan perlakuan yang adil dan tidak diskriminatif dalam pelayanan</li>
                                </ul>
                                <p><strong>Kewajiban Pengguna:</strong></p>
                                <ul>
                                    <li>Memberikan data dan informasi yang benar dan akurat saat mengajukan permohonan</li>
                                    <li>Tidak menyalahgunakan layanan untuk kepentingan yang melanggar hukum</li>
                                    <li>Tidak mencoba mengakses sistem secara tidak sah atau mengganggu keamanan layanan</li>
                                    <li>Menghormati hak-hak pihak lain yang menggunakan layanan ini</li>
                                    <li>Tidak menyebarkan informasi yang diperoleh untuk kepentingan yang bertentangan dengan ketentuan penggunaannya</li>
                                </ul>
                            </div>

                            <div id="t4" class="scroll-mt-20">
                                <h2><span class="section-num">4</span> Hak Kekayaan Intelektual</h2>
                                <p>
                                    Seluruh konten yang terdapat dalam layanan ini, termasuk namun tidak terbatas pada teks, grafis, logo, ikon, gambar, klip audio, unduhan digital, dan kompilasi data, merupakan milik Pemerintah Kabupaten Konawe atau pemberi lisensinya dan dilindungi oleh hukum hak cipta yang berlaku.
                                </p>
                                <ul>
                                    <li>Konten layanan dapat digunakan untuk kepentingan pribadi dan non-komersial</li>
                                    <li>Dilarang menggunakan konten untuk tujuan komersial tanpa izin tertulis</li>
                                    <li>Informasi publik yang diperoleh melalui layanan ini dapat disebarluaskan dengan mencantumkan sumber</li>
                                    <li>Logo dan identitas visual Pemerintah Kabupaten Konawe tidak boleh digunakan tanpa izin resmi</li>
                                </ul>
                            </div>

                            <div id="t5" class="scroll-mt-20">
                                <h2><span class="section-num">5</span> Batasan Tanggung Jawab</h2>
                                <p>
                                    Meskipun kami berupaya menyajikan informasi yang akurat dan mutakhir, Pemerintah Kabupaten Konawe tidak bertanggung jawab atas:
                                </p>
                                <ul>
                                    <li>Kerugian yang timbul akibat penggunaan atau ketidakmampuan menggunakan layanan ini</li>
                                    <li>Ketidakakuratan, kekeliruan, atau kelalaian dalam konten yang disediakan oleh pihak ketiga</li>
                                    <li>Gangguan layanan akibat pemeliharaan sistem, force majeure, atau hal-hal di luar kendali kami</li>
                                    <li>Kerusakan perangkat atau data pengguna yang diakibatkan oleh akses ke layanan ini</li>
                                </ul>
                                <p>Informasi yang tersedia di layanan ini bersifat informatif dan tidak merupakan nasihat hukum resmi.</p>
                            </div>

                            <div id="t6" class="scroll-mt-20">
                                <h2><span class="section-num">6</span> Tautan Pihak Ketiga</h2>
                                <p>
                                    Layanan ini mungkin memuat tautan ke situs web atau layanan pihak ketiga. Kami tidak bertanggung jawab atas konten, kebijakan privasi, atau praktik dari situs web pihak ketiga tersebut.
                                </p>
                                <ul>
                                    <li>Pencantuman tautan tidak merupakan endorsement terhadap situs pihak ketiga</li>
                                    <li>Pengguna mengakses tautan pihak ketiga atas risiko sendiri</li>
                                    <li>Kami menyarankan untuk membaca kebijakan privasi dan syarat penggunaan dari setiap situs yang dikunjungi</li>
                                </ul>
                            </div>

                            <div id="t7" class="scroll-mt-20">
                                <h2><span class="section-num">7</span> Perubahan Layanan dan Ketentuan</h2>
                                <p>
                                    Kami berhak mengubah, menangguhkan, atau menghentikan layanan atau bagian dari layanan ini kapan pun dengan atau tanpa pemberitahuan sebelumnya. Kami juga berhak mengubah Syarat dan Ketentuan ini sewaktu-waktu.
                                </p>
                                <ul>
                                    <li>Perubahan akan berlaku efektif setelah dipublikasikan di halaman ini</li>
                                    <li>Penggunaan layanan setelah perubahan dianggap sebagai persetujuan terhadap ketentuan yang baru</li>
                                    <li>Kami akan berupaya memberikan pemberitahuan yang wajar untuk perubahan yang bersifat material</li>
                                </ul>
                            </div>

                            <div id="t8" class="scroll-mt-20">
                                <h2><span class="section-num">8</span> Hukum yang Berlaku</h2>
                                <p>
                                    Syarat dan Ketentuan ini diatur oleh dan ditafsirkan sesuai dengan hukum Negara Kesatuan Republik Indonesia. Setiap perselisihan yang timbul sehubungan dengan layanan ini akan diselesaikan sesuai mekanisme hukum yang berlaku di Indonesia.
                                </p>
                                <p>Ketentuan ini mengacu pada antara lain:</p>
                                <ul>
                                    <li>UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
                                    <li>UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi</li>
                                    <li>UU No. 11 Tahun 2008 jo. UU No. 19 Tahun 2016 tentang Informasi dan Transaksi Elektronik</li>
                                    <li>Peraturan perundang-undangan lain yang berlaku di Republik Indonesia</li>
                                </ul>
                            </div>

                            <div class="mt-10 pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                <p class="text-xs text-slate-400 !mb-0">
                                    Jika ada pertanyaan tentang Syarat &amp; Ketentuan ini, silakan hubungi kami.
                                </p>
                                <div class="flex gap-3 shrink-0">
                                    <a href="{{ route('kebijakan-privasi') }}" class="inline-flex items-center gap-2 bg-white border border-accent text-accent text-sm font-semibold px-4 py-2.5 rounded-xl hover:bg-accent hover:text-white transition-soft">
                                        <i class="fa-solid fa-shield-halved"></i> Kebijakan Privasi
                                    </a>
                                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 bg-accent text-white text-sm font-semibold px-4 py-2.5 rounded-xl hover:bg-emerald-700 transition-soft shadow-sm">
                                        <i class="fa-regular fa-message"></i> Hubungi Kami
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
<script>
(function () {
    const sidebar  = document.getElementById('toc-sidebar');
    const tocInner = document.getElementById('toc-fixed-inner');
    const article  = document.querySelector('article');
    const tocLinks = document.querySelectorAll('.toc-link');
    const sections = document.querySelectorAll('[id^="t"]');
    const NAV_H    = 96;

    if (!sidebar || !tocInner) return;

    /* ---------- FIXED POSITIONING ---------- */
    function updateFixed() {
        const sRect = sidebar.getBoundingClientRect();
        const aRect = article ? article.getBoundingClientRect() : null;
        const shouldFix = sRect.top <= NAV_H;

        if (shouldFix) {
            let topPos = NAV_H;
            if (aRect) {
                const maxBottom = aRect.bottom - tocInner.offsetHeight - 16;
                if (maxBottom < NAV_H) topPos = maxBottom;
            }
            tocInner.style.position = 'fixed';
            tocInner.style.top      = topPos + 'px';
            tocInner.style.left     = sRect.left + 'px';
            tocInner.style.width    = sidebar.offsetWidth + 'px';
            tocInner.style.zIndex   = '30';
        } else {
            tocInner.style.position = '';
            tocInner.style.top      = '';
            tocInner.style.left     = '';
            tocInner.style.width    = '';
            tocInner.style.zIndex   = '';
        }
    }

    window.addEventListener('scroll', updateFixed, { passive: true });
    window.addEventListener('resize', updateFixed, { passive: true });
    requestAnimationFrame(updateFixed);

    /* ---------- SCROLLSPY ---------- */
    if (!sections.length || !tocLinks.length) return;

    const linkMap = {};
    tocLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && href.startsWith('#')) linkMap[href.slice(1)] = link;
    });

    let activeId = null;

    const setActive = (id) => {
        if (activeId === id) return;
        activeId = id;
        tocLinks.forEach(l => l.classList.remove('active'));
        if (id && linkMap[id]) {
            linkMap[id].classList.add('active');
            const nav = document.getElementById('toc-nav');
            const el  = linkMap[id];
            if (nav && el) nav.scrollTo({ top: el.offsetTop - nav.offsetTop - 32, behavior: 'smooth' });
        }
    };

    if (sections[0]) setActive(sections[0].id);

    const observer = new IntersectionObserver(
        (entries) => {
            let topId = null, topY = Infinity;
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const y = entry.boundingClientRect.top;
                    if (y < topY) { topY = y; topId = entry.target.id; }
                }
            });
            if (topId) setActive(topId);
        },
        { rootMargin: '-10% 0px -70% 0px', threshold: 0 }
    );

    sections.forEach(sec => observer.observe(sec));

    /* ---------- SMOOTH SCROLL ---------- */
    tocLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const id     = link.getAttribute('href').slice(1);
            const target = document.getElementById(id);
            if (target) {
                const top = target.getBoundingClientRect().top + window.scrollY - NAV_H - 8;
                window.scrollTo({ top, behavior: 'smooth' });
                setActive(id);
            }
        });
    });
})();
</script>
@endpush
