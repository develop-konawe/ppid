@if ($paginator->hasPages())
    <div class="bg-slate-50 px-4 py-3 border-t border-slate-200">
        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <p class="text-sm text-slate-600">
                Menampilkan <span class="font-medium">{{ $paginator->firstItem() }}</span> - <span class="font-medium">{{ $paginator->lastItem() }}</span> dari <span class="font-medium">{{ $paginator->total() }}</span> informasi dikecualikan
            </p>
            <div class="flex gap-2">

                {{-- Tombol Previous (Kiri) --}}
                @if ($paginator->onFirstPage())
                    <button class="w-8 h-8 bg-white border border-slate-200 rounded flex items-center justify-center text-slate-400 opacity-50 cursor-not-allowed" disabled>
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="w-8 h-8 bg-white border border-slate-200 rounded flex items-center justify-center text-slate-600 hover:bg-exclusive hover:text-white transition-soft">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </a>
                @endif

                {{-- Elemen Nomor Halaman --}}
                @foreach ($elements as $element)
                    {{-- Pemisah Tiga Titik (...) --}}
                    @if (is_string($element))
                        <span class="w-8 h-8 bg-white border border-slate-200 rounded flex items-center justify-center text-slate-400 text-sm cursor-default">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Link Nomor Halaman --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <button class="w-8 h-8 bg-exclusive text-white rounded text-sm font-semibold cursor-default" aria-current="page">
                                    {{ $page }}
                                </button>
                            @else
                                <a href="{{ $url }}" class="w-8 h-8 bg-white border border-slate-200 rounded flex items-center justify-center text-slate-600 text-sm hover:bg-exclusive hover:text-white transition-soft">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Tombol Next (Kanan) --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="w-8 h-8 bg-white border border-slate-200 rounded flex items-center justify-center text-slate-600 hover:bg-exclusive hover:text-white transition-soft">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </a>
                @else
                    <button class="w-8 h-8 bg-white border border-slate-200 rounded flex items-center justify-center text-slate-400 opacity-50 cursor-not-allowed" disabled>
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>
                @endif
            </div>
        </div>
    </div>
@endif
