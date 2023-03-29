@if ($paginator->hasPages())
    <div class="pagination">
        {{-- start of page --}}
        @if ($paginator->onFirstPage())
            <a href="#" disabled>&laquo;</a>
        @else
            <a class="active-page" href="{{ $paginator->previousPageURL() }}">&laquo;</a>
        @endif
        {{-- display number of pages --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <a href="">{{ $element }}</a>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active-page" href="#">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- go to next page --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageURL() }}">&raquo;</a>
        @else
            <a href="#">&raquo;</a>
        @endif
    </div>
@endif
