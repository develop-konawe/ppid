@extends('layouts.app')

@section('title', 'Regulasi & Kebijakan')

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

        /* Table Styles */
        .table-container { box-shadow: 0 10px 30px -10px rgba(31, 58, 138, 0.1); }
        .table-row-hover:hover { background-color: #f8fafc; }

        /* Custom Scrollbar for Table */
        .table-wrapper::-webkit-scrollbar { height: 8px; }
        .table-wrapper::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
        .table-wrapper::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .table-wrapper::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .btn-download {
            display: inline-flex; align-items: center; gap: 0.5rem; background: #1f3a8a; color: white;
            padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 600; transition: all 0.3s ease;
        }
        .btn-download:hover { background: #172554; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(31, 58, 138, 0.2); }
    </style>
@endpush

@section('content')
    <main class="overflow-hidden bg-slate-50 min-h-screen">

        <section class="bg-gradient-to-r from-primary/10 to-primary-subtle py-12 md:py-16 border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 md:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <nav class="text-sm flex items-center gap-2 text-slate-500 mb-4 flex-wrap">
                            <a href="{{ route('home') }}" class="hover:text-primary transition-soft"><i class="fa-solid fa-home"></i> Beranda</a> /
                            <span class="text-primary font-semibold">Regulasi</span>
                        </nav>

                        <h1 class="text-3xl md:text-4xl font-black text-dark uppercase tracking-tight animate-slide-up">
                            Regulasi & <span class="text-primary">Kebijakan</span>
                        </h1>
                        <p class="text-slate-600 mt-2 max-w-2xl animate-fade-in">
                            Daftar peraturan, keputusan, dan kebijakan perundang-undangan yang berkaitan dengan Keterbukaan Informasi Publik di lingkungan Kabupaten Konawe.
                        </p>
                    </div>

                    <div class="hidden md:flex items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-sm text-primary text-2xl border border-slate-100">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 md:py-16">
            <div class="max-w-7xl mx-auto px-4 md:px-8">

                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <h2 class="text-xl font-bold text-dark flex items-center gap-2">
                        <i class="fa-solid fa-list-check text-primary"></i> Daftar Dokumen Regulasi
                    </h2>
                    <div class="text-sm text-slate-500 bg-white px-4 py-2 rounded-lg border border-slate-200 shadow-sm">
                        Total: <span class="font-bold text-primary">{{ $listRegulasi->total() }}</span> Dokumen
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden table-container">
                    <div class="overflow-x-auto table-wrapper">
                        <table class="w-full text-left border-collapse whitespace-nowrap md:whitespace-normal">
                            <thead>
                            <tr class="bg-primary text-white text-sm uppercase tracking-wider">
                                <th class="py-4 px-6 font-semibold w-16 text-center">No</th>
                                <th class="py-4 px-6 font-semibold min-w-[250px]">Judul Regulasi</th>
                                <th class="py-4 px-6 font-semibold min-w-[200px]">Keterangan Singkat</th>
                                <th class="py-4 px-6 font-semibold w-40">Tanggal Terbit</th>
                                <th class="py-4 px-6 font-semibold w-32 text-center">Unduhan</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-600 text-sm">
                            @forelse($listRegulasi as $regulasi)
                                <tr class="table-row-hover transition-soft">
                                    <td class="py-4 px-6 text-center font-medium text-slate-400">
                                        {{ ($listRegulasi->currentPage() - 1) * $listRegulasi->perPage() + $loop->iteration }}
                                    </td>

                                    <td class="py-4 px-6 font-semibold text-dark leading-snug">
                                        {{ $regulasi->title }}
                                        @if($regulasi->issue_date && $regulasi->issue_date->diffInDays(now()) <= 30)
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-700 uppercase">Baru</span>
                                        @endif
                                    </td>

                                    <td class="py-4 px-6 text-slate-500 text-xs md:text-sm leading-relaxed">
                                        {{ $regulasi->summary ?? '-' }}
                                    </td>

                                    <td class="py-4 px-6">
                                        <div class="flex items-center text-slate-500 whitespace-nowrap">
                                            <i class="fa-regular fa-calendar-check text-primary/70 mr-2"></i>
                                            {{ $regulasi->issue_date ? $regulasi->issue_date->translatedFormat('d F Y') : '-' }}
                                        </div>
                                    </td>

                                    <td class="py-4 px-6 text-center">
                                        @if($regulasi->doc_url)
                                            @php
                                                // Cek apakah url eksternal (http) atau file lokal di storage
                                                $fileUrl = Str::startsWith($regulasi->doc_url, ['http://', 'https://'])
                                                            ? $regulasi->doc_url
                                                            : asset('storage/' . $regulasi->doc_url);
                                            @endphp
                                            <a href="{{ $fileUrl }}" target="_blank" class="btn-download" title="Unduh File">
                                                <i class="fa-regular fa-file-pdf"></i> Unduh
                                            </a>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                                                    <i class="fa-solid fa-ban mr-1"></i> Tidak Ada
                                                </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <i class="fa-regular fa-folder-open text-5xl text-slate-300 mb-4"></i>
                                            <p class="text-slate-500 font-medium">Belum ada data regulasi yang diterbitkan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($listRegulasi->hasPages())
                    <div class="mt-10 flex justify-center">
                        {{ $listRegulasi->links('layouts.pagination.regulation') }}
                    </div>
                @endif

            </div>
        </section>
    </main>
@endsection
