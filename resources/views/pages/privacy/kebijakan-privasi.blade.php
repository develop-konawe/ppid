@extends('layouts.app')

@section('title', 'Kebijakan Privasi - PPID Kabupaten Konawe')

@push('meta-head')
    <meta name="description" content="Kebijakan Privasi resmi PPID Kabupaten Konawe. Informasi mengenai data pribadi yang dikumpulkan, tujuan pemrosesan, hak pengguna, dan cara kami menjaga keamanan data Anda.">
    <meta property="og:title" content="Kebijakan Privasi - PPID Kabupaten Konawe">
    <meta property="og:description" content="Pemberitahuan Pelindungan Data Pribadi (Privacy Notice) layanan digital PPID Kabupaten Konawe.">
    <meta property="og:url" content="{{ route('kebijakan-privasi') }}">
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
        .privacy-content h2 {
            font-size: 1.25rem;
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
        .privacy-content h2 .section-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            min-width: 2rem;
            background: #1F3A8A;
            color: white;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 700;
        }
        .privacy-content p {
            color: #475569;
            line-height: 1.85;
            margin-bottom: 1rem;
        }
        .privacy-content ul {
            list-style: none;
            padding: 0;
            margin: 0.5rem 0 1.25rem 0;
        }
        .privacy-content ul li {
            display: flex;
            align-items: flex-start;
            gap: 0.625rem;
            color: #475569;
            padding: 0.375rem 0;
            line-height: 1.7;
        }
        .privacy-content ul li::before {
            content: '';
            display: inline-block;
            width: 0.5rem;
            height: 0.5rem;
            min-width: 0.5rem;
            background: #1F3A8A;
            border-radius: 9999px;
            margin-top: 0.5rem;
        }
        .toc-link:hover { background: #eff6ff; color: #1f3a8a; }
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .highlight-box { background: linear-gradient(135deg, #eff6ff 0%, #e0f2fe 100%); border: 1px solid #bfdbfe; border-radius: 1rem; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; }
        .contact-card { border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1rem 1.25rem; display: flex; align-items: center; gap: 0.875rem; }
        .contact-card i { width: 2.5rem; height: 2.5rem; min-width: 2.5rem; background: #eff6ff; color: #1f3a8a; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
    </style>
@endpush

@section('content')
    <main class="overflow-hidden bg-slate-50 min-h-screen">

        {{-- Hero Section --}}
        <section class="bg-gradient-to-br from-primary to-primary-dark py-14 md:py-20 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            <div class="max-w-5xl mx-auto px-4 md:px-8 relative">
                <nav class="text-sm flex items-center gap-2 text-white/60 mb-6 flex-wrap">
                    <a href="{{ route('home') }}" class="hover:text-white transition-soft"><i class="fa-solid fa-home"></i> Beranda</a>
                    <span>/</span>
                    <span class="text-white font-medium">Kebijakan Privasi</span>
                </nav>
                <div class="flex items-start gap-5">
                    <div class="w-16 h-16 bg-white/15 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/25 shrink-0">
                        <i class="fa-solid fa-shield-halved text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-white mb-3">Kebijakan Privasi</h1>
                        <p class="text-white/80 text-base md:text-lg max-w-2xl leading-relaxed">
                            Pemberitahuan Pelindungan Data Pribadi (Privacy Notice) layanan digital PPID Kabupaten Konawe
                        </p>
                        <div class="flex flex-wrap gap-3 mt-5">
                            <span class="inline-flex items-center gap-1.5 bg-white/15 text-white text-xs font-semibold px-3 py-1.5 rounded-full border border-white/20">
                                <i class="fa-regular fa-calendar"></i> Berlaku sejak: 1 Agustus 2025
                            </span>
                            <span class="inline-flex items-center gap-1.5 bg-white/15 text-white text-xs font-semibold px-3 py-1.5 rounded-full border border-white/20">
                                <i class="fa-solid fa-rotate"></i> Terakhir diperbarui: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Main Content --}}
        <section class="py-12">
            <div class="max-w-5xl mx-auto px-4 md:px-8">
                <div class="flex flex-col lg:flex-row gap-8 items-start">

                    {{-- Table of Contents (Sticky Sidebar) --}}
                    <aside class="lg:w-72 shrink-0 lg:sticky lg:top-8">
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                            <div class="bg-primary px-5 py-4">
                                <h2 class="text-white font-bold flex items-center gap-2 text-sm">
                                    <i class="fa-solid fa-list-ul"></i> Daftar Isi
                                </h2>
                            </div>
                            <nav class="p-3">
                                <ul class="space-y-0.5 text-sm">
                                    <li><a href="#sec-1" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-primary/10 text-primary rounded text-xs font-bold flex items-center justify-center shrink-0">1</span> Identitas Pengelola</a></li>
                                    <li><a href="#sec-2" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-primary/10 text-primary rounded text-xs font-bold flex items-center justify-center shrink-0">2</span> Data yang Dikumpulkan</a></li>
                                    <li><a href="#sec-3" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-primary/10 text-primary rounded text-xs font-bold flex items-center justify-center shrink-0">3</span> Tujuan Pemrosesan</a></li>
                                    <li><a href="#sec-4" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-primary/10 text-primary rounded text-xs font-bold flex items-center justify-center shrink-0">4</span> Dasar Pemrosesan</a></li>
                                    <li><a href="#sec-5" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-primary/10 text-primary rounded text-xs font-bold flex items-center justify-center shrink-0">5</span> Penggunaan & Penyimpanan</a></li>
                                    <li><a href="#sec-6" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-primary/10 text-primary rounded text-xs font-bold flex items-center justify-center shrink-0">6</span> Pihak Penerima Data</a></li>
                                    <li><a href="#sec-7" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-primary/10 text-primary rounded text-xs font-bold flex items-center justify-center shrink-0">7</span> Jangka Waktu Penyimpanan</a></li>
                                    <li><a href="#sec-8" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-primary/10 text-primary rounded text-xs font-bold flex items-center justify-center shrink-0">8</span> Keamanan Data</a></li>
                                    <li><a href="#sec-9" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-primary/10 text-primary rounded text-xs font-bold flex items-center justify-center shrink-0">9</span> Hak Pengguna</a></li>
                                    <li><a href="#sec-10" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-primary/10 text-primary rounded text-xs font-bold flex items-center justify-center shrink-0">10</span> Kontak Pengelola</a></li>
                                    <li><a href="#sec-11" class="toc-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-slate-600 transition-soft"><span class="w-5 h-5 bg-primary/10 text-primary rounded text-xs font-bold flex items-center justify-center shrink-0">11</span> Perubahan Kebijakan</a></li>
                                </ul>
                            </nav>
                        </div>

                        {{-- Download / Print --}}
                        <div class="mt-4 flex flex-col gap-2">
                            <button onclick="window.print()" class="w-full flex items-center justify-center gap-2 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-4 py-2.5 rounded-xl text-sm font-semibold transition-soft shadow-sm">
                                <i class="fa-solid fa-print"></i> Cetak Halaman Ini
                            </button>
                        </div>
                    </aside>

                    {{-- Content --}}
                    <article class="flex-1 min-w-0">
                        <div class="bg-white rounded-3xl shadow-xl p-7 md:p-10 border border-slate-100 privacy-content">

                            {{-- Intro --}}
                            <div class="highlight-box mb-8">
                                <p class="text-primary font-semibold text-sm flex items-start gap-2 !mb-0">
                                    <i class="fa-solid fa-circle-info mt-0.5 shrink-0"></i>
                                    Kebijakan Privasi ini berlaku untuk layanan digital PPID Kabupaten Konawe yang dapat diakses melalui <strong>ppid.konawekab.go.id</strong>. Dengan mengakses atau menggunakan layanan kami, Anda menyetujui pengumpulan dan penggunaan data sebagaimana diuraikan dalam dokumen ini.
                                </p>
                            </div>

                            {{-- Section 1 --}}
                            <div id="sec-1" class="scroll-mt-20">
                                <h2><span class="section-num">1</span> Identitas Pengelola Layanan</h2>
                                <p>
                                    Layanan PPID (Pejabat Pengelola Informasi dan Dokumentasi) Kabupaten Konawe dikelola oleh:
                                </p>
                                <ul>
                                    <li><strong>Nama Instansi:</strong> Dinas Komunikasi dan Informatika Kabupaten Konawe</li>
                                    <li><strong>Peran:</strong> Pengendali Data Pribadi dalam layanan PPID</li>
                                    <li><strong>Alamat:</strong> Kompleks Perkantoran Pemerintah Kabupaten Konawe, Sulawesi Tenggara</li>
                                    <li><strong>Website:</strong> ppid.konawekab.go.id</li>
                                    <li><strong>Email:</strong> ppid@konawekab.go.id</li>
                                </ul>
                            </div>

                            {{-- Section 2 --}}
                            <div id="sec-2" class="scroll-mt-20">
                                <h2><span class="section-num">2</span> Data Pribadi yang Dikumpulkan</h2>
                                <p>
                                    Dalam pengoperasian layanan PPID, kami hanya mengumpulkan data pribadi yang diperlukan untuk memenuhi permohonan informasi publik dan meningkatkan kualitas layanan, antara lain:
                                </p>
                                <ul>
                                    <li><strong>Data Identitas:</strong> Nama lengkap, nomor identitas (KTP/SIM/Paspor)</li>
                                    <li><strong>Data Kontak:</strong> Alamat surat elektronik (email), nomor telepon/WhatsApp</li>
                                    <li><strong>Data Permohonan:</strong> Jenis informasi yang dimohon, tujuan penggunaan informasi, rincian permohonan</li>
                                    <li><strong>Data Teknis:</strong> Alamat IP, jenis perangkat, jenis browser, dan data log akses server yang dikumpulkan secara otomatis</li>
                                    <li><strong>Data Analitik:</strong> Statistik kunjungan halaman (tanpa identifikasi pribadi) melalui layanan analitik yang digunakan</li>
                                </ul>
                                <p>
                                    Kami <strong>tidak mengumpulkan</strong> data pribadi yang bersifat sensitif seperti NIK, data kesehatan, data biometrik, atau informasi keuangan kecuali secara eksplisit diperlukan dan diminta persetujuan Anda.
                                </p>
                            </div>

                            {{-- Section 3 --}}
                            <div id="sec-3" class="scroll-mt-20">
                                <h2><span class="section-num">3</span> Tujuan Pemrosesan Data</h2>
                                <p>Data pribadi yang kami kumpulkan digunakan untuk tujuan-tujuan berikut:</p>
                                <ul>
                                    <li>Memproses dan merespons permohonan informasi publik sesuai ketentuan UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
                                    <li>Mengirimkan pemberitahuan dan pembaruan mengenai status permohonan informasi</li>
                                    <li>Meningkatkan kualitas dan keamanan layanan digital PPID</li>
                                    <li>Memenuhi kewajiban hukum dan peraturan perundang-undangan yang berlaku</li>
                                    <li>Keperluan statistik dan pelaporan internal yang tidak mengidentifikasi pengguna secara personal</li>
                                    <li>Mendeteksi dan mencegah penyalahgunaan layanan atau akses tidak sah</li>
                                </ul>
                            </div>

                            {{-- Section 4 --}}
                            <div id="sec-4" class="scroll-mt-20">
                                <h2><span class="section-num">4</span> Dasar Pemrosesan Data</h2>
                                <p>Pemrosesan data pribadi Anda didasarkan pada:</p>
                                <ul>
                                    <li><strong>Pelaksanaan tugas pemerintahan</strong> — berdasarkan UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
                                    <li><strong>Pemenuhan kewajiban hukum</strong> — berdasarkan UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP)</li>
                                    <li><strong>Persetujuan pengguna</strong> — untuk penggunaan data yang tidak wajib, misalnya langganan informasi atau newsletter</li>
                                    <li><strong>Kepentingan yang sah</strong> — dalam rangka peningkatan layanan dan keamanan sistem</li>
                                </ul>
                            </div>

                            {{-- Section 5 --}}
                            <div id="sec-5" class="scroll-mt-20">
                                <h2><span class="section-num">5</span> Cara Penggunaan dan Penyimpanan Data</h2>
                                <p>
                                    Data pribadi Anda disimpan dalam sistem informasi yang dikelola oleh Dinas Komunikasi dan Informatika Kabupaten Konawe dengan menggunakan langkah-langkah perlindungan teknis dan organisasi yang memadai.
                                </p>
                                <ul>
                                    <li>Data disimpan di server yang berlokasi di wilayah Republik Indonesia</li>
                                    <li>Akses terhadap data dibatasi hanya kepada petugas PPID yang berwenang</li>
                                    <li>Data tidak akan digunakan untuk keperluan komersial atau iklan</li>
                                    <li>Data tidak akan dijual, disewakan, atau diperdagangkan kepada pihak ketiga mana pun</li>
                                </ul>
                            </div>

                            {{-- Section 6 --}}
                            <div id="sec-6" class="scroll-mt-20">
                                <h2><span class="section-num">6</span> Pihak yang Dapat Menerima Data</h2>
                                <p>
                                    Dalam kondisi tertentu, data pribadi Anda mungkin dibagikan kepada pihak berikut:
                                </p>
                                <ul>
                                    <li><strong>Perangkat Daerah terkait</strong> — apabila permohonan informasi memerlukan koordinasi dengan OPD lain di Lingkungan Pemerintah Kabupaten Konawe</li>
                                    <li><strong>Aparat Penegak Hukum</strong> — apabila terdapat kewajiban hukum berdasarkan peraturan perundang-undangan atau putusan pengadilan</li>
                                    <li><strong>Penyedia Layanan Teknis</strong> — pihak ketiga yang membantu operasional teknis layanan (hosting, keamanan) yang terikat perjanjian kerahasiaan data</li>
                                </ul>
                                <p>
                                    Kami memastikan bahwa setiap pihak penerima data mematuhi ketentuan kerahasiaan dan keamanan data yang berlaku.
                                </p>
                            </div>

                            {{-- Section 7 --}}
                            <div id="sec-7" class="scroll-mt-20">
                                <h2><span class="section-num">7</span> Jangka Waktu Penyimpanan Data</h2>
                                <p>
                                    Data pribadi Anda disimpan selama diperlukan untuk memenuhi tujuan pemrosesan dan memenuhi kewajiban hukum, dengan ketentuan:
                                </p>
                                <ul>
                                    <li><strong>Data permohonan informasi</strong> — disimpan sesuai ketentuan jadwal retensi arsip yang berlaku (minimal 5 tahun)</li>
                                    <li><strong>Data log teknis</strong> — disimpan selama maksimal 90 hari sejak pencatatan</li>
                                    <li><strong>Data kontak untuk notifikasi</strong> — disimpan sampai pengguna meminta penghapusan atau mencabut persetujuan</li>
                                </ul>
                                <p>
                                    Setelah masa retensi berakhir, data akan dihapus atau dianonimkan secara aman.
                                </p>
                            </div>

                            {{-- Section 8 --}}
                            <div id="sec-8" class="scroll-mt-20">
                                <h2><span class="section-num">8</span> Keamanan Data</h2>
                                <p>
                                    Kami menerapkan langkah-langkah teknis dan organisasi yang layak untuk melindungi data pribadi Anda dari akses tidak sah, pengungkapan, perubahan, atau pemusnahan yang tidak disengaja, antara lain:
                                </p>
                                <ul>
                                    <li>Enkripsi data saat transmisi menggunakan protokol HTTPS/TLS</li>
                                    <li>Pembatasan akses berbasis peran (role-based access control)</li>
                                    <li>Pemantauan aktivitas sistem dan pencatatan log akses</li>
                                    <li>Prosedur tanggap insiden keamanan data pribadi</li>
                                    <li>Pembaruan sistem keamanan secara berkala</li>
                                </ul>
                                <p>
                                    Namun demikian, tidak ada sistem yang sepenuhnya bebas risiko. Jika Anda mencurigai adanya pelanggaran keamanan data, segera hubungi kami melalui kontak yang tersedia.
                                </p>
                            </div>

                            {{-- Section 9 --}}
                            <div id="sec-9" class="scroll-mt-20">
                                <h2><span class="section-num">9</span> Hak Pengguna/Subjek Data</h2>
                                <p>
                                    Sebagai subjek data pribadi, Anda memiliki hak-hak berikut sebagaimana dijamin oleh UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi:
                                </p>
                                <ul>
                                    <li><strong>Hak Informasi:</strong> Mendapatkan informasi yang jelas mengenai pemrosesan data pribadi Anda</li>
                                    <li><strong>Hak Akses:</strong> Memperoleh salinan data pribadi yang kami miliki tentang Anda</li>
                                    <li><strong>Hak Koreksi:</strong> Meminta perbaikan atas data pribadi yang tidak akurat atau tidak lengkap</li>
                                    <li><strong>Hak Penghapusan:</strong> Meminta penghapusan data pribadi Anda dalam kondisi tertentu yang diizinkan hukum</li>
                                    <li><strong>Hak Pembatasan:</strong> Meminta pembatasan pemrosesan data dalam situasi tertentu</li>
                                    <li><strong>Hak Penarikan Persetujuan:</strong> Mencabut persetujuan yang pernah diberikan kapan pun</li>
                                    <li><strong>Hak Pengaduan:</strong> Mengajukan pengaduan kepada lembaga yang berwenang jika merasa hak-hak Anda dilanggar</li>
                                </ul>
                                <p>
                                    Untuk mengajukan permintaan terkait hak-hak di atas, silakan hubungi kami melalui informasi kontak yang tersedia di bagian 10.
                                </p>
                            </div>

                            {{-- Section 10 --}}
                            <div id="sec-10" class="scroll-mt-20">
                                <h2><span class="section-num">10</span> Kontak Pengelola Data</h2>
                                <p>
                                    Jika Anda memiliki pertanyaan, permintaan, atau pengaduan terkait kebijakan privasi ini dan pemrosesan data pribadi Anda, silakan hubungi kami melalui:
                                </p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 not-prose mt-4 mb-6">
                                    <div class="contact-card">
                                        <div class="w-10 h-10 min-w-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide !mb-0.5">Email</p>
                                            <a href="mailto:ppid@konawekab.go.id" class="text-primary font-semibold text-sm hover:underline !mb-0">ppid@konawekab.go.id</a>
                                        </div>
                                    </div>
                                    <div class="contact-card">
                                        <div class="w-10 h-10 min-w-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide !mb-0.5">Telepon</p>
                                            <a href="tel:+62408123456" class="text-primary font-semibold text-sm hover:underline !mb-0">(0408) 123456</a>
                                        </div>
                                    </div>
                                    <div class="contact-card sm:col-span-2">
                                        <div class="w-10 h-10 min-w-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide !mb-0.5">Alamat</p>
                                            <p class="text-slate-700 font-semibold text-sm !mb-0">Dinas Kominfo Kab. Konawe, Kompleks Perkantoran Pemerintah Kabupaten Konawe, Sulawesi Tenggara</p>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    Kami berkomitmen merespons setiap pertanyaan atau permintaan terkait data pribadi dalam waktu <strong>14 (empat belas) hari kerja</strong> sejak diterimanya permintaan.
                                </p>
                            </div>

                            {{-- Section 11 --}}
                            <div id="sec-11" class="scroll-mt-20">
                                <h2><span class="section-num">11</span> Perubahan Kebijakan Privasi</h2>
                                <p>
                                    Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu untuk mencerminkan perubahan dalam praktik layanan, teknologi, persyaratan hukum, atau alasan lainnya. Setiap perubahan material akan:
                                </p>
                                <ul>
                                    <li>Diberitahukan melalui halaman ini dengan mencantumkan tanggal pembaruan terbaru</li>
                                    <li>Diumumkan melalui saluran resmi PPID Kabupaten Konawe jika dianggap perlu</li>
                                </ul>
                                <p>
                                    Kami mendorong Anda untuk meninjau kembali halaman ini secara berkala. Penggunaan layanan yang berkelanjutan setelah perubahan dianggap sebagai penerimaan atas kebijakan yang diperbarui.
                                </p>
                            </div>

                            {{-- Footer note --}}
                            <div class="mt-10 pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                <p class="text-xs text-slate-400 !mb-0">
                                    Dokumen ini merupakan bagian dari implementasi Pelindungan Data Pribadi (PDP) Pemerintah Kabupaten Konawe berdasarkan UU No. 27 Tahun 2022.
                                </p>
                                <a href="{{ route('contact') }}" class="shrink-0 inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-primary-dark transition-soft shadow-sm">
                                    <i class="fa-regular fa-message"></i> Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </article>

                </div>
            </div>
        </section>

    </main>
@endsection
