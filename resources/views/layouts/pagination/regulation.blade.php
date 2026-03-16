@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center mt-8">
        <ul class="flex items-center gap-1 md:gap-2">

            {{-- Tombol Previous (Mundur) --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed font-medium transition-soft border border-slate-100" aria-hidden="true">
                        <i class="fa-solid fa-chevron-left text-sm"></i>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-xl bg-white border border-slate-200 text-primary hover:bg-primary-subtle hover:text-primary-dark transition-soft shadow-sm hover:shadow-md hover:-translate-y-0.5" aria-label="@lang('pagination.previous')">
                        <i class="fa-solid fa-chevron-left text-sm"></i>
                    </a>
                </li>
            @endif

            {{-- Elemen Angka Halaman --}}
            @foreach ($elements as $element)

                {{-- Pemisah Tiga Titik "..." --}}
                @if (is_string($element))
                    <li aria-disabled="true">
                        <span class="inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 text-slate-500 font-bold tracking-widest">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Array Angka Halaman --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page">
                                <span class="inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-xl bg-primary text-white font-bold shadow-md shadow-primary/30 transform scale-105 transition-soft">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-xl bg-white border border-slate-200 text-slate-600 font-semibold hover:text-primary hover:bg-primary-subtle hover:border-primary-light transition-soft shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Next (Maju) --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-xl bg-white border border-slate-200 text-primary hover:bg-primary-subtle hover:text-primary-dark transition-soft shadow-sm hover:shadow-md hover:-translate-y-0.5" aria-label="@lang('pagination.next')">
                        <i class="fa-solid fa-chevron-right text-sm"></i>
                    </a>
                </li>
            @else
                <li aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed font-medium transition-soft border border-slate-100" aria-hidden="true">
                        <i class="fa-solid fa-chevron-right text-sm"></i>
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif
