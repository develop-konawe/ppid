@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-btn opacity-50 cursor-not-allowed" aria-disabled="true">
                <i class="fa-solid fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn" rel="prev">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="pagination-btn opacity-50 cursor-default" aria-disabled="true">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-btn active" aria-current="page">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="pagination-btn">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn" rel="next">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        @else
            <span class="pagination-btn opacity-50 cursor-not-allowed" aria-disabled="true">
                <i class="fa-solid fa-chevron-right"></i>
            </span>
        @endif
    </nav>
@endif
