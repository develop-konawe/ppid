@extends('layouts.app')

@section('title', 'Cek Status Permohonan Informasi')

@push('meta-head')
    <meta property="og:title" content="Cek Status Permohonan - PPID Kabupaten Konawe" />
    <meta property="og:description" content="Cek status permohonan informasi publik secara online di Kabupaten Konawe." />
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

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .transition-soft {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input:focus {
            outline: none;
            ring: 2px;
            ring-color: #3b82f6;
            border-color: #3b82f6;
        }
    </style>
@endpush

@section('content')
    <main>
        <!-- Hero Section -->
        <section class="contact-hero py-20 md:py-28 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative max-w-7xl mx-auto px-4 text-center text-white z-10">
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                    <i class="fa-solid fa-search text-sm"></i>
                    <span class="text-sm font-medium">LAYANAN ONLINE</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4">
                    CEK STATUS <span class="text-blue-200">PERMOHONAN</span>
                </h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto">
                    Pantau tahapan status permohonan informasi Anda berdasarkan NIK dan Email yang didaftarkan.
                </p>
            </div>

            <div class="absolute bottom-0 left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" fill="#F8FAFC">
                    <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,100L1360,100C1280,100,1120,100,960,100C800,100,640,100,480,100C320,100,160,100,80,100L0,100Z"></path>
                </svg>
            </div>
        </section>

        <!-- Form Section -->
        <section class="max-w-4xl mx-auto px-4 md:px-8 py-12 -mt-10 relative z-20">
            
            <div class="bg-white rounded-3xl shadow-xl p-8 md:p-10 border border-slate-100 flex flex-col items-center">
                <div class="mb-8 text-center">
                    <h2 class="text-2xl font-bold text-dark mb-3">Lacak Permohonan</h2>
                    <p class="text-slate-500">Masukkan NIK dan Alamat Email Anda di bawah ini untuk melihat detail permohonan Anda.</p>
                </div>

                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6 mb-8 shadow-sm w-full max-w-2xl">
                        <div class="flex items-center text-red-800 font-bold mb-2">
                            <i class="fa-solid fa-circle-exclamation mr-2 text-xl text-red-500"></i> Terjadi Kesalahan
                        </div>
                        <ul class="list-disc pl-8 text-red-700 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('permohonan.status.check') }}" method="POST" class="w-full max-w-2xl space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">NIK / No. Identitas <span class="text-red-500">*</span></label>
                        <input type="number" name="nik_no_identitas" value="{{ old('nik_no_identitas', request('nik_no_identitas') ?? ($validated['nik_no_identitas'] ?? '')) }}" required class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft" placeholder="Masukkan 16 digit NIK">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Email Terdaftar <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', request('email') ?? ($validated['email'] ?? '')) }}" required class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft" placeholder="email@contoh.com">
                    </div>

                    <div class="pt-4 text-center">
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-4 px-10 rounded-xl transition-soft transform hover:-translate-y-1 hover:shadow-xl inline-flex items-center justify-center gap-3 text-lg w-full">
                            <i class="fa-solid fa-search"></i>
                            Cek Status Sekarang
                        </button>
                    </div>
                </form>
            </div>

            <!-- Menampilkan Hasil Pencarian -->
            @if(isset($requests))
                <div class="mt-12">
                    <h3 class="text-xl font-bold text-dark mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left text-primary"></i> Riwayat Permohonan Anda
                    </h3>
                    
                    @if($requests->count() > 0)
                        <div class="space-y-6">
                            @foreach($requests as $req)
                                <div class="bg-white p-6 md:p-8 rounded-2xl shadow border border-slate-100 flex flex-col">
                                    <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 pb-6 border-b border-slate-100 gap-4">
                                        <div>
                                            <p class="text-sm text-slate-500 font-medium mb-1"><i class="fa-regular fa-calendar mr-1"></i> Diajukan pada: {{ $req->created_at->translatedFormat('d F Y, H:i') }}</p>
                                            <h4 class="text-lg font-bold text-dark">{{ $req->nama_lengkap }}</h4>
                                        </div>
                                        
                                        <div>
                                            @if($req->status == 'pending')
                                                <div class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg text-sm font-bold border border-yellow-200">
                                                    <i class="fa-solid fa-clock mr-2"></i> PENDING
                                                </div>
                                            @elseif($req->status == 'diproses')
                                                <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg text-sm font-bold border border-blue-200">
                                                    <i class="fa-solid fa-spinner fa-spin mr-2"></i> SEDANG DIPROSES
                                                </div>
                                            @elseif($req->status == 'approved')
                                                <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-lg text-sm font-bold border border-green-200">
                                                    <i class="fa-solid fa-check-circle mr-2"></i> DISETUJUI / SELESAI
                                                </div>
                                            @elseif($req->status == 'rejected')
                                                <div class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 rounded-lg text-sm font-bold border border-red-200">
                                                    <i class="fa-solid fa-xmark-circle mr-2"></i> DITOLAK
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                        <div>
                                            <p class="text-sm text-slate-500 font-medium mb-1">Rincian Informasi:</p>
                                            <p class="text-dark bg-slate-50 p-4 rounded-xl text-sm leading-relaxed">{{ $req->rincian_informasi }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-slate-500 font-medium mb-1">Tujuan Penggunaan:</p>
                                            <p class="text-dark bg-slate-50 p-4 rounded-xl text-sm leading-relaxed">{{ $req->tujuan_penggunaan }}</p>
                                        </div>
                                    </div>

                                    @if($req->response_message || $req->response_file)
                                        <div class="bg-blue-50 border border-blue-100 p-6 rounded-xl mt-4">
                                            <h5 class="font-bold text-primary mb-3 flex items-center gap-2">
                                                <i class="fa-solid fa-reply"></i> Tanggapan / Balasan PPID
                                            </h5>
                                            
                                            @if($req->response_message)
                                                <p class="text-slate-700 text-sm mb-4 leading-relaxed">{{ $req->response_message }}</p>
                                            @endif
                                            
                                            @if($req->response_file)
                                                <a href="{{ asset('storage/'.$req->response_file) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-primary border border-primary/20 rounded-lg text-sm font-bold hover:bg-primary-subtle transition-soft shadow-sm">
                                                    <i class="fa-solid fa-file-pdf text-red-500"></i> Download File Balasan
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-slate-50 p-10 rounded-2xl text-center border border-slate-100">
                            <i class="fa-solid fa-file-circle-xmark text-4xl text-slate-300 mb-4"></i>
                            <h4 class="text-lg font-bold text-slate-700 mb-2">Riwayat Tidak Ditemukan</h4>
                            <p class="text-slate-500 text-sm">Tidak ada permohonan informasi yang dikirim dari NIK dan Email yang Anda masukkan.</p>
                        </div>
                    @endif
                </div>
            @endif

        </section>
    </main>
@endsection
