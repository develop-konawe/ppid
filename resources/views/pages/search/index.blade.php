@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@push('scripts-head')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#1F3A8A', dark: '#172554', light: '#3B82F6', subtle: '#EFF6FF', },
                        secondary: '#DC2626', accent: '#059669', info: '#0284C7', exclusive: '#6B21A8',
                        announcement: '#B45309', light: '#F8FAFC', dark: '#0F172A',
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
        mark { background-color: #fef08a; color: #0f172a; padding: 0.125rem 0.25rem; border-radius: 0.25rem; font-weight: 700; }
    </style>
@endpush

@section('content')
    <main class="bg-slate-50 min-h-screen pb-20">

        <section class="bg-primary pt-12 pb-24 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-blue-400/20 rounded-full blur-2xl"></div>

            <div class="max-w-5xl mx-auto px-4 relative z-10 text-center text-white mt-4">
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6 shadow-sm border border-white/20">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    <span class="text-sm font-medium">PUSAT PENCARIAN PPID</span>
                </div>
                <h1 class="text-3xl md:text-5xl font-black mb-4 tracking-tight">Hasil Pencarian</h1>
                <p class="text-blue-100 text-lg">Temukan informasi, dokumen publik, berita, dan pengumuman dengan cepat.</p>
            </div>
        </section>

        <section class="max-w-5xl mx-auto px-4 relative z-20 -mt-10 mb-12">
            <form action="{{ url('/search') }}" method="GET" class="bg-white p-3 rounded-2xl shadow-xl flex flex-col md:flex-row gap-3 border border-slate-200">
                <div class="flex-grow flex items-center px-4 bg-slate-50 rounded-xl border border-slate-100 focus-within:ring-2 focus-within:ring-primary/50 transition-all">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 mr-3"></i>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Ketik kata kunci pencarian..." class="w-full py-3.5 outline-none text-slate-700 bg-transparent font-medium" required />
                </div>

                <select name="kategori" class="md:w-56 px-4 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary/50 cursor-pointer font-medium transition-all">
                    <option value="">Semua Kategori</option>
                    <option value="berita" {{ request('kategori') == 'berita' ? 'selected' : '' }}>Berita</option>
                    <option value="pengumuman" {{ request('kategori') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="dokumen" {{ request('kategori') == 'dokumen' ? 'selected' : '' }}>Dokumen Publik</option>
                    <option value="berkala" {{ request('kategori') == 'berkala' ? 'selected' : '' }}>Informasi Berkala</option>
                    <option value="serta-merta" {{ request('kategori') == 'serta-merta' ? 'selected' : '' }}>Informasi Serta Merta</option>
                    <option value="setiap-saat" {{ request('kategori') == 'berita' ? 'selected' : '' }}>Informasi Setiap Saat</option>
                </select>

                <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-8 py-3.5 rounded-xl font-bold transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center gap-2 shrink-0">
                    CARI <i class="fa-solid fa-arrow-right text-sm"></i>
                </button>
            </form>
        </section>

        <section class="max-w-5xl mx-auto px-4">

            <div class="mb-8 flex flex-col md:flex-row items-start md:items-center justify-between border-b border-slate-200 pb-4 gap-4">
                <h2 class="text-xl font-bold text-dark flex items-center gap-2">
                    <i class="fa-solid fa-list-check text-primary"></i>
                    Hasil untuk: <span class="text-primary bg-primary/10 px-3 py-1 rounded-lg">"{{ $keyword ?? 'Semua Data' }}"</span>
                </h2>
                <div class="bg-white border border-slate-200 shadow-sm text-slate-600 px-4 py-2 rounded-full text-sm font-bold flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    Ditemukan {{ $semuaHasil->count() }} Data
                </div>
            </div>

            <div class="flex flex-col gap-4">
                @forelse($results as $item)
                    <a href="{{ $item->url }}" target="{{ $item->target ?? '_self' }}" class="bg-white p-5 md:p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-lg hover:border-primary transition-all duration-300 flex flex-col md:flex-row gap-5 group hover:-translate-y-1">

                        <div class="hidden md:flex w-16 h-16 shrink-0 rounded-2xl {{ $item->badge_color }} items-center justify-center text-3xl group-hover:scale-110 transition-transform shadow-sm">
                            <i class="fa-solid {{ $item->icon }}"></i>
                        </div>

                        <div class="flex-grow">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="{{ $item->badge_color }} px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider border shadow-sm">
                                    {{ $item->tipe }}
                                </span>
                                <span class="text-xs text-slate-500 font-semibold bg-slate-100 px-2 py-1 rounded-md">
                                    <i class="fa-regular fa-calendar mr-1 text-slate-400"></i> {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : '-' }}
                                </span>
                            </div>

                            <h3 class="text-xl md:text-2xl font-bold text-dark mb-3 group-hover:text-primary transition-colors leading-snug">
                                {!! str_ireplace($keyword, "<mark>$keyword</mark>", $item->judul) !!}
                            </h3>

                            <p class="text-sm text-slate-600 line-clamp-2 leading-relaxed">
                                {{ Str::limit(html_entity_decode(strip_tags($item->deskripsi)), 250) }}
                            </p>

                            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center text-primary text-xs font-bold uppercase tracking-wider group-hover:gap-2 transition-all">
                                Kunjungi Halaman <i class="fa-solid fa-arrow-right ml-1"></i>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-20 bg-white rounded-3xl border border-slate-200 shadow-sm">
                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-slate-100">
                            <i class="fa-solid fa-file-circle-xmark text-5xl text-slate-300"></i>
                        </div>
                        <h3 class="text-2xl font-black text-dark mb-3">Tidak Ada Hasil</h3>
                        <p class="text-slate-500 max-w-md mx-auto leading-relaxed">
                            Maaf, kami tidak menemukan dokumen atau informasi yang sesuai dengan kata kunci "<span class="font-bold text-dark">{{ $keyword }}</span>".
                        </p>
                        <a href="{{ route('home') }}" class="inline-block mt-6 px-6 py-3 bg-primary/10 text-primary font-bold rounded-xl hover:bg-primary hover:text-white transition-soft">
                            <i class="fa-solid fa-home mr-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                @endforelse
            </div>

            @if ($results->hasPages())
                <div class="flex justify-center mt-12 mb-8">
                    {{ $results->appends(request()->query())->links('layouts.pagination.tailwind') ?? $results->links() }}
                </div>
            @endif

        </section>
    </main>
@endsection
