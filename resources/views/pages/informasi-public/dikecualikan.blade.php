@extends('layouts.app')

@section('title', 'Informasi Publik Dikecualikan')

@push('scripts-head')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#1F3A8A', dark: '#172554', light: '#3B82F6', subtle: '#EFF6FF',
                        },
                        secondary: '#DC2626', accent: '#059669', info: '#0284C7',
                        exclusive: '#6B21A8', // Ungu untuk informasi dikecualikan
                        light: '#F8FAFC', dark: '#0F172A',
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
        .table-row-hover:hover { background-color: #f5f0ff; }
        .table-header { background: linear-gradient(135deg, #6b21a8 0%, #581c87 100%); }
        .exclusive-card { border-left: 4px solid #6b21a8; }
        .legal-card { background: linear-gradient(135deg, #f9f5ff 0%, #ffffff 100%); }
    </style>
@endpush

@section('content')
    <div class="bg-exclusive text-white py-2">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
            <div class="flex items-center justify-between text-sm flex-wrap gap-2">
                <span><i class="fa-solid fa-shield-halved mr-2"></i> Informasi Dikecualikan - Tidak Dapat Diakses Publik</span>
                <span><i class="fa-regular fa-file-lines mr-2"></i> Berdasarkan UU No. 14 Tahun 2008</span>
            </div>
        </div>
    </div>

    <main class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-6">
            <div class="flex items-center text-sm text-slate-500">
                <a href="/" class="hover:text-primary transition-soft"><i class="fa-solid fa-home mr-1"></i> Beranda</a>
                <span class="mx-2 text-slate-400">/</span>
                <span class="text-exclusive font-medium">Informasi Dikecualikan</span>
            </div>
        </div>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-exclusive/10 rounded-2xl flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-shield-halved text-2xl text-exclusive"></i>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-dark">
                        INFORMASI <span class="text-exclusive">DIKECUALIKAN</span>
                    </h1>
                    <p class="text-slate-600 mt-1">
                        Informasi yang tidak dapat diakses publik berdasarkan ketentuan perundang-undangan
                    </p>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 exclusive-card">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="md:w-2/3">
                        <h2 class="text-lg font-bold text-dark mb-3">Apa itu Informasi Dikecualikan?</h2>
                        <p class="text-slate-600 text-sm leading-relaxed mb-3">
                            Informasi Dikecualikan adalah informasi yang tidak dapat diberikan kepada pemohon informasi publik karena bersifat ketat, terbatas, dan dilindungi kerahasiaannya berdasarkan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik dan peraturan pelaksanaannya.
                        </p>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Informasi ini dikecualikan untuk melindungi kepentingan negara, keamanan nasional, kekayaan intelektual, privasi pribadi, serta rahasia bisnis dan jabatan tertentu.
                        </p>
                    </div>
                    <div class="md:w-1/3 bg-exclusive/5 p-4 rounded-lg">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fa-solid fa-scale-balanced text-exclusive"></i>
                            <span class="font-semibold text-dark">Dasar Hukum</span>
                        </div>
                        <ul class="text-xs text-slate-600 space-y-2">
                            <li>• UU No. 14 Tahun 2008 Pasal 17</li>
                            <li>• PP No. 61 Tahun 2010</li>
                            <li>• Perki No. 1 Tahun 2010</li>
                            <li>• Perbup Konawe No. 15/2020</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Filter Section -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-6">
            <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                <form action="{{ route('ppid.dikecualikan') ?? '#' }}" method="GET" class="flex flex-col md:flex-row gap-3">
                    <div class="flex-grow relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari dokumen..."
                            class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-exclusive focus:ring-1 focus:ring-exclusive"
                        />
                    </div>
                    
                    @php
                        $kategoriIds = \App\Models\PublicInformation::where('information_type', 'dikecualikan')
                            ->where('status', 'published')
                            ->whereNotNull('category_id')
                            ->distinct()
                            ->pluck('category_id');
                    
                        $kategoriList = \App\Models\InformationCategory::whereIn('id', $kategoriIds)
                            ->orderBy('name')
                            ->get();
                            
                        $tahunList = \App\Models\PublicInformation::where('information_type', 'dikecualikan')
                            ->where('status', 'published')
                            ->whereNotNull('year')
                            ->distinct()
                            ->orderBy('year', 'desc')
                            ->pluck('year');
                            
                        $opdList = \App\Models\Opd::orderBy('nama_opd')->get();
                    @endphp
                    
                    <div class="md:w-32 w-full shrink-0">
                        <select name="year" class="select2 w-full px-3 py-2 border border-slate-200 rounded-lg text-sm text-slate-600 focus:outline-none focus:border-exclusive focus:ring-1 focus:ring-exclusive">
                            <option value="">Semua Tahun</option>
                            @foreach($tahunList as $tahun)
                                <option value="{{ $tahun }}" {{ request('year') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:w-40 w-full shrink-0">
                        <select name="category" class="select2 w-full px-3 py-2 border border-slate-200 rounded-lg text-sm text-slate-600 focus:outline-none focus:border-exclusive focus:ring-1 focus:ring-exclusive">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoriList as $kategori)
                                <option value="{{ $kategori->id }}" {{ request('category') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:w-48 w-full shrink-0">
                        <select name="opd" class="select2 w-full px-3 py-2 border border-slate-200 rounded-lg text-sm text-slate-600 focus:outline-none focus:border-exclusive focus:ring-1 focus:ring-exclusive">
                            <option value="">Semua OPD</option>
                            @foreach($opdList as $opd)
                                <option value="{{ $opd->id }}" {{ request('opd') == $opd->id ? 'selected' : '' }}>
                                    {{ $opd->nama_opd }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="bg-exclusive hover:bg-purple-900 text-white px-6 py-2 rounded-lg text-sm font-semibold transition-soft flex items-center justify-center">
                        <i class="fa-solid fa-filter mr-2"></i> FILTER
                    </button>
                    
                    @if(request()->anyFilled(['search', 'year', 'category', 'opd']))
                        <a href="{{ route('ppid.dikecualikan') ?? '#' }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-semibold transition-soft flex items-center justify-center">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </form>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden">
                <div class="table-header px-6 py-4">
                    <h2 class="text-white font-semibold">DAFTAR INFORMASI YANG DIKECUALIKAN</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase w-16">No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Uraian Informasi</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">OPD</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Dasar Pengecualian</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Jangka Waktu</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Keterangan</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-slate-600 uppercase">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                        @forelse($informations as $index => $item)
                            <tr class="table-row-hover transition-soft">
                                <td class="px-4 py-3 text-sm text-slate-600">{{ $informations->firstItem() + $index }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 bg-exclusive/10 text-exclusive rounded-full text-xs font-medium">
                                        {{ $item->category->name ?? 'Lainnya' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 min-w-[250px]">
                                    <span class="font-medium text-dark line-clamp-2">{{ $item->title }}</span>
                                    <div class="text-xs text-slate-500 mt-1 line-clamp-1">
                                        {!! strip_tags($item->description) !!}
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">
                                    {{ $item->opd->singkatan ?? $item->opd->nama_opd ?? 'PPID' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">
                                    {{ $item->exception->legal_basis ?? 'UU KIP Pasal 17' }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    @if($item->exception && $item->exception->valid_until)
                                        <span class="text-slate-700">Sampai {{ \Carbon\Carbon::parse($item->exception->valid_until)->translatedFormat('d M Y') }}</span>
                                    @else
                                        <span class="text-exclusive font-medium">Selamanya / Belum Ditentukan</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-600">
                                    {{ $item->exception->exception_reason ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('dikecualikan.detail', $item->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-exclusive/10 text-exclusive hover:bg-exclusive hover:text-white transition-soft" title="Lihat Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-12 text-center text-slate-500">
                                    <i class="fa-solid fa-folder-open text-4xl mb-3 text-slate-300"></i>
                                    <p>Belum ada data informasi yang dikecualikan.</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $informations->links('layouts.pagination.dikecualikan') }}
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-exclusive/10 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-file-shield text-exclusive"></i>
                        </div>
                        <h3 class="font-bold text-dark">Prosedur Keberatan</h3>
                    </div>
                    <p class="text-sm text-slate-600 mb-4">
                        Jika pemohon informasi keberatan dengan alasan pengecualian, dapat mengajukan keberatan kepada:
                    </p>
                    <ol class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 bg-exclusive/10 text-exclusive rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">1</span>
                            <span class="text-slate-600">Atasan PPID dalam waktu 30 hari kerja</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 bg-exclusive/10 text-exclusive rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">2</span>
                            <span class="text-slate-600">Komisi Informasi Provinsi jika keberatan tidak direspons</span>
                        </li>
                        <!-- <li class="flex items-start gap-3">
                            <span class="w-5 h-5 bg-exclusive/10 text-exclusive rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">3</span>
                            <span class="text-slate-600">Upaya hukum melalui Pengadilan Tata Usaha Negara</span>
                        </li> -->
                    </ol>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex flex-col justify-center items-center text-center">
                        <div class="text-exclusive text-4xl font-black mb-2">{{ $totalDikecualikan ?? 0 }}</div>
                        <div class="text-sm font-semibold text-slate-500">Total Dokumen Dikecualikan</div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex flex-col justify-center items-center text-center">
                        <div class="text-exclusive text-4xl font-black mb-2">{{ $totalKategori ?? 0 }}</div>
                        <div class="text-sm font-semibold text-slate-500">Kategori Terklasifikasi</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 mb-10">
            <h2 class="text-lg font-bold text-dark mb-4">Pertanyaan Umum Seputar Pengecualian</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <h3 class="font-semibold text-dark text-sm mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-exclusive text-xs"></i>
                        Apakah semua informasi bisa dikecualikan?
                    </h3>
                    <p class="text-xs text-slate-600">
                        Tidak. Hanya informasi yang tercantum dalam UU No. 14/2008 Pasal 17 yang dapat dikecualikan dengan uji konsekuensi.
                    </p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <h3 class="font-semibold text-dark text-sm mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-exclusive text-xs"></i>
                        Bagaimana cara mengetahui informasi dikecualikan?
                    </h3>
                    <p class="text-xs text-slate-600">
                        PPID wajib memberikan alasan tertulis dan dasar hukum pengecualian kepada pemohon jika permohonan ditolak.
                    </p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <h3 class="font-semibold text-dark text-sm mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-exclusive text-xs"></i>
                        Apakah pengecualian bersifat permanen?
                    </h3>
                    <p class="text-xs text-slate-600">
                        Tidak. Setelah jangka waktu tertentu (valid until), informasi dapat dibuka kembali atau ditinjau ulang statusnya oleh PPID.
                    </p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-100">
                    <h3 class="font-semibold text-dark text-sm mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-exclusive text-xs"></i>
                        Apa yang dimaksud uji konsekuensi?
                    </h3>
                    <p class="text-xs text-slate-600">
                        Proses evaluasi cermat untuk memastikan bahwa pengecualian informasi benar-benar diperlukan dan sesuai ketentuan hukum yang berlaku.
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection
