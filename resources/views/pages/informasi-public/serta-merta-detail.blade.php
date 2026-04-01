@extends('layouts.app')

@section('title', $informasi->title . ' - Informasi Publik Serta Merta')

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
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                    },
                },
            },
        };
    </script>
@endpush

@push('styles')
    <style>
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(31, 58, 138, 0.15); }
        .info-label { @apply text-sm font-semibold text-slate-500; }
        .info-value { @apply text-base font-medium text-dark; }
        .breadcrumb-item:not(:last-child)::after { content: '/'; margin: 0 0.5rem; color: #94a3b8; }

        /* Styling khusus iframe pdf agar rapi */
        .pdf-preview-container {
            width: 100%;
            height: 600px;
            border-radius: 0.75rem;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
    </style>
@endpush

@section('content')
    <main class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-6">
            <div class="flex items-center text-sm text-slate-500 flex-wrap">
                <a href="/" class="hover:text-primary transition-soft">
                    <i class="fa-solid fa-home mr-1"></i> Beranda
                </a>
                <span class="mx-2 text-slate-400">/</span>
                <a href="{{ route('ppid.serta-merta') ?? '#' }}" class="hover:text-primary transition-soft">
                    Informasi Serta Merta
                </a>
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-primary font-medium truncate max-w-[200px] md:max-w-full">
                    {{ $informasi->title }}
                </span>
            </div>
        </div>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-triangle-exclamation text-3xl text-red-600"></i>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-medium">
                                {{ $informasi->category->name ?? 'Umum' }}
                            </span>
                            @if($informasi->year)
                                <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-full text-xs font-medium">
                                    Tahun {{ $informasi->year }}
                                </span>
                            @endif
                        </div>
                        <h1 class="text-2xl md:text-4xl font-black text-dark">
                            {{ $informasi->title }}
                        </h1>
                    </div>
                </div>

                <div class="flex gap-3 self-end lg:self-center shrink-0">
                    @if($informasi->file_url)
                        <a href="{{ $informasi->file_url }}" target="_blank" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-semibold transition-soft flex items-center gap-2 shadow-lg shadow-blue-200/50">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Tautan Eksternal
                        </a>
                    @elseif($informasi->file_path)
                        <a href="{{ asset('storage/' . $informasi->file_path) }}" target="_blank" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-semibold transition-soft flex items-center gap-2 shadow-lg shadow-blue-200/50">
                            <i class="fa-solid fa-download"></i> Unduh Dokumen
                        </a>
                    @endif

                    <button onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan disalin!')" class="bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-6 py-3 rounded-xl font-semibold transition-soft flex items-center gap-2">
                        <i class="fa-regular fa-share-from-square"></i> Bagikan
                    </button>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6">
                        <h2 class="text-lg font-bold text-dark mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-circle-info text-primary"></i> Informasi Dokumen
                        </h2>
                        <div class="space-y-4">
                            <div class="border-b border-slate-100 pb-3">
                                <p class="info-label">Kategori</p>
                                <p class="info-value">{{ $informasi->category->name ?? '-' }}</p>
                            </div>
                            <div class="border-b border-slate-100 pb-3">
                                <p class="info-label">Tahun / Periode</p>
                                <p class="info-value">{{ $informasi->year ?? '-' }}</p>
                            </div>
                            <div class="border-b border-slate-100 pb-3">
                                <p class="info-label">Tanggal Publikasi</p>
                                <p class="info-value">
                                    {{ \Carbon\Carbon::parse($informasi->published_at ?? $informasi->created_at)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                            <div class="border-b border-slate-100 pb-3">
                                <p class="info-label">Unit Penanggung Jawab</p>
                                <p class="info-value">{{ $informasi->opd->nama_opd ?? 'PPID Utama Kabupaten Konawe' }}</p>
                            </div>
                            <div>
                                <p class="info-label">Tingkat Laporan</p>
                                <p class="info-value capitalize">{{ $informasi->report_level ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-primary-subtle rounded-2xl p-6">
                        <h3 class="font-bold text-dark mb-3">Butuh bantuan?</h3>
                        <p class="text-sm text-slate-600 mb-4">
                            Tidak menemukan informasi yang Anda cari? Hubungi petugas PPID.
                        </p>
                        <a href="{{ url('/kontak') }}" class="block w-full bg-primary hover:bg-primary-dark text-white text-center py-2.5 rounded-xl font-semibold transition-soft text-sm">
                            <i class="fa-regular fa-message mr-2"></i> Hubungi Petugas
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-8">

                    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 md:p-8">
                        <h2 class="text-xl font-bold text-dark mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-align-left text-primary"></i> Ringkasan Informasi
                        </h2>
                        <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                            {!! $informasi->description ?? '<p>Tidak ada ringkasan yang tersedia untuk informasi ini.</p>' !!}
                        </div>
                    </div>

                    @if($informasi->file_path || $informasi->file_url)
                        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 md:p-8">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-bold text-dark flex items-center gap-2">
                                    <i class="fa-regular fa-eye text-primary"></i>
                                    {{ $informasi->file_url ? 'Akses Dokumen' : 'Pratinjau Dokumen' }}
                                </h2>
                                @if($informasi->file_size)
                                    <span class="text-xs font-semibold bg-slate-100 text-slate-500 px-3 py-1 rounded-full">
                                        Ukuran: {{ number_format($informasi->file_size / 1024, 2) }} KB
                                    </span>
                                @endif
                            </div>

                            <div class="bg-slate-50 rounded-xl p-2 border border-slate-200">
                                @if($informasi->file_url)
                                    <div class="py-16 text-center">
                                        <i class="fa-brands fa-google-drive text-6xl text-primary/40 mb-4"></i>
                                        <h3 class="text-lg font-bold text-dark mb-2">Penyimpanan Eksternal</h3>
                                        <p class="text-sm text-slate-500 mb-6 max-w-md mx-auto">
                                            Dokumen ini disimpan menggunakan layanan pihak ketiga (Cloud Storage). Pratinjau langsung tidak tersedia. Silakan klik tombol di bawah untuk membukanya.
                                        </p>
                                        <a href="{{ $informasi->file_url }}" target="_blank" class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3 rounded-xl hover:bg-primary-dark transition-soft font-semibold shadow-lg">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Dokumen Eksternal
                                        </a>
                                    </div>
                                @elseif($informasi->file_path)
                                    @php
                                        $extension = pathinfo($informasi->file_path, PATHINFO_EXTENSION);
                                        $fileUrl = asset('storage/' . $informasi->file_path);
                                    @endphp

                                    @if(strtolower($extension) == 'pdf')
                                        <div class="pdf-preview-container bg-slate-200 flex items-center justify-center">
                                            <iframe src="{{ $fileUrl }}#toolbar=0" class="w-full h-full" frameborder="0" title="PDF Preview"></iframe>
                                        </div>
                                    @elseif(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                                        <div class="flex justify-center p-4">
                                            <img src="{{ $fileUrl }}" alt="Preview Dokumen" class="max-w-full rounded-lg shadow-sm border border-slate-200">
                                        </div>
                                    @else
                                        <div class="py-16 text-center">
                                            <i class="fa-solid fa-file-arrow-down text-6xl text-primary/30 mb-4"></i>
                                            <h3 class="text-lg font-bold text-dark mb-2">Pratinjau Tidak Tersedia</h3>
                                            <p class="text-sm text-slate-500 mb-6 max-w-sm mx-auto">
                                                Format file (<b>.{{ strtoupper($extension) }}</b>) tidak dapat ditampilkan langsung di browser. Silakan unduh file untuk melihat isinya.
                                            </p>
                                            <a href="{{ $fileUrl }}" target="_blank" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl hover:bg-primary-dark transition-soft font-semibold">
                                                <i class="fa-solid fa-download"></i> Unduh File Sekarang
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 md:p-8">
                        <h2 class="text-xl font-bold text-dark mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-clock-rotate-left text-primary"></i> Riwayat Sistem
                        </h2>
                        <ul class="space-y-4">
                            <li class="flex gap-4">
                                <div class="w-12 flex flex-col items-center shrink-0">
                                    <span class="text-xs font-bold text-primary">{{ \Carbon\Carbon::parse($informasi->updated_at)->format('d M') }}</span>
                                    <span class="text-[10px] text-slate-400">{{ \Carbon\Carbon::parse($informasi->updated_at)->format('Y') }}</span>
                                </div>
                                <div class="flex-1 border-l-2 border-primary/20 pl-4 pb-2">
                                    <p class="text-sm font-semibold text-dark">Pembaruan Terakhir</p>
                                    <p class="text-xs text-slate-500">Data informasi publik ini terakhir kali diperbarui di dalam sistem.</p>
                                </div>
                            </li>
                            <li class="flex gap-4">
                                <div class="w-12 flex flex-col items-center shrink-0">
                                    <span class="text-xs font-bold text-slate-500">{{ \Carbon\Carbon::parse($informasi->created_at)->format('d M') }}</span>
                                    <span class="text-[10px] text-slate-400">{{ \Carbon\Carbon::parse($informasi->created_at)->format('Y') }}</span>
                                </div>
                                <div class="flex-1 border-l-2 border-slate-200 pl-4 pb-2">
                                    <p class="text-sm font-semibold text-dark">Dokumen Didaftarkan</p>
                                    <p class="text-xs text-slate-500">Informasi awal ditambahkan ke dalam database portal PPID.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        @if($terkait && $terkait->count() > 0)
            <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 my-16">
                <h2 class="text-2xl font-bold text-dark mb-8 flex items-center gap-3">
                    <span class="w-1.5 h-8 bg-red-600 rounded-full"></span>
                    Informasi Serta Merta Terkait
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($terkait as $item)
                        <a href="{{ route('serta-merta.detail', $item->id) }}" class="bg-white rounded-2xl p-6 border border-slate-100 shadow-lg hover:shadow-2xl transition-soft group">
                            <div class="flex items-start gap-3 mb-3">
                                <i class="fa-solid fa-triangle-exclamation text-red-600 text-xl group-hover:scale-110 transition-transform"></i>
                            </div>
                            <h3 class="font-bold text-dark mb-1 line-clamp-2">{{ $item->title }}</h3>
                            <p class="text-sm text-slate-500 mb-3">{{ $item->opd->singkatan ?? 'PPID' }} · {{ \Carbon\Carbon::parse($item->published_at ?? $item->created_at)->translatedFormat('d M Y') }}</p>
                            <span class="text-red-600 text-sm font-semibold inline-flex items-center gap-1">
                                Lihat <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                            </span>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </main>
@endsection
