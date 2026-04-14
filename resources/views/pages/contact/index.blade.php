@extends('layouts.app')

@section('title', 'Kontak')

@push('meta-head')
    <!-- Open Graph / Social Media Meta Tags -->
    <meta
        property="og:title"
        content="PPID Kabupaten Konawe - Portal Informasi Publik Transparan"
    />
    <meta
        property="og:description"
        content="Akses informasi publik Kabupaten Konawe secara transparan dan mudah"
    />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://ppid.konawelkab.go.id" />
@endpush

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
        /* Custom Styles - Diambil dari halaman utama */
        .glass-nav {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(31, 58, 138, 0.1);
        }

        .transition-soft {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover {
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -10px rgba(31, 58, 138, 0.2);
        }

        /* Logo Styles */
        .logo-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-konawe {
            filter: drop-shadow(0 4px 8px rgba(31, 58, 138, 0.3));
            transition: all 0.3s ease;
        }

        .logo-container:hover .logo-konawe {
            filter: drop-shadow(0 8px 16px rgba(31, 58, 138, 0.5));
            transform: scale(1.05);
        }

        .gov-badge-modern {
            background: linear-gradient(135deg, #ffffff 0%, #2563eb 100%);
            border: 2px solid rgba(220, 38, 38, 0.3);
            box-shadow: 0 10px 25px -5px rgba(174, 183, 208, 0.4);
            position: relative;
            overflow: hidden;
        }

        .gov-badge-modern::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .badge-indicator {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 14px;
            height: 14px;
            background: #dc2626;
            border: 2px solid white;
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.8;
            }
        }

        /* Mobile menu */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .mobile-menu.active {
            max-height: 500px;
        }

        /* Hero Section Khusus Kontak */
        .contact-hero {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            position: relative;
            overflow: hidden;
        }

        .contact-hero::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: rotate 30s linear infinite;
        }

        /* Map Container */
        #map {
            height: 400px;
            width: 100%;
            border-radius: 1rem;
            z-index: 1;
        }

        /* Form focus styles */
        .form-input:focus {
            outline: none;
            ring: 2px;
            ring-color: #3b82f6;
            border-color: #3b82f6;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #1e3a8a;
            border-radius: 4px;
        }

        *:focus {
            outline: 2px solid #1e3a8a;
            outline-offset: 2px;
        }
    </style>
@endpush

