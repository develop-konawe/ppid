@extends('layouts.app')

@section('title', 'Aksesibilitas - PPID Kabupaten Konawe')

@push('meta-head')
    <meta name="description" content="Pernyataan Aksesibilitas layanan digital PPID Kabupaten Konawe. Kami berkomitmen memberikan akses yang setara bagi semua pengguna termasuk penyandang disabilitas.">
    <meta property="og:title" content="Aksesibilitas - PPID Kabupaten Konawe">
    <meta property="og:url" content="{{ route('aksesibilitas') }}">
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
        .access-content h2 {
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
        .access-content p { color: #475569; line-height: 1.85; margin-bottom: 1rem; }
        .access-content ul { list-style: none; padding: 0; margin: 0.5rem 0 1.25rem 0; }
        .access-content ul li {
            display: flex;
            align-items: flex-start;
            gap: 0.625rem;
            color: #475569;
            padding: 0.375rem 0;
            line-height: 1.7;
        }
        .access-content ul li::before {
            content: '';
            display: inline-block;
            width: 0.5rem;
            height: 0.5rem;
            min-width: 0.5rem;
            background: #7c3aed;
            border-radius: 9999px;
            margin-top: 0.5rem;
        }
        .toc-link:hover { background: #f5f3ff; color: #7c3aed; }
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .highlight-box { background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%); border: 1px solid #ddd6fe; border-radius: 1rem; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; }
        .feature-card { border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1.25rem; display: flex; gap: 1rem; align-items: flex-start; }
        .feature-card .icon { width: 2.5rem; height: 2.5rem; min-width: 2.5rem; background: #f5f3ff; color: #7c3aed; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
    </style>
@endpush

@section('content')
    <main class="overflow-hidden bg-slate-50 min-h-screen">

        {{-- Hero --}}
        <section class="bg-gradient-to-br from-violet-700 to-purple-800 py-14 md:py-20 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            <div class="max-w-5xl mx-auto px-4 md:px-8 relative">
                <nav class="text-sm flex items-center gap-2 text-white/60 mb-6 flex-wrap">
                    <a href="{{ route('home') }}" class="hover:text-white transition-soft"><i class="fa-solid fa-home"></i> Beranda</a>
                    <span>/</span>
                    <span class="text-white font-medium">Aksesibilitas</span>
                </nav>
                <div class="flex items-start gap-5">
                    <div class="w-16 h-16 bg-white/15 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/25 shrink-0">
                        <i class="fa-solid fa-universal-access text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-white mb-3">Pernyataan Aksesibilitas</h1>
                        <p class="text-white/80 text-base md:text-lg max-w-2xl leading-relaxed">
                            Komitmen kami untuk memastikan layanan digital PPID Konawe dapat diakses oleh semua pengguna
                        </p>
                        <div class="flex flex-wrap gap-3 mt-5">
                            <span class="inline-flex items-center gap-1.5 bg-white/15 text-white text-xs font-semibold px-3 py-1.5 rounded-full border border-white/20">
                                <i class="fa-solid fa-rotate"></i> Diperbarui: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Content --}}
        <section class="py-12">
            <div class="max-w-5xl mx-auto px-4 md:px-8">
                <div class="flex flex-col lg:flex-row gap-8 items-start">

                    {{-- Sidebar --}}
                    <aside class="lg:w-72 shrink-0 lg:sticky lg:top-8">
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                            <div class="bg-violet-700 px-5 py-4">
                                <h2 class="text-white font-bold flex items-center gap-2 text-sm">
                                    <i class="fa-solid fa-list-ul"></i> Daftar Isi
                                </h2>
                            </div>
                            <nav class="p-3">
                                <ul class="space-y-0.5 text-sm">
                                    <li><a href="#a1" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-violet-100 text-violet-700 rounded text-xs font-bold flex items-center justify-center shrink-0">1</span> Komitmen Kami</a></li>
                                    <li><a href="#a2" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-violet-100 text-violet-700 rounded text-xs font-bold flex items-center justify-center shrink-0">2</span> Standar Aksesibilitas</a></li>
                                    <li><a href="#a3" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-violet-100 text-violet-700 rounded text-xs font-bold flex items-center justify-center shrink-0">3</span> Fitur Aksesibilitas</a></li>
                                    <li><a href="#a4" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-violet-100 text-violet-700 rounded text-xs font-bold flex items-center justify-center shrink-0">4</span> Status Kepatuhan</a></li>
                                    <li><a href="#a5" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-violet-100 text-violet-700 rounded text-xs font-bold flex items-center justify-center shrink-0">5</span> Layanan Alternatif</a></li>
                                    <li><a href="#a6" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-violet-100 text-violet-700 rounded text-xs font-bold flex items-center justify-center shrink-0">6</span> Umpan Balik</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="mt-4">
                            <button onclick="window.print()" class="w-full flex items-center justify-center gap-2 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-4 py-2.5 rounded-xl text-sm font-semibold transition-soft shadow-sm">
                                <i class="fa-solid fa-print"></i> Cetak Halaman Ini
                            </button>
                        </div>
                    </aside>

                    {{-- Main content --}}
                    <article class="flex-1 min-w-0">
                        <div class="bg-white rounded-3xl shadow-xl p-7 md:p-10 border border-slate-100 access-content">

                            <div class="highlight-box mb-8">
                                <p class="text-violet-700 font-semibold text-sm flex items-start gap-2 !mb-0">
                                    <i class="fa-solid fa-universal-access mt-0.5 shrink-0"></i>
                                    Pemerintah Kabupaten Konawe berkomitmen untuk memastikan bahwa seluruh layanan digital PPID dapat diakses oleh semua kalangan masyarakat, termasuk penyandang disabilitas, lansia, dan pengguna dengan keterbatasan teknis.
                                </p>
                            </div>

                            <div id="a1" class="scroll-mt-20">
                                <h2><i class="fa-solid fa-heart text-violet-600 text-lg"></i> Komitmen Kami</h2>
                                <p>
                                    Kami percaya bahwa setiap warga negara berhak mendapatkan akses yang setara terhadap informasi publik. Oleh karena itu, kami berupaya membangun layanan digital yang inklusif dan dapat dijangkau oleh semua lapisan masyarakat, tanpa memandang kemampuan fisik, usia, maupun tingkat melek teknologi.
                                </p>
                                <p>
                                    Pernyataan aksesibilitas ini berlaku untuk seluruh layanan digital yang dikelola oleh PPID Kabupaten Konawe, termasuk website utama dan aplikasi pendukung.
                                </p>
                            </div>

                            <div id="a2" class="scroll-mt-20">
                                <h2><i class="fa-solid fa-certificate text-violet-600 text-lg"></i> Standar Aksesibilitas</h2>
                                <p>
                                    Layanan digital kami mengacu pada pedoman aksesibilitas web internasional <strong>WCAG 2.1</strong> (Web Content Accessibility Guidelines) dan <strong>PERMENKOMINFO No. 6 Tahun 2023</strong> tentang Standar Teknis dan Prosedur Pengelolaan Sistem Pemerintahan Berbasis Elektronik, dengan menargetkan kepatuhan terhadap level <strong>AA</strong>.
                                </p>
                                <p>Empat prinsip utama yang kami terapkan:</p>
                                <ul>
                                    <li><strong>Perceivable (Dapat Dirasakan):</strong> Konten disajikan sehingga dapat dirasakan oleh semua pengguna</li>
                                    <li><strong>Operable (Dapat Dioperasikan):</strong> Antarmuka dapat dioperasikan menggunakan berbagai perangkat masukan</li>
                                    <li><strong>Understandable (Dapat Dipahami):</strong> Konten dan pengoperasian antarmuka mudah dipahami</li>
                                    <li><strong>Robust (Kuat):</strong> Konten dapat diinterpretasikan oleh berbagai teknologi assistif</li>
                                </ul>
                            </div>

                            <div id="a3" class="scroll-mt-20">
                                <h2><i class="fa-solid fa-wand-magic-sparkles text-violet-600 text-lg"></i> Fitur Aksesibilitas</h2>
                                <p>Layanan digital PPID Konawe dilengkapi dengan fitur-fitur aksesibilitas berikut:</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 not-prose my-5">
                                    <div class="feature-card">
                                        <div class="icon"><i class="fa-solid fa-text-height"></i></div>
                                        <div>
                                            <p class="font-semibold text-slate-700 text-sm mb-1">Ukuran Teks Responsif</p>
                                            <p class="text-slate-500 text-xs">Teks dapat diperbesar hingga 200% tanpa kehilangan konten atau fungsi</p>
                                        </div>
                                    </div>
                                    <div class="feature-card">
                                        <div class="icon"><i class="fa-solid fa-keyboard"></i></div>
                                        <div>
                                            <p class="font-semibold text-slate-700 text-sm mb-1">Navigasi Keyboard</p>
                                            <p class="text-slate-500 text-xs">Seluruh fungsi dapat diakses menggunakan keyboard saja</p>
                                        </div>
                                    </div>
                                    <div class="feature-card">
                                        <div class="icon"><i class="fa-solid fa-eye-low-vision"></i></div>
                                        <div>
                                            <p class="font-semibold text-slate-700 text-sm mb-1">Kontras Warna</p>
                                            <p class="text-slate-500 text-xs">Rasio kontras warna memenuhi standar minimal 4.5:1 untuk teks</p>
                                        </div>
                                    </div>
                                    <div class="feature-card">
                                        <div class="icon"><i class="fa-solid fa-image"></i></div>
                                        <div>
                                            <p class="font-semibold text-slate-700 text-sm mb-1">Teks Alternatif</p>
                                            <p class="text-slate-500 text-xs">Gambar dilengkapi dengan deskripsi teks alternatif (alt text)</p>
                                        </div>
                                    </div>
                                    <div class="feature-card">
                                        <div class="icon"><i class="fa-solid fa-mobile-screen"></i></div>
                                        <div>
                                            <p class="font-semibold text-slate-700 text-sm mb-1">Desain Responsif</p>
                                            <p class="text-slate-500 text-xs">Layanan dapat diakses optimal dari berbagai perangkat</p>
                                        </div>
                                    </div>
                                    <div class="feature-card">
                                        <div class="icon"><i class="fa-solid fa-language"></i></div>
                                        <div>
                                            <p class="font-semibold text-slate-700 text-sm mb-1">Bahasa yang Jelas</p>
                                            <p class="text-slate-500 text-xs">Konten ditulis dalam bahasa Indonesia yang mudah dipahami</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="a4" class="scroll-mt-20">
                                <h2><i class="fa-solid fa-chart-bar text-violet-600 text-lg"></i> Status Kepatuhan</h2>
                                <p>
                                    Kami secara aktif bekerja menuju kepatuhan penuh terhadap standar aksesibilitas. Status kepatuhan saat ini:
                                </p>
                                <ul>
                                    <li>Halaman utama dan navigasi: <strong>Sebagian patuh</strong> (WCAG 2.1 Level AA)</li>
                                    <li>Halaman konten informasi publik: <strong>Sebagian patuh</strong></li>
                                    <li>Formulir permohonan informasi: <strong>Dalam perbaikan</strong></li>
                                    <li>Dokumen PDF yang tersedia: <strong>Dalam pengembangan</strong> (target: PDF yang dapat diakses)</li>
                                </ul>
                                <p>
                                    Kami melakukan audit aksesibilitas secara berkala dan terus berupaya meningkatkan kepatuhan di setiap area layanan.
                                </p>
                            </div>

                            <div id="a5" class="scroll-mt-20">
                                <h2><i class="fa-solid fa-hands-helping text-violet-600 text-lg"></i> Layanan Alternatif</h2>
                                <p>
                                    Bagi pengguna yang mengalami kesulitan mengakses layanan digital kami, tersedia layanan alternatif secara langsung:
                                </p>
                                <ul>
                                    <li><strong>Kunjungan langsung:</strong> Datang ke Kantor Dinas Kominfo Kabupaten Konawe pada jam kerja</li>
                                    <li><strong>Melalui telepon:</strong> Hubungi (0408) 123456 untuk bantuan mengakses layanan</li>
                                    <li><strong>Melalui email:</strong> Kirim permintaan ke ppid@konawekab.go.id</li>
                                    <li><strong>Petugas pendamping:</strong> Tersedia petugas yang siap membantu pengguna dengan kebutuhan khusus</li>
                                </ul>
                            </div>

                            <div id="a6" class="scroll-mt-20">
                                <h2><i class="fa-solid fa-comment-dots text-violet-600 text-lg"></i> Umpan Balik Aksesibilitas</h2>
                                <p>
                                    Kami menghargai setiap masukan untuk meningkatkan aksesibilitas layanan kami. Jika Anda menemukan masalah aksesibilitas atau membutuhkan bantuan untuk mengakses konten tertentu, silakan hubungi kami:
                                </p>
                                <ul>
                                    <li>Laporkan masalah aksesibilitas melalui formulir kontak kami</li>
                                    <li>Kami berkomitmen merespons laporan aksesibilitas dalam <strong>5 hari kerja</strong></li>
                                    <li>Setiap laporan akan ditindaklanjuti dan digunakan sebagai bahan perbaikan layanan</li>
                                </ul>
                            </div>

                            <div class="mt-10 pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                <p class="text-xs text-slate-400 !mb-0">
                                    Kami terus berupaya meningkatkan aksesibilitas layanan untuk semua pengguna.
                                </p>
                                <a href="{{ route('contact') }}" class="shrink-0 inline-flex items-center gap-2 bg-violet-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-violet-800 transition-soft shadow-sm">
                                    <i class="fa-regular fa-message"></i> Laporkan Masalah
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>
@endsection
