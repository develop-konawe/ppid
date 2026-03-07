@if ($paginator->hasPages())
    <ul class="mb-0  paginate  font_12 fw-bold">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="d-inline-block mt-1 mb-1">
                <span class="d-block"><i class="fa fa-chevron-left"></i></span>
            </li>
        @else
            <li class="d-inline-block mt-1 mb-1">
                <a class="d-block" href="{{ $paginator->previousPageUrl() }}">
                    <i class="fa fa-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="d-inline-block mt-1 mb-1"><span class="d-block">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="d-inline-block mt-1 mb-1">
                            <a class="d-block active">{{ $page }}</a>
                        </li>
                    @else
                        <li class="d-inline-block mt-1 mb-1">
                            <a class="d-block" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="d-inline-block mt-1 mb-1">
                <a class="d-block" href="{{ $paginator->nextPageUrl() }}">
                    <i class="fa fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="d-inline-block mt-1 mb-1">
                <span class="d-block"><i class="fa fa-chevron-right"></i></span>
            </li>
        @endif
    </ul>
@endif