@section('content')
    <main>
        <!-- Hero Section Khusus Kontak -->
        <section class="contact-hero py-20 md:py-28 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative max-w-7xl mx-auto px-4 md:px-8 lg:px-12 text-center text-white z-10">
                <div
                    class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6 animate-fade-in"
                >
                    <i class="fa-solid fa-headset text-sm"></i>
                    <span class="text-sm font-medium">HUBUNGI KAMI</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 animate-slide-up">
                    KONTAK <span class="text-blue-200">PPID</span>
                </h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto">
                    Kami siap membantu Anda dalam mengakses informasi publik. Silakan hubungi kami melalui
                    berbagai saluran komunikasi yang tersedia.
                </p>
            </div>

            <!-- Wave Decoration -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" fill="#F8FAFC">
                    <path
                        d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,100L1360,100C1280,100,1120,100,960,100C800,100,640,100,480,100C320,100,160,100,80,100L0,100Z"
                    ></path>
                </svg>
            </div>
        </section>

        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-6">
            <div class="flex items-center text-sm text-slate-500">
                <a href="index.html" class="hover:text-primary transition-soft"
                ><i class="fa-solid fa-home mr-1"></i> Beranda</a
                >
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-primary font-medium">Kontak</span>
            </div>
        </div>

        <!-- Info Kontak Cards -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 -mt-10 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Alamat -->
                <div
                    class="bg-white rounded-2xl shadow-xl p-6 card-hover border border-slate-100 transform hover:-translate-y-2"
                >
                    <div
                        class="w-14 h-14 bg-primary/10 text-primary rounded-xl flex items-center justify-center text-2xl mb-4"
                    >
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2 text-dark">Alamat Kantor</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Kompleks Perkantoran Pemerintah Kabupaten Konawe<br />
                        Sulawesi Tenggara, 93461
                    </p>
                    <a
                        href="#map"
                        class="inline-flex items-center gap-2 text-primary text-sm font-semibold mt-3 hover:underline"
                    >
                        <i class="fa-solid fa-map"></i> Lihat Peta
                    </a>
                </div>

                <!-- Telepon -->
                <div
                    class="bg-white rounded-2xl shadow-xl p-6 card-hover border border-slate-100 transform hover:-translate-y-2"
                >
                    <div
                        class="w-14 h-14 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-2xl mb-4"
                    >
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2 text-dark">Telepon</h3>
                    <p class="text-slate-600 text-sm mb-2">
                        <a href="tel:+62408123456" class="hover:text-primary transition-soft"
                        >(0408) 123456</a
                        >
                    </p>
                    <p class="text-xs text-slate-400">Senin - Jumat, 08.00 - 16.00 WITA</p>
                </div>

                <!-- Email -->
                <div
                    class="bg-white rounded-2xl shadow-xl p-6 card-hover border border-slate-100 transform hover:-translate-y-2"
                >
                    <div
                        class="w-14 h-14 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-2xl mb-4"
                    >
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2 text-dark">Email</h3>
                    <p class="text-slate-600 text-sm break-all">
                        <a href="mailto:ppid@konawelkab.go.id" class="hover:text-primary transition-soft"
                        >ppid@konawelkab.go.id</a
                        >
                    </p>
                    <p class="text-xs text-slate-400 mt-2">Respon maksimal 2x24 jam</p>
                </div>

                <!-- Whatsapp / Layanan Chat -->
                <div
                    class="bg-white rounded-2xl shadow-xl p-6 card-hover border border-slate-100 transform hover:-translate-y-2"
                >
                    <div
                        class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-2xl mb-4"
                    >
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2 text-dark">WhatsApp</h3>
                    <p class="text-slate-600 text-sm">
                        <a
                            href="https://wa.me/6281234567890"
                            target="_blank"
                            class="hover:text-primary transition-soft"
                        >+62 812-3456-7890</a
                        >
                    </p>
                    <p class="text-xs text-slate-400 mt-2">Chat langsung dengan petugas</p>
                </div>
            </div>
        </section>

        <!-- Form Kontak & Peta -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Form Kontak -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 border border-slate-100">
                    <h2 class="text-2xl font-black text-dark mb-2">KIRIM PESAN</h2>
                    <p class="text-slate-500 text-sm mb-8">
                        Isi formulir di bawah ini untuk mengirimkan pertanyaan atau masukan kepada kami.
                    </p>

                    @if(session('success'))
                        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mb-8 shadow-sm flex items-start">
                            <i class="fa-solid fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <div>
                                <h3 class="font-bold text-green-800">Berhasil!</h3>
                                <p class="text-green-700 text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-8 shadow-sm">
                            <ul class="list-disc pl-5 text-red-700 text-sm space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" id="contactForm" class="space-y-6">
                        @csrf
                        <!-- Nama -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">
                                    <i class="fa-regular fa-user text-primary mr-1"></i> Nama Depan
                                </label>
                                <input
                                    type="text"
                                    name="first_name"
                                    value="{{ old('first_name') }}"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft"
                                    placeholder="Nama depan"
                                    required
                                />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">
                                    Nama Belakang (Opsional)
                                </label>
                                <input
                                    type="text"
                                    name="last_name"
                                    value="{{ old('last_name') }}"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft"
                                    placeholder="Nama belakang"
                                />
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">
                                <i class="fa-regular fa-envelope text-primary mr-1"></i> Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft"
                                placeholder="nama@email.com"
                                required
                            />
                        </div>

                        <!-- Subjek -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">
                                <i class="fa-regular fa-message text-primary mr-1"></i> Subjek
                            </label>
                            <input
                                type="text"
                                name="subject"
                                value="{{ old('subject') }}"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft"
                                placeholder="Subjek pesan"
                                required
                            />
                        </div>

                        <!-- Pesan -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">
                                <i class="fa-regular fa-pen-to-square text-primary mr-1"></i> Pesan
                            </label>
                            <textarea
                                name="message"
                                rows="5"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft resize-none"
                                placeholder="Tulis pesan Anda di sini..."
                                required
                            >{{ old('message') }}</textarea>
                        </div>

                        <!-- Captcha Sederhana -->
                        <div class="bg-slate-50 p-4 rounded-xl">
                            <p class="text-sm text-slate-600 mb-2">
                                <i class="fa-solid fa-shield-halved text-primary mr-1"></i> Verifikasi Keamanan
                            </p>
                            <div class="flex items-center gap-3">
                                <span class="bg-primary text-white px-4 py-2 rounded-lg font-mono font-bold">5 + 3 =</span>
                                <input
                                    type="number"
                                    id="captcha_answer"
                                    class="w-24 px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50"
                                    placeholder="?"
                                    required
                                />
                            </div>
                        </div>
                        
                        <!-- Checkbox Persetujuan (wajib untuk controller validation 'agree' => 'accepted') -->
                        <div class="flex items-start mb-6">
                            <div class="flex items-center h-5">
                                <input id="agree" name="agree" type="checkbox" value="1" class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300" required>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="agree" class="font-medium text-gray-900">Saya menyetujui <a href="#" class="text-blue-600 hover:underline">Syarat dan Ketentuan</a></label>
                            </div>
                        </div>

                        <!-- Tombol Kirim -->
                        <button
                            type="submit"
                            class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-4 px-6 rounded-xl transition-soft transform hover:-translate-y-1 hover:shadow-xl flex items-center justify-center gap-2"
                        >
                            <i class="fa-regular fa-paper-plane"></i>
                            KIRIM PESAN
                        </button>
                    </form>
                </div>

                <!-- Peta & Informasi Tambahan -->
                <div class="space-y-8">
                    <!-- Peta Interaktif -->
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
                        <div class="p-6 border-b border-slate-100">
                            <h3 class="font-bold text-lg text-dark flex items-center gap-2">
                                <i class="fa-solid fa-map-location-dot text-primary"></i>
                                LOKASI KAMI
                            </h3>
                        </div>
                        <iframe src="https://maps.google.com/maps?q=-3.8549123,122.0427052&t=&z=17&ie=UTF8&iwloc=&output=embed" class="w-full h-[400px] border-0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <div class="p-4 bg-slate-50 text-sm text-slate-600">
                            <i class="fa-solid fa-location-dot text-primary mr-2"></i>
                            Kompleks Perkantoran Pemerintah Kabupaten Konawe, Sulawesi Tenggara
                        </div>
                    </div>

                    <!-- Jam Layanan -->
                    <div class="bg-white rounded-3xl shadow-2xl p-8 border border-slate-100">
                        <h3 class="font-bold text-lg text-dark mb-4 flex items-center gap-2">
                            <i class="fa-regular fa-clock text-primary"></i>
                            JAM LAYANAN
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                                <span class="text-slate-600">Senin - Kamis</span>
                                <span class="font-semibold text-dark">08.00 - 16.00 WITA</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                                <span class="text-slate-600">Jumat</span>
                                <span class="font-semibold text-dark">08.00 - 16.30 WITA</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                                <span class="text-slate-600">Istirahat</span>
                                <span class="font-semibold text-dark">12.00 - 13.00 WITA</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-600">Sabtu & Minggu</span>
                                <span class="font-semibold text-red-600">Libur</span>
                            </div>
                        </div>

                        <!-- Status Layanan -->
                        <div class="mt-6 p-4 bg-green-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                    <span
                        class="absolute inline-flex h-3 w-3 rounded-full bg-green-500 opacity-75 animate-ping"
                    ></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-600"></span>
                                </div>
                                <div>
                                    <p class="font-semibold text-green-700">Layanan Sedang Buka</p>
                                    <p class="text-xs text-green-600">Senin, 08.00 - 16.00 WITA</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sosial Media -->
                    <div class="bg-white rounded-3xl shadow-2xl p-8 border border-slate-100">
                        <h3 class="font-bold text-lg text-dark mb-4">IKUTI KAMI</h3>
                        <div class="flex flex-wrap gap-3">
                            <a
                                href="#"
                                class="flex-1 min-w-[100px] bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-xl transition-soft flex items-center justify-center gap-2"
                            >
                                <i class="fa-brands fa-facebook-f"></i>
                                <span class="text-sm">Facebook</span>
                            </a>
                            <a
                                href="#"
                                class="flex-1 min-w-[100px] bg-pink-600 hover:bg-pink-700 text-white py-3 px-4 rounded-xl transition-soft flex items-center justify-center gap-2"
                            >
                                <i class="fa-brands fa-instagram"></i>
                                <span class="text-sm">Instagram</span>
                            </a>
                            <a
                                href="#"
                                class="flex-1 min-w-[100px] bg-blue-400 hover:bg-blue-500 text-white py-3 px-4 rounded-xl transition-soft flex items-center justify-center gap-2"
                            >
                                <i class="fa-brands fa-twitter"></i>
                                <span class="text-sm">Twitter</span>
                            </a>
                            <a
                                href="#"
                                class="flex-1 min-w-[100px] bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-xl transition-soft flex items-center justify-center gap-2"
                            >
                                <i class="fa-brands fa-youtube"></i>
                                <span class="text-sm">YouTube</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="bg-primary-subtle py-20">
            <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-black text-dark mb-4">
                        PERTANYAAN <span class="text-primary">UMUM</span>
                    </h2>
                    <p class="text-slate-600 max-w-2xl mx-auto">
                        Beberapa pertanyaan yang sering diajukan kepada kami.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                    <!-- FAQ 1 -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg card-hover">
                        <h3 class="font-bold text-dark mb-2 flex items-center gap-2">
                            <i class="fa-regular fa-circle-question text-primary"></i>
                            Bagaimana cara mengajukan permohonan informasi?
                        </h3>
                        <p class="text-slate-600 text-sm">
                            Anda dapat mengajukan permohonan informasi melalui menu "Permohonan Informasi" di
                            website ini atau datang langsung ke kantor PPID.
                        </p>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg card-hover">
                        <h3 class="font-bold text-dark mb-2 flex items-center gap-2">
                            <i class="fa-regular fa-circle-question text-primary"></i>
                            Berapa lama waktu penyelesaian permohonan?
                        </h3>
                        <p class="text-slate-600 text-sm">
                            Sesuai UU No. 14 Tahun 2008, permohonan informasi akan diproses maksimal 10 hari
                            kerja dan dapat diperpanjang 7 hari kerja.
                        </p>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg card-hover">
                        <h3 class="font-bold text-dark mb-2 flex items-center gap-2">
                            <i class="fa-regular fa-circle-question text-primary"></i>
                            Apakah ada biaya untuk mendapatkan informasi?
                        </h3>
                        <p class="text-slate-600 text-sm">
                            Tidak ada biaya untuk mengakses informasi publik. Namun, jika memerlukan
                            penggandaan, akan dikenakan biaya sesuai ketentuan.
                        </p>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg card-hover">
                        <h3 class="font-bold text-dark mb-2 flex items-center gap-2">
                            <i class="fa-regular fa-circle-question text-primary"></i>
                            Bagaimana jika permohonan saya ditolak?
                        </h3>
                        <p class="text-slate-600 text-sm">
                            Anda dapat mengajukan keberatan kepada atasan PPID atau mengajukan sengketa
                            informasi ke Komisi Informasi.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        // Handle form submission
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function (e) {
                // Validasi captcha sederhana
                const captchaInput = document.getElementById('captcha_answer');
                if (captchaInput && captchaInput.value != 8) {
                    e.preventDefault();
                    alert('Jawaban captcha salah. Silakan coba lagi.');
                    return;
                }
                // Allow normal submission to backend
            });
        }
    </script>
@endpush
