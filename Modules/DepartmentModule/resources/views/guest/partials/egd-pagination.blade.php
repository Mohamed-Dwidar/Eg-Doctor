@if ($paginator->hasPages())
    <ul class="egd-pagination">
        @if ($paginator->onFirstPage())
            <li class="disabled"><button disabled><i class="fas fa-chevron-right"></i></button></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-chevron-right"></i></a></li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a href="{{ $url }}" class="active">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-chevron-left"></i></a></li>
        @else
            <li class="disabled"><button disabled><i class="fas fa-chevron-left"></i></button></li>
        @endif
    </ul>
@endif
