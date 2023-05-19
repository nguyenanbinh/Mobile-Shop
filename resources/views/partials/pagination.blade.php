@if ($paginator->hasPages())
    <span class="store-qty">Showing {{ $paginator->count() }} product{{ $paginator->count() == 1 ? "" : "s"  }}</span>
    <ul class="store-pagination">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><i class="fa fa-angle-left"></i></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
        @endif
        {{-- \Previous --}}
        {{-- Each item per page --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- \Each item per page --}}
        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
        @else
            <li class="disabled"><i class="fa fa-angle-right"></i></li>
        @endif
        {{-- \Next --}}
    </ul>
@endif


