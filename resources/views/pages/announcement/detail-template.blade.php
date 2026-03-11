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

    <!-- ========== [START: PAGE SPECIFIC STYLES (DETAIL PENGUMUMAN)] ========== -->
    <style>
        /* Hero khusus halaman detail pengumuman */
        .announcement-detail-hero {
            background: linear-gradient(135deg, #b45309 0%, #92400e 100%);
            position: relative;
            overflow: hidden;
        }
        /* Gaya untuk konten CKEditor agar konsisten dengan desain modern - hanya dipakai di halaman detail */
        .ck-content {
            font-family: 'Inter', sans-serif;
            color: #1e293b;
            line-height: 1.7;
        }
        .ck-content h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #1f3a8a;
            border-left: 6px solid #b45309;
            padding-left: 1rem;
        }
        .ck-content h3 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            color: #2d3c5e;
        }
        .ck-content p {
            margin-bottom: 1.2rem;
            font-size: 1.05rem;
        }
        .ck-content ul,
        .ck-content ol {
            margin-left: 2rem;
            margin-bottom: 1.5rem;
        }
        .ck-content li {
            margin-bottom: 0.3rem;
        }
        .ck-content a {
            color: #b45309;
            text-decoration: underline;
        }
        .ck-content blockquote {
            border-left: 5px solid #b45309;
            background: #fffbeb;
            padding: 1rem 1.5rem;
            font-style: italic;
            margin: 1.5rem 0;
            border-radius: 0 1rem 1rem 0;
        }
        .ck-content table {
            border-collapse: collapse;
            width: 100%;
            margin: 1.5rem 0;
        }
        .ck-content td,
        .ck-content th {
            border: 1px solid #e2e8f0;
            padding: 0.75rem;
            text-align: left;
        }
        .ck-content th {
            background: #1f3a8a;
            color: white;
            font-weight: 600;
        }
        .ck-content img {
            max-width: 100%;
            height: auto;
            border-radius: 1rem;
            margin: 1.5rem 0;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .status-badge {
            @apply px-3 py-1 rounded-full text-xs font-medium inline-flex items-center gap-1;
        }
    </style>
@endpush

@section('content')
    <!-- ========== [START: MAIN CONTENT - DETAIL PENGUMUMAN] ========== -->
    <main>
        <!-- Hero kecil untuk detail -->
        <section class="announcement-detail-hero py-12 md:py-16 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative max-w-7xl mx-auto px-4 md:px-8 lg:px-12 text-center text-white z-10">
                <div
                    class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-4"
                >
                    <i class="fa-solid fa-file-lines text-sm"></i>
                    <span class="text-sm font-medium">DETAIL PENGUMUMAN</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-black mb-2 animate-slide-up">#InformasiResmi</h2>
                <p class="text-lg text-amber-100 max-w-2xl mx-auto">
                    Baca selengkapnya pengumuman resmi dari PPID Kabupaten Konawe
                </p>
            </div>
            <!-- Wave -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" fill="#F8FAFC">
                    <path
                        d="M0,48L80,53.3C160,59,320,69,480,69.3C640,69,800,59,960,53.3C1120,48,1280,48,1360,48L1440,48L1440,80L1360,80C1280,80,1120,80,960,80C800,80,640,80,480,80C320,80,160,80,80,80L0,80Z"
                    />
                </svg>
            </div>
        </section>

        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-4">
            <div class="flex items-center text-sm text-slate-500">
                <a href="index.html" class="hover:text-primary"
                ><i class="fa-solid fa-home mr-1"></i> Beranda</a
                >
                <span class="mx-2 text-slate-400">/</span>
                <a href="pengumuman.html" class="hover:text-primary">Pengumuman</a>
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-amber-600 font-medium truncate max-w-xs">Detail Pengumuman</span>
            </div>
        </div>

        <!-- Konten Utama Detail -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 pb-16">
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
                <!-- Header info pengumuman (metadata) -->
                <div class="p-6 md:p-8 border-b border-slate-200 bg-gradient-to-r from-amber-50 to-white">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                        <div>
                            <div class="flex flex-wrap gap-3 items-center mb-3">
                  <span
                      class="status-badge bg-amber-100 text-amber-700 text-sm px-3 py-1.5 rounded-full"
                  ><i class="fa-solid fa-clock mr-1"></i> Layanan</span
                  >
                                <span
                                    class="status-badge bg-red-100 text-red-600 text-sm px-3 py-1.5 rounded-full"
                                ><i class="fa-solid fa-circle text-[8px] mr-1"></i> AKTIF</span
                                >
                                <span class="text-sm bg-slate-100 text-slate-700 px-3 py-1.5 rounded-full"
                                ><i class="fa-regular fa-file-pdf mr-1 text-amber-600"></i> Lampiran: 2
                    file</span
                                >
                            </div>
                            <h1 class="text-3xl md:text-4xl font-black text-dark mb-3 leading-tight">
                                Perubahan Jam Layanan PPID Selama Bulan Ramadhan 1447 H
                            </h1>
                            <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-slate-500">
                  <span
                  ><i class="fa-regular fa-calendar mr-2 text-amber-600"></i>Diterbitkan: 22
                    Februari 2026</span
                  >
                                <span
                                ><i class="fa-regular fa-clock mr-2 text-amber-600"></i>Diperbarui: 28 Februari
                    2026</span
                                >
                                <span
                                ><i class="fa-regular fa-user mr-2 text-amber-600"></i>Oleh: Humas PPID</span
                                >
                                <span
                                ><i class="fa-regular fa-folder-open mr-2 text-amber-600"></i>Kategori:
                    Layanan</span
                                >
                            </div>
                        </div>
                        <!-- tombol aksi -->
                        <div class="flex gap-2">
                            <a
                                href="#"
                                class="bg-white border border-slate-200 hover:bg-amber-50 text-slate-700 px-4 py-2.5 rounded-xl font-medium text-sm transition-soft shadow-sm"
                            ><i class="fa-solid fa-print mr-2"></i> Cetak</a
                            >
                            <a
                                href="#"
                                class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2.5 rounded-xl font-medium text-sm transition-soft shadow-md flex items-center gap-2"
                            ><i class="fa-solid fa-download"></i> Unduh PDF</a
                            >
                        </div>
                    </div>
                </div>

                <!-- Body konten (CKEditor) - Area preview dinamis -->
                <div class="p-6 md:p-10">
                    <!-- Inilah tempat konten dari CKEditor akan ditampilkan. Untuk demo kita isi contoh HTML kaya -->
                    <div class="ck-content prose prose-amber max-w-none" id="announcement-content">
                        <!-- Ini adalah simulasi konten yang dihasilkan CKEditor.
                           Biasanya Anda akan mengambil dari database dan menampilkan di sini. -->
                        <h2>Pengumuman Penting Bagi Pengguna Layanan</h2>
                        <p>
                            Sehubungan dengan memasuki bulan suci Ramadhan 1447 H, bersama ini kami sampaikan
                            bahwa
                            <strong>jam operasional layanan PPID Kabupaten Konawe mengalami penyesuaian</strong>
                            sebagai berikut:
                        </p>
                        <h3>Jam Layanan Baru (efektif 1 Maret 2026)</h3>
                        <ul>
                            <li>
                                <i class="fa-regular fa-clock text-amber-600 mr-2"></i>
                                <strong>Senin – Kamis:</strong> 08.00 – 15.00 WITA (istirahat 12.00-12.45)
                            </li>
                            <li>
                                <i class="fa-regular fa-clock text-amber-600 mr-2"></i>
                                <strong>Jumat:</strong> 08.00 – 15.30 WITA (istirahat 11.30-12.30)
                            </li>
                            <li>
                                <i class="fa-regular fa-clock text-amber-600 mr-2"></i> Sabtu, Minggu, dan libur
                                nasional: <strong>Tutup</strong>
                            </li>
                        </ul>
                        <p>
                            Khusus selama Ramadhan,
                            <mark
                            >layanan konsultasi dan pengambilan dokumen fisik hanya dilayani hingga pukul
                                14.30 WITA.</mark
                            >
                        </p>
                        <blockquote>
                            <p>
                                “Kami mengimbau masyarakat untuk memanfaatkan layanan permohonan informasi secara
                                daring melalui website PPID guna mengurangi waktu tunggu.”
                            </p>
                            <footer>— Kepala PPID Kab. Konawe</footer>
                        </blockquote>
                        <h3>Layanan Online Tetap 24 Jam</h3>
                        <p>
                            Masyarakat tetap dapat mengajukan permohonan informasi kapan saja melalui
                            <a href="#">Formulir Permohonan Online</a> di website ini. Permohonan yang masuk
                            setelah jam kerja akan diproses pada hari kerja berikutnya.
                        </p>
                        <figure>
                            <img
                                src="https://via.placeholder.com/800x400?text=Infografis+Jam+Layanan+Ramadhan"
                                alt="Infografis jam layanan"
                            />
                            <figcaption class="text-sm text-slate-500 mt-2 text-center">
                                Infografis jam layanan Ramadhan 1447 H
                            </figcaption>
                        </figure>
                        <h3>Tabel Perubahan Jam (Perbandingan)</h3>
                        <table>
                            <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam Normal</th>
                                <th>Jam Ramadhan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Senin - Kamis</td>
                                <td>08.00-16.00</td>
                                <td>08.00-15.00</td>
                            </tr>
                            <tr>
                                <td>Jumat</td>
                                <td>08.00-16.30</td>
                                <td>08.00-15.30</td>
                            </tr>
                            </tbody>
                        </table>
                        <p>
                            Demikian pengumuman ini disampaikan. Atas perhatian dan kerja samanya, kami ucapkan
                            terima kasih. <i class="fa-regular fa-hand-peace"></i>
                        </p>
                    </div>

                    <!-- Informasi Lampiran -->
                    <div class="mt-10 p-6 bg-slate-50 rounded-2xl border border-slate-200">
                        <h4 class="font-bold text-lg mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-paperclip text-amber-600"></i> Lampiran (2)
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <a
                                href="#"
                                class="flex items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 hover:border-amber-300 transition-soft group"
                            >
                                <div
                                    class="w-10 h-10 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-soft"
                                >
                                    <i class="fa-regular fa-file-pdf text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-dark">Surat_Edaran_Ramadhan_2026.pdf</p>
                                    <p class="text-xs text-slate-400">245 KB</p>
                                </div>
                            </a>
                            <a
                                href="#"
                                class="flex items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 hover:border-amber-300 transition-soft group"
                            >
                                <div
                                    class="w-10 h-10 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-soft"
                                >
                                    <i class="fa-regular fa-image text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-dark">Infografis_Jam_Ramadhan.png</p>
                                    <p class="text-xs text-slate-400">1.2 MB</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Bagian berbagi dan navigasi ke pengumuman lain -->
                    <div
                        class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-10 pt-6 border-t border-slate-200"
                    >
                        <div class="flex items-center gap-3">
                            <span class="text-slate-500 text-sm">Bagikan:</span>
                            <div class="flex gap-2">
                                <a
                                    href="#"
                                    class="w-9 h-9 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-blue-600 hover:text-white transition-soft"
                                ><i class="fa-brands fa-facebook-f"></i
                                    ></a>
                                <a
                                    href="#"
                                    class="w-9 h-9 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-blue-400 hover:text-white transition-soft"
                                ><i class="fa-brands fa-twitter"></i
                                    ></a>
                                <a
                                    href="#"
                                    class="w-9 h-9 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-green-500 hover:text-white transition-soft"
                                ><i class="fa-brands fa-whatsapp"></i
                                    ></a>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <a
                                href="pengumuman.html"
                                class="text-amber-600 hover:text-amber-800 font-medium text-sm flex items-center gap-1"
                            ><i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar</a
                            >
                            <span class="text-slate-300">|</span>
                            <a
                                href="#"
                                class="text-amber-600 hover:text-amber-800 font-medium text-sm flex items-center gap-1"
                            >Pengumuman Selanjutnya <i class="fa-solid fa-arrow-right"></i
                                ></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Pengumuman Terkait -->
            <div class="mt-12">
                <h3 class="text-2xl font-black text-dark mb-6 flex items-center gap-2">
                    <i class="fa-regular fa-newspaper text-amber-600"></i> Pengumuman Lainnya
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-white p-5 rounded-xl shadow-md border border-slate-100 card-hover">
              <span
                  class="status-badge bg-blue-100 text-blue-600 text-xs mb-2 inline-block rounded-full px-2 py-1"
              ><i class="fa-solid fa-users"></i> Kepegawaian</span
              >
                        <h4 class="font-bold text-dark mb-1">Hasil Seleksi PPPK Formasi 2025</h4>
                        <p class="text-xs text-slate-500 mb-2">15 Feb 2026</p>
                        <a href="#" class="text-amber-600 font-medium text-sm inline-flex items-center gap-1"
                        >Baca <i class="fa-solid fa-arrow-right"></i
                            ></a>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-white p-5 rounded-xl shadow-md border border-slate-100 card-hover">
              <span
                  class="status-badge bg-purple-100 text-purple-600 text-xs mb-2 inline-block rounded-full px-2 py-1"
              ><i class="fa-solid fa-calendar-alt"></i> Libur</span
              >
                        <h4 class="font-bold text-dark mb-1">Libur Nasional & Cuti Bersama 2026</h4>
                        <p class="text-xs text-slate-500 mb-2">10 Feb 2026</p>
                        <a href="#" class="text-amber-600 font-medium text-sm inline-flex items-center gap-1"
                        >Baca <i class="fa-solid fa-arrow-right"></i
                            ></a>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-white p-5 rounded-xl shadow-md border border-slate-100 card-hover">
              <span
                  class="status-badge bg-green-100 text-green-600 text-xs mb-2 inline-block rounded-full px-2 py-1"
              ><i class="fa-solid fa-truck"></i> Pengadaan</span
              >
                        <h4 class="font-bold text-dark mb-1">Pengadaan Langsung Jasa Kebersihan</h4>
                        <p class="text-xs text-slate-500 mb-2">5 Feb 2026</p>
                        <a href="#" class="text-amber-600 font-medium text-sm inline-flex items-center gap-1"
                        >Baca <i class="fa-solid fa-arrow-right"></i
                            ></a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- ========== [END: MAIN CONTENT - DETAIL PENGUMUMAN] ========== -->
@endsection
