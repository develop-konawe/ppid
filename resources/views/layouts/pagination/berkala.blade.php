@if ($paginator->hasPages())
    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm text-slate-600">
                Menampilkan
                <span class="font-semibold">{{ $paginator->firstItem() }}</span> -
                <span class="font-semibold">{{ $paginator->lastItem() }}</span>
                dari <span class="font-semibold">{{ $paginator->total() }}</span> dokumen
            </p>

            <div class="flex items-center gap-2">
                {{-- Tombol Previous (Kiri) --}}
                @if ($paginator->onFirstPage())
                    <button class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 cursor-not-allowed" disabled>
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition-soft">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Elemen Nomor Halaman --}}
                @foreach ($elements as $element)
                    {{-- Pemisah Tiga Titik (...) --}}
                    @if (is_string($element))
                        <span class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 cursor-default">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Link Nomor Halaman --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <button class="w-10 h-10 bg-primary text-white rounded-lg font-semibold flex items-center justify-center cursor-default" aria-current="page">
                                    {{ $page }}
                                </button>
                            @else
                                <a href="{{ $url }}" class="w-10 h-10 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition-soft flex items-center justify-center">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Tombol Next (Kanan) --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition-soft">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                @else
                    <button class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 cursor-not-allowed" disabled>
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                @endif
            </div>
        </div>
    </div>
@endif
