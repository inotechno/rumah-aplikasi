@if ($paginator->hasPages())
    <div class="blog-pagination">
        <ul class="justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="disabled"><a href="#">Prev</a></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}">Prev</a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a>{{ $page }}</a></li>
                        @else
                            <li class="">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}">Next</a></li>
            @else
                <li class="disabled"><a href="#">Next</a></li>
            @endif
        </ul>
    </div><!-- End blog pagination -->
@endif
